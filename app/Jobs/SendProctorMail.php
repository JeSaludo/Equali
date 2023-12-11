<?php

namespace App\Jobs;

use App\Mail\NotifyProctorMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendProctorMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lastName;
    protected $firstName;
    protected $studentLastName;
    protected $studentFirstName;
    protected $date;
    protected $startTime;
    protected $email;
    public function __construct($email,$lastName, $firstName, $studentLastName, $studentFirstName, $date, $startTime)
    {
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->studentLastName = $studentLastName;
        $this->studentFirstName = $studentFirstName;
        $this->date = $date;
        $this->startTime = $startTime;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new NotifyProctorMail($this->lastName, $this->firstName, $this->studentLastName, $this->studentFirstName, $this->date, $this->startTime));
    }
}
