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
    protected $end_time;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $exam_schedule_date, $start_time, $end_time)
    {
        $this->email = $email;
        $this->exam_schedule_date = $exam_schedule_date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ScheduleMail($this->exam_schedule_date, $this->start_time, $this->end_time));
    }
}
