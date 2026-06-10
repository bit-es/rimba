<?php

namespace Database\Factories\Job;

use App\Models\Org\OrgTeam;
use App\Models\Org\OrgUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobContractFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'org_unit_id' => OrgUnit::factory(),
            'org_team_id' => OrgTeam::factory(),
            'type' => fake()->randomElement(["permanent","contract","temporary","outsource"]),
            'status' => fake()->randomElement(["draft","active","on_hold","closed"]),
            'position_limit' => fake()->numberBetween(-10000, 10000),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
