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
    <!-- Créer un partenaire -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4 hover-effect">
            <div class="card-body d-flex align-items-center justify-content-between">
                <span><i class="fas fa-handshake me-2"></i>Créer un Partenaire</span>
                <i class="fas fa-angle-right"></i>
            </div>
            <div class="card-footer text-white">
                <a class="small text-white stretched-link" href="{{ route('partenaires.create') }}">Ajouter</a>
            </div>
        </div>
    </div>

    <!-- Tous les stages -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4 hover-effect">
            <div class="card-body d-flex align-items-center justify-content-between">
                <span><i class="fas fa-list-alt me-2"></i>Tous les Stages</span>
                <i class="fas fa-angle-right"></i>
            </div>
            <div class="card-footer text-white">
                <a class="small text-white stretched-link" href="{{ route('admin.tous-stages') }}">Voir</a>
            </div>
        </div>
    </div>

    <!-- Stages validés -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4 hover-effect">
            <div class="card-body d-flex align-items-center justify-content-between">
                <span><i class="fas fa-check-circle me-2"></i>Stages Validés</span>
                <i class="fas fa-angle-right"></i>
            </div>
            <div class="card-footer text-white">
                <a class="small text-white stretched-link" href="{{ route('admin.stages-valides') }}">Consulter</a>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->role == 'etudiant')
<div class="row mt-4">
    <!-- Faire une Demande -->
    <div class="col-xl-3 col-md-6 hover-effect">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body d-flex align-items-center justify-content-between">
                <span><i class="fas fa-briefcase me-2"></i>Faire une Demande</span>
                <i class="fas fa-angle-right"></i>
            </div>
            <div class="card-footer text-white">
                <a class="small text-white stretched-link" href="{{ route('postuler') }}">Postuler</a>
            </div>
        </div>
    </div>

    <!-- Mes Demandes -->
    <div class="col-xl-3 col-md-6 hover-effect">
        <div class="card bg-info text-white mb-4">
            <div class="card-body d-flex align-items-center justify-content-between">
                <span><i class="fas fa-folder-open me-2"></i>Mes Demandes</span>
                <i class="fas fa-angle-right"></i>
            </div>
            <div class="card-footer text-white">
                <a class="small text-white stretched-link" href="{{ route('mes-stages') }}">Voir</a>
            </div>
        </div>
    </div>
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