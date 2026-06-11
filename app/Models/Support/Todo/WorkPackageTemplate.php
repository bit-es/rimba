<?php

namespace App\Models\Support\Todo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Enums\TaskStatus;
use Spatie\Permission\Models\Role;

class WorkPackageTemplate extends Model
{
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(WorkPackageTemplateItem::class);
    }
}