
@extends('layouts.custom')

@section('title', 'mes stages')

@section('content')
                
                   
               
               
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



                    @if($stage->statut === 'rejeté')
                     <td>
                        
                         <p class="text-muted"><strong>Motif :</strong> {{ $stage->motif_rejet ?? 'Non spécifié' }}</p>
                     </td>
                 @endif
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
<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
            {{ $stages->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

</table>


         
 @endsection

