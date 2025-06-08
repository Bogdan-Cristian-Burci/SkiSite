<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;
    public string $replyMessage;
    public string $replySubject;

    public function __construct(Contact $contact, string $replyMessage, string $replySubject)
    {
        $this->contact = $contact;
        $this->replyMessage = $replyMessage;
        $this->replySubject = $replySubject;
    }

    public function build()
    {
        return $this->view('emails.contact-reply')
            ->to($this->contact->email)
            ->subject($this->replySubject)
            ->with([
                'contact' => $this->contact,
                'replyMessage' => $this->replyMessage,
            ]);
    }
}