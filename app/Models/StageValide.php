<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class StageValide extends Model
{
    //
    use HasFactory;
    protected $table = 'stages_valides';

    protected $fillable = [
        'stage_id', 'matricule', 'nom', 'prenom', 'email', 'campus', 
        'filiere', 'annee', 'periode', 'partenaire_id', 'date_validation'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'partenaire_id');
       /* return $this->belongsTo(Partenaire::class); */
    }
    
}
