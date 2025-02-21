@extends('layouts.admin')
@section('title','EnvoiColis')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Clients</h1>
    <a href="{{url('admin/Ajoutclients')}}" class="btn btn-primary mb-3">Ajouter un Client</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ident.</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->code_unique}}</td>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->adresse }}</td>
                <td>
<<<<<<< HEAD
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
=======
                    <a href="{{ route('clients.editClient', $client->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('clients.destroyClient', $client->id) }}" method="POST" style="display:inline-block;">
>>>>>>> a1e8f092d60808c0d58dcc0c31c8ccb7de5cdbae
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
