<?php

namespace App\Models\Ppl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Staff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'org_unit_id',
        'job_contract_id',
        'type',
        'status',
        'name',
        'staff_no',
        'attributes',
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
            'user_id' => 'integer',
            'org_unit_id' => 'integer',
            'job_contract_id' => 'integer',
            'attributes' => 'array',
        ];
    }

    public function staffPositions(): HasMany
    {
        return $this->hasMany(StaffPosition::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(\App\Models\Business\Tos\Models\Request::class);
    }

    public function models(): MorphMany
    {
        return $this->morphMany(\App\Models\Support\AuditTrail\AuditLog::class, 'modelable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function orgUnit(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Org\OrgUnit::class);
    }

    public function jobContract(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Job\JobContract::class);
    }
}
