<?php

namespace Database\Factories;

use App\Models\Logo;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogoFactory extends Factory
{
    protected $model = Logo::class;

    public function definition()
    {
        return [
            'venue_id' => $this->faker->numberBetween(1, 100),
            'path' => $this->faker->imageUrl(),
        ];
    }
}