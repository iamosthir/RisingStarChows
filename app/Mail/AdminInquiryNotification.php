<?php

namespace App\Mail;

use App\Models\Pet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminInquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $sourceType,
        public string $senderName,
        public string $senderEmail,
        public string $senderPhone,
        public string $messageBody,
        public ?string $topic = null,
        public ?Pet $pet = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New ' . $this->sourceType . ' from ' . $this->senderName,
            replyTo: [new Address($this->senderEmail, $this->senderName)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-inquiry-notification',
        );
    }
}
