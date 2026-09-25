<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecretCapsule extends Model
{
    use HasFactory;

    protected $fillable = [
        'capsule_id',
        'recipient_user_id',
        'recipient_email',
        'password_hash',
        'hint',
        'share_token',
    ];

    /**
     * Get the capsule.
     */
    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class);
    }

    /**
     * Get the recipient user.
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'recipient_user_id'
        );
    }
}