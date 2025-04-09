@extends('layouts.admin')
@section('title','EnvoiColis')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste Rdv</h1>
    <!-- <a href="{{url('admin/Ajoutclients')}}" class="btn btn-primary mb-3">Ajouter un Client</a> -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N° Suivi</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Heure retrait</th>
                <th>Date retrait</th>
                <th>designation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rendevouses as $rdv)
            <tr>
                <td>{{ $rdv->numero_suivi}}</td>
                <td>{{ $rdv->nom}}</td>
                <td>{{ $rdv->telephone}}</td>
                <td>{{ $rdv->heure_retrait }}</td>
                <td>{{ $rdv->date_retrait}}</td>
                <td>{{ $rdv->designation}}</td>
                <td>
                    <form action="{{ route('deleteRdv.destroy',$rdv->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection