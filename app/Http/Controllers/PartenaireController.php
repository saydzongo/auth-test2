<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    /**
     * Affiche la liste des partenaires avec pagination.
     */
    public function index()
    {
        $partenaires = Partenaire::paginate(6);
        return view('partenaires.index', compact('partenaires'));
    }

    /**
     * Affiche le formulaire de création avec pagination des partenaires.
     */
    public function create()
    {
        $partenaires = Partenaire::paginate(6);

        // 📊 Top 5 partenaires par type de stage
        $topPayants = Partenaire::where('type_stage', 'payant')
            ->withCount('stages')
            ->orderByDesc('stages_count')
            ->take(5)
            ->get();
    
        $topGratuits = Partenaire::where('type_stage', 'gratuit')
            ->withCount('stages')
            ->orderByDesc('stages_count')
            ->take(5)
            ->get();
    
        return view('admin.partenaires.create', compact('partenaires', 'topPayants', 'topGratuits'));
    }

    /**
     * Enregistre un nouveau partenaire.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'domaine' => 'required|string',
            'lieu' => 'required|string',
            'email' => 'required|email|unique:partenaires',
            'numero' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_web' => 'nullable|string',
            'localisation' => 'nullable|string',
            'domaine_recherche' => 'nullable|string',
            'nombre_places' => 'nullable|integer|min:1',
            'niveau_recherche' => 'nullable|string',
            'type_stage' => 'required|string',
            'frais_stage' => $request->type_stage === 'payant' ? 'required|numeric|min:0' : '',
            'numero_payment' => $request->type_stage === 'payant' ? 'required|string' : 'nullable|string',
            
        ]);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partenaires', 'public');
            
        }
        $data['numero_payment'] = $request->numero_payment;
        Partenaire::create($data);

        return redirect()->route('partenaires.create')->with('success', 'Partenaire ajouté avec succès !');
    }

    /**
     * Affiche un partenaire spécifique (à compléter si besoin).
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Met à jour un partenaire existant.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'domaine' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'numero' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_web' => 'nullable|string',
            'localisation' => 'nullable|string',
            'domaine_recherche' => 'nullable|string',
            'nombre_places' => 'nullable|integer|min:1',
            'niveau_recherche' => 'nullable|string',
            'frais_stage' => 'nullable|numeric|min:0',
           
        ]);

        $partenaire = Partenaire::findOrFail($id);
        $partenaire->update($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('partenaires', 'public');
            $partenaire->image = $imagePath;
            $partenaire->save();
        }

        return redirect()->route('partenaires.create')->with('success', 'Partenaire modifié avec succès!');
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit($id)
    {
        $partenaire = Partenaire::find($id);
        return view('admin.partenaires.edit', compact('partenaire'));
    }

    /**
     * Supprime un partenaire.
     */
    public function destroy($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $partenaire->delete();

        return redirect()->route('admin.partenaires.create')->with('success', 'Partenaire supprimé avec succès!');
    }
}