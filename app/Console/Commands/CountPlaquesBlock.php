<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Block;
use App\Traits\TracksCronJob;
use Carbon\Carbon;

class CountPlaquesBlock extends Command
{
    use TracksCronJob;

    protected $signature = 'block:count-plaques';
    protected $description = 'Count the number of plaques (markers for seats) associated with each block';

    public function handle()
    {
        $startTime = $this->startCronJob($this->signature);

        try {
            $blocks = Block::with(['seats.markers' => function ($query) {
                $query->where('plaqueable_type', 'seat');
            }])->get();

            foreach ($blocks as $block) {
                $plaqueCount = $block->seats
                    ->pluck('markers')
                    ->flatten()
                    ->count();

                $block->update(['plaques' => $plaqueCount]);
            }

            $this->completeCronJob();
        } catch (\Exception $e) {
            $this->failCronJob($e);
        }

        return 0;
    }
}
