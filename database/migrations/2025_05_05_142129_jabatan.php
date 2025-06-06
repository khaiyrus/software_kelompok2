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
        Schema::create('jabatan', function (Blueprint $table) {
    $table->id();
    $table->string('nama');   // contoh: Walikota, Bupati, Gubernur
    $table->string('level');  // contoh: kota, kabupaten, provinsi
    $table->timestamps();     // created_at & updated_at
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
