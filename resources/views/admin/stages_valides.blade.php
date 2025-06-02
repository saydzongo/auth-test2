@extends('layouts.custom')

@section('title', 'Postuler')

@section('content')
                   
                    

<div class="container mt-5">
    <h2 class="text-center mb-4">Stages validés</h2>

    <div class="card shadow-sm p-4">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Filière</th>
                    <th>campus</th>
                    <th>Année</th>
                    <th>Période de Stage</th>
                    <th>Partenaire Choisi</th>
                    <th>Date de Validation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stages_valides as $stage)
                <tr>
                    <td>{{ $stage->matricule }}</td>
                    <td>{{ $stage->nom }}</td>
                    <td>{{ $stage->prenom }}</td>
                    <td>{{ $stage->filiere }}</td>
                    <td>{{ $stage->campus }}</td>
                    <td>{{ $stage->annee }}</td>
                    <td>{{ $stage->periode }}</td>
                    <td>{{ $stage->partenaire->nom }}</td>
                    <td>{{ $stage->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    </br>
    <a href="{{ route('stages.export') }}" class="btn btn-success">
    📥 Exporter la liste
</a>  

</div>  
</br>                
            
 @endsection
