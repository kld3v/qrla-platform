<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;
use App\Models\User;
use App\Models\Venue;
use App\Models\Stand;
use App\Models\Block;
use App\Models\Redirect;
use App\Models\BaseUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Support\Facades\Log;

class GetPlaqueManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_plaque_management()
    {
        $venue = Venue::factory()->create();

        $response = $this->get("/venues/{$venue->id}/plaque-management");

        $response->assertRedirect('/login');
    }

    public function test_user_without_permission_cannot_access_plaque_management()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();

        $this->actingAs($user);

        $response = $this->get("/venues/{$venue->id}/plaque-management");

        $response->assertForbidden();
    }

    public function test_authorized_user_can_access_plaque_management()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();

        // Associate the user with the venue
        $user->venues()->attach($venue->id);

        $this->actingAs($user);

        $response = $this->get("/venues/{$venue->id}/plaque-management");

        $response->assertStatus(200);
    }

 
    public function test_authorized_user_receives_correct_data()
    {
        // Create a user and venue, log the details
        $user = User::factory()->create();
        $venue = Venue::factory()->create();

        // Attach the user to the venue
        $user->venues()->attach($venue->id);

        // Create stand and block, log the details
        $stand = Stand::factory()->create(['venue_id' => $venue->id]);
        $block = Block::factory()->create(['stand_id' => $stand->id]);

        // Create BaseUrl and Redirect, log the details
        $baseUrl = BaseUrl::factory()->create();
        $redirect = Redirect::factory()->create(['base_url_id' => $baseUrl->id]);

        // Associate the redirect with the block and save
        $block->redirect()->associate($redirect);
        $block->save();

        // Log the user authentication
        $this->actingAs($user);

        // Perform the request and log the response
        $response = $this->get("/venues/{$venue->id}/plaque-management");

        // Assert the status code
        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) use ($venue, $stand, $block, $redirect, $baseUrl) {
            $page->component('PlaqueManagement/index')
                ->where('nav', 'plaque_management')
                ->has('venue', function (Assert $pageVenue) use ($venue) {
                    $pageVenue->where('id', $venue->id)->etc();
                })
                ->has('stands', 1, function (Assert $pageStand) use ($stand, $block, $redirect, $baseUrl) {
                    $pageStand->where('id', $stand->id)
                        ->where('name', $stand->name)
                        ->where('venue_id', $stand->venue_id)
                        ->has('blocks', 1, function (Assert $pageBlock) use ($block, $redirect, $baseUrl) {
                            $pageBlock->where('id', $block->id)
                                ->where('name', $block->name)
                                ->has('redirect', function (Assert $pageRedirect) use ($redirect, $baseUrl) {
                                    $pageRedirect->where('id', $redirect->id)
                                        ->has('base_url', function (Assert $pageBaseUrl) use ($baseUrl) {
                                            $pageBaseUrl->where('id', $baseUrl->id)
                                                ->where('url', $baseUrl->url)
                                                ->etc();
                                        })
                                        ->etc();
                                })
                                ->etc();
                        })
                        ->etc();
                });
        });
    }


    public function test_venue_without_stands_returns_empty_stands()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();
        $user->venues()->attach($venue->id);

        $this->actingAs($user);

        $response = $this->get("/venues/{$venue->id}/plaque-management");

        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('PlaqueManagement/index')
                ->has('stands', 0);
        });
    }


    public function test_stand_without_blocks_returns_empty_blocks()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();
        $user->venues()->attach($venue->id);

        $stand = Stand::factory()->create(['venue_id' => $venue->id]);

        $this->actingAs($user);

        $response = $this->get("/venues/{$venue->id}/plaque-management");

        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) use ($stand) {
            $page->component('PlaqueManagement/index')
                ->has('stands', 1, function (Assert $pageStand) use ($stand) {
                    $pageStand->where('id', $stand->id)
                        ->has('blocks', 0)
                        ->etc();
                });
        });
    }

    public function test_nonexistent_venue_returns_404()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/venues/9999/plaque-management');

        $response->assertNotFound();
    }

    public function test_user_cannot_access_plaque_management_of_unauthorized_venue()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();

        $this->actingAs($user);

        $response = $this->get("/venues/{$venue->id}/plaque-management");

        $response->assertForbidden();
    }
}
