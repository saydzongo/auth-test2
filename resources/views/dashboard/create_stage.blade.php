
<@extends('layouts.custom')

@section('title', 'creer stage')

@section('content')
                   
<div class="container mt-3">
    <button class="btn btn-secondary shadow-sm" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> 
    </button>
</div>       


<div class="container-fluid mt-5">
<div class="card shadow-sm p-4 ms-5">
    <h2 class="text-center mb-4">Postuler chez {{ $partenaire->nom }}</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('stage.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="partenaire_id" value="{{ $partenaire->id }}">

            <div class="mb-3">
                <label for="matricule" class="form-label">Numéro Matricule :</label>
                <input type="text" name="matricule" class="form-control" value="{{ old('matricule') }}" required>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
             </div>
                
            </div>

      <div class="row mt-3">
            <div class="col-md-6">
                    <label for="age">Âge</label>
                    <input type="number" name="age" class="form-control" min="18" max="60" placeholder="Votre âge">
               </div>
            <div class="col-md-6">
                <label for="numero_whatsapp">Numéro WhatsApp</label>
               <input type="text" name="numero_whatsapp" class="form-control" placeholder="Ex: +226 70 12 34 56">
           </div>
     </div>
     
     
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Adresse Email :</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
               <div class="col-md-6">
                    <label for="residence" class="form-label">Résidence :</label>
                    <input type="text" name="residence" class="form-control" value="{{ old('residence') }}" required>
                </div>
    </div>
    <div class="row mt-3">
                <div class="col-md-6">
                    <label for="parent_tuteur">Parent ou Tuteur</label>
                    <input type="text" name="parent_tuteur" class="form-control" placeholder="Nom du parent ou tuteur">
               </div>
                
               <div class="col-md-6">
                   <label for="numero_tuteur">Numéro du tuteur</label>
                   <input type="text" name="numero_tuteur" class="form-control" placeholder="Ex: +226 78 90 12 34">
               </div>
      </div>

            <div class="row mt-3 ">
                <div class="col-md-6">
                    <label for="campus" class="form-label">Campus :</label>
                    <input type="text" name="campus" class="form-control" value="{{ old('campus') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="filiere" class="form-label">Filière :</label>
                    <input type="text" name="filiere" class="form-control" value="{{ old('filiere') }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="annee" class="form-label">Année :</label>
                    <input type="number" name="annee" class="form-control" value="{{ old('annee') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="periode" class="form-label">Période de Stage :</label>
                    <input type="text" name="periode" class="form-control" value="{{ old('periode') }}" required>
             </div>
                <div class="form-group">
    <label for="commentaire">Commentaire</label>
    <textarea name="commentaire" class="form-control" rows="4" placeholder="Ajoutez vos remarques..."></textarea>
</div>
            </div>

            

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">Valider la candidature</button>
            </div>
        </form>
    </div>
</div>
    
                                       
@endsection