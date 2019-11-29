<?php

namespace App\Console;

use Carbon\Carbon;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if ($this->shouldRun()) {
            // auth
            $schedule->command('auth:clear-resets')->daily();
            // sitemap
            $schedule->command('sitemap:generate')->twiceDaily();
            // horizon
            $schedule->command('horizon:snapshot')->everyFiveMinutes();
            // telescope
            $schedule->command('telescope:prune')->daily();
            // stuck failed jobs notifier
            // https://github.com/Okipa/laravel-failed-jobs-notifier
            $schedule->command('queue:failed:notify')->twiceDaily(9, 15);
        }
    }

    /**
     * Scheduled commands should run or not.
     *
     * @return bool
     */
    protected function shouldRun(): bool
    {
        $shouldRun = ! $this->onScheduledDailyMaintenance();

        // $shouldRun = $shouldRun ?: // other condition;

        return $shouldRun;
    }

    /**
     * Check if we currently are in a scheduled daily maintenance period.
     *
     * @return bool
     */
    protected function onScheduledDailyMaintenance(): bool
    {
        $dailyMaintenanceStart = $this->carbonDateFromStringTime('03:30');
        $dailyMaintenanceEnd = $this->carbonDateFromStringTime('05:30');

        return Carbon::now($this->scheduleTimezone())->between($dailyMaintenanceStart, $dailyMaintenanceEnd);
    }

    /**
     * @param string $time
     *
     * @return \Carbon\Carbon
     */
    protected function carbonDateFromStringTime(string $time): Carbon
    {
        $segments = explode(':', $time);

        return Carbon::now($this->scheduleTimezone())
            ->startOfDay()
            ->hours((int) $segments[0])
            ->minutes((int) $segments[1]);
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'Europe/Paris';
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
