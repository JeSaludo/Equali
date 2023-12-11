<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduleMail;


class SendScheduleEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $email;
    protected $exam_schedule_date;
    protected $start_time;
   
    protected $first_name;
    protected $last_name;
    protected $location;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $exam_schedule_date, $start_time, $first_name, $last_name, $location)
    {
        $this->email = $email;
        $this->exam_schedule_date = $exam_schedule_date;
        $this->start_time = $start_time;
     
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->location = $location;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ScheduleMail($this->exam_schedule_date, $this->start_time, $this->first_name, $this->last_name, $this->location));
    }
}
