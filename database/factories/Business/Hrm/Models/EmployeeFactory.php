<?php

namespace Database\Factories\Business\Hrm\Models;

use App\Models\Org\OrgCorp;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'staff_id' => Staff::factory(),
            'org_corp_id' => OrgCorp::factory(),
            'status' => fake()->randomElement(["active","resigned","terminated","retired"]),
            'employee_no' => fake()->word(),
            'hire_date' => fake()->date(),
            'termination_date' => fake()->date(),
            'attributes' => '{}',
        ];
    }
}
