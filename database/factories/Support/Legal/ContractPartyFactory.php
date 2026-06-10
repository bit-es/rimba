<?php

namespace Database\Factories\Support\Legal;

use App\Models\Support\Legal\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractPartyFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'contract_id' => Contract::factory(),
            'role' => fake()->word(),
            'is_signatory' => fake()->boolean(),
            'notify_on_expiry' => fake()->boolean(),
            'meta' => '{}',
        ];
    }
}
