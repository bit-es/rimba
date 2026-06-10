<?php

namespace Database\Factories\Ppl;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(["transfer","promotion","demotion","assignment","end_of_assignment"]),
            'effective_date' => fake()->date(),
            'from' => '{}',
            'to' => '{}',
        ];
    }
}
