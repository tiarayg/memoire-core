<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CapsuleOpen extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'capsule_id',
        'user_id',
        'opened_at',
    ];

    protected function casts(): array
    {
        return [
            'opened_at' => 'datetime',
        ];
    }

    /**
     * Get the capsule that was opened.
     */
    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class);
    }

    /**
     * Get the user who opened the capsule.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}