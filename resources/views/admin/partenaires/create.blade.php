@extends('layouts.custom')

@section('title', 'creer partenaire')

@section('content')


    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center text-primary">Ajouter un partenaire 🤝</h1>

        <!-- Affichage des messages de succès -->
        @if(session('success'))
            <div class="alert alert-success text-center fw-bold">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Bouton "Créer un partenaire" -->
        <div class="text-center mb-3">
            <button class="btn btn-lg btn-primary shadow-sm" onclick="afficherFormulaire()">
                ➕ Ajouter un partenaire
            </button>
        </div>

        <!-- Formulaire caché par défaut -->
        <div id="formPartenaire" class="card shadow-lg p-4 bg-light border-0 rounded" style="display: none;">


    <form id="formPartenaireAction" action="{{ route('partenaires.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="partenaireId">

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
                <label for="image" class="form-label">Logo</label>
                <input type="file" class="form-control" name="image">
              <!--  <img id="logoPreview" src="" class="img-fluid rounded-circle shadow-sm mt-2" style="width: 100px; height: 100px; display: none;"> -->
                <img id="logoPreview" class="img-fluid rounded-circle shadow-sm mt-2" style="width: 100px; height: 100px; display: none;">
                
            </div>
      
                    <div class="col-md-6 mb-3">
                        <label for="site_web" class="form-label">Site Web</label>
                        <input type="url" class="form-control" name="site_web" id="site_web">
                    </div>
                    <div class="col-md-6 mb-3">
                       <label for="localisation" class="form-label">Localisation</label>
                        <input type="text" name="localisation" placeholder="Localisation" class="form-control" required>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="domaine_recherche" class="form-label">Domaine recherché</label>
                        <input type="text" class="form-control" name="domaine_recherche" id="domaine_recherche" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombre_places" class="form-label">Nombre de places</label>
                        <input type="number" class="form-control" name="nombre_places" id="nombre_places" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombre_places" class="form-label">Niveu recquis</label>
                        <input type="number" class="form-control" name="niveau_recherche" id="niveau_recherche" required>
                    </div>
                </div>

                <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="type_stage" class="form-label">Type de stage :</label>
                             <select id="type_stage" name="type_stage" class="form-control" onchange="toggleFraisStage()">
                                 <option value="gratuit">Gratuit</option>
                                 <option value="payant">Payant</option>
                             </select>
                         </div>

                         <div class="col-md-6 mb-3" id="frais_stage_box" style="display: none;">
                             <label for="frais_stage" class="form-label">Frais de stage (€)</label>
                             <input type="number" id="frais_stage" name="frais_stage" class="form-control" placeholder="Montant en €">
                         </div>
                     </div>
                

        

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg shadow-sm">💾 Enregistrer</button>
            <button type="button" class="btn btn-danger btn-lg shadow-sm" onclick="fermerFormulaire()">❌ Fermer</button>
        </div>
   </form>
 </div>






            <h3 class="mt-4 text-center text-primary">Nos Partenaires 🤩</h3>

<div class="row">
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
            <p><strong>Type de stage :</strong> {{ $partenaire->type_stage }} </p>
            <p><strong>Frais :</strong> {{ $partenaire->frais_stage }} Fcfa</p>
            </div>
  


            <div class="text-center">
    <!-- Icône "+" pour afficher les détails -->
    <button class="btn btn-info btn-sm" onclick="toggleDetails('{{ $partenaire->id }}')">
                <i class="fas fa-plus-circle"></i>
            </button>




          <!--  <a href="#" class="btn btn-warning btn-sm" onclick="remplirFormulaire(
                            '{{ $partenaire->id }}', 
                            '{{ $partenaire->nom }}', 
                            '{{ $partenaire->domaine }}', 
                            '{{ $partenaire->lieu }}', 
                            '{{ $partenaire->email }}', 
                            '{{ $partenaire->numero }}', 
                            '{{ asset('storage/' . $partenaire->image) }}',
                            '{{ $partenaire->site_web }}',
                            '{{ $partenaire->localisation }}',
                            '{{ $partenaire->domaine_recherche }}',
                            '{{ $partenaire->nombre_places }}',
                            '{{ $partenaire->niveau_recherche }}',
                            '{{ $partenaire->type_stage }}',
                            '{{ $partenaire->frais_stage }}'
                        )"><i class="fas fa-edit"></i></a> -->

                        <a href="{{ route('partenaires.edit', $partenaire->id) }}" class="btn btn-warning btn-sm">
                                       <i class="fas fa-edit"></i>
                           </a>

                
                <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmSuppression('{{ route('partenaires.destroy', $partenaire->id) }}')">
                       <i class="fas fa-trash-alt"></i> 
                    </button>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach



        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>


function toggleDetails(id) {
        let details = document.getElementById('details-' + id);
        details.style.display = details.style.display === "none" ? "block" : "none";
    }
    

    function remplirFormulaire(id, nom, domaine, lieu, email, numero, site_web, localisation, domaine_recherche, 
    nombre_places, niveau_recherche, imageUrl, frais_stage) {
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
        document.getElementById('formPartenaire').style.display = 'block';
    }

    function fermerFormulaire() {
    document.getElementById('formPartenaire').style.display = 'none';
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

    if (typeStage === "payant") {
        fraisStageBox.style.display = "block"; 
        fraisStageBox.style.opacity = "1"; 
        fraisStageBox.style.transition = "opacity 0.5s ease-in-out";
    } else {
        fraisStageBox.style.opacity = "0"; 
        setTimeout(() => { fraisStageBox.style.display = "none"; }, 500);
        document.getElementById("frais_stage").value = ""; 
    }
}



</script>



@endsection