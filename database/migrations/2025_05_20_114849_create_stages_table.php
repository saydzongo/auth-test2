<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('partenaire_id')->constrained()->onDelete('cascade');
            $table->string('matricule');
            $table->string('nom');
            $table->string('prenom');
            $table->string('campus');
            $table->string('email');
            $table->string('residence');
            $table->string('campus');
            $table->string('filiere');
            $table->integer('annee');
            $table->string('periode');
            $table->string('statut')->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('stages');
    }


};
