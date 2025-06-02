
@extends('layouts.custom')

@section('title', 'edit stage')

@section('content')
                   
                <div class="container mt-5">
    <h2 class="text-center mb-4">Modifier ma candidature</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('stage.update', ['id' => $stage->id]) }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="matricule" class="form-label">Numéro Matricule :</label>
                <input type="text" name="matricule" class="form-control" value="{{ $stage->matricule }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" name="nom" class="form-control" value="{{ $stage->nom }}" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" name="prenom" class="form-control" value="{{ $stage->prenom }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Adresse Email :</label>
                    <input type="email" name="email" class="form-control" value="{{ $stage->email }}" required>
                </div>
                <div class="col-md-6">
                    <label for="residence" class="form-label">Résidence :</label>
                    <input type="text" name="residence" class="form-control" value="{{ $stage->residence }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="campus" class="form-label">Campus :</label>
                    <input type="text" name="campus" class="form-control" value="{{ $stage->campus }}" required>
                </div>
                <div class="col-md-6">
                    <label for="filiere" class="form-label">Filière :</label>
                    <input type="text" name="filiere" class="form-control" value="{{ $stage->filiere }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="annee" class="form-label">Année :</label>
                    <input type="number" name="annee" class="form-control" value="{{ $stage->annee }}" required>
                </div>
                <div class="col-md-6">
                    <label for="periode" class="form-label">Période de Stage :</label>
                    <input type="text" name="periode" class="form-control" value="{{ $stage->periode }}" required>
                </div>
            </div>

    

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>            
@endsection


