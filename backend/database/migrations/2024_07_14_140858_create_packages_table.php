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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->integer('quantity');
            $table->double('weight');
            $table->double('length');
            $table->double('width');
            $table->double('height');
            $table->string('type');
            $table->string('shipping_type');
            $table->double('product_value');
            $table->double('shipping_value');
            $table->double('total_value');
            $table->string('tracking_code');
            $table->string('status');
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
