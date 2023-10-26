<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AcceptanceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $get_user_mail;  
    public $get_first_name;
    public $get_last_name;
    public $get_user_password;
    /**
     * Create a new message instance.
     */
    public function __construct($get_user_mail, $get_first_name, $get_last_name, $get_user_password)
    {
        $this->get_user_mail = $get_user_mail;
        $this->get_first_name = $get_first_name;
        $this->get_last_name = $get_last_name;
        $this->get_user_password = $get_user_password;
    }
    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Acceptance Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.acceptance',
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
}
