<?php

namespace Tests\Unit\Services\StatsOverTimeService;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\StatsOverTimeService;
use App\Models\Venue;
use App\Models\Stand;
use App\Models\Block;
use App\Models\Seat;
use App\Models\Marker;
use App\Models\AccessLog;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TestableStatsOverTimeService extends StatsOverTimeService {
    public function generateTimeGroups($startTime, $endTime, $interval) {
        return parent::generateTimeGroups($startTime, $endTime, $interval);
    }
    public function determineInterval($startTime, $endTime) {
        return parent::determineInterval($startTime, $endTime);
    }
    public function getSeatMarkerIdsForVenue($venue) {
        return parent::getSeatMarkerIdsForVenue($venue);
    }
    public function getBlockMarkerIdsForVenue($venue) {
        return parent::getBlockMarkerIdsForVenue($venue);
    }
    public function getSeatMarkerIdsForBlock($block) {
        return parent::getSeatMarkerIdsForBlock($block);
    }
    public function getMarkerIdsForVenue($venue) {
        return parent::getMarkerIdsForVenue($venue);
    }
    public function getMarkerIdsForBlock($block) {
        return parent::getMarkerIdsForBlock($block);
    }
    public function getAccessCountsOverTime($markerIds, $interval, $startTime, $endTime) {
        return parent::getAccessCountsOverTime($markerIds, $interval, $startTime, $endTime);
    }
}

class HelperFunctionTests extends TestCase
{
    use RefreshDatabase;

    //generateTimeGroups
    public function testGenerateTimeGroupsWithMinuteInterval()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-11-13 12:00:00';
        $endTime = '2024-11-13 12:10:00';
        $interval = ['unit' => 'minute', 'format' => 'Y-m-d H:i'];

        $result = $service->generateTimeGroups($startTime, $endTime, $interval);

        $expected = [
            '2024-11-13 12:00',
            '2024-11-13 12:01',
            '2024-11-13 12:02',
            '2024-11-13 12:03',
            '2024-11-13 12:04',
            '2024-11-13 12:05',
            '2024-11-13 12:06',
            '2024-11-13 12:07',
            '2024-11-13 12:08',
            '2024-11-13 12:09',
            '2024-11-13 12:10',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateTimeGroupsWithHourInterval()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-11-13 08:00:00';
        $endTime = '2024-11-13 12:00:00';
        $interval = ['unit' => 'hour', 'format' => 'Y-m-d H:i'];

        $result = $service->generateTimeGroups($startTime, $endTime, $interval);

        $expected = [
            '2024-11-13 08:00',
            '2024-11-13 09:00',
            '2024-11-13 10:00',
            '2024-11-13 11:00',
            '2024-11-13 12:00',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateTimeGroupsWithDayInterval()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-11-10';
        $endTime = '2024-11-13';
        $interval = ['unit' => 'day', 'format' => 'Y-m-d'];

        $result = $service->generateTimeGroups($startTime, $endTime, $interval);

        $expected = [
            '2024-11-10',
            '2024-11-11',
            '2024-11-12',
            '2024-11-13',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateTimeGroupsWithInvalidInterval()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid interval unit.');

        $service = new TestableStatsOverTimeService();

        $startTime = '2024-11-13 08:00:00';
        $endTime = '2024-11-13 12:00:00';
        $interval = ['unit' => 'invalid', 'format' => 'Y-m-d H:i'];

        $service->generateTimeGroups($startTime, $endTime, $interval);
    }

    public function testGenerateTimeGroupsWithMonthInterval()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-01-01';
        $endTime = '2024-05-01';
        $interval = ['unit' => 'month', 'format' => 'Y-m'];

        $result = $service->generateTimeGroups($startTime, $endTime, $interval);

        $expected = [
            '2024-01',
            '2024-02',
            '2024-03',
            '2024-04',
            '2024-05',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGenerateTimeGroupsWithYearInterval()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2020-01-01';
        $endTime = '2024-01-01';
        $interval = ['unit' => 'year', 'format' => 'Y'];

        $result = $service->generateTimeGroups($startTime, $endTime, $interval);

        $expected = [
            '2020',
            '2021',
            '2022',
            '2023',
            '2024',
        ];

        $this->assertEquals($expected, $result);
    }

    //determineInterval
    public function testDetermineIntervalWithinOneHour()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-11-13 12:00:00';
        $endTime = '2024-11-13 12:30:00'; // 30 minutes difference

        $result = $service->determineInterval($startTime, $endTime);
        $expected = ['unit' => 'minute', 'format' => '%Y-%m-%d %H:%i'];

        $this->assertEquals($expected, $result);
    }

    public function testDetermineIntervalWithinOneDay()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-11-13 00:00:00';
        $endTime = '2024-11-13 12:00:00'; // 12 hours difference

        $result = $service->determineInterval($startTime, $endTime);
        $expected = ['unit' => 'hour', 'format' => '%Y-%m-%d %H:00'];

        $this->assertEquals($expected, $result);
    }

