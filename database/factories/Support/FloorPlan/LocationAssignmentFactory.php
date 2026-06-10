<?php

namespace Database\Factories\Support\FloorPlan;

use App\Models\Support\FloorPlan\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'type' => fake()->randomElement(["primary","secondary","temporary"]),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
