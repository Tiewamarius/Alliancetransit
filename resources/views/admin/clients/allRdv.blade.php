@extends('layouts.admin')
@section('title','EnvoiColis')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste Rdv</h1>
    <!-- <a href="{{url('admin/Ajoutclients')}}" class="btn btn-primary mb-3">Ajouter un Client</a> -->
    <div class="container" style="overflow-x: auto;">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Heure retrait</th>
                <th>Date retrait</th>
                <th>designation</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($rendevouses as $rdv)
            <tr>
                <td>{{ $rdv->nom}}</td>
                <td>{{ $rdv->telephone}}</td>
                <td>{{ $rdv->heure_retrait }}</td>
                <td>{{ $rdv->date_retrait}}</td>
                <td>{{ $rdv->designation}}</td>
                <td>
                    @php
                    $dateRetrait = \Carbon\Carbon::parse($rdv->date_retrait);
                    @endphp

                    @if ($dateRetrait->isPast())
                        <form action="{{ route('deleteRdv.destroy',$rdv->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    @elseif ($dateRetrait->isToday())
                    <button type="button" class="btn btn-warning">Aujourd'hui</button>
                    @else
                    <button type="button" class="btn btn-secondary">Avenir</button>
                    @endif
                </td>
                <td>
                @if ($rdv->status === 'non traite')
                    <form action="{{ route('rdv.statut.traite', ['rdv' => $rdv->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-info" style="padding:5px; color:white;">
                            Validé
                        </button>
                    </form>
                @else
                    <i class="fas fa-check-circle fa-fw" style="color: green;"></i>
                @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection