<?php

declare(strict_types=1);

namespace Bites\Foundation\Access\Entities;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Connection('sqlite')]
#[Table('model_access_controls')]
#[Fillable([
    'action',
    'role',
])]
class ModelAccessControl extends Model
{
    public function model()
    {
        return $this->morphTo();
    }
}
