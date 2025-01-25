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
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->before('email');
            $table->string('lastname')->before('email');
            $table->string('business_name')->before('email');
            $table->string('phone_number')->nullable()->before('email');
            $table->dropColumn(['name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn(['firstname', 'lastname', 'business_name', 'phone_number']);
        });
    }
};
