@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')
<style>
    h4{
        color:blue;
    }
    label{
        color:black;
        font-weight: 400;
    }
    .form-control{
        border: 1px solid blue;
        color:black;
        font-weight:800;
    }
    .is-invalid {
        border-color: red !important;
    }
    .invalid-feedback {
        color: red;
        display: none;
    }
</style>
<div class="container mt-4">
    <h2>Ajout de conteneur</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <form action="{{ route('admin.updateConteneur', $conteneur->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <br>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <label for="nom_expediteur">Nom Conteneur</label>
                            <input type="text" name="nom" class="form-control" id="nom_expediteur" value="{{$conteneur->nom}}">
                        </div><br>
                        <button type="submit" class="btn btn-success expedier">MODIFIER</button>
            
                    </div>
                </div>
            </div>
        </div>
    </form>
        
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection