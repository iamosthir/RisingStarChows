<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'enable_action_button',
        'action_button_text',
        'action_button_link',
        'is_active',
        'order',
    ];

    protected $casts = [
        'enable_action_button' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
