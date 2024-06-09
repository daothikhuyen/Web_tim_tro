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
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_activated')->default(0)->comment('0: Tài khoản bị khoá hoặc chưa xác nhận, 1: Tài khoản chưa đã được xác nhận');
            $table->string('password');
            $table->integer('is_deleted')->default(0)->comment('0: Chưa xoá tài khoản 1: Xoá tài khoản');
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
