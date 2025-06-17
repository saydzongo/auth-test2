<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partenaire;
use App\Models\User;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'partenaire_id', 'matricule', 'nom', 'prenom', 'email', 'residence', 'campus', 
    'filiere', 'annee', 'periode', 'statut', 'numero_whatsapp', 'commentaire', 'age', 'parent_tuteur', 'numero_tuteur','motif_rejet', 'numero_payment', 'code_payment', 'capture_payment'];


    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'partenaire_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function etudiant()
{
    return $this->belongsTo(User::class, 'user_id'); // Assure que 'user_id' est la clé étrangère
}


}



