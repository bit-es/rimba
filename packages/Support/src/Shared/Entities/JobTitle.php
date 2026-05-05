<?php

declare(strict_types=1);

namespace Bites\Support\Shared\Entities;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    protected $fillable = [
        'title',
        'jobgrade',
        'uuid',
        'description',
        'attributes',
        'masco_code',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];
}
