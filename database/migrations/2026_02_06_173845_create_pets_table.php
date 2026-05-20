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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('call_name')->nullable();
            $table->string('sire_name')->nullable();
            $table->string('dam_name')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('breeder_name')->nullable();
            $table->string('reg_no')->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->date('birthdate')->nullable();
            $table->string('color')->nullable();
            $table->string('status')->nullable();
            $table->string('slug')->unique();
            $table->string('OFA')->nullable();
            $table->string('ref_link')->nullable();
            $table->text('description')->nullable();
            $table->string('primaryImg')->nullable();
            $table->json('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
