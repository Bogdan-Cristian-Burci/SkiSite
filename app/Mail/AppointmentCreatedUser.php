<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentCreatedUser extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Appointment $appointment
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Request Received - SkiUp Ski School',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment-user',
            with: [
                'appointment' => $this->appointment,
                'user' => $this->appointment->user,
                'replyTimeHours' => config('appointment.email.reply_time_hours'),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}