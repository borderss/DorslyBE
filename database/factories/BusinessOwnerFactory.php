<?php

namespace Database\Factories;

use App\Models\BusinessOwner;
use App\Models\PointOfInterest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BusinessOwnerFactory extends Factory
{
    protected $model = BusinessOwner::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'point_of_interest_id' => PointOfInterest::factory(),
            'user_id' => User::factory(),
        ];
    }
}
