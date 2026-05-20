<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'RisingStarChows',
                'logo' => null,
                'favicon' => null,
                'email' => 'info@thebengal.club',
                'phone' => '+1 (123) 456-7890',
                'address' => '123 Main Street, City, State, ZIP',
                'facebook' => 'https://facebook.com/risingStarchows',
                'twitter' => 'https://twitter.com/risingStarchows',
                'instagram' => 'https://instagram.com/risingStarchows',
                'linkedin' => null,
                'youtube' => null,
                'footer_text' => '&copy; ' . date('Y') . ' RisingStarChows. Premium Chow Chow Breeders. All Rights Reserved.',
                'about_us' => 'We are dedicated to breeding healthy, happy, and high-quality Chow Chow puppies.',
            ]
        );
    }
}
