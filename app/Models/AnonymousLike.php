<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnonymousLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'anonymous_capsule_id',
        'user_id',
    ];

    public function anonymousCapsule(): BelongsTo
    {
        return $this->belongsTo(AnonymousCapsule::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}