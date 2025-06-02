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
            Schema::table('partenaires', function (Blueprint $table) {
                $table->string('site_web')->nullable()->change();
                $table->string('localisation')->nullable()->change();
                $table->string('domaine_recherche')->nullable()->change();
                $table->integer('nombre_places')->nullable()->change();
                $table->string('niveau_recherche')->nullable()->change();
                $table->decimal('frais_stage', 8, 2)->nullable()->change();
            });


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partenaires', function (Blueprint $table) {
            //
            Schema::table('partenaires', function (Blueprint $table) {
                $table->string('site_web')->nullable()->change();
                $table->string('localisation')->nullable()->change();
                $table->string('domaine_recherche')->nullable()->change();
                $table->integer('nombre_places')->nullable()->change();
                $table->string('niveau_recherche')->nullable()->change();
                $table->decimal('frais_stage', 8, 2)->nullable()->change();
            });
        });
    }
};
