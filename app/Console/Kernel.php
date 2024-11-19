<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SetupPermitsSystem;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SetupPermitsSystem::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Here you can define your scheduled commands
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
