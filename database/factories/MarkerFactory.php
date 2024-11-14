<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\Marker;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkerFactory extends Factory
{
    protected $model = Marker::class;

    public function definition()
    {
        $markerableType = $this->faker->randomElement(['seat', 'block']);

        return [
            'short_code' => $this->faker->bothify('MKR-####'),
            'markerable_id' => ($markerableType === 'seat' ? Seat::factory() : Block::factory()), // Generates the appropriate ID
            'markerable_type' => $markerableType,
        ];
    }
}
