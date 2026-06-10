<?php

namespace Database\Factories\Job;

use App\Models\Job\JobContract;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPositionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job_contract_id' => JobContract::factory(),
            'level' => fake()->randomElement(["junior","mid","senior","lead","manager"]),
            'status' => fake()->randomElement(["open","filled","closed"]),
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
