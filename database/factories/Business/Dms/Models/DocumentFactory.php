<?php

namespace Database\Factories\Business\Dms\Models;

use App\Models\Org\OrgTeam;
use App\Models\Org\OrgUnit;
use App\Models\Support\FloorPlan\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_team_id' => OrgTeam::factory(),
            'org_unit_id' => OrgUnit::factory(),
            'location_id' => Location::factory(),
            'type' => fake()->randomElement(["sop","work_instruction","policy","drawing","contract","other"]),
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
