<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Entities;

use Illuminate\Database\Eloquent\Model;

#[\Illuminate\Database\Eloquent\Attributes\Fillable([
    'title',
    'jobgrade',
    'uuid',
    'description',
    'extra',
    'masco_code',
])]
class JobTitle extends Model
{
    protected function casts(): array
    {
        return [
            'extra' => 'array',
        ];
    }
}
