<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobContract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'job_title_id',
        'staff_id',
        'issuing_org_corp_id',
        'contract_type',
        'start_date',
        'end_date',
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
            'job_title_id' => 'integer',
            'org_unit_id' => 'integer',
            'org_team_id' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'attributes' => 'array',
        ];
    }

    // public function jobTitle(): HasOne
    // {
    //     return $this->hasOne(JobTitle::class);
    // }

    public function orgUnit(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Org\OrgUnit::class);
    }

    public function orgTeam(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Org\OrgTeam::class);
    }
}
