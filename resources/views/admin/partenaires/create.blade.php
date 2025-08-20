@extends('layouts.custom')

@section('title', 'creer partenaire')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center text-primary">Liste des partenaires </h1>
@if(session('success'))
        <div class="alert alert-success text-center fw-bold">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Bouton flottant -->
    <button class="btn btn-primary btn-lg rounded-circle shadow-lg bouton-flottant" onclick="afficherFormulaire()" title="Ajouter un partenaire">
        ➕
    </button>

    <!-- Formulaire en pop-up -->
<div id="formPartenaireOverlay" class="custom-overlay" style="display: none;">
    <div class="custom-modal">
        <button class="btn-close-modal" onclick="fermerFormulaire()">❌</button>

        <form id="formPartenaireAction" action="{{ route('partenaires.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="partenaireId">

            <!-- Identité du partenaire -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom du partenaire</label>
                    <input type="text" class="form-control" name="nom" id="nom" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="domaine" class="form-label">Domaine</label>
                    <input type="text" class="form-control" name="domaine" id="domaine" required>
                </div>
            </div>

            <!-- Coordonnées -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" class="form-control" name="lieu" id="lieu" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numero" class="form-label">Numéro</label>
                    <input type="text" class="form-control" name="numero" id="numero" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="site_web" class="form-label">Site Web</label>
                    <input type="url" class="form-control" name="site_web" id="site_web">
                </div>
            </div>

            <!-- Localisation et logo -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="localisation" class="form-label">Localisation</label>
                    <input type="text" name="localisation" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Logo</label>
                    <input type="file" class="form-control" name="image">
                    <img id="logoPreview" class="img-fluid rounded-circle shadow-sm mt-2" style="width: 100px; height: 100px; display: none;">
                </div>
            </div>

            <!-- Recherche et critères -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="domaine_recherche" class="form-label">Domaine recherché</label>
                    <input type="text" class="form-control" name="domaine_recherche" id="domaine_recherche" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nombre_places" class="form-label">Nombre de places</label>
                    <input type="number" class="form-control" name="nombre_places" id="nombre_places" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="niveau_recherche" class="form-label">Niveau requis</label>
                    <select name="niveau_recherche" id="niveau_recherche" class="form-control" required>
                        <option value="Licence1">Licence1</option>
                        <option value="Licence2">Licence2</option>
                        <option value="Licence3">Licence3</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="type_stage" class="form-label">Type de stage :</label>
                    <select id="type_stage" name="type_stage" class="form-control" onchange="toggleFraisStage()">
                        <option value="gratuit">Gratuit</option>
                        <option value="payant">Payant</option>
                    </select>
                </div>
            </div>

            <!-- Champs conditionnels : paiement -->
            <div class="row">
                <div class="col-md-6 mb-3" id="numero_payment_box" style="display: none;">
                    <label for="numero_payment" class="form-label">Numéro de dépôt</label>
                    <input type="text" id="numero_payment" name="numero_payment" class="form-control" placeholder="Ex: 70 00 00 00">
                </div>
                <div class="col-md-6 mb-3" id="frais_stage_box" style="display: none;">
                    <label for="frais_stage" class="form-label">Frais de stage (€)</label>
                    <input type="number" id="frais_stage" name="frais_stage" class="form-control" placeholder="Montant en €">
                </div>
            </div>

            <!-- Boutons -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg shadow-sm">💾 Enregistrer</button>
                <button type="button" class="btn btn-danger btn-lg shadow-sm" onclick="fermerFormulaire()">❌ Fermer</button>
            </div>
        </form>
    </div>
    </div>

    <!-- Liste des partenaires -->
    <div class="row mt-5">
        @foreach($partenaires as $partenaire)

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded p-3 partenaire-card">
                <div class="text-center">
                    <img src="{{ Storage::url($partenaire->image) }}" class="logo-partenaire">
                    <h5 class="fw-bold text-primary">{{ $partenaire->nom }}</h5>
                    <p class="text-muted"><strong>Domaine :</strong> {{ $partenaire->domaine }}</p>
                </div>
                <div id="details-{{ $partenaire->id }}" style="display: none;">
                    <p><strong>Lieu :</strong> {{ $partenaire->lieu }}</p>
                    <p><strong>Email :</strong> {{ $partenaire->email }}</p>
                    <p><strong>Numéro :</strong> {{ $partenaire->numero }}</p>
                    <p><strong>Site Web :</strong> {{ $partenaire->site_web }}</p>
                    <p><strong>Localisation :</strong> {{ $partenaire->localisation }}</p>
                    <p><strong>Domaine recherché :</strong> {{ $partenaire->domaine_recherche }}</p>
                    <p><strong>Places :</strong> {{ $partenaire->nombre_places }}</p>
                    <p><strong>Niveau requis :</strong> {{ $partenaire->niveau_recherche }}</p>
                    <p><strong>Type de stage :</strong> {{ $partenaire->type_stage }}</p>
                    <p><strong>Frais :</strong> {{ $partenaire->frais_stage }} Fcfa</p>
                    <p><strong>Numero de depot :</strong> {{ $partenaire->numero_payment }}</p>
                </div>
                <div class="text-center">
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('{{ $partenaire->id }}')">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                    <a href="{{ route('partenaires.edit', $partenaire->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmSuppression('{{ route('partenaires.destroy', $partenaire->id) }}')">
                            <i class="fas fa-trash-alt"></i> 
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

<!-- Pagination (à placer après la boucle) -->
<div class="d-flex justify-content-center mt-4">
    {{ $partenaires->links('pagination::bootstrap-5') }}
</div>


   <!-- 📊 Graphique comparatif -->
<div class="card mt-5 p-4 shadow">
    <h4 class="text-center">Top 5 partenaires : stages payants vs gratuits</h4>
    <canvas id="stageTypeChart" height="150"></canvas>
</div>



    <style>
.custom-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 9999;
    display: none;
    justify-content: center;
    align-items: center;
}
.custom-modal {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    width: 90%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    position: relative;
}
.btn-close-modal {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
}


.partenaire-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.partenaire-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

</style>

<script>
function afficherFormulaire() {
    document.getElementById('formPartenaireOverlay').style.display = 'flex';
}
function fermerFormulaire() {
    document.getElementById('formPartenaireOverlay').style.display = 'none';
}
</script>


</div>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>


function toggleDetails(id) {
        let details = document.getElementById('details-' + id);
        details.style.display = details.style.display === "none" ? "block" : "none";
    }
    

    function remplirFormulaire(id, nom, domaine, lieu, email, numero, site_web, localisation, domaine_recherche, 
    nombre_places, niveau_recherche, imageUrl, frais_stage, numero_payment, type_stage) {
        afficherFormulaire();

        document.getElementById('partenaireId').value = id;
    document.getElementById('nom').value = nom;
    document.getElementById('domaine').value = domaine;
    document.getElementById('lieu').value = lieu;
    document.getElementById('email').value = email;
    document.getElementById('numero').value = numero;
    document.getElementById('site_web').value = site_web;
    document.getElementById('localisation').value = localisation;
    document.getElementById('domaine_recherche').value = domaine_recherche;
    document.getElementById('nombre_places').value = nombre_places;
    document.getElementById('niveau_recherche').value = niveau_recherche;
    document.getElementById('frais_stage').value = frais_stage;
    document.getElementById('numero_payment').value = numero_payment;


        
        if (imageUrl && imageUrl !== 'null') {
    document.getElementById('logoPreview').src = imageUrl;
    document.getElementById('logoPreview').style.display = 'block';
} else {
    document.getElementById('logoPreview').style.display = 'none';
}
        document.getElementById('formPartenaireAction').action = `/partenaires/${id}/update`;

        document.getElementById('type_stage').value = type_stage;
toggleFraisStage(); // mise à jour dynamique des frais si payant

    }

    

function afficherFormulaire() {
    document.getElementById('formPartenaireOverlay').style.display = 'flex';
}

function fermerFormulaire() {
    document.getElementById('formPartenaireOverlay').style.display = 'none';
}


function confirmSuppression(url) {
    Swal.fire({
        title: "Êtes-vous sûr ?",
        text: "Cette action est irréversible !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Oui, supprimer!",
        cancelButtonText: "Annuler"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    _method: "DELETE"
                })
            }).then(response => {
                if (response.ok) {
                    Swal.fire("Supprimé!", "Le partenaire a été supprimé.", "success").then(() => {
                        window.location.href = "{{ route('admin.partenaires.create') }}"; // ✅ Redirection mise à jour
                    });
                } else {
                    Swal.fire("Erreur!", "Impossible de supprimer.", "error");
                }
            }).catch(error => {
                Swal.fire("Erreur!", "Une erreur est survenue.", "error");
            });
        }
    });
}


