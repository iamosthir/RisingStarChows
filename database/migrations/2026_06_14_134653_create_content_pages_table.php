<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('body')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('inquiry_intro')->nullable();
            $table->timestamps();
        });

        Schema::create('content_page_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_page_id')->constrained('content_pages')->cascadeOnDelete();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('content_pages')->insert([
            [
                'slug' => 'puppies',
                'title' => 'Our Puppies',
                'subtitle' => 'Beautiful, healthy puppies ready for their forever homes',
                'body' => null,
                'inquiry_intro' => 'Interested in welcoming a puppy into your family? Send us a message and we will get back to you.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'companion-dogs',
                'title' => 'Companion Dogs',
                'subtitle' => 'Our retired breeding dogs, looking for loving homes',
                'body' => null,
                'inquiry_intro' => 'Interested in adopting one of our retired companions? Send us a message and we will be in touch.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('content_page_images');
        Schema::dropIfExists('content_pages');
    }
};
