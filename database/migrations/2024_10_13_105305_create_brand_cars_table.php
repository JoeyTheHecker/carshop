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
        Schema::create('brand_car', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name')->nullable();
            $table->string('brand_image')->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->timestamps();
        });

        DB::table('brand_car')->insert([
            'id' => 1,
            'brand_name' => 'Toyota',
            'brand_image' => 'toyota.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 2,
            'brand_name' => 'Honda',
            'brand_image' => 'honda.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 3,
            'brand_name' => 'Hyundai',
            'brand_image' => 'hyundai.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 4,
            'brand_name' => 'Kia',
            'brand_image' => 'kia.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 5,
            'brand_name' => 'Chevrolet',
            'brand_image' => 'cheve.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 6,
            'brand_name' => 'Ford',
            'brand_image' => 'ford.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 7,
            'brand_name' => 'Isuzu',
            'brand_image' => 'isuzu.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 8,
            'brand_name' => 'Mazda',
            'brand_image' => 'mazda.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 9,
            'brand_name' => 'Mitsubishi',
            'brand_image' => 'mitsubishi.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 10,
            'brand_name' => 'Nissan',
            'brand_image' => 'nissan.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 11,
            'brand_name' => 'Subaru',
            'brand_image' => 'subaru.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 12,
            'brand_name' => 'Suzuki',
            'brand_image' => 'suzuki.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 13,
            'brand_name' => 'Daewoo',
            'brand_image' => 'daewoo.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 14,
            'brand_name' => 'Hino',
            'brand_image' => 'hino.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('brand_car')->insert([
            'id' => 15,
            'brand_name' => 'Others',
            'brand_image' => 'others.png',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_car');
    }
};
