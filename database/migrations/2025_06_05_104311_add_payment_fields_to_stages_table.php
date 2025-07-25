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
        Schema::table('stages', function (Blueprint $table) {
            //
            $table->string('numero_payment')->nullable();
            $table->string('code_payment')->nullable();
            $table->string('capture_payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            //
            $table->string('numero_payment')->nullable();
            $table->string('code_payment')->nullable();
            $table->string('capture_payment')->nullable();
        });
    }
};
