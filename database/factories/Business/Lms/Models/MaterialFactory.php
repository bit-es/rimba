<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Org\OrgTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_team_id' => OrgTeam::factory(),
            'type' => fake()->randomElement(["document","video","link","other"]),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
