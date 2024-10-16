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
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('display')->nullable();
            $table->timestamps();
        });

        DB::table('groups')->insert([
            'id' => 1,
            'code' => 'LUZ',
            'display' => 'LUZON',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'id' => 2,
            'code' => 'VIS',
            'display' => 'VISAYAS',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'id' => 3,
            'code' => 'MIN',
            'display' => 'MINDANAO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
