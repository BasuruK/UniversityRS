<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Deadline;
use Illuminate\Support\Facades\Mail;

class SendDeadlineEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @param Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {
        $userData   = User::all();
        $dateData = Deadline::all()->last();
        $semester = $dateData->semester;
        $date     = $dateData->deadline;
        $year     = $dateData->year;

        foreach ($userData as $UserDetails)
        {
            $name   = $UserDetails->name;
            $email  = $UserDetails->email;

            $mailer->send('email.deadlineNotification', ['date' => $date, 'semester' => $semester, 'year' => $year], function ($message) use($name,$email) {
                $message->from('notify.urscheduler@gmail.com','Admin');
                $message->to($email,$name);
                $message->subject('Deadline Notification');
            });
        }
    }
}
