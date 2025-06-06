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
        Schema::table('voter', function (Blueprint $table) {
            $table->unsignedBigInteger('voting_model_id')->nullable()->after('wilayah_id');
            $table->foreign('voting_model_id')->references('id')->on('voting_models')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('voter', function (Blueprint $table) {
            $table->dropForeign(['voting_model_id']);
            $table->dropColumn('voting_model_id');
        });
    }
};
