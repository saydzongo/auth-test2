@extends('layouts.custom')

@section('title', 'index.blade')

@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">Bienvenue sur votre tableau de bord</h2>

        @if(isset($user))
    <h3>Bienvenue, {{ $user->name }}</h3>
@endif


        @if(Auth::user()->role == 'admin')
<div class="row mt-4">
    <!-- ✅ Carte : Créer un Partenaire -->
    <div class="col-md-4">
        <div class="card text-center p-3 shadow-lg hover-effect">
            <i class="fas fa-handshake fa-3x text-primary"></i>
            <h4 class="mt-2">Créer un Partenaire</h4>
            <p><strong>{{ $nombrePartenaires }}</strong> partenaires existants</p>
            <a href="{{ route('partenaires.create') }}" class="btn btn-primary mt-2">Ajouter</a>
        </div>
    </div>

    <!-- ✅ Carte : Tous les Stages -->
    <div class="col-md-4">
        <div class="card text-center p-3 shadow-lg hover-effect">
            <i class="fas fa-list-alt fa-3x text-info"></i>
            <h4 class="mt-2">Tous les Stages</h4>
            <p><strong>{{ $nombreStages }}</strong> stages au total</p>
            <a href="{{ route('admin.tous-stages') }}" class="btn btn-info mt-2">Voir</a>
        </div>
    </div>

    <!-- ✅ Carte : Stages Validés -->
    <div class="col-md-4">
        <div class="card text-center p-3 shadow-lg hover-effect">
            <i class="fas fa-check-circle fa-3x text-success"></i>
            <h4 class="mt-2">Stages Validés</h4>
            <p><strong>{{ $nombreStagesValides }}</strong> stages validés</p>
            <a href="{{ route('admin.stages-valides') }}" class="btn btn-success mt-2">Consulter</a>
        </div>
    </div>
</div>
@endif


@if(Auth::user()->role == 'etudiant')
<div class="row mt-4">
    <!-- ✅ Carte : Demander un Stage -->
    <div class="col-md-6">
        <div class="card text-center p-3 shadow-lg hover-effect">
            <i class="fas fa-briefcase fa-3x text-primary"></i>
            <h4 class="mt-2">Faire une Demande</h4>
            <p><strong>{{ $nombrePartenaires }}</strong> partenaires disponibles</p>
            <p class="text-muted">💰 Stages payants : <strong>{{ $nombreStagesPayants }}</strong></p>
            <p class="text-muted">🎓 Stages gratuits : <strong>{{ $nombreStagesGratuits }}</strong></p>            
            <a href="{{ route('postuler') }}" class="btn btn-primary mt-2">Postuler</a>
        </div>
    </div>

   <!-- ✅ Carte : Voir ses Demandes -->
   <div class="col-md-6">
        <div class="card text-center p-3 shadow-lg hover-effect">
            <i class="fas fa-folder-open fa-3x text-info"></i>
            <h4 class="mt-2">Mes Demandes</h4>
            <p><strong>{{ $nombreDemandes }}</strong> demandes effectuées</p>
            <p class="text-muted">🔵 {{ $nombreEnAttente }} en attente | ✅ {{ $nombreValides }} validées | ❌ {{ $nombreRejetes }} rejetées</p>
            <a href="{{ route('mes-stages') }}" class="btn btn-info mt-2">Voir mes demandes</a>
        </div>
    </div>
</div>
@endif

 

        <!-- ✅ Graphique de répartition des stages -->
        @if(Auth::user()->role == 'admin')
        <div class="card p-3 shadow mt-4">
            <h4 class="text-center">Répartition des Stages</h4>
            <canvas id="stagesChart" width="400" height="200"></canvas>
        </div>
        @endif



    </div>

    <!-- ✅ Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('stagesChart').getContext('2d');
        var stagesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['En attente', 'Validés', 'Rejetés'],
                datasets: [{
                    data: [{{ $nombreStagesEnAttente }}, {{ $nombreStagesValides }}, {{ $nombreStagesRejetes }}],
                    backgroundColor: ['#f1c40f', '#2ecc71', '#e74c3c']
                }]
            }
        });
    });
    </script>
    
@endsection