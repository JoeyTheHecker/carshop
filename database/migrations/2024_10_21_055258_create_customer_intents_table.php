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
        Schema::create('customer_intents', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index();
            $table->string('agent_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->string('presented_id')->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->string('region')->nullable();
            $table->string('bid_amount')->nullable();
            $table->integer('type_id')->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_intents');
    }
};
