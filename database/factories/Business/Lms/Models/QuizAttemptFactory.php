<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\Quiz;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'quiz_id' => Quiz::factory(),
            'staff_id' => Staff::factory(),
            'result' => fake()->randomElement(["pass","fail"]),
            'score' => fake()->numberBetween(-10000, 10000),
            'attempted_at' => fake()->dateTime(),
            'attributes' => '{}',
        ];
    }
}
