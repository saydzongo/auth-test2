
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
                                   
                                    <!--<a class="nav-link" href="layout-sidenav-light.html">Stages en Attente</a> -->
                                    </nav>
                            </div>
                           
                       </div>
                    </div> 
                  
                </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
                   
               
               
<div class="container mt-5">
    <h2 class="text-center mb-4">Mes stages postulés</h2>

    <div class="card shadow-sm p-4">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nom du Partenaire</th>
                    <th>Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stages as $stage)
                <tr>
                    <td>{{ $stage->partenaire ? $stage->partenaire->nom : 'Partenaire inconnu' }}</td>
                <!--    <td>
                        <span class="badge 
                            {{ $stage->statut == 'en attente' ? 'bg-warning' : ($stage->statut == 'validé' ? 'bg-success' : 'bg-danger') }}">
                            {{ ucfirst($stage->statut) }}
                        </span>
                    </td> -->
                    <td>
                   
                                        <span class="badge 
                        @if ($stage->statut == 'validé') bg-success 
                       @elseif ($stage->statut == 'rejeté') bg-danger 
                        @else bg-warning 
                        @endif">
                             {{ ucfirst($stage->statut) }}
                    </span>
                    </td>


                  <!--  <td class="text-center">
                        <a href="{{ route('stage.edit', ['id' => $stage->id]) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('stage.destroy', ['id' => $stage->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette candidature ?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td> -->
                                     <td class="text-center">
                     @if ($stage->statut == 'en attente') {{-- Affiche les boutons seulement si le stage est encore modifiable --}}
                         <a href="{{ route('stage.edit', ['id' => $stage->id]) }}" class="btn btn-sm btn-warning">
                             <i class="fas fa-edit"></i> Modifier
                         </a>
                         <form action="{{ route('stage.destroy', ['id' => $stage->id]) }}" method="POST" style="display:inline;">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette candidature ?');">
                                 <i class="fas fa-trash"></i> Supprimer
                             </button>
                         </form>
                     @else
                         <span class="text-muted">Modification non autorisée</span>
                    @endif
                 </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</table>


         
                                       
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
