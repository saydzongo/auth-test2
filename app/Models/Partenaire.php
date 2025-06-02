<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'domaine', 
        'lieu', 
        'email', 
        'numero', 
        'image',
        'site_web', 
        'localisation', 
        'domaine_recherche', 
        'nombre_places', 
        'niveau_recherche', 
        'frais_stage'
    ];
    protected $table = 'partenaires';
}