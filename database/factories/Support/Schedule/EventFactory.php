<?php

namespace Database\Factories\Support\Schedule;

use App\Models\Org\OrgCorp;
use App\Models\Org\OrgTeam;
use App\Models\Org\OrgUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_corp_id' => OrgCorp::factory(),
            'org_unit_id' => OrgUnit::factory(),
            'org_team_id' => OrgTeam::factory(),
            'type' => fake()->randomElement(["holiday","company","operational","training","maintenance","other"]),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'start_at' => fake()->dateTime(),
            'end_at' => fake()->dateTime(),
            'is_blocking' => fake()->boolean(),
            'attributes' => '{}',
        ];
    }
}
