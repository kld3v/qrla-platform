<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Block;
use App\Models\AccessLog;
use App\Traits\TracksCronJob;
use Carbon\Carbon;

class CalculateAccessRateBlock extends Command
{
    use TracksCronJob;

    protected $signature = 'block:calculate-access-rate';
    protected $description = 'Calculate the access rate for each block over the past week and store it';

    public function handle()
    {
        $startTime = $this->startCronJob($this->signature);

        try {
            $oneWeekAgo = Carbon::now()->subDays(7);

            $blocks = Block::with('markers', 'seats.markers')->get();

            foreach ($blocks as $block) {
                $blockMarkerIds = $block->markers->pluck('id')->merge($block->seats->flatMap->markers->pluck('id'));

                $blockAccessCount = AccessLog::whereIn('marker_id', $blockMarkerIds)
                    ->where('accessed_at', '>=', $oneWeekAgo)
                    ->count();

                $blockPlaqueCount = $block->plaques;

                $blockAccessRate = ($blockPlaqueCount > 0) ? ($blockAccessCount / $blockPlaqueCount) * 100 : 0;

                $block->update([
                    'access_rate' => $blockAccessRate
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
