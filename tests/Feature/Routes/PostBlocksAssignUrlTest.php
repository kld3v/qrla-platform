<?php

namespace Tests\Feature\Routes;

use App\Models\BaseUrl;
use App\Models\Block;
use App\Models\Redirect;
use App\Models\Stand;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class PostBlocksAssignUrlTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $venue;
    protected $stand;
    protected $blocks;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user
        $this->user = User::factory()->create();

        // Create a venue
        $this->venue = Venue::factory()->create();

        $this->user->venues()->attach($this->venue);

        // Create a stand associated with the venue
        $this->stand = Stand::factory()->create(['venue_id' => $this->venue->id]);

        // Create blocks associated with the stand
        $this->blocks = Block::factory()->count(3)->create(['stand_id' => $this->stand->id]);

        // Act as the user
        $this->actingAs($this->user);
    }


    /** @test */
    public function test_assign_base_url_successfully()
    {
        // Create existing redirects for the blocks
        foreach ($this->blocks as $block) {
            $redirect = Redirect::factory()->create();

            $block->redirect()->associate($redirect);
            $block->save();
        }

        // Prepare data for the POST request
        $data = [
            'url' => 'https://example.com',
            'blocks' => $this->blocks->pluck('id')->toArray(),
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert the response
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'BaseUrl and associated Redirects successfully assigned to blocks',
            'base_url' => [
                'url' => 'https://example.com',
            ],
        ]);

        // Assert that the BaseUrl was created
        $this->assertDatabaseHas('base_urls', ['url' => 'https://example.com']);

        // Assert that the redirects were updated
        $baseUrl = BaseUrl::where('url', 'https://example.com')->first();

        foreach ($this->blocks as $block) {
            $block->refresh();
            $redirect = $block->redirect;
            $this->assertEquals($baseUrl->id, $redirect->base_url_id);
        }
    }

    /** @test */
    public function test_validation_fails_when_url_is_missing()
    {
        // Prepare data without 'url'
        $data = [
            'blocks' => $this->blocks->pluck('id')->toArray(),
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert validation error
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('url');
    }

    /** @test */
    public function test_validation_fails_when_url_is_invalid()
    {
        // Prepare data with invalid 'url'
        $data = [
            'url' => 'not-a-valid-url',
            'blocks' => $this->blocks->pluck('id')->toArray(),
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert validation error
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('url');
    }

    /** @test */
    public function test_validation_fails_when_blocks_are_missing()
    {
        // Prepare data without 'blocks'
        $data = [
            'url' => 'https://example.com',
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert validation error
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('blocks');
    }

    /** @test */
    public function test_validation_fails_when_blocks_are_invalid()
    {
        // Prepare data with invalid 'blocks'
        $data = [
            'url' => 'https://example.com',
            'blocks' => 'not-an-array',
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert validation error
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('blocks');
    }

    /** @test */
    public function test_validation_fails_when_blocks_contain_invalid_ids()
    {
        // Prepare data with invalid block IDs
        $data = [
            'url' => 'https://example.com',
            'blocks' => [9999, 8888],
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert validation error
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['blocks.0', 'blocks.1']);
    }

    /** @test */
    public function test_fails_with_validation_error_for_invalid_block_ids()
    {
        // Prepare data with invalid or non-existent block IDs
        $blockIds = [999, 1000]; // IDs that are unlikely to exist in the database

        $data = [
            'url' => 'https://example.com',
            'blocks' => $blockIds,
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);
        // Assert the response status for validation error
        $response->assertStatus(422);

        // Assert the structure of the validation error response
        $response->assertJsonValidationErrors([
            'blocks.0', // Validation should fail for the first invalid block ID
            'blocks.1', // Validation should fail for the second invalid block ID
        ]);
    }


    /** @test */
    public function test_fails_when_blocks_belong_to_different_venues()
    {
        // Create blocks belonging to a different venue
        $anotherVenue = Venue::factory()->create();
        $blocks = Block::factory()->count(2)->create(['stand_id' => Stand::factory()->create(['venue_id' => $anotherVenue->id])]);

        $data = [
            'url' => 'https://example.com',
            'blocks' => $blocks->pluck('id')->toArray(),
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert the response
        $response->assertStatus(403);

        $response->assertJson([
            'message' => 'Blocks do not belong to the same venue',
        ]);
    }


    /** @test */
    public function test_fails_when_user_is_not_authorized_for_the_venue()
    {
        // Create another user who does not belong to the venue
        $unauthorizedUser = User::factory()->create();

        // Act as the unauthorized user
        $this->actingAs($unauthorizedUser);

        // Prepare data
        $data = [
            'url' => 'https://example.com',
            'blocks' => $this->blocks->pluck('id')->toArray(),
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert forbidden
        $response->assertStatus(403);
    }

    /** @test */
    public function test_fails_when_blocks_array_is_empty()
    {
        // Prepare data with empty blocks array
        $data = [
            'url' => 'https://example.com',
            'blocks' => [],
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert the response
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The blocks field is required.',
        ]);
    }

    /** @test */
    public function test_validation_fails_when_blocks_contain_non_integer_values()
    {
        // Prepare data with invalid blocks
        $data = [
            'url' => 'https://example.com',
            'blocks' => ['invalid', 'values'],
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert validation errors
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['blocks.0', 'blocks.1']);
    }

    /** @test */
    public function test_fails_when_venue_does_not_exist()
    {
        // Prepare data
        $data = [
            'url' => 'https://example.com',
            'blocks' => $this->blocks->pluck('id')->toArray(),
        ];

        // Send POST request with non-existing venue ID
        $nonExistingVenueId = 9999;
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $nonExistingVenueId]), $data);

        // Assert not found
        $response->assertStatus(404);
    }

    /** @test */
    public function test_fails_when_blocks_do_not_belong_to_specified_venue()
    {
        // Create another venue
        $otherVenue = Venue::factory()->create();

        // Prepare data
        $data = [
            'url' => 'https://example.com',
            'blocks' => $this->blocks->pluck('id')->toArray(),
        ];

        // Send POST request with other venue ID
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $otherVenue->id]), $data);

        // Assert the response
        $response->assertStatus(403);
        $response->assertJson([
            'message' => 'Blocks do not belong to the same venue',
        ]);
    }

    /** @test */
    public function test_validation_fails_when_some_blocks_do_not_exist()
    {
        // Prepare data with some valid and some invalid block IDs
        $validBlockIds = $this->blocks->pluck('id')->take(2)->toArray();
        $invalidBlockIds = [9999];

        $data = [
            'url' => 'https://example.com',
            'blocks' => array_merge($validBlockIds, $invalidBlockIds),
        ];

        // Send POST request
        $response = $this->postJson(route('blocks.assignBaseUrl', ['venue' => $this->venue->id]), $data);

        // Assert validation errors
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['blocks.2']);
    }
}
