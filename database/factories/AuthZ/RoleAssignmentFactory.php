<?php

namespace Database\Factories\AuthZ;

use App\Models\AuthZ\Role;
use App\Models\Org\OrgTeam;
use App\Models\Org\OrgUnit;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'role_id' => Role::factory(),
            'staff_id' => Staff::factory(),
            'assigned_by' => Staff::factory()->create()->assigned_by,
            'org_unit_id' => OrgUnit::factory(),
            'org_team_id' => OrgTeam::factory(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
