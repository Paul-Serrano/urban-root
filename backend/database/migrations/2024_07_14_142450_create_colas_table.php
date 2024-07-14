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
        Schema::create('colas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_type_id')->constrained();
            $table->string('region');
            $table->string('type');
            $table->string('appellation')->nullable();
            $table->double('degree');
            $table->string('grape_variety')->nullable();
            $table->string('ttb_id');
            $table->string('permit_number');
            $table->string('brand')->nullable();
            $table->string('fanciful_name')->nullable();
            $table->string('serial_number');
            $table->timestamp('approved_at')->nullable();
            $table->string('status');
            // represents "CHERCHE COLA" column in the Excel "All colas" sheet
            $table->string('source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colas');
    }
};
