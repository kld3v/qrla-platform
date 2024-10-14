<?php

namespace Database\Factories;

use App\Models\Stand;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;

class StandFactory extends Factory
{
    protected $model = Stand::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'venue_id' => Venue::factory(),
        ];
    }
}
