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
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname', 'city']);
            $table->string('country')->before('created_at');
            $table->unique(['user_id', 'business_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('firstname');
            $table->string('lastname');
            $table->string('city');
            $table->dropColumn(['country']);
        });
    }
};
