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
            if (!Schema::hasColumn('partenaires', 'site_web')) {
                $table->string('site_web')->nullable();
            }
            if (!Schema::hasColumn('partenaires', 'localisation')) {              
                $table->string('localisation')->default('Non spécifié');
            }
            if (!Schema::hasColumn('partenaires', 'domaine_recherche')) {
                $table->string('domaine_recherche');
            }
            if (!Schema::hasColumn('partenaires', 'nombre_places')) {
                $table->integer('nombre_places');
            }
            if (!Schema::hasColumn('partenaires', 'niveau_recherche')) {
                $table->string('niveau_recherche');
            }
            if (!Schema::hasColumn('partenaires', 'frais_stage')) {
                $table->decimal('frais_stage', 8, 2)->nullable();
            }

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
                //
                if (!Schema::hasColumn('partenaires', 'site_web')) {
                    $table->string('site_web')->nullable();
                }
                if (!Schema::hasColumn('partenaires', 'localisation')) {              
                    $table->string('localisation')->default('Non spécifié');
                }
                if (!Schema::hasColumn('partenaires', 'domaine_recherche')) {
                    $table->string('domaine_recherche');
                }
                if (!Schema::hasColumn('partenaires', 'nombre_places')) {
                    $table->integer('nombre_places');
                }
                if (!Schema::hasColumn('partenaires', 'niveau_recherche')) {
                    $table->string('niveau_recherche');
                }
                if (!Schema::hasColumn('partenaires', 'frais_stage')) {
                    $table->decimal('frais_stage', 8, 2)->nullable();
                }
    
            });
        });
    }
};
