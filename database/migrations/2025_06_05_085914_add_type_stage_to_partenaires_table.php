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
        Schema::table('partenaires', function (Blueprint $table) {
            //
            $table->string('type_stage')->default('gratuit'); // ✅ Le stage est gratuit par défaut
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partenaires', function (Blueprint $table) {
            //
            $table->string('type_stage')->default('gratuit'); // ✅ Le stage est gratuit par défaut
        });
    }
};
