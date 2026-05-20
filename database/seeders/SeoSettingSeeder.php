<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoSetting::updateOrCreate(
            ['id' => 1],
            [
                'meta_title' => 'RisingStarChows - Premium Chow Chow Breeders | Champion Dog Training & Breeding',
                'meta_description' => 'Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services. Find your perfect Chow Chow puppy today.',
                'meta_keywords' => 'chow chow, chow chow breeders, chow chow puppies, dog breeding, dog training, champion dogs, premium breeders',
                'og_title' => 'RisingStarChows - Premium Chow Chow Breeders',
                'og_description' => 'Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services.',
                'og_image' => null,
                'google_analytics' => null,
                'google_tag_manager' => null,
                'facebook_pixel' => null,
            ]
        );
    }
}
