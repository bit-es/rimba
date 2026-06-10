<?php

namespace Database\Factories\Org;

use App\Models\Org\OrgCorp;
use App\Models\Org\OrgUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrgUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_corp_id' => OrgCorp::factory(),
            'parent_id' => OrgUnit::factory(),
            'name' => fake()->name(),
            'code' => fake()->word(),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
