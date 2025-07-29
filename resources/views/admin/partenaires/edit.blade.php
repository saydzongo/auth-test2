@extends('layouts.custom')

@section('title', 'edit partenaire')

@section('content')
   

               
                <div class="container mt-4">
    <h2>Modifier le partenaire</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('partenaires.update', $partenaire->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du partenaire</label>
            <input type="text" class="form-control" name="nom" value="{{ $partenaire->nom }}" required>
        </div>
        <div class="mb-3">
            <label for="domaine" class="form-label">Domaine</label>
            <input type="text" class="form-control" name="domaine" value="{{ $partenaire->domaine }}" required>
        </div>
        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu</label>
            <input type="text" class="form-control" name="lieu" value="{{ $partenaire->lieu }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $partenaire->email }}" required>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Numéro</label>
            <input type="text" class="form-control" name="numero" value="{{ $partenaire->numero }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Logo</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
    <label for="site_web" class="form-label">Site Web</label>
    <input type="text" class="form-control" name="site_web" value="{{ $partenaire->site_web }}">
</div>

<div class="mb-3">
    <label for="localisation" class="form-label">Localisation</label>
    <input type="text" class="form-control" name="localisation" value="{{ $partenaire->localisation }}">
</div>

<div class="mb-3">
    <label for="domaine_recherche" class="form-label">Domaine recherché</label>
    <input type="text" class="form-control" name="domaine_recherche" value="{{ $partenaire->domaine_recherche }}">
</div>

<div class="mb-3">
    <label for="site_web" class="form-label">Site Web</label>
    <input type="text" class="form-control" name="site_web" value="{{ $partenaire->site_web }}">
</div>

<div class="mb-3">
    <label for="localisation" class="form-label">Localisation</label>
    <input type="text" class="form-control" name="localisation" value="{{ $partenaire->localisation }}">
</div>

<div class="mb-3">
    <label for="domaine_recherche" class="form-label">Domaine recherché</label>
    <input type="text" class="form-control" name="domaine_recherche" value="{{ $partenaire->domaine_recherche }}">
</div>

<div class="mb-3" id="frais_stage_box" style="{{ $partenaire->type_stage == 'payant' ? '' : 'display: none;' }}">
    <label for="frais_stage" class="form-label">Frais de stage (€)</label>
    <input type="number" class="form-control" name="frais_stage" value="{{ $partenaire->frais_stage }}">
</div>

@if($partenaire->image)
    <div class="mb-3">
        <img src="{{ Storage::url($partenaire->image) }}" class="img-fluid rounded-circle shadow-sm" style="width: 100px; height: 100px;">
    </div>
@endif
        
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
    </form>
</div> 





<script>
function toggleFraisStage() {
    let typeStage = document.querySelector('select[name="type_stage"]').value;
    let fraisBox = document.getElementById("frais_stage_box");
    if (typeStage === "payant") {
        fraisBox.style.display = "block";
    } else {
        fraisBox.style.display = "none";
        document.querySelector('input[name="frais_stage"]').value = "";
    }
}
</script>

     
@endsection
