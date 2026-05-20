<?php

namespace App\Jobs;

use App\Mail\ApplicationReply;
use App\Models\ApplicationMessage;
use App\Models\ReservationApplication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendApplicationReply implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public $backoff = [60, 180, 600]; // 1 min, 3 mins, 10 mins

    /**
     * The message instance.
     */
    public ApplicationMessage $message;

    /**
     * The application instance.
     */
    public ReservationApplication $application;

    /**
     * Create a new job instance.
     */
    public function __construct(ApplicationMessage $message, ReservationApplication $application)
    {
        $this->message = $message;
        $this->application = $application;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Generate unique message ID for this email
            $messageId = $this->generateMessageId();

            // Get previous message for In-Reply-To header
            $previousMessage = $this->application->messages()
                ->where('id', '<', $this->message->id)
                ->where('email_message_id', '!=', null)
                ->orderBy('id', 'desc')
                ->first();

            // Get all previous message IDs for References header
            $allMessageIds = $this->application->messages()
                ->where('id', '<', $this->message->id)
                ->where('email_message_id', '!=', null)
                ->pluck('email_message_id')
                ->toArray();

            // Prepare threading data
            $threadingData = [
                'message_id' => $messageId,
                'in_reply_to' => $previousMessage?->email_message_id,
                'references' => $allMessageIds,
                'application_id' => $this->application->id,
                'application_token' => $this->generateApplicationToken(),
            ];

            // Send the email
            Mail::to($this->application->email)
                ->send(new ApplicationReply($this->message, $this->application, $threadingData));

            // Update message with email headers
            $this->message->update([
                'email_message_id' => $messageId,
                'email_in_reply_to' => $threadingData['in_reply_to'],
                'email_references' => implode(' ', $threadingData['references']),
            ]);

            Log::info('Application reply sent successfully', [
                'application_id' => $this->application->id,
                'message_id' => $this->message->id,
                'to' => $this->application->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send application reply', [
                'application_id' => $this->application->id,
                'message_id' => $this->message->id,
                'error' => $e->getMessage(),
                'attempt' => $this->attempts(),
            ]);

            throw $e; // Re-throw to trigger retry
        }
    }

    /**
     * Generate a unique RFC 822 Message-ID.
     * Note: Don't include angle brackets - addIdHeader() adds them automatically
     */
    private function generateMessageId(): string
    {
        $domain = config('mail.from.address');
        $domain = substr($domain, strpos($domain, '@') + 1);

        return sprintf('%s.%s@%s', uniqid(), time(), $domain);
    }

    /**
     * Generate application token for verification.
     */
    private function generateApplicationToken(): string
    {
        $secret = config('app.email_thread_secret', env('APP_EMAIL_THREAD_SECRET', config('app.key')));
        return hash_hmac('sha256', $this->application->id . '|' . strtolower($this->application->email), $secret);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Application reply job failed permanently', [
            'application_id' => $this->application->id,
            'message_id' => $this->message->id,
            'error' => $exception->getMessage(),
        ]);

        // You could notify admins here
    }
}
