<?php

namespace Tests\Unit\Services\StatsOverTimeService;

use Tests\TestCase;
use App\Services\StatsOverTimeService;
use App\Models\AccessLog;
use App\Models\Venue;
use App\Models\Stand;
use App\Models\Block;
use App\Models\Marker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GetAccessesByBlockTest extends TestCase
{
    use RefreshDatabase;

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(StatsOverTimeService::class);
    }

    /** @test */
    public function it_returns_access_data_for_all_blocks_in_a_venue()
    {
        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);
        $block1 = Block::factory()->create(['stand_id' => $stand->id, 'name' => 'block1']);
        $block2 = Block::factory()->create(['stand_id' => $stand->id, 'name' => 'block2']);
        $startTime = Carbon::now()->subDay();
        $endTime = Carbon::now();

        // Create markers and access logs for block1
        $block1Marker = Marker::factory()->create([
            'markerable_id' => $block1->id,
            'markerable_type' => 'block',
        ]);

        AccessLog::factory()->count(5)->create([
            'marker_id' => $block1Marker->id,
            'accessed_at' => Carbon::now()->subHours(2),
        ]);

        // Create markers and access logs for block2
        $block2Marker = Marker::factory()->create([
            'markerable_id' => $block2->id,
            'markerable_type' => 'block',
        ]);

        AccessLog::factory()->count(3)->create([
            'marker_id' => $block2Marker->id,
            'accessed_at' => Carbon::now()->subHours(1),
        ]);

        $result = $this->service->getAccessesByBlock($venue->id, $startTime, $endTime);

        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);

        $block1Data = $result[0];
        $block2Data = $result[1];

        // Assert block data
        $this->assertEquals($block1->id, $block1Data['block_id']);
        $this->assertEquals('block1', $block1Data['block_name']);
        $this->assertEquals(5, $block1Data['access_count']);
        $this->assertEquals(round((5 / 8) * 100, 2), $block1Data['access_percent']);

        $this->assertEquals($block2->id, $block2Data['block_id']);
        $this->assertEquals('block2', $block2Data['block_name']);
        $this->assertEquals(3, $block2Data['access_count']);
        $this->assertEquals(round((3 / 8) * 100, 2), $block2Data['access_percent']);
    }

    /** @test */
    public function it_returns_zero_access_counts_when_no_logs_exist()
    {
        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);
        $block1 = Block::factory()->create(['stand_id' => $stand->id]);
        $block2 = Block::factory()->create(['stand_id' => $stand->id]);

        $startTime = Carbon::now()->subDay();
        $endTime = Carbon::now();

        $result = $this->service->getAccessesByBlock($venue->id, $startTime, $endTime);

        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);

        foreach ($result as $blockData) {
            $this->assertEquals(0, $blockData['access_count']);
            $this->assertEquals(0, $blockData['access_percent']);
        }
    }

    /** @test */
    public function it_handles_a_venue_with_no_blocks()
    {
        $venue = Venue::factory()->create();
        $startTime = Carbon::now()->subDay();
        $endTime = Carbon::now();

        $result = $this->service->getAccessesByBlock($venue->id, $startTime, $endTime);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_throws_exception_for_non_existent_venue()
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        $this->service->getAccessesByBlock(999, Carbon::now()->subDay(), Carbon::now());
    }
}
