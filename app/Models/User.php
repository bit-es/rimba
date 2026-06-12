<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Ppl\Staff;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Http;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements HasAvatar
{
    use HasFactory;
    use HasRoles;
    use Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'user_id');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        dump($this->staff);
        $number = $this->staff?->attributes['attributes'];//->attributes['staff_old_number'];
        dd($number);

        // Always have a safe default
        $default = asset('images/unknown_user.png');

        if (! $number) {
            return $default;
        }

        $url = sprintf('http://10.40.3.41:8080/%s.jpg', $number);

        try {
            // Lightweight check without downloading the file body
            $response = Http::timeout(1.5)->head($url);

            if ($response->ok()) {
                return $url;
            }
        } catch (\Throwable $throwable) {
            // Swallow network/timeout errors and fall back
        }

        return $default;
    }
}
