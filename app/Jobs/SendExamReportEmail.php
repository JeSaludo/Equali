<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ExamReports;
use Illuminate\Support\Facades\Mail;

class SendExamReportEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $defaultEmail;
    protected $firstName;
    protected $lastName;
    protected $tempQuestion;
    /**
     * Create a new message instance.
     */
    public function __construct($defaultEmail, $firstName, $lastName, $tempQuestion)
    {
        $this->defaultEmail = $defaultEmail;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->tempQuestion = $tempQuestion;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->defaultEmail)->send(new ExamReports($this->firstName, $this->lastName, $this->tempQuestion));
    
    }
}
