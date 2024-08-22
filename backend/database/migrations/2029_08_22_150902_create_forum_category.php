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
        Schema::create('forum_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->timestamps();

            $table->primary(['forum_id', 'category_id']);
            $table->unique(['forum_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_category');
    }
};
