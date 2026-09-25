<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable([
    'name',
    'username',
    'email',
    'password',
    'avatar',
    'bio',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory;

    public function capsules(): HasMany
    {
        return $this->hasMany(Capsule::class);
    }

    public function anonymousCapsules(): HasMany
    {
        return $this->hasMany(AnonymousCapsule::class);
    }

    public function anonymousLikes(): HasMany
    {
        return $this->hasMany(AnonymousLike::class);
    }

    public function receivedSecretCapsules(): HasMany
    {
        return $this->hasMany(
            SecretCapsule::class,
            'recipient_user_id'
        );
    }

    public function capsuleOpens(): HasMany
    {
        return $this->hasMany(CapsuleOpen::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}