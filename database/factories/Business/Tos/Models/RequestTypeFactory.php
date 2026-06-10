<?php

namespace Database\Factories\Business\Tos\Models;

use App\Models\Process\Workflow;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'workflow_id' => Workflow::factory(),
            'name' => fake()->name(),
            'attributes' => '{}',
        ];
    }
}
