<?php

namespace Database\Factories\Support\Copies;

use App\Models\Ppl\Staff;
use App\Models\Support\Copies\Versionable;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'versionable_id' => Versionable::factory(),
            'created_by' => Staff::factory()->create()->created_by,
            'approved_by' => Staff::factory()->create()->approved_by,
            'published_by' => Staff::factory()->create()->published_by,
            'status' => fake()->randomElement(["draft","approved","published","archived","rejected"]),
            'content_type' => fake()->randomElement(["file","url","inline","json"]),
            'content_path' => fake()->word(),
            'major' => fake()->numberBetween(-10000, 10000),
            'minor' => fake()->numberBetween(-10000, 10000),
            'patch' => fake()->numberBetween(-10000, 10000),
            'version' => fake()->word(),
            'change_summary' => fake()->word(),
            'change_notes' => fake()->text(),
            'is_menu' => fake()->boolean(),
            'approved_at' => fake()->dateTime(),
            'published_at' => fake()->dateTime(),
            'effective_from' => fake()->dateTime(),
            'effective_to' => fake()->dateTime(),
            'attributes' => '{}',
        ];
    }
}
