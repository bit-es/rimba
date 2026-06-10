<?php

namespace Database\Factories\Org;

use App\Models\Org\OrgUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrgTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_unit_id' => OrgUnit::factory(),
            'name' => fake()->name(),
            'code' => fake()->word(),
            'is_active' => fake()->boolean(),
            'attributes' => '{}',
        ];
    }
}
