<?php

namespace Database\Factories\Business\Lms\Models;

use App\Models\Business\Lms\Models\Material;
use App\Models\Business\Lms\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'material_id' => Material::factory(),
            'module_id' => Module::factory(),
            'sequence' => fake()->numberBetween(-10000, 10000),
            'attributes' => '{}',
        ];
    }
}
