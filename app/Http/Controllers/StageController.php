<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stage;
use App\Models\Partenaire;


class StageController extends Controller
{
    // Afficher la liste des partenaires
    public function index()
    {
        $partenaires = Partenaire::all();
        return view('dashboard.postuler', compact('partenaires'));
    }

    // Afficher le formulaire de candidature
    public function create($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        return view('dashboard.create_stage', compact('partenaire'));
    }

    // Enregistrer la candidature en base de données
    public function store(Request $request)
{
    $request->validate([
        'partenaire_id' => 'required|exists:partenaires,id',
    ]);

    Stage::create([
        'user_id' => Auth::id(),
        'partenaire_id' => $request->partenaire_id,
        'matricule' => $request->matricule,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'residence' => $request->residence,
        'campus' => $request->campus,
        'filiere' => $request->filiere,
        'annee' => $request->annee,
        'periode' => $request->periode,
        'statut' => 'en attente',
    ]);

    return redirect()->route('mes-stages')->with('success', 'Votre candidature a été envoyée!');
}






public function mesStages()
{
    $stages = Stage::where('user_id', Auth::id())->get(); // Récupérer les candidatures de l'étudiant connecté
    return view('dashboard.mes_stages', compact('stages')); // Afficher la bonne vue
}


public function edit($id)
{
    $stage = Stage::findOrFail($id);
    return view('dashboard.edit_stage', compact('stage'));
}


public function update(Request $request, $id)
{
    $stage = Stage::findOrFail($id);
    
    $stage->update([
        'matricule' => $request->matricule,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'residence' => $request->residence,
        'campus' => $request->campus,
        'filiere' => $request->filiere,
        'annee' => $request->annee,
        'periode' => $request->periode,
        'motivation' => $request->motivation,
    ]);

    return redirect()->route('mes-stages')->with('success', 'Candidature mise à jour avec succès!');
}

public function destroy($id)
{
    $stage = Stage::findOrFail($id);
    $stage->delete();

    return redirect()->route('mes-stages')->with('success', 'Candidature supprimée avec succès!');
}


    }
