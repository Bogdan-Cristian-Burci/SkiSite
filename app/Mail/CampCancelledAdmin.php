<?php

namespace App\Mail;

use App\Models\Camp;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CampCancelledAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Camp $camp,
        public User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Camp Registration Cancelled - SkiUp Ski School'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.camp-cancelled-admin',
            with: [
                'camp' => $this->camp,
                'user' => $this->user,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}