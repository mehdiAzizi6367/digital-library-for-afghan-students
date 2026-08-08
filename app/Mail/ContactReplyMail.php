<?php
// app/Mail/ContactReplyMail.php

 namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;
use App\Models\ContactReply;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $reply;

    public function __construct(Contact $contact, ContactReply $reply)
    {
        $this->contact = $contact;
        $this->reply = $reply;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->reply->subject ?? 'Re: ' . $this->contact->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-reply',
        );
    }
}