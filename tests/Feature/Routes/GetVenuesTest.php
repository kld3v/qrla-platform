<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Venue;
use App\Models\Block;
use App\Models\Stand;
use App\Models\Seat;
use App\Models\Organisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class GetVenuesTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $organisation;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an organisation
        $this->organisation = Organisation::factory()->create();

        // Create a user associated with the organisation
        $this->user = User::factory()->create([
            'organisation_id' => $this->organisation->id,
        ]);

        // Authenticate the user
        $this->actingAs($this->user);
    }

    /** @test */
    public function guest_cannot_access_venues_index()
    {
        // Logout the authenticated user
        $this->get('/logout');

        $response = $this->get(route('venues.index'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function user_with_no_venues_sees_empty_venues_page()
    {
        $response = $this->get(route('venues.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Venues/index')
            ->where('venues', [])
            ->where('stats.total_venues', 0)
            ->where('stats.total_plaques', 0)
            ->where('stats.total_visits', 0)
            ->where('stats.average_access_rate', 0)
        );
    }

    /** @test */
    public function user_with_one_venue_is_redirected_to_venue_show()
    {
        // Create a venue and associate it with the user
        $venue = Venue::factory()->create([
            'organisation_id' => $this->organisation->id,
        ]);
        $this->user->venues()->attach($venue);

        $response = $this->get(route('venues.index'));

        $response->assertRedirect(route('venues.show', ['venue' => $venue->id]));
    }

    /** @test */
    public function user_with_multiple_venues_sees_venues_list_and_stats()
    {
        // Create multiple venues and associate them with the user
        $venues = Venue::factory()->count(3)->create([
            'organisation_id' => $this->organisation->id,
        ]);
        $this->user->venues()->attach($venues);

        $response = $this->get(route('venues.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Venues/index')
            ->has('venues', 3)
            ->has('stats', fn ($stats) => $stats
                ->where('total_venues', 3)
                ->etc()
            )
        );
    }

    /** @test */
    public function stats_are_calculated_correctly_for_venues()
    {
        // Create venues with specific plaques and access rates
        $venues = Venue::factory()->count(2)->sequence(
            ['plaques' => 100, 'access_rate' => 5],
            ['plaques' => 200, 'access_rate' => 10]
        )->create([
            'organisation_id' => $this->organisation->id,
        ]);

        $this->user->venues()->attach($venues);

        // Simulate access counts
        foreach ($venues as $venue) {
            $venue->accessCounts()->create([
                'total_count' => 50,
                'marker_type' => 'block',
            ]);
            $venue->accessCounts()->create([
                'total_count' => 150,
                'marker_type' => 'seat',
            ]);
        }

        $response = $this->get(route('venues.index'));

        $average_access_rate = ($venues[0]->access_rate + $venues[1]->access_rate) / 2;

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Venues/index')
            ->where('stats.total_venues', 2)
            ->where('stats.total_plaques', 300)
            ->where('stats.total_visits', 400) // 2 venues * (50 + 150)
            ->where('stats.average_access_rate', $average_access_rate)
        );
    }

    /** @test */
    public function user_only_sees_their_own_venues()
    {
        // Create a venue for another organisation
        $otherOrganisation = Organisation::factory()->create();

        $otherVenue = Venue::factory()->create([
            'organisation_id' => $otherOrganisation->id,
        ]);

        // Create a venue for the authenticated user
        $venue = Venue::factory()->create([
            'organisation_id' => $this->organisation->id,
        ]);

        $this->user->venues()->attach($venue);

        $response = $this->get(route('venues.index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('venues.show', ['venue' => $venue->id]));
    }
    /** @test */
    public function venues_are_loaded_with_required_relationships()
    {
        // Create a venue with related models
        $venue1 = Venue::factory()->create([
            'organisation_id' => $this->organisation->id,
        ]);
        $venue2 = Venue::factory()->create([
            'organisation_id' => $this->organisation->id,
        ]);

        $this->user->venues()->attach($venue1);
        $this->user->venues()->attach($venue2);

        $this->user->load('organisation', 'venues.organisation');

        // Reload the venue1 instance to ensure the relationship is loaded
        $venue1->load('organisation');

        $response = $this->get(route('venues.index'));

        $response->assertStatus(200);

        $this->assertTrue($venue1->relationLoaded('organisation'), 'Organisation relationship not loaded for venue1');
        $this->assertTrue($this->user->relationLoaded('venues'), 'Venues relationship not loaded for user');
    }

    /** @test */
    public function average_access_rate_is_calculated_correctly()
    {
        // Create venues with different access rates
        $venues = Venue::factory()->count(3)->sequence(
            ['access_rate' => 5],
            ['access_rate' => 10],
            ['access_rate' => 15]
        )->create([
            'organisation_id' => $this->organisation->id,
        ]);

        $this->user->venues()->attach($venues);

        $averageAccessRate = ($venues->sum('access_rate')) / $venues->count();

        $response = $this->get(route('venues.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Venues/index')
            ->where('stats.average_access_rate', $averageAccessRate)
        );
    }
}
