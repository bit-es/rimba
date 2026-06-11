<?php

namespace App\Models\Support\Todo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role;
use App\Models\Ppl\Staff;

class TaskAssignment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id',
        'role_id',
        'staff_id',
        'assigned_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'task_id' => 'integer',
            'role_id' => 'integer',
            'staff_id' => 'integer',
            'assigned_by' => 'integer',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
