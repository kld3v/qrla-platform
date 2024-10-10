<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Venue;
use App\Traits\TracksCronJob;
use Carbon\Carbon;

class CountPlaques extends Command
{
    use TracksCronJob;

    protected $signature = 'venue:count-plaques';
    protected $description = 'Count the number of plaques (markers for seats) associated with each venue';

    public function handle()
    {
        $startTime = $this->startCronJob($this->signature);

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

            $this->completeCronJob();
        } catch (\Exception $e) {
            $this->failCronJob($e);
        }

        return 0;
    }
}
