<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Venue;
use App\Models\CronJob;
use Carbon\Carbon;

class CountPlaques extends Command
{
    protected $signature = 'venue:count-plaques';
    protected $description = 'Count the number of plaques (markers for seats) associated with each venue';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $startTime = Carbon::now();
        $cronJob = CronJob::create([
            'name' => $this->signature,
            'started_at' => $startTime,
            'status' => 'running'
        ]);

        try {
            $venues = Venue::all();

            foreach ($venues as $venue) {
                $plaqueCount = $venue->stands()
                    ->with(['blocks.seats' => function ($query) {
                        $query->with('markers');
                    }])
                    ->get()
                    ->pluck('blocks')
                    ->flatten()
                    ->pluck('seats')
                    ->flatten()
                    ->pluck('markers')
                    ->flatten()
                    ->count();

                $venue->update(['plaques' => $plaqueCount]);
            }

            $cronJob->update([
                'status' => 'success',
                'completed_at' => Carbon::now(),
                'runtime' => $startTime->diffInSeconds(Carbon::now()),
            ]);
        } catch (\Exception $e) {
            $cronJob->update([
                'status' => 'failed',
                'completed_at' => Carbon::now(),
                'runtime' => $startTime->diffInSeconds(Carbon::now()),
                'error_message' => $e->getMessage(),
            ]);
        }

        return 0;
    }
}
