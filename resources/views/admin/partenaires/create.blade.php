<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="{{asset('admincss/https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admincss/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card {
        animation: fadeIn 0.8s ease-in-out;
    }


   /* .logo-partenaire {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    } */

    .logo-partenaire {
    width: 120px;
    height: 120px;
    object-fit: contain; /* Garde l'image entière sans la couper */
    border-radius: 50%;
    background-color: #f0f0f0; /* Fond pour images transparentes */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

</style>


    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin.index') }}">Admin Dashboard</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                     <!--   <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li> -->
                        <li>
    <a class="dropdown-item" href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Logout
    </a>
</li>

                    </ul> 
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('partenaires.create') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                PUBLIER UN STAGE
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                STAGES
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                
                                    <a class="nav-link" href="{{ route('admin.tous-stages') }}">Tous les Stages</a>
                                    <a class="nav-link" href="{{ route('admin.stages-valides') }}">Stages Validés</a>
                                    </nav>
                            </div>
                           
                        </div>
                    </div> 
                  
                </nav>
            </div> 
            <div id="layoutSidenav_content">


            <main>
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
                ➕ Créer un partenaire
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
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg shadow-sm">💾 Enregistrer</button>
        </div>
    </form>
</div>

        <h3 class="mt-4 text-center text-primary">Nos Partenaires 🤩</h3>

        <div class="row">
            @foreach($partenaires as $partenaire)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded p-3">
                    <div class="text-center">
                      <!--  <img src="{{ asset('storage/' . $partenaire->image) }}" class="img-fluid rounded-circle shadow-sm mb-3" style="width: 100px; height: 100px;"> -->
                        <img src="{{ Storage::url($partenaire->image) }}" class="logo-partenaire">
                        <h5 class="fw-bold text-primary">{{ $partenaire->nom }}</h5>
                    </div>
                    <p class="text-muted"><strong>Domaine :</strong> {{ $partenaire->domaine }}</p>
                    <p class="text-muted"><strong>Lieu :</strong> {{ $partenaire->lieu }}</p>
                    <p class="text-muted"><strong>Email :</strong> {{ $partenaire->email }}</p>
                    <p class="text-muted"><strong>Numéro :</strong> {{ $partenaire->numero }}</p>
                    <div class="text-center">
                    <a href="#" class="btn btn-warning btn-sm" onclick="remplirFormulaire({{ $partenaire->id }}, '{{ $partenaire->nom }}', '{{ $partenaire->domaine }}', '{{ $partenaire->lieu }}', '{{ $partenaire->email }}',
                     '{{ $partenaire->numero }}', '{{ asset('storage/' . $partenaire->image) }}')">✏️ Modifier</a>
                     <!--   <a href="{{ route('partenaires.edit', $partenaire->id) }}" class="btn btn-warning btn-sm">✏️ Modifier</a> -->
                        <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <script>
    

    function remplirFormulaire(id, nom, domaine, lieu, email, numero, imageUrl) {
        afficherFormulaire();

        document.getElementById('partenaireId').value = id;
        document.getElementById('nom').value = nom;
        document.getElementById('domaine').value = domaine;
        document.getElementById('lieu').value = lieu;
        document.getElementById('email').value = email;
        document.getElementById('numero').value = numero;
        
        if (imageUrl && imageUrl !== 'null') {
    document.getElementById('logoPreview').src = imageUrl;
    document.getElementById('logoPreview').style.display = 'block';
} else {
    document.getElementById('logoPreview').style.display = 'none';
}
        document.getElementById('formPartenaireAction').action = `/partenaires/${id}/update`;
    }

    function afficherFormulaire() {
        document.getElementById('formPartenaire').style.display = 'block';
    }




    function afficherFormulaire() {
        document.getElementById('formPartenaire').style.display = 'block';
    } 
</script>



</main>





            
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                           <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admincss/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admincss/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('admincss/assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admincss/js/datatables-simple-demo.js')}}"></script>
    </body>
</html>
