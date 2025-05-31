<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voting_models', function (Blueprint $table) {
            $table->id();
            $table->string('acara');
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('wilayah_id');
            $table->dateTime('voting_sampai')->nullable();
            $table->foreign('wilayah_id')->references('id')->on('wilayah')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voting_models');
    }
};
