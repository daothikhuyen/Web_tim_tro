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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->integer('level')->comments('0: admin, 1: user');
            $table->boolean('is_activated')->default(0)->comment('0: Tài khoản bị khoá hoặc chưa xác nhận, 1: Tài khoản đã được xác nhận');
            $table->integer('is_deleted')->default(0)->comment('0: Chưa xoá tài khoản 1: Xoá tài khoản');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
