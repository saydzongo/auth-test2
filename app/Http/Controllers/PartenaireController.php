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
       /* 'image' => 'nullable|image|max:2048', */
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Limite à 2MB et formats compatibles
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('partenaires', 'public');
    }

    Partenaire::create($data);

    return redirect()->route('partenaires.create')->with('success', 'Partenaire ajouté avec succès !');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    /**
     * Update the specified resource in storage.
     */
  /*  public function update(Request $request, Partenaire $partenaire)
{
    $data = $request->validate([
        'nom' => 'required|string',
        'domaine' => 'required|string',
        'lieu' => 'required|string',
        'email' => 'required|email|unique:partenaires,email,' . $partenaire->id,
        'numero' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('partenaires', 'public');
    }

    $partenaire->update($data);

    return redirect()->route('partenaires.create')->with('success', 'Partenaire modifié avec succès !');
} */

public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'domaine' => 'required|string|max:255',
        'lieu' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'numero' => 'required|string|max:15',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $partenaire = Partenaire::findOrFail($id);
    $partenaire->nom = $request->nom;
    $partenaire->domaine = $request->domaine;
    $partenaire->lieu = $request->lieu;
    $partenaire->email = $request->email;
    $partenaire->numero = $request->numero;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('partenaires', 'public');
        $partenaire->image = $imagePath;
    }

    $partenaire->save();

    return redirect()->back()->with('success', 'Partenaire modifié avec succès!');
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


public function destroy(Partenaire $partenaire)
{
    $partenaire->delete();
    return redirect()->route('partenaires.create')->with('success', 'Partenaire supprimé avec succès !');
}
}
