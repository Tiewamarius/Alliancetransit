@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

<div class="container mt-4">
    <h2>Créer une expédition</h2>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

    <form method="POST" action="{{ route('storeExpedition') }}">
        @csrf
        
        <br>
        
        <h4>Information du Expediteur</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                <input type="hiden" name="expediteur_id" class="form-control" value="{{ Auth::user()->code_unique}}">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <label for="floatingInputGrid">Nom Expediteur</label>
                            <input type="text" name="nom_expediteur" class="form-control" id="floatingInputGrid" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="tel" id="telephone_client" name="numero_expediteur" class="form-control" value="{{ Auth::user()->numero}}">
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" name="email_expediteur" class="form-label">Email_expediteur</label>
                        <input type="email" id="email_client" name="email" class="form-control" value="{{ Auth::user()->email}}">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" name="adresse" class="form-label">Adresse_expediteur</label>
                        <input type="text" id="adresse_client" name="adresse_expediteur" class="form-control" value="{{ Auth::user()->adresse}}">
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
                            <input type="text"  name="nom_destinataire" class="form-control" id="floatingInputGrid" placeholder="Nom du destinataire" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="text" id="telephone_client" name="numero_destinataire" class="form-control" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" name="emai_destin" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email_destinataire" class="form-control" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse_destinataire" class="form-control"  >

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
                        <label for="nom_client" class="form-label">Code de suivi</label>
                        <input type="text" id="nom_client" name="numeroSuivi" value="{{$code_suivi}}" class="form-control"  >
                    </div>
                    <div class="col-md-6">
                        <label for="prenom_client" class="form-label">Desigation</label>
                        <input type="text" id="prenom_client" name="designation" class="form-control"  >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">N° CONTENEUR</label>
                        <input type="text" id="telephone_client" name="numeroConteneur" class="form-control"  >
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Remarque</label>
                        <input type="text" id="email_client" name="typeService" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Date-Enlevement</label>
                        <input type="datetime-local" id="telephone_client" name="dateEnlev" class="form-control"  >
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Date-Livraison</label>
                        <input type="datetime-local" id="telephone_client" name="dateLivr" class="form-control"  >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="montant_total">Montant Total</label>
                        <input type="number" step="0.01" name="montant_total" id="montant_total" value="{{ old('montant_total') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="montant_paye">Montant Payé</label>
                        <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="{{ old('montant_paye') }}">
                    </div>
                    <div  class="col-md-6">
                        <br><label for="statut" class="form-label">STATUS D'EXP.</label>
                        <select name="status" id="status">
                            <option value="encour" {{ old('status') == 'encour' ? 'selected' : '' }}>Encours</option>
                            <option value="Non Livré" {{ old('status') == "Non Livré" ? 'selected' : '' }}>Non Livré</option>
                            <option value="Livré" {{ old('status') == 'Livré' ? 'selected' : '' }}>Livré</option>
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