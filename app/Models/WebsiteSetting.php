<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'email',
        'phone',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'footer_text',
        'about_us',
    ];

    /**
     * Get the settings instance (singleton pattern).
     */
    public static function getSettings()
    {
        // Try to get from cache first
        $settings = cache()->get('website_settings');

        if ($settings) {
            return $settings;
        }

        // Get from database
        $settings = self::first();

        // Only cache if we have actual data
        if ($settings) {
            cache()->put('website_settings', $settings, 3600);
            return $settings;
        }

        // Return empty instance if no settings found (don't cache this)
        return new self();
    }
}
