<?php

namespace App\Jobs;

use App\Services\VenueOnboardingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessVenueOnboardingJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $venueData;
    protected $filePath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $venueData, string $filePath)
    {
        $this->venueData = $venueData;
        $this->filePath  = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(VenueOnboardingService $service)
    {
        try {
            $service->onboardVenue($this->venueData, $this->filePath);
        } catch (\Exception $e) {
            \Log::error('Venue Onboarding Failed: ' . $e->getMessage());
        } finally {
            \Storage::delete($this->filePath);
        }
    }
}
