<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Venue;
use App\Models\Stand;
use App\Models\Block;
use App\Models\Seat;
use App\Models\Marker;
use App\Models\AccessLog;
use Carbon\Carbon;

class StatsOverTimeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_correct_access_counts_over_time_for_a_given_venue()
    {
    }
}
