<?php

namespace Database\Factories\Calendar;

use App\Models\Org\OrgTeam;
use App\Models\Org\OrgUnit;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_unit_id' => OrgUnit::factory(),
            'org_team_id' => OrgTeam::factory(),
            'staff_id' => Staff::factory(),
            'type' => fake()->randomElement(["fixed","rotational"]),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
