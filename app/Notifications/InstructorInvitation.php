<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InstructorInvitation extends Notification
{
    use Queueable;

    public function __construct(
        public string $temporaryPassword,
        public string $loginUrl
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to Ski Site - Instructor Invitation')
            ->line('You have been invited to join our ski school as an instructor.')
            ->line('Your account has been created with the following credentials:')
            ->line('Email: ' . $notifiable->email)
            ->line('Temporary Password: ' . $this->temporaryPassword)
            ->line('**Important:** You will be required to change your password upon first login.')
            ->action('Login to Dashboard', $this->loginUrl)
            ->line('If you have any questions, please contact our administration team.')
            ->line('Welcome aboard!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
