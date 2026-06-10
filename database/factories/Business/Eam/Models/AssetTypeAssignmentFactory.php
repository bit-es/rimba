<?php

namespace Database\Factories\Business\Eam\Models;

use App\Models\Business\Eam\Models\Asset;
use App\Models\Business\Eam\Models\AssetType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetTypeAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'asset_type_id' => AssetType::factory(),
            'attributes' => '{}',
        ];
    }
}
