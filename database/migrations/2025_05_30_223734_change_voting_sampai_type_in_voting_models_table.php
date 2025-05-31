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
        Schema::table('voting_models', function (Blueprint $table) {
            $table->time('voting_sampai')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('voting_models', function (Blueprint $table) {
            $table->dateTime('voting_sampai')->nullable()->change();
        });
    }
};
