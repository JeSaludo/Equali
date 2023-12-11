<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $get_date;
    public $get_start_time;

    public $get_first_name;
    public $get_last_name; 
    public $get_location;
    /**
     * Create a new message instance.
     */
    public function __construct($get_date, $get_start_time,$get_first_name, $get_last_name, $get_location)
    {
        $this->get_date = $get_date;
        $this->get_start_time = $get_start_time;
     
        $this->get_first_name = $get_first_name;
        $this->get_last_name = $get_last_name;
        $this->get_location = $get_location;
    }  

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Schedule Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.schedule',
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
