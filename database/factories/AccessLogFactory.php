<?php

namespace Database\Factories;

use App\Models\AccessLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessLogFactory extends Factory
{
    protected $model = AccessLog::class;

    public function definition()
    {
        return [
            'marker_id' => $this->faker->randomDigit,
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'os' => $this->faker->word,
            'device' => $this->faker->word,
            'country' => $this->faker->country,
            'browser' => $this->faker->word,
            'language' => $this->faker->languageCode,
            'referrer' => $this->faker->url,
            'accessed_at' => $this->faker->dateTime,
        ];
    }
}