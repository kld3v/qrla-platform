<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Venue;
use App\Models\AccessLog;
use App\Models\CronJob;
use Carbon\Carbon;

class CountAccesses extends Command
{
    protected $signature = 'venue:count-accesses';
    protected $description = 'Count the total number of accesses for each venue since the last cron run and update the venue table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $startTime = Carbon::now();

        $cronJob = CronJob::create([
            'name'        => 'venue:count-accesses',
            'status'      => 'running',
            'started_at'  => $startTime,
        ]);

        try {
            $lastCronJob = CronJob::where('name', 'venue:count-accesses')
                ->where('status', 'success')
                ->orderBy('ended_at', 'desc')
                ->first();

            $lastRun = $lastCronJob ? Carbon::parse($lastCronJob->ended_at) : AccessLog::min('accessed_at') ?? Carbon::now();

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

                $newAccessCount = AccessLog::whereIn('marker_id', $markerIds)
                    ->where('accessed_at', '>=', $lastRun)
                    ->count();

                $venue->increment('accesses', $newAccessCount);
            }

            $cronJob->update([
                'status'      => 'success',
                'ended_at'    => Carbon::now(),
                'runtime'     => $startTime->diffInSeconds(Carbon::now()),
                'output'      => 'Access counts updated successfully',
            ]);
        } catch (\Exception $e) {
            $cronJob->update([
                'status'        => 'failed',
                'ended_at'      => Carbon::now(),
                'runtime'       => $startTime->diffInSeconds(Carbon::now()),
                'error_message' => $e->getMessage(),
            ]);

            $this->error("An error occurred: " . $e->getMessage());
        }

        return 0;
    }
}
