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
/* DEBUT STYLE INDEX.BLADE */  


.hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-effect:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

/* FIN STYLE INDEX.BLADE */  


          /* DEBUT STYLE POSTULER */           

    .logo-partenaire {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .partenaire-card {
    padding: 15px;
    min-height: 260px; /* ✅ Réduction de la hauteur du cadre */
}

.btn-info {
    margin-top: 10px;
    margin-right: 10px;
    display: inline-block;
}

.btn-primary i {
    font-size: 18px; /* ✅ Ajuste la taille de l’icône */
    padding: 5px; /* ✅ Ajoute un léger espace autour */
}

         /*  FIN STYLE POSTULER */ 


         /* DEBUT STYLE CREATE PARTENAIRE */

         @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card {
        animation: fadeIn 0.8s ease-in-out;
    }


   
    .logo-partenaire {
    width: 120px;
    height: 120px;
    object-fit: contain; /* Garde l'image entière sans la couper */
    border-radius: 50%;
    background-color: #f0f0f0; /* Fond pour images transparentes */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

.btn-info {
    margin-right: 20px;
}

.btn-warning {
    margin-right: 20px;
}

.bouton-flottant {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    font-size: 24px;
    border-radius: 50%;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bouton-flottant:hover {
    transform: scale(1.1);
    transition: transform 0.2s ease-in-out;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

.btn-close-modal {
    position: absolute;
    top: 10px;
    right: 15px;
    background: transparent;
    border: none;
    font-size: 24px;
    cursor: pointer;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }


    .bouton-flottant {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    font-size: 24px;
    border-radius: 50%;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: flex;
    align}

   
}

/* FIN STYLE CREATE PARTENAIRE */



 /* DEBUT STYLE EDIT PARTENAIRE */






 /* FIN STYLE EDIT PARTENAIRE */





</style>



    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin.index') }}"> Dashboard</a>
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

                        @if(auth()->user() && auth()->user()->role === 'admin')
                         
                            <a class="nav-link" href="{{ route('partenaires.create') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                LISTE DES PARTENAIRES
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
                       @endif
                    </div>                  
                </nav>
            </div>            
            <div id="layoutSidenav_content">


                <main>
                @yield('content') <!-- Chaque vue pourra injecter son propre contenu ici -->
         
                </main>
            </div>
                
         <!--   </div> 
        </div> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admincss/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admincss/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('admincss/assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admincss/js/datatables-simple-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>
</html>
