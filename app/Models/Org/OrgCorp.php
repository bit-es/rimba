<?php

namespace App\Models\Org;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Concerns\HasUniqueCode;
use App\Observers\OrgCorpObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
#[ObservedBy([OrgCorpObserver::class])]
class OrgCorp extends Model
{
    use HasFactory, HasUniqueCode;
    // --- Trait HasUniqueCode Settings ---
    public $codeLength = 4;       // Generates a 4-character random block
    public $codePrefix = 'O';   // Adds "O-" to the front of the code
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'uuid',
        'code',
        'type',
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
            'extra' => 'array',
        ];
    }

    public function orgUnits(): HasMany
    {
        return $this->hasMany(OrgUnit::class);
    }
}
