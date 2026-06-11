<?php

namespace App\Models\Org;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Concerns\HasUniqueCode;

class OrgTeam extends Model
{
    use HasFactory, HasUniqueCode;
    // --- Trait HasUniqueCode Settings ---
    public $codeLength = 4;       // Generates a 4-character random block
    public $codePrefix = 'T';   // Adds "T-" to the front of the code

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'org_unit_id',
        'name',
        'code',
        'is_active',
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
            'is_active' => 'boolean',
            'attributes' => 'array',
        ];
    }

    public function workflows(): HasMany
    {
        return $this->hasMany(\App\Models\Process\Workflow::class);
    }

    public function jobContracts(): HasMany
    {
        return $this->hasMany(\App\Models\Job\JobContract::class);
    }

    public function orgUnit(): BelongsTo
    {
        return $this->belongsTo(OrgUnit::class);
    }
}
