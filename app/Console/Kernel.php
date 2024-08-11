<?php

namespace App\Console;

use App\Mail\Conference\ConferenceReminder;
use App\Mail\Course\CourseReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('queue:work --tries=3 --stop-when-empty')->withoutOverlapping()->everyMinute();
        $schedule->call(function () {
            CourseReminder::sendEmail();
        })->dailyAt('19:00');

        // 登山研討會前一天晚上七點發送 email 提醒報名者
        $schedule->call(function () {
            ConferenceReminder::sendEmail();
        })->dailyAt('19:00')
        ->when(function () {
            return now()->format('Y-m-d') === '2024-10-25';
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
