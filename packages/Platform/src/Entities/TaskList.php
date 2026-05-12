<?php

declare(strict_types=1);

namespace Bites\Platform\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class TaskList extends Model
{
    protected $fillable = [
        'title',
        'description',
        'role_id',
        'completion_action',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