    public function testDetermineIntervalWithinOneWeek()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-11-01';
        $endTime = '2024-11-07'; // 6 days difference

        $result = $service->determineInterval($startTime, $endTime);
        $expected = ['unit' => 'day', 'format' => '%Y-%m-%d'];

        $this->assertEquals($expected, $result);
    }

    public function testDetermineIntervalWithinOneMonth()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-10-01';
        $endTime = '2024-10-28'; // 27 days difference

        $result = $service->determineInterval($startTime, $endTime);
        $expected = ['unit' => 'day', 'format' => '%Y-%m-%d'];

        $this->assertEquals($expected, $result);
    }

    public function testDetermineIntervalWithinOneYear()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2024-01-01';
        $endTime = '2024-10-01'; // 9 months difference

        $result = $service->determineInterval($startTime, $endTime);
        $expected = ['unit' => 'month', 'format' => '%Y-%m'];

        $this->assertEquals($expected, $result);
    }

    public function testDetermineIntervalGreaterThanOneYear()
    {
        $service = new TestableStatsOverTimeService();

        $startTime = '2022-01-01';
        $endTime = '2024-01-01'; // 2 years difference

        $result = $service->determineInterval($startTime, $endTime);
        $expected = ['unit' => 'year', 'format' => '%Y'];

        $this->assertEquals($expected, $result);
    }


    //getSeatMarkerIdsForVenue
    /** @test */
    public function it_returns_empty_array_for_venue_with_no_seats()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();

        $result = $service->getSeatMarkerIdsForVenue($venue);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_single_seat_marker_id_for_venue_with_one_seat_marker()
    {
        $service = new TestableStatsOverTimeService();


        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);
        $block = Block::factory()->create(['stand_id' => $stand->id]);
        $seat = Seat::factory()->create(['block_id' => $block->id]);
        $marker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);

        $result = $service->getSeatMarkerIdsForVenue($venue);

        $this->assertEquals([$marker->id], $result);
    }

    /** @test */
    public function it_returns_all_seat_marker_ids_for_venue_with_multiple_blocks_and_seat_markers()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);

        $block1 = Block::factory()->create(['stand_id' => $stand->id]);
        $block2 = Block::factory()->create(['stand_id' => $stand->id]);

        $seat1 = Seat::factory()->create(['block_id' => $block1->id]);
        $seat2 = Seat::factory()->create(['block_id' => $block2->id]);

        $marker1 = Marker::factory()->create(['markerable_id' => $seat1->id, 'markerable_type' => 'seat']);
        $marker2 = Marker::factory()->create(['markerable_id' => $seat2->id, 'markerable_type' => 'seat']);


        $result = $service->getSeatMarkerIdsForVenue($venue);


        $this->assertEqualsCanonicalizing([$marker1->id, $marker2->id], $result);
    }


    /** @test */
    public function it_returns_only_seat_marker_ids_for_venue_with_mixed_marker_types()
    {

        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);

        $block = Block::factory()->create(['stand_id' => $stand->id]);
        
        // Create a seat marker
        $seat = Seat::factory()->create(['block_id' => $block->id]);
        $seatMarker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);

        // Create a block marker (not a seat marker)
        $blockMarker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        $result = $service->getSeatMarkerIdsForVenue($venue);

        $this->assertEquals([$seatMarker->id], $result);
        $this->assertNotContains($blockMarker->id, $result);
    }


    //getBlockMarkerIdsForVenue
    /** @test */
    public function it_returns_empty_array_for_venue_with_no_blocks()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();

        $result = $service->getBlockMarkerIdsForVenue($venue);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_single_block_marker_id_for_venue_with_one_block_marker()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);
        $block = Block::factory()->create(['stand_id' => $stand->id]);
        $marker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        $result = $service->getBlockMarkerIdsForVenue($venue);

        $this->assertEquals([$marker->id], $result);
    }

    /** @test */
    public function it_returns_all_block_marker_ids_for_venue_with_multiple_stands_and_blocks()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);

        $block1 = Block::factory()->create(['stand_id' => $stand->id]);
        $block2 = Block::factory()->create(['stand_id' => $stand->id]);

        $marker1 = Marker::factory()->create(['markerable_id' => $block1->id, 'markerable_type' => 'block']);
        $marker2 = Marker::factory()->create(['markerable_id' => $block2->id, 'markerable_type' => 'block']);

        $result = $service->getBlockMarkerIdsForVenue($venue);

        $this->assertEqualsCanonicalizing([$marker1->id, $marker2->id], $result);
    }

    /** @test */
    public function it_returns_only_block_marker_ids_for_venue_with_mixed_marker_types()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);

        $block = Block::factory()->create(['stand_id' => $stand->id]);

        // Create a block marker
        $blockMarker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        // Create a seat marker (not a block marker)
        $seat = Seat::factory()->create(['block_id' => $block->id]);
        $seatMarker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);

        $result = $service->getBlockMarkerIdsForVenue($venue);

        $this->assertEquals([$blockMarker->id], $result);
        $this->assertNotContains($seatMarker->id, $result);
    }

    //getSeatMarkerIdsForBlock
    /** @test */
    public function it_returns_empty_array_for_block_with_no_seat_markers()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();

        $result = $service->getSeatMarkerIdsForBlock($block);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_single_seat_marker_id_for_block_with_one_seat_marker()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();
        $seat = Seat::factory()->create(['block_id' => $block->id]);
        $marker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);

        $result = $service->getSeatMarkerIdsForBlock($block);

        $this->assertEquals([$marker->id], $result);
    }

    /** @test */
    public function it_returns_all_seat_marker_ids_for_block_with_multiple_seat_markers()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();
        $seat1 = Seat::factory()->create(['block_id' => $block->id]);
        $seat2 = Seat::factory()->create(['block_id' => $block->id]);

        $marker1 = Marker::factory()->create(['markerable_id' => $seat1->id, 'markerable_type' => 'seat']);
        $marker2 = Marker::factory()->create(['markerable_id' => $seat2->id, 'markerable_type' => 'seat']);

        $result = $service->getSeatMarkerIdsForBlock($block);

        $this->assertEqualsCanonicalizing([$marker1->id, $marker2->id], $result);
    }

    /** @test */
    public function it_returns_only_seat_marker_ids_for_block_with_mixed_marker_types()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();
        $seat = Seat::factory()->create(['block_id' => $block->id]);
        $seatMarker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);
        $blockMarker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        $result = $service->getSeatMarkerIdsForBlock($block);

        $this->assertEquals([$seatMarker->id], $result);
        $this->assertNotContains($blockMarker->id, $result);
    }


    //getMarkerIdsForVenue
    /** @test */
    public function it_returns_empty_array_for_venue_with_no_markers()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();

        $result = $service->getMarkerIdsForVenue($venue);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_both_seat_and_block_marker_ids_for_venue_with_mixed_markers()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);
        $block = Block::factory()->create(['stand_id' => $stand->id]);

        $seat = Seat::factory()->create(['block_id' => $block->id]);
        $seatMarker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);
        $blockMarker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        $result = $service->getMarkerIdsForVenue($venue);

        $this->assertEqualsCanonicalizing([$seatMarker->id, $blockMarker->id], $result);
    }

    /** @test */
    public function it_returns_only_block_marker_ids_for_venue_with_only_block_markers()
    {
        $service = new TestableStatsOverTimeService();

        $venue = Venue::factory()->create();
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);
        $block = Block::factory()->create(['stand_id' => $stand->id]);

        $blockMarker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        $result = $service->getMarkerIdsForVenue($venue);

        $this->assertEquals([$blockMarker->id], $result);
    }

    //getMarkerIdsForBlock
    /** @test */
    public function it_returns_empty_array_for_block_with_no_markers()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();

        $result = $service->getMarkerIdsForBlock($block);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_both_seat_and_block_marker_ids_for_block_with_mixed_markers()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();
        $seat = Seat::factory()->create(['block_id' => $block->id]);

        $seatMarker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);
        $blockMarker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        $result = $service->getMarkerIdsForBlock($block);

        $this->assertEqualsCanonicalizing([$seatMarker->id, $blockMarker->id], $result);
    }

    /** @test */
    public function it_returns_only_seat_marker_ids_for_block_with_only_seat_markers()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();
        $seat = Seat::factory()->create(['block_id' => $block->id]);
        $seatMarker = Marker::factory()->create(['markerable_id' => $seat->id, 'markerable_type' => 'seat']);

        $result = $service->getMarkerIdsForBlock($block);

        $this->assertEquals([$seatMarker->id], $result);
    }

    /** @test */
    public function it_returns_only_block_marker_ids_for_block_with_only_block_markers()
    {
        $service = new TestableStatsOverTimeService();

        $block = Block::factory()->create();
        $blockMarker = Marker::factory()->create(['markerable_id' => $block->id, 'markerable_type' => 'block']);

        $result = $service->getMarkerIdsForBlock($block);

        $this->assertEquals([$blockMarker->id], $result);
    }

    //getAccessCountsOverTime
    /** @test */
    public function it_returns_empty_array_when_marker_ids_is_empty()
    {
        $service = new TestableStatsOverTimeService();
        $result = $service->getAccessCountsOverTime([], ['format' => '%Y-%m-%d'], now()->subDays(7), now());

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_empty_array_when_no_access_logs_exist_within_time_range()
    {
        $service = new TestableStatsOverTimeService();

        // Create markers but no access logs within the time range
        $markers = Marker::factory()->count(3)->create();
        $markerIds = $markers->pluck('id')->toArray();

        $startTime = now()->subDays(7);
        $endTime = now();

        $result = $service->getAccessCountsOverTime($markerIds, ['format' => '%Y-%m-%d'], $startTime, $endTime);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_access_counts_grouped_by_day_for_a_given_time_range()
    {
        $service = new TestableStatsOverTimeService();

        // Create markers
        $markers = Marker::factory()->count(2)->create();
        $markerIds = $markers->pluck('id')->toArray();

        $startTime = now()->startOfDay()->subDays(3);
        $endTime = now()->endOfDay();

        // Simulate access logs for the past three days
        AccessLog::factory()->create(['marker_id' => $markerIds[0], 'accessed_at' => $startTime->copy()->addDays(1)]);
        AccessLog::factory()->create(['marker_id' => $markerIds[1], 'accessed_at' => $startTime->copy()->addDays(1)]);
        AccessLog::factory()->create(['marker_id' => $markerIds[0], 'accessed_at' => $startTime->copy()->addDays(2)]);
        AccessLog::factory()->create(['marker_id' => $markerIds[1], 'accessed_at' => $startTime->copy()->addDays(3)]);

        $result = $service->getAccessCountsOverTime($markerIds, ['format' => '%Y-%m-%d'], $startTime, $endTime);

        $expected = [
            $startTime->copy()->addDays(1)->format('Y-m-d') => 2,
            $startTime->copy()->addDays(2)->format('Y-m-d') => 1,
            $startTime->copy()->addDays(3)->format('Y-m-d') => 1,
        ];

        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function it_returns_access_counts_grouped_by_hour_for_a_given_time_range()
    {
        $service = new TestableStatsOverTimeService();

        // Create marker
        $marker = Marker::factory()->create();
        $markerIds = [$marker->id];

        $startTime = now()->startOfDay();
        $endTime = now()->endOfDay();

        // Simulate hourly access logs for a single day
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addHours(1)]);
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addHours(1)]);
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addHours(2)]);
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addHours(3)]);

        $result = $service->getAccessCountsOverTime($markerIds, ['format' => '%H:%i'], $startTime, $endTime);

        $expected = [
            $startTime->copy()->addHours(1)->format('H:i') => 2,
            $startTime->copy()->addHours(2)->format('H:i') => 1,
            $startTime->copy()->addHours(3)->format('H:i') => 1,
        ];

        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function it_excludes_access_logs_outside_of_the_given_time_range()
    {
        $service = new TestableStatsOverTimeService();
    
        // Create markers
        $markers = Marker::factory()->count(2)->create();
        $markerIds = $markers->pluck('id')->toArray();
    
        $startTime = now()->subDays(3)->startOfDay();
        $endTime = now()->subDays(1)->endOfDay();
    
        // Simulate access logs on different dates within the time range
        AccessLog::factory()->create(['marker_id' => $markerIds[0], 'accessed_at' => $startTime->copy()->addDay()]);
        AccessLog::factory()->create(['marker_id' => $markerIds[0], 'accessed_at' => now()]); // outside the range
        AccessLog::factory()->create(['marker_id' => $markerIds[1], 'accessed_at' => $endTime->copy()->subDay()]);
        AccessLog::factory()->create(['marker_id' => $markerIds[1], 'accessed_at' => now()->subDays(4)]); // outside the range
    
        $result = $service->getAccessCountsOverTime($markerIds, ['format' => '%Y-%m-%d'], $startTime, $endTime);
    
        $expected = [
            $startTime->copy()->addDay()->format('Y-m-d') => 1,
            $endTime->copy()->subDay()->format('Y-m-d') => 1,
        ];
    
        $this->assertEquals($expected, $result);
    }
    

    /** @test */
    public function it_handles_different_date_intervals_correctly()
    {
        $service = new TestableStatsOverTimeService();

        // Create marker
        $marker = Marker::factory()->create();
        $markerIds = [$marker->id];

        $startTime = now()->subMonths(1)->startOfMonth();
        $endTime = now()->subMonths(1)->endOfMonth();

        // Simulate multiple access logs on different dates within the month
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addDays(3)]);
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addDays(10)]);
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addDays(15)]);
        AccessLog::factory()->create(['marker_id' => $marker->id, 'accessed_at' => $startTime->copy()->addDays(25)]);

        $result = $service->getAccessCountsOverTime($markerIds, ['format' => '%Y-%m-%d'], $startTime, $endTime);

        $expected = [
            $startTime->copy()->addDays(3)->format('Y-m-d') => 1,
            $startTime->copy()->addDays(10)->format('Y-m-d') => 1,
            $startTime->copy()->addDays(15)->format('Y-m-d') => 1,
            $startTime->copy()->addDays(25)->format('Y-m-d') => 1,
        ];

        $this->assertEquals($expected, $result);
    }

}