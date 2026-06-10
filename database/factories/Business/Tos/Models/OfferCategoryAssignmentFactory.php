<?php

namespace Database\Factories\Business\Tos\Models;

use App\Models\Business\Tos\Models\Offer;
use App\Models\Business\Tos\Models\OfferCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferCategoryAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory(),
            'offer_category_id' => OfferCategory::factory(),
            'attributes' => '{}',
        ];
    }
}
