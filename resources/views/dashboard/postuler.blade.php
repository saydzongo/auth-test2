




@extends('layouts.custom')

@section('title', 'Postuler')

@section('content')
  
<div class="container mt-3">
    <button class="btn btn-secondary shadow-sm" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> 
    </button>
</div>
 

<div class="container mt-5">
        <h2 class="text-center mb-4 text-primary">🌟 Nos Partenaires 🌟</h2>

        <div class="row">
            @foreach ($partenaires as $partenaire)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded p-3 text-center partenaire-card">
                    <div class="text-center">
                        <img src="{{ Storage::url($partenaire->image) }}" class="img-fluid rounded-circle shadow-sm mb-3 logo-partenaire">
                        <h5 class="fw-bold text-primary">{{ $partenaire->nom }}</h5>
                        <p class="text-muted"><strong>Domaine :</strong> {{ $partenaire->domaine }}</p>
                    </div>

                   
                    <!-- Détails cachés par défaut -->
                    <div id="details-{{ $partenaire->id }}" style="display: none;">
                        <p><strong>Lieu :</strong> {{ $partenaire->lieu }}</p>
                        <p><strong>Email :</strong> {{ $partenaire->email }}</p>
                        <p><strong>Numéro :</strong> {{ $partenaire->numero }}</p>              
                        <p><strong>Site Web :</strong> {{ $partenaire->site_web ?? 'Non spécifié' }}</p>
                        <p><strong>Localisation :</strong> {{ $partenaire->localisation ?? 'Non spécifié' }}</p>
                        <p><strong>Domaine recherché :</strong> {{ $partenaire->domaine_recherche ?? 'Non spécifié' }}</p>
                        <p><strong>Places :</strong> {{ $partenaire->nombre_places ?? '0' }}</p>
                        <p><strong>Niveau requis :</strong> {{ $partenaire->niveau_recherche ?? 'Non spécifié' }}</p>
                        <p><strong>Frais :</strong> {{ $partenaire->frais_stage ?? '0' }} €</p>
                    </div>

                    <div class="text-center mt-2">

                    <!-- Icône "+" pour afficher les détails -->
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('{{ $partenaire->id }}')">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                    <a href="{{ route('stage.create', ['id' => $partenaire->id]) }}" class="btn btn-primary btn-sm shadow-sm">
    <i class="fas fa-paper-plane"></i> 
</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
    function toggleDetails(id) {
        let details = document.getElementById('details-' + id);
        details.style.display = details.style.display === "none" ? "block" : "none";
    }
    </script>




@endsection