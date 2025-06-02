@extends('layouts.custom')

@section('title', 'tout stages')

@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">Toutes les demandes de stage</h2>

        <div class="card shadow-sm p-4">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th> <!-- ✅ Ajout de la colonne Numéro -->
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Filière</th>
                        <th>Statut</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stages as $index => $stage) <!-- ✅ Utilisation de $index pour la numérotation -->
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- ✅ Affichage du numéro -->
                        <td>{{ $stage->matricule }}</td>
                        <td>{{ $stage->nom }}</td>
                        <td>{{ $stage->prenom }}</td>
                        <td>{{ $stage->filiere }}</td>
                        <td>
                            <span class="badge 
                                {{ $stage->statut == 'en attente' ? 'bg-warning' : ($stage->statut == 'validé' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($stage->statut) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($stage->statut == 'en attente')
                                <form action="{{ route('stage.valider', ['id' => $stage->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Voulez-vous valider cette demande ?');">
                                       <i class="fas fa-check"></i> Valider
                                     </button>
                                    
                                </form>

                                <button class="btn btn-danger btn-sm" onclick="afficherFormRejet({{ $stage->id }})">
                                    <i class="fas fa-times"></i> Rejeter
                                </button>

                                <div id="formRejet-{{ $stage->id }}" style="display:none; margin-top:10px;">
                                    <form action="{{ route('stage.rejeter', ['id' => $stage->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="motif_rejet" class="form-control" placeholder="Raison du rejet..." required>
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Confirmer le rejet</button>
                                    </form>
                                </div>
                            @endif
                        </td>

                        <td class="text-center">
                            <button class="btn btn-info btn-sm" onclick="toggleDetails({{ $stage->id }})">
                                <i class="fas fa-plus-circle"></i>
                            </button>

                            <div id="details-{{ $stage->id }}" style="display: none; padding:10px; border:1px solid #ddd; background:#f9f9f9;">
                            <p><strong>Matricule :</strong> {{ $stage->matricule }}</p>
                                <p><strong>Nom :</strong> {{ $stage->nom }}</p>
                                <p><strong>Prénom :</strong> {{ $stage->prenom }}</p>
                                <p><strong>Email :</strong> {{ $stage->email }}</p>
                                <p><strong>Résidence :</strong> {{ $stage->residence }}</p>
                                <p><strong>Campus :</strong> {{ $stage->campus }}</p>
                                <p><strong>Filière :</strong> {{ $stage->filiere }}</p>
                                <p><strong>Année :</strong> {{ $stage->annee }}</p>
                                <p><strong>Période de Stage :</strong> {{ $stage->periode }}</p>
                                <p><strong>Partenaire :</strong> {{ $stage->partenaire->nom }}</p>
                                <p><strong>Numéro WhatsApp :</strong> {{ $stage->numero_whatsapp }}</p>
                                <p><strong>Commentaire :</strong> {{ $stage->commentaire }}</p>
                                <p><strong>Âge :</strong> {{ $stage->age }}</p>
                                <p><strong>Parent ou Tuteur :</strong> {{ $stage->parent_tuteur }}</p>
                                <p><strong>Numéro Tuteur :</strong> {{ $stage->numero_tuteur }}</p>
                            </div>
                        </td>

                        @if($stage->statut === 'rejeté')
                        <td>
                            <span class="badge bg-danger">Rejeté</span>
                            <p class="text-muted">Motif : {{ $stage->motif_rejet }}</p>
                        </td>
                        @endif

                        @if($stage->statut === 'validé')
                        <td>
                            <a href="{{ route('admin.stages-remettre-en-attente', $stage->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-undo"></i> Remettre en attente
                            </a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>     

    <script>
    function afficherFormRejet(id) {
        document.getElementById('formRejet-' + id).style.display = 'block';
    }

    function toggleDetails(id) {
        let details = document.getElementById('details-' + id);
        details.style.display = details.style.display === "none" ? "block" : "none";
    }
    </script>
@endsection


