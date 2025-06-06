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
        Schema::create('candidate_profiles', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->string('visi');
    $table->string('misi');
    $table->string('photo')->nullable();
    $table->unsignedBigInteger('wilayah_id');
    $table->unsignedBigInteger('jabatan_id'); // Tambahkan ini
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('wilayah_id')->references('id')->on('wilayah')->onDelete('cascade');
    $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade'); // foreign key

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
