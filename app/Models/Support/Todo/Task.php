<?php

namespace App\Models\Support\Todo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Enums\TaskStatus;
use Spatie\Permission\Models\Role;
use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Concerns\HasTaskStatus;

#[ObservedBy(TaskObserver::class)]
class Task extends Model
{
    use HasTaskStatus;

    protected $fillable = [
        'work_package_id',
        'task_template_id',
        'title',
        'description',
        'seq',
        'list',
        'role_id',
        'staff_id',
        'status',
        'started_at',
        'completed_at',
        'action_url',
    ];

    protected $dates = ['started_at', 'completed_at'];

    public function workPackage()
    {
        return $this->belongsTo(WorkPackage::class);
    }

    public function taskTemplate()
    {
        return $this->belongsTo(TaskTemplate::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function assignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }
}
