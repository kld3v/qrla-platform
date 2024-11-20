<?php

namespace Tests\Unit\Services\StatsOverTimeService;

use Tests\TestCase;
use App\Services\StatsOverTimeService;
use App\Models\AccessLog;
use App\Models\Venue;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Exception;

class GetAccessesOverTimeTests extends TestCase
{
    use RefreshDatabase;

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(StatsOverTimeService::class);
    }

    /** @test */
    public function it_returns_access_counts_for_venue_with_valid_venue_id()
    {
        $venue = Venue::factory()->create();
        $startTime = Carbon::now()->subDay();
        $endTime = Carbon::now();

        AccessLog::factory()->count(5)->create([
            'marker_id' => $this->getVenueMarkerId($venue),
            'accessed_at' => Carbon::now()->subHour(),
        ]);

        $result = $this->service->getAccessesOverTime('venue', $venue->id, $startTime, $endTime);

        $this->assertNotEmpty($result);
        $this->assertEquals(5, array_sum(array_column($result, 'total_access_count')));
    }

    /** @test */
    public function it_returns_access_counts_for_block_with_valid_block_id()
    {
        $block = Block::factory()->create();
        $startTime = Carbon::now()->subDay();
        $endTime = Carbon::now();

        AccessLog::factory()->count(3)->create([
            'marker_id' => $this->getBlockMarkerId($block),
            'accessed_at' => Carbon::now()->subHour(),
        ]);

        $result = $this->service->getAccessesOverTime('block', $block->id, $startTime, $endTime);

        $this->assertNotEmpty($result);
        $this->assertEquals(3, array_sum(array_column($result, 'total_access_count')));
    }

    /** @test */
    public function it_handles_different_time_intervals_correctly()
    {
        $venue = Venue::factory()->create();
        $intervals = [
            'minute' => [Carbon::now()->subMinute(), Carbon::now()],
            'hour' => [Carbon::now()->subHour(), Carbon::now()],
            'day' => [Carbon::now()->subDay(), Carbon::now()],
            'week' => [Carbon::now()->subWeek(), Carbon::now()],
        ];

        foreach ($intervals as $interval) {
            [$startTime, $endTime] = $interval;
            $result = $this->service->getAccessesOverTime('venue', $venue->id, $startTime, $endTime);

            $this->assertIsArray($result);
        }
    }

    /** @test */
    public function it_returns_zero_counts_when_no_logs_within_time_range()
    {
        $venue = Venue::factory()->create();
        $startTime = Carbon::now()->subDay();
        $endTime = Carbon::now()->subHours(23);

        $result = $this->service->getAccessesOverTime('venue', $venue->id, $startTime, $endTime);

        foreach ($result as $data) {
            $this->assertEquals(0, $data['total_access_count']);
        }
    }

    /** @test */
    public function it_throws_exception_for_invalid_type()
    {
        $this->expectException(Exception::class);
        $this->service->getAccessesOverTime('invalidType', 1, Carbon::now()->subDay(), Carbon::now());
    }

    /** @test */
    public function it_handles_non_existent_id()
    {
        $this->expectException(Exception::class);
        $this->service->getAccessesOverTime('venue', 999, Carbon::now()->subDay(), Carbon::now());
    }

    // Helper functions to get marker IDs
    protected function getVenueMarkerId($venue)
    {
        return $venue->markers()->first()->id ?? 1;
    }

    protected function getBlockMarkerId($block)
    {
        return $block->markers()->first()->id ?? 1;
    }
}
