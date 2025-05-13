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
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Admin Dashboard</a>
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
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Publier un Partenaire
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Statut des Stages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Touts les Stages</a>
                                    <a class="nav-link" href="layout-static.html">Stages Validés</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Stages en Attente</a>
                                </nav>
                            </div>
                           
                        </div>
                    </div> 
                  
                </nav>
            </div> 
            <div id="layoutSidenav_content">


                <main>
                  

                    <div class="container-fluid px-4">
    <h1 class="mt-4">Ajouter un partenaire</h1>

    <!-- Affichage des messages de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bouton "Créer un partenaire" -->
    <button class="btn btn-primary mb-3" onclick="afficherFormulaire()">Créer un partenaire</button>

    <!-- Formulaire caché par défaut -->
    <div id="formPartenaire" style="display: none;">
        <form action="{{ route('partenaires.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du partenaire</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="domaine" class="form-label">Domaine</label>
                <input type="text" class="form-control" name="domaine" required>
            </div>
            <div class="mb-3">
                <label for="lieu" class="form-label">Lieu</label>
                <input type="text" class="form-control" name="lieu" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Numéro</label>
                <input type="text" class="form-control" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Logo</label>
                <input type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </div>

    <!-- Liste des partenaires existants -->
    <h3 class="mt-4">Liste des partenaires</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Domaine</th>
                <th>Lieu</th>
                <th>Email</th>
                <th>Numéro</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partenaires as $partenaire)
            <tr>
                <td>{{ $partenaire->nom }}</td>
                <td>{{ $partenaire->domaine }}</td>
                <td>{{ $partenaire->lieu }}</td>
                <td>{{ $partenaire->email }}</td>
                <td>{{ $partenaire->numero }}</td>
                <td><img src="{{ asset('storage/' . $partenaire->image) }}" width="50"></td>
                <td>
                    <a href="{{ route('partenaires.edit', $partenaire->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
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
