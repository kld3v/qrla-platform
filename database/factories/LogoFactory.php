<?php

namespace Database\Factories;

use App\Models\Logo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;

class LogoFactory extends Factory
{
    protected $model = Logo::class;

    public function definition()
    {
        return [
            'venue_id' => Venue::factory(),
            'path' => $this->faker->imageUrl(),
        ];
    }
}