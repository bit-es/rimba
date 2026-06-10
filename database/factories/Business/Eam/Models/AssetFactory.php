<?php

namespace Database\Factories\Business\Eam\Models;

use App\Models\Org\OrgTeam;
use App\Models\Support\FloorPlan\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_team_id' => OrgTeam::factory(),
            'location_id' => Location::factory(),
            'code' => fake()->word(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'type' => fake()->randomElement(["machine","tool","vehicle","storage","facility","other"]),
            'brand' => fake()->word(),
            'model' => fake()->word(),
            'serial_number' => fake()->word(),
            'status' => fake()->randomElement(["setup","active","maintenance","out_of_service","disposed"]),
            'attributes' => '{}',
        ];
    }
}
