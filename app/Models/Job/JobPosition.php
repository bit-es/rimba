<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Concerns\HasAbacs;

class JobPosition extends Model
{
    use HasFactory, HasAbacs;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_contract_id',
        'org_unit_id',
        'level',
        'status',
        'title',
        'description',
        'extra',
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
            'job_contract_id' => 'integer',
            'extra' => 'array',
        ];
    }

    public function staffPositions(): HasMany
    {
        return $this->hasMany(\App\Models\Ppl\StaffPosition::class);
    }

    public function jobContract(): BelongsTo
    {
        return $this->belongsTo(JobContract::class);
    }
}