function toggleFraisStage() {
    let typeStage = document.getElementById("type_stage").value;
    let fraisStageBox = document.getElementById("frais_stage_box");
    let numeroPaymentBox = document.getElementById("numero_payment_box");

    if (typeStage === "payant") {
        fraisStageBox.style.display = "block";
        numeroPaymentBox.style.display = "block";
        fraisStageBox.style.opacity = "1";
        numeroPaymentBox.style.opacity = "1";
        fraisStageBox.style.transition = "opacity 0.5s ease-in-out";
        numeroPaymentBox.style.transition = "opacity 0.5s ease-in-out";
    } else {
        fraisStageBox.style.opacity = "0";
        numeroPaymentBox.style.opacity = "0";
        setTimeout(() => {
            fraisStageBox.style.display = "none";
            numeroPaymentBox.style.display = "none";
        }, 500);
        document.getElementById("frais_stage").value = "";
        document.getElementById("numero_payment").value = "";
    }
}



</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stageTypeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($topPayants as $p) "{{ $p->nom }}", @endforeach
                @foreach($topGratuits as $g) "{{ $g->nom }}", @endforeach
            ],
            datasets: [
                {
                    label: 'Stages Payants',
                    data: [@foreach($topPayants as $p) {{ $p->stages_count }}, @endforeach],
                    backgroundColor: '#e67e22'
                },
                {
                    label: 'Stages Gratuits',
                    data: [@foreach($topGratuits as $g) {{ $g->stages_count }}, @endforeach],
                    backgroundColor: '#3498db'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>




@endsection