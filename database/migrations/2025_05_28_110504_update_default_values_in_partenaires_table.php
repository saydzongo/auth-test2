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
                $table->string('site_web')->nullable()->default('Non spécifié')->change();
                $table->string('localisation')->nullable()->default('Non spécifié')->change();
                $table->string('domaine_recherche')->nullable()->default('Non spécifié')->change();
                $table->integer('nombre_places')->nullable()->default(0)->change();
                $table->string('niveau_recherche')->nullable()->default('Non spécifié')->change();
                $table->decimal('frais_stage', 8, 2)->nullable()->default(0)->change();
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
                $table->string('site_web')->nullable()->default('Non spécifié')->change();
                $table->string('localisation')->nullable()->default('Non spécifié')->change();
                $table->string('domaine_recherche')->nullable()->default('Non spécifié')->change();
                $table->integer('nombre_places')->nullable()->default(0)->change();
                $table->string('niveau_recherche')->nullable()->default('Non spécifié')->change();
                $table->decimal('frais_stage', 8, 2)->nullable()->default(0)->change();
            });

        });
    }
};
