<?php

namespace LANMS\Console;

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
        Commands\CheckLicense::class,
        Commands\DeleteExpiredSeatReservation::class,
        Commands\CleanUpActivity::class,
        \Dialect\Gdpr\Commands\AnonymizeInactiveUsers::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('lanms:checkschedule')->everyMinute();
        $schedule->command('lanms:checklicense')->twiceDaily(1, 13);
        $schedule->command('lanms:desr')->hourly();
        $schedule->command('lanms:dnau')->daily();
        $schedule->command('gdpr:anonymizeInactiveUsers')->daily();
        $schedule->command('lanms:cleanupactivity')->daily();
        $schedule->command('lanms:updatenotifications')->hourly();
        $schedule->command('lanms:checkbirthdate')->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
        $this->load(__DIR__.'/Commands');
    }
}
