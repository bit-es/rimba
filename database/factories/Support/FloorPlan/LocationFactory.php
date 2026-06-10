<?php

namespace Database\Factories\Support\FloorPlan;

use App\Models\Org\OrgCorp;
use App\Models\Support\FloorPlan\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'parent_id' => Location::factory(),
            'org_corp_id' => OrgCorp::factory(),
            'type' => fake()->randomElement(["site","building","area","section","room","zone","other"]),
            'name' => fake()->name(),
            'attributes' => '{}',
        ];
    }
}
