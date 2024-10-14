<?php

namespace Database\Factories;

use App\Models\BaseUrl;
use Illuminate\Database\Eloquent\Factories\Factory;

class BaseUrlFactory extends Factory
{
    protected $model = BaseUrl::class;

    public function definition()
    {
        return [
            'url' => $this->faker->url,
        ];
    }
}