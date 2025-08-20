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
         'type_stage',
        'frais_stage',
        'numero_payment'
    ];
    protected $table = 'partenaires';



    public function stages()
{
    return $this->hasMany(Stage::class);
}
}

