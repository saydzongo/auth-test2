<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partenaire;
use App\Models\User;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'partenaire_id', 'matricule', 'nom', 'prenom', 'email', 'residence', 'campus', 'filiere', 'annee', 'periode', 'statut'];


    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'partenaire_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}



