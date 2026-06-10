<?php

namespace Database\Factories\Business\Dms\Models;

use App\Models\Business\Dms\Models\Document;
use App\Models\Business\Dms\Models\DocumentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentCategoryAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'document_id' => Document::factory(),
            'document_category_id' => DocumentCategory::factory(),
            'attributes' => '{}',
        ];
    }
}
