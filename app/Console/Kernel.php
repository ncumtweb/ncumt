<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\CourseRecord;
use App\Models\Course;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseReminder;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sitemap:generate')->daily();
        $schedule->command('queue:work --tries=3 --stop-when-empty')->withoutOverlapping()->everyMinute();
        $schedule->call(function () {
           $course = Course::where('date', now()->addDay()->toDateString())->first();
           if($course) {
                foreach($course->users as $user) {
                    Mail::to($user->email)->send(new CourseReminder($course, $user));
                }
           }
        })->daily()
        ->when(function () {
            $course = Course::where('date', '>', now()->toDateString())->first();
            return $course->date === now()->addDay()->toDateString();
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
