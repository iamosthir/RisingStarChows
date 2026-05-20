<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->nullable()
            ->constrained('pets')->onDelete('cascade');
            $table->string('user_name');
            $table->string('email');
            $table->string('phone');
            $table->text('inquiry');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_applications');
    }
};
