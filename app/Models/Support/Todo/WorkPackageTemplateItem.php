<?php

namespace App\Models\Support\Todo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Enums\TaskStatus;
use Spatie\Permission\Models\Role;

class WorkPackageTemplateItem extends Model
{
    protected $fillable = [
        'work_package_template_id',
        'task_template_id',
        'seq',
        'list',
        'order',
    ];

    public function template()
    {
        return $this->belongsTo(WorkPackageTemplate::class);
    }

    public function taskTemplate()
    {
        return $this->belongsTo(TaskTemplate::class);
    }
}