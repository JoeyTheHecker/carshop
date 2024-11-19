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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code')->index();
            $table->string('product_identification_number', 255);
            $table->string('product_name')->index();
            $table->string('year_model')->index()->nullable();
            $table->longText('descriptions')->nullable();
            $table->string('plate_number')->nullable();
            $table->decimal('inventory_price', 20, 2)->nullable();
            $table->decimal('selling_price', 20, 2)->nullable();
            $table->string('market_value')->nullable();
            $table->string('latest_condition')->nullable();
            $table->string('document_status')->nullable();
            $table->tinyInteger('status')->default(0)->index();
            $table->string('image')->nullable();
            $table->string('mileage')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->date('expiration_date')->nullable();
            $table->decimal('min_bid_price', 8, 2)->default(0.7);
            $table->date('puo_date')->nullable();
            $table->string('puo_number')->nullable();
            $table->string('tct_no')->nullable();
            $table->string('appliance_type')->nullable();
            $table->string('bmlv')->nullable();
            $table->integer('is_display_on')->nullable()->index();
            $table->string('featured_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
