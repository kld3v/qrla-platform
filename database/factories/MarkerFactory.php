<?php

namespace Database\Factories;

use App\Models\Marker;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkerFactory extends Factory
{
    protected $model = Marker::class;

    public function definition()
    {
        return [
            'short_code' => $this->faker->bothify('MKR-####'),
            'markerable_id' => $this->faker->numberBetween(1, 100),
            'markerable_type' => $this->faker->randomElement(['block', 'seat']),
        ];
    }
}