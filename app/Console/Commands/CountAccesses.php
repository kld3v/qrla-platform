<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Venue;
use App\Models\Block;
use App\Models\Marker;
use App\Models\AccessLog;
use App\Models\AccessCount;
use App\Traits\TracksCronJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CountAccesses extends Command
{
    use TracksCronJob;

    protected $signature = 'venue:count-accesses';
    protected $description = 'Count accesses for venues and blocks via block and seat markers';

    public function handle()
    {
        $startTime = $this->startCronJob($this->signature);

        try {
            // Get the last time this cron job ran successfully
            $lastCronJob = $this->getLastSuccessfulCronJob($this->signature);
            $lastRun = $lastCronJob ? Carbon::parse($lastCronJob->ended_at) : AccessLog::min('accessed_at') ?? Carbon::now();

            // Fetch all venues
            $venues = Venue::with([
                'stands.blocks.markers',
                'stands.blocks.seats.markers',
                'stands.blocks' => function ($query) {
                    $query->with('markers', 'seats.markers');
                },
            ])->get();

            foreach ($venues as $venue) {
                // Initialize marker ID arrays
                $venueBlockMarkerIds = [];
                $venueSeatMarkerIds = [];

                // Collect marker IDs associated with the venue
                foreach ($venue->stands as $stand) {
                    foreach ($stand->blocks as $block) {
                        // Collect block marker IDs for the venue
                        foreach ($block->markers as $marker) {
                            $venueBlockMarkerIds[] = $marker->id;
                        }

                        // Collect seat marker IDs for the venue
                        foreach ($block->seats as $seat) {
                            foreach ($seat->markers as $marker) {
                                $venueSeatMarkerIds[] = $marker->id;
                            }
                        }
                    }
                }

                // Count accesses via block markers for the venue
                $venueBlockAccessCount = AccessLog::whereIn('marker_id', $venueBlockMarkerIds)
                    ->where('accessed_at', '>=', $lastRun)
                    ->count();

                // Update or create AccessCount for venue via block markers
                $venueBlockAccessCountModel = AccessCount::firstOrCreate(
                    [
                        'countable_type' => Venue::class,
                        'countable_id'   => $venue->id,
                        'marker_type'    => 'block',
                    ],
                    ['total_count' => 0]
                );
                $venueBlockAccessCountModel->increment('total_count', $venueBlockAccessCount);

                // Count accesses via seat markers for the venue
                $venueSeatAccessCount = AccessLog::whereIn('marker_id', $venueSeatMarkerIds)
                    ->where('accessed_at', '>=', $lastRun)
                    ->count();

                // Update or create AccessCount for venue via seat markers
                $venueSeatAccessCountModel = AccessCount::firstOrCreate(
                    [
                        'countable_type' => Venue::class,
                        'countable_id'   => $venue->id,
                        'marker_type'    => 'seat',
                    ],
                    ['total_count' => 0]
                );
                $venueSeatAccessCountModel->increment('total_count', $venueSeatAccessCount);

                // Now handle each block within the venue
                foreach ($venue->stands as $stand) {
                    foreach ($stand->blocks as $block) {
                        // Initialize marker ID arrays for the block
                        $blockMarkerIds = [];
                        $blockSeatMarkerIds = [];

                        // Collect block marker IDs for the block
                        foreach ($block->markers as $marker) {
                            $blockMarkerIds[] = $marker->id;
                        }

                        // Collect seat marker IDs for the block
                        foreach ($block->seats as $seat) {
                            foreach ($seat->markers as $marker) {
                                $blockSeatMarkerIds[] = $marker->id;
                            }
                        }

                        // Count accesses via block markers for the block
                        $blockBlockAccessCount = AccessLog::whereIn('marker_id', $blockMarkerIds)
                            ->where('accessed_at', '>=', $lastRun)
                            ->count();

                        // Update or create AccessCount for block via block markers
                        $blockBlockAccessCountModel = AccessCount::firstOrCreate(
                            [
                                'countable_type' => Block::class,
                                'countable_id'   => $block->id,
                                'marker_type'    => 'block',
                            ],
                            ['total_count' => 0]
                        );
                        $blockBlockAccessCountModel->increment('total_count', $blockBlockAccessCount);

                        // Count accesses via seat markers for the block
                        $blockSeatAccessCount = AccessLog::whereIn('marker_id', $blockSeatMarkerIds)
                            ->where('accessed_at', '>=', $lastRun)
                            ->count();

                        // Update or create AccessCount for block via seat markers
                        $blockSeatAccessCountModel = AccessCount::firstOrCreate(
                            [
                                'countable_type' => Block::class,
                                'countable_id'   => $block->id,
                                'marker_type'    => 'seat',
                            ],
                            ['total_count' => 0]
                        );
                        $blockSeatAccessCountModel->increment('total_count', $blockSeatAccessCount);
                    }
                }
            }

            $this->completeCronJob();
            $this->info('Access counts have been successfully updated.');
        } catch (\Exception $e) {
            $this->failCronJob($e);
            $this->error("An error occurred: " . $e->getMessage());
        }

        return 0;
    }
}
