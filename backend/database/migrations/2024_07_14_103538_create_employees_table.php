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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('email_address')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('civility')->nullable();
            $table->string('job')->nullable();
            $table->string('language_iso_code')->nullable();
            $table->string('phone_portable_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
