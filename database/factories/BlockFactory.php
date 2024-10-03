<?php

namespace Database\Factories;

use App\Models\Block;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stand;
use App\Models\BaseUrl;

class BlockFactory extends Factory
{
    protected $model = Block::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'stand_id' => Stand::factory(),
            'base_url_id' => BaseUrl::factory(),
        ];
    }
}