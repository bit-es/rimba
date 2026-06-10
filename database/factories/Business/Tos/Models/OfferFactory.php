<?php

namespace Database\Factories\Business\Tos\Models;

use App\Models\Org\OrgTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'org_team_id' => OrgTeam::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
