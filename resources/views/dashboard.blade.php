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
            <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">Students Dashboard</a>
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
                                    
                                    <!--<a class="nav-link" href="layout-sidenav-light.html">Stages en Attente</a> -->
                                    </nav>
                            </div>
                           
                       </div>
                    </div> 
                  
                </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
           <!--

<div class="card shadow-lg p-4 bg-light border-0 rounded">
    <div class="card-body text-center">
        @php
            $hour = now()->hour;
            $message = $hour < 12 ? '🌞 Bonjour' : ($hour < 18 ? '🌤️ Bon après-midi' : '🌙 Bonsoir');
        @endphp

        <h2 class="text-primary fw-bold">
            {{ $message }}, {{ $user->name }} !
        </h2>
        <p class="text-muted mb-3">
            <i class="fas fa-envelope"></i> {{ $user->email }}
        </p>
        <p class="text-muted mb-3">
            📅 Date d'inscription : <strong>{{ $user->created_at->format('d-m-Y') }}</strong>
        </p>
        <hr>
        <p class="text-secondary">Nous sommes ravis de vous voir ici! 😊</p>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card {
        animation: fadeIn 0.8s ease-in-out;
    }
</style> -->

    <div class="container">
        <h2>Bienvenue sur votre tableau de bord</h2>

        {{-- Actions réservées à l'admin --}}
        @role('admin')
            <a href="{{ route('admin.tous-stages') }}" class="btn btn-primary">Gérer tous les stages</a>
            <a href="{{ route('admin.gestion-users') }}" class="btn btn-warning">Gérer les Utilisateurs</a>
        @endrole

        {{-- Actions réservées à l'étudiant --}}
        @role('etudiant')
            <p>Voici vos stages validés :</p>
            <ul>
                @foreach($stages as $stage)
                    <li>{{ $stage->nom }} - {{ $stage->periode }}</li>
                @endforeach
            </ul>
        @endrole
    </div>

<!--


    @if(isset($stages))
    <ul>
        @foreach($stages as $stage)
            <li>{{ $stage->nom }} - {{ $stage->periode }}</li>
        @endforeach
    </ul>
@else
    <p>Aucun stage trouvé.</p>
@endif -->




                     
                            
                                       
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
