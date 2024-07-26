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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('full_name');
            $table->string('full_name_en')->nullable();
            $table->string('code_name')->nullable();
            $table->bigInteger('administrative_unit_id')->unsigned()->nullable();
            $table->bigInteger('administrative_region_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('administrative_region_id')->references('id')->on('administrative_regions');
            $table->foreign('administrative_unit_id')->references('id')->on('administrative_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
