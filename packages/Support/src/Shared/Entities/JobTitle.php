<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Entities;

use Illuminate\Database\Eloquent\Model;

#[\Illuminate\Database\Eloquent\Attributes\Fillable([
    'title',
    'jobgrade',
    'uuid',
    'description',
    'attributes',
    'masco_code',
])]
class JobTitle extends Model
{
    protected function casts(): array
    {
        return [
            'attributes' => 'array',
        ];
    }
}
