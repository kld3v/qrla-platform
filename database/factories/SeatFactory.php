<?php

namespace Database\Factories;

use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Block;

class SeatFactory extends Factory
{
    protected $model = Seat::class;

    public function definition()
    {
        return [
            'block_id' => Block::factory(),
            'row' => $this->faker->randomLetter,
            'seat_number' => $this->faker->numberBetween(1, 100),
        ];
    }
}