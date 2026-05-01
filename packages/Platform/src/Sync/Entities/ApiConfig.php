<?php

declare(strict_types=1);

namespace Bites\Platform\Sync\Entities;

use Illuminate\Database\Eloquent\Model;

#[\Illuminate\Database\Eloquent\Attributes\Fillable([
    'name',
    'source_type',
    'source_config',
    'data_path',
    'mapping',
    'active',
])]
class ApiConfig extends Model
{
    public function records()
    {
        return $this->hasMany(ApiData::class);
    }
    protected function casts(): array
    {
        return [
            'source_config' => 'array',
            'mapping' => 'array',
            'active' => 'boolean',
        ];
    }
}
