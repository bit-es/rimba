<?php

namespace Database\Factories\AuthZ;

use App\Models\AuthZ\Role;
use App\Models\Job\JobContract;
use App\Models\Job\JobPosition;
use App\Models\Job\JobRole;
use App\Models\Org\OrgCorp;
use App\Models\Org\OrgTeam;
use App\Models\Org\OrgUnit;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'staff_id' => Staff::factory(),
            'role_id' => Role::factory(),
            'org_corp_id' => OrgCorp::factory(),
            'org_unit_id' => OrgUnit::factory(),
            'org_team_id' => OrgTeam::factory(),
            'job_position_id' => JobPosition::factory(),
            'job_role_id' => JobRole::factory(),
            'job_contract_id' => JobContract::factory(),
            'source' => fake()->randomElement(["auto","manual"]),
            'status' => fake()->randomElement(["active","inactive"]),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
