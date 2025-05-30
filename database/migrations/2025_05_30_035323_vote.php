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
        Schema::create('votes', function (Blueprint $table) {
    $table->id('vote_id');
    $table->unsignedBigInteger('voter_id');
    $table->unsignedBigInteger('candidate_id');
    $table->integer('vote_time');
    $table->foreign('voter_id')->references('id')->on('users');
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
