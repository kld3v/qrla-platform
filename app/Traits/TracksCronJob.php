<?php

namespace App\Traits;

use App\Models\CronJob;
use Carbon\Carbon;

trait TracksCronJob
{
    protected $cronJob;

    protected function startCronJob($name)
    {
        $startTime = Carbon::now();

        $this->cronJob = CronJob::create([
            'name'        => $name,
            'status'      => 'running',
            'started_at'  => $startTime,
        ]);

        return $startTime;
    }

    protected function completeCronJob($message = 'Completed successfully')
    {
        if ($this->cronJob) {
            $this->cronJob->update([
                'status'      => 'success',
                'ended_at'    => Carbon::now(),
                'runtime'     => $this->cronJob->started_at->diffInSeconds(Carbon::now()),
                'output'      => $message,
            ]);
        }
    }

    protected function failCronJob(\Exception $e)
    {
        if ($this->cronJob) {
            $this->cronJob->update([
                'status'        => 'failed',
                'ended_at'      => Carbon::now(),
                'runtime'       => $this->cronJob->started_at->diffInSeconds(Carbon::now()),
                'error_message' => $e->getMessage(),
            ]);
        }
    }

    protected function getLastSuccessfulCronJob($name)
    {
        return CronJob::where('name', $name)
            ->where('status', 'success')
            ->orderBy('ended_at', 'desc')
            ->first();
    }
}
