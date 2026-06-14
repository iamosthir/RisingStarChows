<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentPage extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'body',
        'hero_image',
        'inquiry_intro',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ContentPageImage::class)->orderBy('sort_order');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($page) {
            if ($page->hero_image && file_exists(public_path($page->hero_image))) {
                @unlink(public_path($page->hero_image));
            }
            $page->images()->each(function ($image) {
                $image->delete();
            });
        });
    }
}
