@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

<div class="container mt-4">
    {{$code_unique}}
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

    <form method="POST" action="{{ isset($expedition) ? route('expeditions.update', $expedition->id) : route('storeExpedition') }}">
        @csrf
        @if(isset($expedition))
            @method('PUT')
        @endif
        <h4>Information du client</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div>
                        <input type="hidden" id="nom_client" name="code_unique" value="{{$code_unique}}">
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="name" name="nom" class="form-control" id="floatingInputGrid" placeholder="Nom du client" value="{{ isset($expedition) ? $expedition->nom : '' }}">
                            <label for="floatingInputGrid">Nom</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select id="nom_client" name="client_id" class="form-select">
                                <option value="">Client Existant</option>
                                @foreach($nomsClients as $id => $nom)
                                    <option value="{{ $id }}" {{ isset($expedition) && $expedition->client_id == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">LES CLIENTS EXISTANTS</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="tel" id="telephone_client" name="numero" class="form-control" value="{{ isset($expeditions) && is_object($expeditions) ? $expeditions->numero : '' }}"></div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email" class="form-control" value="{{ isset($expeditions) && is_object($expeditions) ? $expeditions->email : '' }}"></div>
                    <div class="col-md-6">
                        <label for="adresse_client" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse" class="form-control" value="{{ isset($expeditions) && is_object($expeditions) ? $expeditions->adresse : '' }}">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h4>Information du Expediteur</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="nom" class="form-control" id="floatingInputGrid" placeholder="Nom de l'Expediteur" value="{{ isset($expedition) ? $expedition->nom : '' }}">
                            <label for="floatingInputGrid">Nom</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select id="nom_client" name="expediteur_id" class="form-select">
                                <option value="">Expediteur Existant</option>
                                @foreach($expediteurs as $id => $nom)
                                    <option value="{{ $id }}" {{ isset($expedition) && $expedition->expediteur_id == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">EXP. EXISTANTS</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" name="numero" class="form-label">Téléphone</label>
                        <input type="tel" id="telephone_client" name="numero" class="form-control" value="{{ isset($expeditions) && is_object($expeditions) ? $expeditions->numero : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" name="email" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email" class="form-control" value="{{ isset($expeditions) && is_object($expeditions) ? $expeditions->email : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse" class="form-control" value="{{ isset($expeditions) && is_object($expeditions) ? $expeditions->adresse : '' }}">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h4>Information du Destinataire</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="nom" class="form-control" id="floatingInputGrid" placeholder="Nom du destinataire" value="{{ isset($expedition) ? $expedition->nom : '' }}">
                            <label for="floatingInputGrid">Destinataire</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select name="destinataire_id" id="destinataire_id" class="form-select">
                                <option value="">Sélectionnez un destinataire</option>
                                @foreach($destinataires as $destinataire)
                                    <option value="{{ $destinataire->id }}" {{ isset($expedition) && $expedition->destinataire_id == $destinataire->id ? 'selected' : '' }}>{{ $destinataire->nom }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">DEST. EXISTANTS</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="text" id="telephone_client" name="numero" class="form-control" value="{{ isset($expedition) ? $expedition->numero : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" name="email" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email" class="form-control" value="{{ isset($expedition) ? $expedition->email : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse" class="form-control"  >

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
                        <label for="email_client" class="form-label">Type de service</label>
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
                    <div  class="col-md-6">
                        <label for="statut" class="form-label">STATUS D'EXP.</label>
                        <select name="statut" id="statut" class="form-select"  >
                            <option value="en préparation" {{ isset($expeditions) && is_object($expeditions) && $expeditions->statut == 'en préparation' ? 'selected' : '' }}>En préparation</option>
                            <option value="en transit" {{ isset($expeditions) && is_object($expeditions) && $expeditions->statut == 'en transit' ? 'selected' : '' }}>En transit</option>
                            <option value="arrivé" {{ isset($expeditions) && is_object($expeditions) && $expeditions->statut == 'arrivé' ? 'selected' : '' }}>Arrivé</option>
                            <option value="terminé" {{ isset($expeditions) && is_object($expeditions) && $expeditions->statut == 'terminé' ? 'selected' : '' }}>Terminé</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="statut" class="form-label">Paiement</label>
                        <select name="statut" id="statut" class="form-select"  >
                            <option value="en préparation" {{ isset($expeditions) && is_object($expeditions) && $expeditions->statut == 'avance' ? 'selected' : '' }}>Avance</option>
                            <option value="en transit" {{ isset($expeditions) && is_object($expeditions) && $expeditions->statut == 'soldé' ? 'selected' : '' }}>Soldé</option>
                            <option value="arrivé" {{ isset($expeditions) && is_object($expeditions) && $expeditions->statut == 'Credit' ? 'selected' : '' }}>Credit</option>
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