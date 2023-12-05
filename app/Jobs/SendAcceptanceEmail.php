<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AcceptanceMail;
use Illuminate\Support\Facades\Mail;

class SendAcceptanceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmail;
    protected $firstName;
    protected $lastName;
    protected $tempPassword;

    public function __construct($userEmail, $firstName, $lastName, $tempPassword)
    {
        $this->userEmail = $userEmail;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->tempPassword = $tempPassword;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->userEmail)->send(new AcceptanceMail($this->userEmail, $this->firstName, $this->lastName, $this->tempPassword));
    }
}
