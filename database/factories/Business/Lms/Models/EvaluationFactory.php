<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\Module;
use App\Models\Ppl\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'staff_id' => Staff::factory(),
            'evaluator_id' => User::factory(),
            'result' => fake()->randomElement(["pass","fail"]),
            'evaluated_at' => fake()->dateTime(),
            'attributes' => '{}',
        ];
    }
}
