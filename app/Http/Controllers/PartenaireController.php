<?php

namespace App\Http\Controllers;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $partenaires = Partenaire::all();
        return view('admin.partenaires.create', compact('partenaires')); // ✅ Correction ici
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $partenaires = Partenaire::all();
    return view('admin.partenaires.create', compact('partenaires'));
}

    /**
     * Store a newly created resource in storage.
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
        /*'frais_stage' => 'nullable|numeric|min:0', */
    ]);
    // Vérification des données avant insertion
    /*dd($data); */

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('partenaires', 'public');
    }

    Partenaire::create($data);
    
    $partenaires = Partenaire::select('nom', 'domaine', 'site_web', 'localisation', 'domaine_recherche', 'nombre_places', 'niveau_recherche', 'frais_stage')->get();

    return redirect()->route('partenaires.create')->with('success', 'Partenaire ajouté avec succès !');
    
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   
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

    /*$partenaire = Partenaire::findOrFail($id);
    $partenaire->nom = $request->nom;
    $partenaire->domaine = $request->domaine;
    $partenaire->lieu = $request->lieu;
    $partenaire->email = $request->email;
    $partenaire->numero = $request->numero;
    $partenaire->site_web = $request->site_web;
    $partenaire->localisation = $request->localisation;
    $partenaire->domaine_recherche = $request->domaine_recherche;
    $partenaire->nombre_places = $request->nombre_places;
    $partenaire->niveau_recherche = $request->niveau_recherche;
    $partenaire->frais_stage = $request->frais_stage;
    $partenaire->save();*/

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('partenaires', 'public');
        $partenaire->image = $imagePath;
        $partenaire->save();
    }

    return redirect()->route('partenaires.create')->with('success', 'Partenaire modifié avec succès!');

   
   
   }


    /**
     * Remove the specified resource from storage.
     */
    


     /*public function edit(Partenaire $partenaire)
     {
       
        return view('admin.partenaires.edit', compact('partenaire'));
     }*/

     public function edit($id) {
        $partenaire = Partenaire::find($id);
        return view('admin.partenaires.edit', compact('partenaire'));
    }


/*public function destroy(Partenaire $partenaire)
{
    $partenaire->delete();
    return redirect()->route('partenaires.create')->with('success', 'Partenaire supprimé avec succès !');
} */
public function destroy($id)
{
    $partenaire = Partenaire::findOrFail($id);
    $partenaire->delete();
   
    return redirect()->route('admin.partenaires.create')->with('success', 'Partenaire supprimé avec succès!');
}

}
