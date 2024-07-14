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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ultimate_consignee_id')->constrained();
            $table->foreignId('recipient_id')->constrained();
            $table->string('reference')->unique();
            $table->string('type');
            $table->string('reason');
            $table->string('payment_term');
            $table->string('shipping_type');
            $table->double('shipping_cost');
            $table->double('total_cost');
            $table->string('status');
            $table->longText('comment')->nullable();
            $table->longText('delivery_instructions')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
