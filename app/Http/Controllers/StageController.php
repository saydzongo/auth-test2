<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stage;
use App\Models\Partenaire;
use App\Models\StageValide;
use App\Models\StageHistorique;
use App\Notifications\StageValideNotification;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StagesExport;



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

public function tousLesStages()
{
    $stages = Stage::with('partenaire', 'user')->orderBy('created_at', 'desc')->get();
    $stages = Stage::with('partenaire')->get();
    return view('admin.tous_les_stages', compact('stages'));   
}

public function valider($id)
{
    $stage = Stage::findOrFail($id);
    $stage->update(['statut' => 'validé']);
   
    StageValide::create([
        'stage_id' => $stage->id,
        'matricule' => $stage->matricule,
        'nom' => $stage->nom,
        'prenom' => $stage->prenom,
        'campus' => $stage->campus,
        'email' => $stage->email,
        'filiere' => $stage->filiere,
        'annee' => $stage->annee,
        'periode' => $stage->periode,
        'partenaire_id' => $stage->partenaire_id,
        'date_validation' => now(),
    ]);
    $stage->user->notify(new StageValideNotification($stage)); 
   

    return redirect()->route('admin.tous-stages')->with('success', 'La demande de stage a été validée avec succès!');
}

public function demandesValidees()
{
    $stages = Stage::with('partenaire')->where('statut', 'validé')->orderBy('updated_at', 'desc')->get();
    $stages_valides = StageValide::orderBy('date_validation', 'desc')->get();
    return view('admin.stages_valides', compact('stages'));
}
/*public function demandesValidees()
{
    $stages = Stage::where('statut', 'validé')->orderBy('updated_at', 'desc')->get();
    return view('admin.stages_valides', compact('stages'));
}*/

public function afficherStagesValides()
{
    $stages_valides = StageValide::orderBy('date_validation', 'desc')->get();
    return view('admin.stages_valides', compact('stages_valides'));
}



/*public function remettreEnAttente($id)
{
    $stage = StageValide::findOrFail($id);

    // Repasser le statut à "en attente" dans la table `stages`
    Stage::where('id', $stage->stage_id)->update(['statut' => 'en attente']);

    // Supprimer l'enregistrement du stage validé dans `stages_valides`
    $stage->delete();

    return redirect()->route('admin.stages-valides')->with('success', 'Le stage a été remis en attente.');
} */

public function remettreEnAttente($id)
{
    $stage = Stage::findOrFail($id);

    // Modifier le statut du stage en "en attente"
    $stage->update(['statut' => 'en attente']);

    // Supprimer le stage de `stages_valides`
    StageValide::where('stage_id', $stage->id)->delete();

    return redirect()->route('admin.tous-stages')->with('success', 'Le stage a été remis en attente.');
}


public function changerStatut($id, $nouveauStatut)
{
  /*  $stage = Stage::findOrFail($id);*/
    $stage = StageValide::findOrFail($id);
    $ancienStatut = $stage->statut;

    // Mettre à jour le statut du stage
    $stage->update(['statut' => $nouveauStatut]);
  /* StageValide::where('stage_id', $stage->id)->update(['statut' => $nouveauStatut]);*/
   
    dd('Avant insertion dans StageHistorique', $stage);
    // Enregistrer le changement dans l'historique
    StageHistorique::create([
        'stage_id' => $stage->id,
        'ancien_statut' => $ancienStatut,
        'nouveau_statut' => $nouveauStatut,
        'date_changement' => now(),
    ]);
    $historique = StageHistorique::create([
        'stage_id' => $stage->id,
        'ancien_statut' => $ancienStatut,
        'nouveau_statut' => $nouveauStatut,
        'date_changement' => now(),
    ]);
    
    
   
   return redirect()->route('admin.tous-stages')->with('success', 'Le statut a été mis à jour.');
}

public function exportExcel()
{
    /*return Excel::download(new StagesExport, 'stages_valides.xlsx'); */
   /* return Excel::download(new StagesExport, 'stages_valides.csv', \Maatwebsite\Excel\Excel::CSV); */
    return Excel::download(new StagesExport, 'stages_valides.xlsx', \Maatwebsite\Excel\Excel::XLSX);
}


    }
