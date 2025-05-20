
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
            <a class="navbar-brand ps-3" href="index.html">Students Dashboard</a>
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
                      
 <li>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Logout
    </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
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
                            <a class="nav-link" href="{{ route('postuler') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Postuler a un Stage
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Stages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('mes-stages') }}">Mes stages</a>
                                    <a class="nav-link" href="layout-static.html">Statut de mes stages</a>
                                    <!--<a class="nav-link" href="layout-sidenav-light.html">Stages en Attente</a> -->
                                    </nav>
                            </div>
                           
                       </div>
                    </div> 
                  
                </nav>
            </div> 
            <div id="layoutSidenav_content">
            <main class="ms-5">
                   
              


<div class="container-fluid mt-5">
<div class="card shadow-sm p-4 ms-5">
    <h2 class="text-center mb-4">Postuler chez {{ $partenaire->nom }}</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('stage.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="partenaire_id" value="{{ $partenaire->id }}">

            <div class="mb-3">
                <label for="matricule" class="form-label">Numéro Matricule :</label>
                <input type="text" name="matricule" class="form-control" value="{{ old('matricule') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Adresse Email :</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="residence" class="form-label">Résidence :</label>
                    <input type="text" name="residence" class="form-control" value="{{ old('residence') }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="campus" class="form-label">Campus :</label>
                    <input type="text" name="campus" class="form-control" value="{{ old('campus') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="filiere" class="form-label">Filière :</label>
                    <input type="text" name="filiere" class="form-control" value="{{ old('filiere') }}" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="annee" class="form-label">Année :</label>
                    <input type="number" name="annee" class="form-control" value="{{ old('annee') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="periode" class="form-label">Période de Stage :</label>
                    <input type="text" name="periode" class="form-control" value="{{ old('periode') }}" required>
                </div>
            </div>

            

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">Valider la candidature</button>
            </div>
        </form>
    </div>
</div>
    
                                       
                </main>
</div>
                
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
