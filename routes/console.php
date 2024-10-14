<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();


Schedule::command('venue:count-accesses')->dailyAt('02:00');
Schedule::command('venue:count-plaques')->dailyAt('03:00');
Schedule::command('venue:calculate-access-rate')->dailyAt('04:00');