<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationApplication extends Model
{
    protected $fillable = [
        'pet_id',
        'user_name',
        'email',
        'phone',
        'inquiry',
        'status',
        'last_message_at',
        'unread_messages_count',
        'email_thread_id',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ApplicationMessage::class);
    }

    /**
     * Scope to eager load unread messages count.
     */
    public function scopeWithUnreadCount($query)
    {
        return $query->withCount(['messages as unread_messages_count' => function ($q) {
            $q->where('sender_type', 'user')->where('is_read', false);
        }]);
    }
}
