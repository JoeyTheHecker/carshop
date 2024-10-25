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
        Schema::create('bidding_config', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('start_day')->default('Tue');
            $table->string('start_hour')->default('08');
            $table->integer('bidding_hours')->default('129');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidding_config');
    }
};
