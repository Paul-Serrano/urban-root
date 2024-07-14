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
        Schema::create('exporters', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name');
            $table->string('phone_number')->unique();
            $table->string('email_address')->unique();
            $table->string('siret')->unique();
            $table->string('tva_reference')->unique();
            $table->string('eori_reference')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exporters');
    }
};