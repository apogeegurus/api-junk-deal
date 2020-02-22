<?php

namespace App\Console;

use App\Console\Commands\BackupDB;
use App\Console\Commands\ClearBackups;
use App\Console\Commands\ImportSql;
use App\Console\Commands\PopulateWeather;
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
        PopulateWeather::class,
        BackupDB::class,
        ImportSql::class,
        ClearBackups::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('populate:weather')
                  ->cron('*/30 * * * *');

        $schedule->command('backup:db')
            ->daily();

        $schedule->command('clear:backups')
            ->daily();
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
