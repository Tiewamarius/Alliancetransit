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
</style>
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
        <input type="text" id="nom_client" name="id" readonly  value="{{$expeditions->id}}" style="display: none;">
        <h4>Information du Expediteur</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                <input type="hiden" readonly name="expediteur_id" class="form-control" value="{{$expeditions->expediteur_id}}"  style="display: none;">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <label for="floatingInputGrid">Nom Expediteur</label>
                            <input type="text" name="nom_expediteur" class="form-control" id="floatingInputGrid" value="{{$expeditions->nom_expediteur}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="tel" id="telephone_client" name="numero_expediteur" class="form-control" value="{{$expeditions->numero_expediteur}}">
                        <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" name="email_expediteur" class="form-label">Email_expediteur</label>
                        <input type="email" id="email_client" name="email" class="form-control" value="{{$expeditions->email_expediteur}}">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" name="adresse" class="form-label">Adresse_expediteur</label>
                        <input type="text" id="adresse_client" name="adresse_expediteur" class="form-control" value="{{$expeditions->adresse_expediteur}}">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h4>Information du Destinataire</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <label for="floatingInputGrid">Destinataire</label>
                            <input type="text"  name="nom_destinataire" class="form-control" id="floatingInputGrid" placeholder="Nom du destinataire" value="{{$expeditions->nom_destinataire}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="text" id="telephone_client" name="numero_destinataire" class="form-control" value="{{$expeditions->numero_destinataire}}">
                        <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" name="emai_destin" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email_destinataire" class="form-control" value="{{$expeditions->email_destinataire}}">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse_destinataire" class="form-control" value="{{$expeditions->adresse_destinataire}}" >

                    </div>
                </div>
            </div>

        </div>
        <br>
        <h4>Information du colis</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="numeroSuivi" class="form-label">Code de suivi</label>
                        <input type="text" readonly id="numeroSuivi" name="numeroSuivi" value="{{$expeditions->numeroSuivi}}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Désignation</label>
                        <input type="text" id="designation" name="designation" value="{{$expeditions->designation}}" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div  class="col-md-6">
                        <label for="status" class="form-label">Conteneur</label>
                        <select name="conteneur_id" id="status" class="form-control">
                        @foreach($conteneur as $unConteneur)
                        <option value="{{ $unConteneur->nom }}"
                            @if(isset($expeditions) && $expeditions->conteneur_id == $unConteneur->nom)selected
                                @endif>{{ $unConteneur->nom }}
                        </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="typeService" class="form-label">Remarque</label>
                        <input type="text" id="typeService" name="typeService" value="{{$expeditions->typeService}}" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dateEnlev" class="form-label">Date d'Enlèvement</label>
                        <input type="datetime-local" id="dateEnlev" name="dateEnlev"  value="{{$expeditions->dateEnlev}}" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="dateEnlev" class="form-label">Date chargement</label>
                        <input type="datetime-local" id="dateCharg" name="dateCharg" value="{{$expeditions->dateCharg}}"  class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dateLivr" class="form-label">Date de Livraison</label>
                        <input type="datetime-local" id="dateLivr" name="dateLivr" value="{{$expeditions->dateLivr}}" class="form-control" >
                    </div>
                    <div  class="col-md-6">
                        <label for="status" class="form-label">STATUS D'EXP.</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Encour" {{ old('status') == 'Encour' ? 'selected' : '' }}>Encour</option>
                            <option value="Arrivé" {{ old('status') == 'Arrivé' ? 'selected' : '' }}>Arrivé</option>
                            <option value="Depot" {{ old('status') == 'Depot' ? 'selected' : '' }}>Depot</option>
                            <option value="Non Livré" {{ old('status') == "Non Livré" ? 'selected' : '' }}>Non Livré</option>
                            <option value="Livré" {{ old('status') == 'Livré' ? 'selected' : '' }}>Livré</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6" style="display: flex; align-items: center;">
                        <label for="montant_total" style="margin-right: 10px;">Montant Total:</label>
                        <input type="number" step="0.01" name="montant_total" id="montant_total" value="{{$expeditions->montant_total}}" class="form-control" style="flex-grow: 1; margin-right: 5px;">
                        <select class="form-select" id="devise" name="devise" style="max-width: 80px;" readonly>
                            <option value="EUR" selected>EUR</option>
                            <option value="XOF">FCFA</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="display: flex; align-items: center;">
                        <label for="montant_total" style="margin-right: 10px;">CREDIT:</label>
                        <input type="number" step="0.01" id="montant_total" value="{{ $expeditions->montant_total - $expeditions->montant_paye}}" class="form-control" style="flex-grow: 1; margin-right: 5px;">
                        <select class="form-select" id="devise" name="devise" style="max-width: 80px;" readonly>
                            <option value="EUR" selected>EUR</option>
                            <option value="XOF">FCFA</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="display: flex; align-items: center;">
                        <label for="montant_total" style="margin-right: 10px;">Montant Versé:</label>
                        <input type="number" step="0.01" name="montant_versement" id="montant_total" value="0" class="form-control" style="flex-grow: 1; margin-right: 5px;">
                        <select class="form-select" id="devise" name="devise" style="max-width: 80px;">
                            <option value="EUR" selected>EUR</option>
                            <option value="XOF">FCFA</option>
                        </select>
                    </div>
                </div>

            <div class="row mb-3" style="float: right;">
                <button type="submit" class="btn btn-success expedier">EXPEDIER</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection