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
        Schema::create('application_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_application_id')->constrained('reservation_applications')->onDelete('cascade');
            $table->enum('sender_type', ['admin', 'user']);
            $table->foreignId('sender_id')->nullable()->constrained('users')->onDelete('set null');
            $table->longText('message_text');
            $table->longText('message_html');
            $table->string('email_message_id')->nullable()->unique();
            $table->string('email_in_reply_to')->nullable();
            $table->text('email_references')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('sent_at');
            $table->timestamps();

            // Indexes for performance
            $table->index('reservation_application_id');
            $table->index(['sender_type', 'is_read']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_messages');
    }
};
