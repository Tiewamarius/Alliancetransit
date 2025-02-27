@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

<div class="container mt-4">
    <h2>Modification de L'envoi</h2>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

    <form method="POST" action="{{ route('updateExpedition.update', $expeditions->id) }}">
        @csrf
        <br>
        <input type="text" id="nom_client" name="id"  value="{{$expeditions->id}}" style="display: none;">
        
        <h4>Information du colis</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom_client" class="form-label">Code de suivi</label>
                        <input type="text" id="nom_client" name="numeroSuivi" class="form-control" value="{{$expeditions->numeroSuivi}}"   >
                    </div>
                    <div class="col-md-6">
                        <label for="prenom_client" class="form-label">Designation</label>
                        <input type="text" id="prenom_client" name="designation" class="form-control" value="{{$expeditions->designation}}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">N° CONTENEUR</label>
                        <input type="text" id="telephone_client" name="numeroConteneur" class="form-control" value="{{$expeditions->numeroConteneur}}" >
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Remarque</label>
                        <input type="text" id="email_client" name="typeService" class="form-control" value="{{$expeditions->typeService}}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Date-Enlevement</label>
                        <input type="datetime-local" id="telephone_client" name="dateEnlev" class="form-control"  >
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Date-Livraison</label>
                        <input type="datetime-local" id="telephone_client" name="dateLivr" class="form-control" value="{{$expeditions->dateLivr}}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="montant_total">Montant Total</label>
                        <input type="number" step="0.01" name="montant_total" id="montant_total" value="{{ $expeditions->montant_total}}">
                    </div>
                    <div class="col-md-6">
                        <label for="montant_paye">Montant Payé</label>
                        <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="{{$expeditions->montant_paye}}">
                    </div>
                    <div  class="col-md-6">
                        <br><label for="statut" class="form-label">STATUS D'EXP.</label>
                        <select name="status" id="status">
                            <option value="encour" {{ old('status') == 'encour' ? 'selected' : '' }}>En cours</option>
                            <option value="depot" {{ old('status') == 'depot' ? 'selected' : '' }}>Dépot</option>
                            <option value="terminer" {{ old('status') == 'terminer' ? 'selected' : '' }}>Livré</option>
                        </select>
                    </div>
                </div>
                
            <div class="row mb-3" style="float: right;">
                <button type="submit" class="btn btn-success">EXPEDIER</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection