<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PointOfInterest>
 */
class PointOfInterestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $round_the_clock = $this->faker->boolean;

        if ($round_the_clock) {
            $opens_at = null;
            $closes_at = null;
        } else {
            $opens_at = $this->faker->time('H:i');
            $closes_at = $this->faker->time('H:i');

            if ($opens_at > $closes_at) {
                $temp = $opens_at;
                $opens_at = $closes_at;
                $closes_at = $temp;
            }
        }

        return[
            'name' => $this->faker->company(),
            'description' => $this->faker->text($maxNbChars = 200),
            'gps_lng' => $this->faker->longitude(),
            'gps_lat' => $this->faker->latitude(),
            'country' => $this->faker->country(),
            'images' => 'poi_image.jpg',
            'opens_at' => $opens_at,
            'closes_at' => $closes_at,
            'is_open_round_the_clock' => $round_the_clock,
            'is_takeaway' => $this->faker->boolean,
            'is_on_location' => $this->faker->boolean,
            'available_seats' => $this->faker->randomDigit(),
            'review_count' => 0,
        ];
    }
}
