<?php

namespace Database\Factories\Support\Copies;

use App\Models\Support\Copies\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionRelationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'version_id' => Version::factory(),
            'related_version_id' => Version::factory(),
        ];
    }
}
