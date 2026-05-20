<?php

namespace App\Mail;

use App\Models\ApplicationMessage;
use App\Models\ReservationApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationReply extends Mailable
{
    use Queueable, SerializesModels;

    public ApplicationMessage $adminMessage;
    public ReservationApplication $application;
    public array $threadingData;

    /**
     * Create a new message instance.
     */
    public function __construct(ApplicationMessage $message, ReservationApplication $application, array $threadingData)
    {
        $this->adminMessage = $message;
        $this->application = $application;
        $this->threadingData = $threadingData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $petName = $this->application->pet ? ($this->application->pet->call_name ?? $this->application->pet->full_name) : 'Your Application';

        return new Envelope(
            subject: "Re: Reservation Application #{$this->application->id} - {$petName}",
            replyTo: [config('mail.from.address')],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.application-reply',
            with: [
                'adminMessage' => $this->adminMessage,
                'application' => $this->application,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message with custom headers.
     */
    public function build()
    {
        return $this->withSymfonyMessage(function ($message) {
            $headers = $message->getHeaders();

            // Add Message-ID (use addIdHeader for proper email header type)
            $headers->addIdHeader('Message-ID', $this->threadingData['message_id']);

            // Add In-Reply-To if exists
            if (!empty($this->threadingData['in_reply_to'])) {
                $headers->addIdHeader('In-Reply-To', $this->threadingData['in_reply_to']);
            }

            // Add References if exists
            if (!empty($this->threadingData['references'])) {
                $references = implode(' ', $this->threadingData['references']);
                $headers->addIdHeader('References', $references);
            }

            // Add custom threading headers (text headers for custom X- headers)
            $headers->addTextHeader('X-Application-ID', (string) $this->threadingData['application_id']);
            $headers->addTextHeader('X-Application-Token', $this->threadingData['application_token']);
        });
    }
}
