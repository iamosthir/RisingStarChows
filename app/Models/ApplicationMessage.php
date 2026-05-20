<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationMessage extends Model
{
    protected $fillable = [
        'reservation_application_id',
        'sender_type',
        'sender_id',
        'message_text',
        'message_html',
        'email_message_id',
        'email_in_reply_to',
        'email_references',
        'is_read',
        'sent_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
    ];

    /**
     * Get the reservation application that owns the message.
     */
    public function reservationApplication(): BelongsTo
    {
        return $this->belongsTo(ReservationApplication::class);
    }

    /**
     * Get the admin user who sent the message (if sender_type is admin).
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Scope a query to only include unread messages.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope a query to only include messages from users.
     */
    public function scopeFromUser($query)
    {
        return $query->where('sender_type', 'user');
    }

    /**
     * Scope a query to only include messages from admins.
     */
    public function scopeFromAdmin($query)
    {
        return $query->where('sender_type', 'admin');
    }

    /**
     * Get the sender's name.
     */
    public function getSenderNameAttribute(): string
    {
        if ($this->sender_type === 'admin') {
            return $this->sender ? $this->sender->name : 'Admin';
        }

        return $this->reservationApplication->user_name ?? 'User';
    }

    /**
     * Get formatted sent_at timestamp.
     */
    public function getFormattedSentAtAttribute(): string
    {
        return $this->sent_at->format('M d, Y g:i A');
    }

    /**
     * Check if a message with this email message ID already exists.
     */
    public static function isDuplicate(?string $emailMessageId): bool
    {
        if (!$emailMessageId) {
            return false;
        }

        return static::where('email_message_id', $emailMessageId)->exists();
    }

    /**
     * Mark this message as read.
     */
    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update(['is_read' => true]);
        }
    }

    /**
     * Get the initials for the sender (for avatar).
     */
    public function getSenderInitialsAttribute(): string
    {
        $name = $this->sender_name;
        $nameParts = explode(' ', $name);

        if (count($nameParts) >= 2) {
            return strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
        }

        return strtoupper(substr($name, 0, 2));
    }
}
