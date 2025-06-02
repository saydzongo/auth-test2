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
            $table->string('numero_whatsapp')->nullable();
    $table->text('commentaire')->nullable();
    $table->integer('age')->nullable();
    $table->string('parent_tuteur')->nullable();
    $table->string('numero_tuteur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            //
            $table->string('numero_whatsapp')->nullable();
    $table->text('commentaire')->nullable();
    $table->integer('age')->nullable();
    $table->string('parent_tuteur')->nullable();
    $table->string('numero_tuteur')->nullable();
        });
    }
};
