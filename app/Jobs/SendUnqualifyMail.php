<?php

namespace App\Jobs;

use App\Mail\UnqualifyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUnqualifyMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmail;
    protected $firstName;
    protected $lastName;
 

    public function __construct($userEmail,$firstName, $lastName)
    {
        $this->userEmail = $userEmail;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
      
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->userEmail)->send(new UnqualifyMail( $this->firstName,$this->lastName));
        
    }
}
