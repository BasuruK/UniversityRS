<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         Commands\Inspire::class,
         Commands\TruncateTables::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        // ->everyMinute();


        $schedule->call(function () {
             
            $date = Carbon::now()->toDateString();

            $name = "Basuru Kusal";
            $email = "bestbasuru@live.com";
            
            Mail::send('email.deadlineNotification',['date' => $date],function ($message) use($name,$email) {
                $message->from('notify.urscheduler@gmail.com','Admin');
                $message->to($email,$name);
                $message->subject('Deadline Notification');
            });

        })->everyMinute();
    }
}
