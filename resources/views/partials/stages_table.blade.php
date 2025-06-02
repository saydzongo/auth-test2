<tbody id="tableBody">
@foreach ($stages as $stage)
<tr>
    <td>{{ $stage->matricule }}</td>
    <td>{{ $stage->nom }}</td>
    <td>{{ $stage->prenom }}</td>
    <td>{{ $stage->filiere }}</td>

   <!-- <td>{{ $stage->email }}</td>
    <td>{{ $stage->residence }}</td>
    <td>{{ $stage->campus }}</td>
    <td>{{ $stage->filiere }}</td>
    <td>{{ $stage->annee }}</td>
    <td>{{ $stage->periode }}</td>
    <td>{{ $stage->numero_whatsapp }}</td>
    <td>{{ $stage->numero_tuteur }}</td> -->
    <td>
        <span class="badge 
            {{ $stage->statut == 'en attente' ? 'bg-warning' : ($stage->statut == 'validé' ? 'bg-success' : 'bg-danger') }}">
            {{ ucfirst($stage->statut) }}
        </span>
    </td>
</tr>

@endforeach
</tbody>