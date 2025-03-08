@extends('layouts.admin')


@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Ajouter un Client</h2>
    
    <div class="card">
        <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('storeClient')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div>
                        <input type="hidden" id="nom_client" name="code_client" value="{{$code_client}}">
                    </div>
                    <div class="col-md-6">
                        <label for="nom_client" class="form-label">Nom</label>
                        <input type="text" id="nom_client" name="nom_client" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="prenom_client" class="form-label">Prénom</label>
                        <input type="text" id="prenom_client" name="prenom_client" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="text" id="telephone_client" name="numero_client" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email_client" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="adresse_client" class="form-label">Adresse</label>
                    <input type="text" id="adresse_client" name="adresse_client" class="form-control" required>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection