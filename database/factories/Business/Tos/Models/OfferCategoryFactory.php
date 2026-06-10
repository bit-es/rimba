<?php

namespace Database\Factories\Business\Tos\Models;

use App\Models\Business\Tos\Models\OfferCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'parent_id' => OfferCategory::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'attributes' => '{}',
        ];
    }
}
