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
        Schema::create('vote_history', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('vote_id');
    $table->unsignedBigInteger('candidate_id');
    $table->foreign('vote_id')->references('id')->on('voter')->onDelete('cascade');
    $table->foreign('candidate_id')->references('id')->on('users');
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
