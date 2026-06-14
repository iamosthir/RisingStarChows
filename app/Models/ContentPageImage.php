<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentPageImage extends Model
{
    protected $fillable = [
        'content_page_id',
        'image',
        'caption',
        'sort_order',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(ContentPage::class, 'content_page_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            if ($image->image && file_exists(public_path($image->image))) {
                @unlink(public_path($image->image));
            }
        });
    }
}
