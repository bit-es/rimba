<?php

namespace App\Models\Support\Todo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Concerns\HasTaskStatus;

class WorkPackage extends Model
{
    use HasTaskStatus;

    protected $fillable = [
        'work_package_template_id',
        'ref_type',
        'ref_id',
        'status',
    ];

    public function template()
    {
        return $this->belongsTo(WorkPackageTemplate::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function ref()
    {
        return $this->morphTo();
    }
}