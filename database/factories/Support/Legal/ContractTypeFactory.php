<?php

namespace Database\Factories\Support\Legal;

use App\Models\Process\Workflow;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'name' => fake()->name(),
            'code' => fake()->word(),
            'description' => fake()->text(),
            'template' => fake()->text(),
            'public_schema' => '{}',
            'confidential_schema' => '{}',
            'notify' => '{}',
            'expiry_notify_days' => fake()->numberBetween(-10000, 10000),
            'requires_approval' => fake()->boolean(),
            'requires_signature' => fake()->boolean(),
            'workflow_id' => Workflow::factory(),
            'meta' => '{}',
        ];
    }
}
