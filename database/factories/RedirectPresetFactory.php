<?php

namespace Database\Factories;

use App\Models\RedirectPreset;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedirectPresetFactory extends Factory
{
    protected $model = RedirectPreset::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'thumbnail' => $this->faker->imageUrl(),
            'file_name' => $this->faker->word . '.png',
        ];
    }
}