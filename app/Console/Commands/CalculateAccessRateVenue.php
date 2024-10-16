<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Venue;
use App\Models\AccessLog;
use App\Traits\TracksCronJob;
use Carbon\Carbon;

class CalculateAccessRateVenue extends Command
{
    use TracksCronJob;

    protected $signature = 'venue:calculate-access-rate';
    protected $description = 'Calculate the access rate for each venue over the past week and store it';

    public function handle()
    {
        $startTime = $this->startCronJob($this->signature);

        try {
            $oneWeekAgo = Carbon::now()->subDays(7);

            $venues = Venue::all();

            foreach ($venues as $venue) {
                $markerIds = $venue->stands()
                    ->with('blocks.markers', 'blocks.seats.markers')
                    ->get()
                    ->pluck('blocks')
                    ->flatten()
                    ->flatMap(function ($block) {
                        return $block->markers->pluck('id')->merge($block->seats->flatMap->markers->pluck('id'));
                    });

                    $accessCount = AccessLog::whereIn('marker_id', $markerIds)
                    ->where('accessed_at', '>=', $oneWeekAgo)
                    ->count();

                $plaqueCount = $venue->plaques;

                $accessRate = ($plaqueCount > 0) ? ($accessCount / $plaqueCount) * 100 : 0;

                $venue->update([
                    'access_rate' => $accessRate
                ]);
            }

            $this->completeCronJob();
        } catch (\Exception $e) {
            $this->failCronJob($e);
            $this->error("An error occurred: " . $e->getMessage());
        }

        return 0;
    }
}
