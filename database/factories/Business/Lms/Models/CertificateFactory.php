<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\Evaluation;
use App\Models\Business\Lms\Models\Module;
use App\Models\Business\Lms\Models\QuizAttempt;
use App\Models\Ppl\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'staff_id' => Staff::factory(),
            'quiz_attempt_id' => QuizAttempt::factory(),
            'evaluation_id' => Evaluation::factory(),
            'issued_by' => User::factory()->create()->issued_by,
            'status' => fake()->randomElement(["valid","expired","revoked"]),
            'issued_at' => fake()->dateTime(),
            'expires_at' => fake()->dateTime(),
            'attributes' => '{}',
        ];
    }
}
