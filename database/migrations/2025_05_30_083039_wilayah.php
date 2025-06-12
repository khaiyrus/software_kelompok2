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
        Schema::create('wilayah', function (Blueprint $table) {
    $table->id();
    $table->string('nama_wilayah');
    $table->enum('level', ['kota', 'kabupaten', 'provinsi']);
    $table->unsignedBigInteger('parent_id')->nullable();
    $table->foreign('parent_id')->references('id')->on('wilayah')->onDelete('cascade');
    $table->timestamps();
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
