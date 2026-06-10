<?php

namespace Database\Factories\Support\Copies;

use App\Models\Ppl\Staff;
use App\Models\Support\Copies\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionLockFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'version_id' => Version::factory(),
            'locked_by' => Staff::factory()->create()->locked_by,
        ];
    }
}
