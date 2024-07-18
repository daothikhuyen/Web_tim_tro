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
        Schema::table('posts', function (Blueprint $table) {
            $table->bigInteger('province_id');
            $table->bigInteger('district_id');
            $table->bigInteger('ward_id');
            $table->bigInteger('street_id')->nullable();
            $table->integer('is_deleted')->default(0)->comment('0: Bài không bị xoá, 1: Bài bị xoá');
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
