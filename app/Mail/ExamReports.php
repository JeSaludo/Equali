<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExamReports extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $last_name;
    public $tempQuestion;
    /**
     * Create a new message instance.
     */
    public function __construct($first_name,  $last_name, $tempQuestion)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->tempQuestion = $tempQuestion;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Exam Reports',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.exam-reports',
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
