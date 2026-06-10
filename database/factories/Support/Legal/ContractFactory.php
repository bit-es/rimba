<?php

namespace Database\Factories\Support\Legal;

use App\Models\Org\OrgCorp;
use App\Models\Support\Legal\ContractType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'contract_type_id' => ContractType::factory(),
            'org_corp_id' => OrgCorp::factory(),
            'contract_no' => fake()->word(),
            'title' => fake()->sentence(4),
            'summary' => fake()->text(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'renewal_date' => fake()->date(),
            'status' => fake()->randomElement(["draft","pending","active","expired","terminated","archived"]),
            'terms' => '{}',
            'meta' => '{}',
        ];
    }
}
