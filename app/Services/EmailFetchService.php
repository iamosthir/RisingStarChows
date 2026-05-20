<?php

namespace App\Services;

use App\Models\ApplicationMessage;
use App\Models\ReservationApplication;
use Illuminate\Support\Facades\Log;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;

class EmailFetchService
{
    private const CONFIDENCE_CUSTOM_HEADER = 99;
    private const CONFIDENCE_SUBJECT_LINE = 95;
    private const CONFIDENCE_IN_REPLY_TO = 90;
    private const CONFIDENCE_EMAIL_FALLBACK = 70;

    /**
     * Fetch new emails from IMAP server.
     */
    public function fetchNewEmails(?int $applicationId = null, ?string $since = null): array
    {
        $results = [
            'fetched' => 0,
            'stored' => 0,
            'duplicates' => 0,
            'rejected' => 0,
            'errors' => [],
        ];

        try {
            $client = $this->connectToIMAP();
            $folder = $client->getFolder('INBOX');

            // Build search criteria
            $query = $folder->query()->unseen();

            if ($since) {
                $query->since(now()->parse($since));
            }

            $messages = $query->get();
            $results['fetched'] = $messages->count();

            foreach ($messages as $email) {
                try {
                    $this->processEmail($email, $applicationId, $results);
                } catch (\Exception $e) {
                    $results['errors'][] = $e->getMessage();
                    Log::error('Error processing email', [
                        'subject' => $email->getSubject(),
                        'from' => $email->getFrom(),
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        } catch (ConnectionFailedException $e) {
            $results['errors'][] = 'IMAP connection failed: ' . $e->getMessage();
            Log::error('IMAP connection failed', ['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            $results['errors'][] = 'Unexpected error: ' . $e->getMessage();
            Log::error('Unexpected error fetching emails', ['error' => $e->getMessage()]);
        }

        return $results;
    }

    /**
     * Process a single email message.
     */
    private function processEmail($email, ?int $applicationId, array &$results): void
    {
        // Parse email data
        $parsed = $this->parseEmail($email);

        // Check for duplicates
        if (ApplicationMessage::isDuplicate($parsed['message_id'])) {
            $results['duplicates']++;
            $email->setFlag('Seen');
            return;
        }

        // Match to application
        $application = $this->matchToApplication($email, $parsed, $applicationId);

        if (!$application) {
            $results['rejected']++;
            Log::warning('Could not match email to application', [
                'from' => $parsed['from'],
                'subject' => $parsed['subject'],
                'message_id' => $parsed['message_id'],
            ]);
            return;
        }

        // Verify sender email matches application
        if (!$this->verifySender($parsed['from'], $application->email)) {
            $results['rejected']++;
            Log::warning('Email sender mismatch', [
                'expected' => $application->email,
                'received' => $parsed['from'],
                'application_id' => $application->id,
            ]);
            return;
        }

        // Rate limiting check
        if ($this->isRateLimited($application)) {
            $results['rejected']++;
            Log::warning('Rate limit exceeded', [
                'application_id' => $application->id,
                'email' => $application->email,
            ]);
            return;
        }

        // Store the message
        ApplicationMessage::create([
            'reservation_application_id' => $application->id,
            'sender_type' => 'user',
            'sender_id' => null,
            'message_text' => $parsed['text'],
            'message_html' => $parsed['html'],
            'email_message_id' => $parsed['message_id'],
            'email_in_reply_to' => $parsed['in_reply_to'],
            'email_references' => $parsed['references'],
            'is_read' => false,
            'sent_at' => $parsed['date'],
        ]);

        $results['stored']++;
        $email->setFlag('Seen');

        Log::info('Email stored successfully', [
            'application_id' => $application->id,
            'from' => $parsed['from'],
            'subject' => $parsed['subject'],
        ]);
    }

    /**
     * Connect to IMAP server.
     */
    private function connectToIMAP()
    {
        $cm = new ClientManager();
        $client = $cm->make([
            'host' => config('imap.host', env('IMAP_HOST')),
            'port' => config('imap.port', env('IMAP_PORT', 993)),
            'encryption' => config('imap.encryption', env('IMAP_ENCRYPTION', 'ssl')),
            'validate_cert' => config('imap.validate_cert', env('IMAP_VALIDATE_CERT', true)),
            'username' => config('imap.username', env('IMAP_USERNAME')),
            'password' => config('imap.password', env('IMAP_PASSWORD')),
            'protocol' => config('imap.protocol', env('IMAP_PROTOCOL', 'imap')),
        ]);

        $client->connect();

        return $client;
    }

    /**
     * Parse email into structured data.
     */
    private function parseEmail($email): array
    {
        $fromAddresses = $email->getFrom();
        $from = $fromAddresses[0]->mail ?? '';

        // Get email body
        $htmlBody = $email->getHTMLBody();
        $textBody = $email->getTextBody();

        // Extract only new reply content (strip quoted text)
        $plainText = $this->extractReplyContent($textBody ?: strip_tags($htmlBody));

        // Sanitize HTML
        $sanitizedHtml = $this->sanitizeHtml($htmlBody ?: $textBody);

        return [
            'from' => strtolower($from),
            'subject' => $email->getSubject(),
            'text' => $plainText,
            'html' => $sanitizedHtml,
            'message_id' => $email->getMessageId(),
            'in_reply_to' => $email->getInReplyTo(),
            'references' => $email->getReferences(),
            'date' => $email->getDate(),
        ];
    }

    /**
     * Match email to reservation application using multi-layer strategy.
     */
    private function matchToApplication($email, array $parsed, ?int $forceApplicationId): ?ReservationApplication
    {
        // If specific application requested, use it
        if ($forceApplicationId) {
            return ReservationApplication::find($forceApplicationId);
        }

        $matches = [];

        // Layer 1: Custom header (99% confidence)
        if ($appId = $this->extractCustomHeader($email)) {
            if ($this->verifyApplicationToken($appId, $parsed['from'], $email)) {
                $matches[self::CONFIDENCE_CUSTOM_HEADER] = $appId;
            }
        }

        // Layer 2: Subject line parsing (95% confidence)
        if ($appId = $this->extractApplicationIdFromSubject($parsed['subject'])) {
            $matches[self::CONFIDENCE_SUBJECT_LINE] = $appId;
        }

        // Layer 3: In-Reply-To header (90% confidence)
        if ($parsed['in_reply_to']) {
            if ($appId = $this->matchInReplyTo($parsed['in_reply_to'])) {
                $matches[self::CONFIDENCE_IN_REPLY_TO] = $appId;
            }
        }

        // Layer 4: Email address fallback (70% confidence)
        if ($appId = $this->matchByEmailAddress($parsed['from'])) {
            $matches[self::CONFIDENCE_EMAIL_FALLBACK] = $appId;
        }

        // Use highest confidence match
        if (empty($matches)) {
            return null;
        }

        krsort($matches);
        $applicationId = reset($matches);

        return ReservationApplication::find($applicationId);
    }

    /**
     * Extract custom X-Application-ID header.
     */
    private function extractCustomHeader($email): ?int
    {
        $headers = $email->getHeaders();

        if (isset($headers['x-application-id'])) {
            return (int) $headers['x-application-id']->first();
        }

        return null;
    }

    /**
     * Verify application token from custom header.
     */
    private function verifyApplicationToken(int $appId, string $email, $emailObject): bool
    {
        $headers = $emailObject->getHeaders();

        if (!isset($headers['x-application-token'])) {
            return true; // No token to verify
        }

        $providedToken = $headers['x-application-token']->first();
        $expectedToken = $this->generateApplicationToken($appId, $email);

        return hash_equals($expectedToken, $providedToken);
    }

    /**
     * Generate application token for verification.
     */
    private function generateApplicationToken(int $appId, string $email): string
    {
        $secret = config('app.email_thread_secret', env('APP_EMAIL_THREAD_SECRET', config('app.key')));
        return hash_hmac('sha256', $appId . '|' . strtolower($email), $secret);
    }

    /**
     * Extract application ID from email subject line.
     */
    private function extractApplicationIdFromSubject(string $subject): ?int
    {
        // Pattern: "Re: Reservation Application #123 - Pet Name"
        if (preg_match('/Reservation Application #(\d+)/i', $subject, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }

    /**
     * Match email by In-Reply-To header against sent messages.
     */
    private function matchInReplyTo(string $inReplyTo): ?int
    {
        $message = ApplicationMessage::where('email_message_id', $inReplyTo)
            ->where('sender_type', 'admin')
            ->first();

        return $message?->reservation_application_id;
    }

    /**
     * Match by email address to most recent pending application.
     */
    private function matchByEmailAddress(string $email): ?int
    {
        $application = ReservationApplication::where('email', $email)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->first();

        return $application?->id;
    }

    /**
     * Verify sender email matches application email.
     */
    private function verifySender(string $emailFrom, string $applicationEmail): bool
    {
        return strtolower($emailFrom) === strtolower($applicationEmail);
    }

    /**
     * Check if application has exceeded rate limit (max 10 messages per hour).
     */
    private function isRateLimited(ReservationApplication $application): bool
    {
        $count = $application->messages()
            ->where('sender_type', 'user')
            ->where('created_at', '>=', now()->subHour())
            ->count();

        return $count >= 10;
    }

    /**
     * Extract only the new reply content, stripping quoted text.
     */
    private function extractReplyContent(string $text): string
    {
        if (empty($text)) {
            return '';
        }

        $lines = explode("\n", $text);
        $replyContent = [];
        $quoteDetected = false;

        foreach ($lines as $line) {
            $trimmedLine = trim($line);

            // Detect quote markers (common patterns)
            $isQuoted =
                // Standard email quote (>)
                str_starts_with($trimmedLine, '>') ||
                // Gmail/Outlook quote headers (On [date], [name] wrote:)
                preg_match('/^On .+wrote:$/i', $trimmedLine) ||
                // Forwarded message markers
                preg_match('/^-+\s*(Original Message|Forwarded Message)/i', $trimmedLine) ||
                // Email header lines in quotes (From:, Sent:, To:, Subject:)
                preg_match('/^(From|Sent|To|Subject|Date):/i', $trimmedLine) ||
                // Bengali/other language quote markers (তারিখে...লিখেছেন)
                preg_match('/(তারিখে|লিখেছেন|wrote)/u', $trimmedLine) ||
                // Common separator lines
                str_starts_with($trimmedLine, '---') ||
                str_starts_with($trimmedLine, '___');

            if ($isQuoted) {
                $quoteDetected = true;
                break; // Stop processing once we hit quoted content
            }

            // Add non-quoted lines to reply content
            $replyContent[] = $line;
        }

        // Join lines and trim whitespace
        $content = implode("\n", $replyContent);
        $content = trim($content);

        // Remove common email signatures
        $content = preg_replace('/\n--\s*\n.*/s', '', $content);
        $content = preg_replace('/\nSent from my .*/i', '', $content);

        return trim($content);
    }

    /**
     * Sanitize HTML content to prevent XSS.
     */
    private function sanitizeHtml(?string $html): ?string
    {
        if (!$html) {
            return null;
        }

        // Basic HTML purification - in production, use HTMLPurifier package
        $allowed = '<p><br><b><strong><i><em><u><a><ul><ol><li><blockquote>';
        return strip_tags($html, $allowed);
    }
}
