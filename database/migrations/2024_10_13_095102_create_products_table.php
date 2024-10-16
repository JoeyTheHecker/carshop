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
            $table->integer('category_id')->index()->nullable();
            $table->integer('group_id')->index();
            $table->string('region_name')->index();
            $table->string('location_name')->index();
            $table->string('origin_barangay')->index();
            $table->string('product_name')->index();
            $table->string('unit_name');
            $table->string('brand_name')->index();
            $table->string('year_model')->index()->nullable();
            $table->longText('descriptions')->nullable();
            $table->string('plate_number')->nullable();
            $table->decimal('inventory_price', 20, 2)->nullable();
            $table->decimal('selling_price', 20, 2)->nullable();
            $table->string('market_value')->nullable();
            $table->string('is_sold')->index();
            $table->string('latest_condition')->nullable();
            $table->string('classification')->nullable();
            $table->string('document_status')->nullable();
            $table->string('custody')->nullable();
            $table->string('repo_yard')->nullable();
            $table->integer('is_rating')->nullable();
            $table->integer('view_counter')->nullable();
            $table->integer('is_best_deal')->index()->nullable();
            $table->integer('is_featured')->index()->nullable();
            $table->integer('is_sale')->index()->nullable();
            $table->integer('is_new_repo')->index()->nullable();
            $table->integer('is_premium')->index()->nullable();
            $table->tinyInteger('status')->default(0)->index();
            $table->string('image')->nullable();
            $table->string('mileage')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->date('expiration_date')->nullable();
            $table->decimal('min_bid_price', 8, 2)->default(0.7);
            $table->date('puo_date')->nullable();
            $table->string('puo_number')->nullable();
            $table->integer('sub_category_id')->nullable()->index();
            $table->string('tct_no')->nullable();
            $table->string('appliance_type')->nullable();
            $table->string('bmlv')->nullable();
            $table->integer('brand_id')->nullable()->index();
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
