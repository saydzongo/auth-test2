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
        
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
    </form>
</div> 

                     
@endsection
