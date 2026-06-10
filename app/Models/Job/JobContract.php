<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobContract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'org_unit_id',
        'org_team_id',
        'type',
        'status',
        'position_limit',
        'start_date',
        'end_date',
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
            'org_unit_id' => 'integer',
            'org_team_id' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'attributes' => 'array',
        ];
    }

    public function jobPositions(): HasMany
    {
        return $this->hasMany(JobPosition::class);
    }

    public function orgUnit(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Org\OrgUnit::class);
    }

    public function orgTeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Org\OrgTeam::class);
    }
}
