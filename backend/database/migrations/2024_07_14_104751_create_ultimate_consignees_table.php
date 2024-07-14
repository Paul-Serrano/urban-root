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
        Schema::create('ultimate_consignees', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name');
            $table->string('phone_number')->unique();
            $table->string('email_address')->unique();
            $table->string('siret')->unique();
            $table->string('tva_reference')->unique();
            $table->string('fda_number')->unique();
            $table->string('eori_reference')->unique();
            $table->string('fedex_account_reference')->unique();
            $table->string('tiers_code');
            $table->string('import_license');
            $table->string('tax_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ultimate_consignees');
    }
};
