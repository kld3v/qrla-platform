<?php

namespace Database\Factories;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedirectFactory extends Factory
{
    protected $model = Redirect::class;

    public function definition()
    {
        return [
            'base_url_id' => $this->faker->numberBetween(1, 100),
            'logo_id' => $this->faker->numberBetween(1, 100),
            'redirect_preset_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}