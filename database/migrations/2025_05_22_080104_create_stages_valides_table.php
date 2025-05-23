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
        Schema::create('stages_valides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stage_id')->constrained()->onDelete('cascade');
            $table->string('matricule');
            $table->string('nom');
            $table->string('prenom');
            $table->string('campus');
            $table->string('email');
            $table->string('filiere');
            $table->integer('annee');
            $table->string('periode');
            $table->foreignId('partenaire_id')->constrained()->onDelete('cascade');
            $table->timestamp('date_validation')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages_valides');
    }
};
