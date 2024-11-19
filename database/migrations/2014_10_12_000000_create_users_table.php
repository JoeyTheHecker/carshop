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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role')->default(0); // 0 for normal users, 1 for admins
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->text('source_of_income')->nullable();
            $table->string('govt_id')->nullable();
            $table->string('govt_id_type');
            $table->string('selfie_with_id')->nullable();
            $table->string('e_signature')->nullable()->index();
            $table->timestamp('date_banned')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
