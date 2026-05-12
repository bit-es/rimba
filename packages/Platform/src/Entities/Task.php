<?php

declare(strict_types=1);

namespace Bites\Platform\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'role_id',
        'staff_id',
        'task_template_id',
        'status',
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

    public function taskList()
    {
        return $this->belongsTo(TaskList::class, 'task_template_id');
    }
}
