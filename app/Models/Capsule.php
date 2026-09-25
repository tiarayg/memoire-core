<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Capsule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'content',
        'status',
        'open_at',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'open_at' => 'datetime',
        ];
    }

    /**
     * User who owns this capsule.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Secret capsule detail.
     */
    public function secretCapsule(): HasOne
    {
        return $this->hasOne(SecretCapsule::class);
    }

    /**
     * Capsule opening history.
     */
    public function opens(): HasMany
    {
        return $this->hasMany(CapsuleOpen::class);
    }

    /**
     * Open When category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            OpenWhenCategory::class,
            'category_id'
        );
    }
}