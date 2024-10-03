<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    protected $model = Venue::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address_line1' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'postcode' => $this->faker->postcode,
            'type' => $this->faker->randomElement(['Sport', 'Concert Hall', 'Theatre', 'Confex']),
            'logo_url' => $this->faker->imageUrl(),
            'banner_url' => $this->faker->imageUrl(),
            'capacity' => $this->faker->numberBetween(100, 5000),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'short_description' => $this->faker->sentence,
            'long_description' => $this->faker->text,
            'contact_email' => $this->faker->safeEmail,
            'contact_phone' => $this->faker->phoneNumber,
            'management' => $this->faker->name,
        ];
    }
}