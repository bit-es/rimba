<?php

namespace App\Concerns;

use App\Actions\GenerateUniqueCode;

trait HasUniqueCode
{
    /**
     * Laravel automatically boots this trait.
     */
    protected static function bootHasUniqueCode()
    {
        static::creating(function ($model) {
            // 1. Configure fields (with fallback defaults)
            $sourceField = property_exists($model, 'codeSourceField') ? $model->codeSourceField : 'name';
            $targetField = property_exists($model, 'codeTargetField') ? $model->codeTargetField : 'code';
            $codeLength  = property_exists($model, 'codeLength') ? $model->codeLength : 3;
            
            // Get prefix configuration (defaults to empty string if not set)
            $prefix = property_exists($model, 'codePrefix') ? $model->codePrefix : '';

            // 2. Only run if the source text exists and the code column is empty
            if (!empty($model->$sourceField) && empty($model->$targetField)) {
                $generator = app(GenerateUniqueCode::class);

                // We generate the raw code using our generic action class
                $rawCode = $generator->execute(
                    $model->$sourceField, 
                    $codeLength, 
                    function ($generatedCode) use ($model, $targetField, $prefix) {
                        // Apply the prefix during the database check to ensure total uniqueness
                        $fullCodeToCheck = !empty($prefix) ? strtoupper($prefix) . '-' . $generatedCode : $generatedCode;
                        return $model->newQuery()->where($targetField, $fullCodeToCheck)->exists();
                    }
                );

                // 3. Attach prefix to the final code if it was requested
                $model->$targetField = !empty($prefix) ? strtoupper($prefix) . '-' . $rawCode : $rawCode;
            }
        });
    }
}
