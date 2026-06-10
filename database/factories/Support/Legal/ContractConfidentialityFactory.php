<?php

namespace Database\Factories\Support\Legal;

use App\Models\Support\Legal\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractConfidentialityFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'contract_id' => Contract::factory(),
            'payload' => fake()->word(),
            'allowed_roles' => '{}',
            'meta' => '{}',
        ];
    }
}
