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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;




class StageController extends Controller
{
    use AuthorizesRequests;
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
        'numero_whatsapp' => $request->numero_whatsapp,
        'commentaire' => $request->commentaire, 
        'age' => $request->age, 
        'parent_tuteur' => $request->parent_tuteur, 
        'numero_tuteur' => $request->numero_tuteur, 
    ]);

    return redirect()->route('mes-stages')->with('success', 'Votre candidature a été envoyée!');
}






/*public function mesStages()
{
    $stages = Stage::where('user_id', Auth::id())->get(); // Récupérer les candidatures de l'étudiant connecté
    return view('dashboard.mes_stages', compact('stages')); // Afficher la bonne vue
} */
public function mesStages()
{
    $etudiant = auth()->user();
    $stages = Stage::where('user_id', $etudiant->id)->get();
   return view('dashboard.mes_stages', compact('stages'));
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
    $this->authorizeForUser(auth()->user(), 'voir tous les stages');
    $stages = Stage::with('partenaire', 'user')->orderBy('created_at', 'desc')->get();
    return view('admin.tous_les_stages', compact('stages'));
}







public function valider($id)
{
    // ✅ Récupération du stage
    $stage = Stage::findOrFail($id);
    $stage->update(['statut' => 'validé']);

    // ✅ Création d'un enregistrement dans `stages_valides`
    $stage_valide = StageValide::create([
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

    // ✅ Vérification avant notification
    if (!$stage_valide) {
        return redirect()->back()->with('error', 'Erreur lors de la validation.');
    }

    // ✅ Envoi de la notification à l'étudiant
    Notification::route('mail', $stage_valide->email)
        ->notify(new StageValideNotification($stage_valide));

    return redirect()->route('admin.tous-stages')->with('success', 'La demande de stage a été validée avec succès!');
}

/*public function demandesValidees()
{
    $stages = Stage::with('partenaire')->where('statut', 'validé')->orderBy('updated_at', 'desc')->get();
    $stages_valides = StageValide::orderBy('date_validation', 'desc')->get();
    return view('admin.stages_valides', compact('stages'));
}  */

public function demandesValidees()
{
    $stages_valides = StageValide::orderBy('date_validation', 'desc')->get();
    return view('admin.stages_valides', compact('stages_valides'));
}

public function afficherStagesValides()
{
    $stages_valides = StageValide::orderBy('date_validation', 'desc')->get();
    return view('admin.stages_valides', compact('stages_valides'));
}





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
    
    return Excel::download(new StagesExport, 'stages_valides.xlsx', \Maatwebsite\Excel\Excel::XLSX);
}



public function rejeter(Request $request, $id)
{
    $stage = Stage::findOrFail($id);
    $stage->update([
        'statut' => 'rejeté',
        'motif_rejet' => $request->motif_rejet
    ]);

    return redirect()->route('admin.tous-stages')->with('success', 'Demande de stage rejetée.');
}




public function filtrer(Request $request)
{
    $query = Stage::query();

    if ($request->has('statut') && !empty($request->statut)) {
        $query->where('statut', $request->statut);
    }

    $stages = $query->orderBy('statut')->get(); // ✅ Trie par statut pour éviter l'intercalage
    $html = view('partials.stages_table', compact('stages'))->render();

    return response()->json(['html' => $html]);
}



    }
