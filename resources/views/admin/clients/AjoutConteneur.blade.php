@extends('layouts.admin')
@section('title','AjoutConteneur')

@section('content')
<div class="container">
    <h2 class="mb-4">Ajouter un Conteneur</h2>
    <div class="card">
        <div class="card-body">@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('storeConteneur') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="container_number" class="form-label">Numéro du Conteneur *</label>
                    <input type="text" name="container_number" id="container_number" class="form-control" placeholder="Numéro du Conteneur" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type *</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="">Choisir un type</option>
                        <option value="Conteneur standard">Conteneur standard</option>
                        <option value="Conteneur Réfrigéré">Conteneur Réfrigéré</option>
                        <option value="Conteneur Open Top">Conteneur Open Top</option>
                        <option value="Conteneur High Cube">Conteneur High Cube</option>
                        <option value="Conteneur Flat Rack">Conteneur Flat Rack</option>
                        <option value="Conteneur Citerne">Conteneur Citerne</option>
                        <option value="Le conteneur- stockage">Le conteneur- stockage</option>
                        <!-- Ajouter les options dynamiquement -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Emplacement *</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Emplacement" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url('admin.dashbord') }}" class="btn btn-light me-2">Abandonner</a>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection