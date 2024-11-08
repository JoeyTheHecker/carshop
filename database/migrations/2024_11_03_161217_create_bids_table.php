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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('customer_id');
            $table->string('product_id');
            $table->integer('amount');
            $table->string('product_identification_number', 255);
            $table->string('full_name', 255);
            $table->string('email_add', 255);
            $table->string('mobile_number');
            $table->string('birth_date');
            $table->text('address');
            $table->text('source_of_income');
            $table->string('e_signature');
            $table->string('govt_id');
            $table->string('selfie_with_id');
            $table->string('status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
