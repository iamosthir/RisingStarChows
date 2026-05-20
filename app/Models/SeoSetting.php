<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'google_analytics',
        'google_tag_manager',
        'facebook_pixel',
    ];

    /**
     * Get the SEO settings instance (singleton pattern).
     */
    public static function getSeoSettings()
    {
        // Try to get from cache first
        $seo = cache()->get('seo_settings');

        if ($seo) {
            return $seo;
        }

        // Get from database
        $seo = self::first();

        // Only cache if we have actual data
        if ($seo) {
            cache()->put('seo_settings', $seo, 3600);
            return $seo;
        }

        // Return empty instance if no settings found (don't cache this)
        return new self();
    }
}
