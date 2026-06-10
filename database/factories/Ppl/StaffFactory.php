<?php

namespace Database\Factories\Ppl;

use App\Models\Job\JobContract;
use App\Models\Org\OrgUnit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'org_unit_id' => OrgUnit::factory(),
            'job_contract_id' => JobContract::factory(),
            'type' => fake()->randomElement(["internal","external","contractor"]),
            'status' => fake()->randomElement(["active","inactive","suspended"]),
            'name' => fake()->name(),
            'staff_no' => fake()->word(),
            'attributes' => '{}',
        ];
    }
}
