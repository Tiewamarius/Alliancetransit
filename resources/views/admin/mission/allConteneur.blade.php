@extends('layouts.admin')
@section('title','EnvoiColis')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Conteneur</h1>
    <!-- <a href="{{url('admin/Ajoutclients')}}" class="btn btn-primary mb-3">Ajouter un Client</a> -->
    <div class="container" style="overflow-x: auto;">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($conteneur as $conteneur)
            <tr>
                <td>{{ $conteneur->nom}}</td>
                <td>
                    <a href="{{ route('editeConteneur', $conteneur->id) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-pen"></i>
                    </a>
                    
                    <a href="{{ route('deleteConteneur', $conteneur->id) }}" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expédition ?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection