<?php

namespace Database\Factories\Business\Tos\Models;

use App\Models\Ppl\Staff;
use App\Models\Process\WorkflowInstance;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'requester_id' => Staff::factory(),
            'workflow_instance_id' => WorkflowInstance::factory(),
            'status' => fake()->randomElement(["submitted","in_review","approved","rejected","in_progress","completed","closed"]),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'request_type' => fake()->word(),
            'attributes' => '{}',
        ];
    }
}
