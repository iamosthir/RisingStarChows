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
        Schema::table('reservation_applications', function (Blueprint $table) {
            $table->renameColumn('user_name', 'name');
            $table->string('address')->after('phone');
            $table->enum('gender', ['Male', 'Female', 'Litter'])->after('address');
            $table->string('color')->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_applications', function (Blueprint $table) {
            $table->dropColumn(['address', 'gender', 'color']);
            $table->renameColumn('name', 'user_name');
        });
    }
};
