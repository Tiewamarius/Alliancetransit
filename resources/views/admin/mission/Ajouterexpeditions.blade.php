@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')


<div class="container mt-4">
    {{$code_unique}}
    <h2>Créer une expédition</h2>
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
                                <input type="email" class="form-control" id="floatingInputGrid" placeholder="Nom du client" value="">
                                <label for="floatingInputGrid">Nom</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                            <select id="nom_client" name="client_id" class="form-select" required>
                                <option value="">Client Existant</option>
                                @foreach($nomsClients as $id => $nom)
                                <option value="{{ $id }}">{{ $nom }}</option>
                                @endforeach
                            </select>
                                <label for="floatingSelectGrid">LES CLIENTS EXISTANTS</label>
                            </div>
                        </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="text" id="telephone_client" name="numero" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse" class="form-control" required>

                    </div>
                </div>
                <div class="row mb-3">
                </div>
                <div class="row mb-3">
                </div>
            </div>
        </div>
        <br>
    <h4>Information du Expediteur</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div>
                        <input type="hidden" id="nom_client" name="code_unique" value="{{$code_unique}}">
                    </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGrid" placeholder="Nom de l'Expediteur" value="">
                                <label for="floatingInputGrid">Nom</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                            <select id="nom_client" name="client_id" class="form-select" required>
                                <option value="">Expediteur Existant</option>
                                @foreach($nomsClients as $id => $nom)
                                <option value="{{ $id }}">{{ $nom }}</option>
                                @endforeach
                            </select>
                                <label for="floatingSelectGrid">EXP. EXISTANTS</label>
                            </div>
                        </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="text" id="telephone_client" name="numero" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse" class="form-control" required>

                    </div>
                </div>
                <div class="row mb-3">
                </div>
                <div class="row mb-3">
                </div>
            </div>
        </div>
        <br>
    <h4>Information du Destinataire</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div>
                        <input type="hidden" id="nom_client" name="code_unique" value="{{$code_unique}}">
                    </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGrid" placeholder="Nom du destinataire" value="">
                                <label for="floatingInputGrid">Destinataire</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                            <select name="destinataire_id" id="destinataire_id" class="form-select" required>
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
                        <input type="text" id="telephone_client" name="numero" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" class="form-label">Adresse</label>
                        <input type="text" id="adresse_client" name="adresse" class="form-control" required>

                    </div>
                </div>
                <div class="row mb-3">
                </div>
                <div class="row mb-3">
                </div>
            </div>
        
        </div>
        <br> 
    <h4>Information du colis</h4>
        <div class="card">
        <div class="card-body">
                <div class="row mb-3">
                    <div>
                        <input type="hidden" id="nom_client" name="code_unique" value="{{$code_unique}}">
                    </div>
                    <div class="col-md-6">
                        <label for="nom_client" class="form-label">Nom</label>
                        <input type="text" id="nom_client" name="nom" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="prenom_client" class="form-label">Prénom</label>
                        <input type="text" id="prenom_client" name="prenom" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="text" id="telephone_client" name="numero" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" class="form-label">Email</label>
                        <input type="email" id="email_client" name="email" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="adresse_client" class="form-label">Adresse</label>
                    <input type="text" id="adresse_client" name="adresse" class="form-control" required>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

</div>


<div class="container mt-5">
    <form method="POST" action="{{ isset($expedition) ? route('expeditions.update', $expedition->id) : route('storeExpedition') }}">
        @csrf
        @if(isset($expedition))
        @method('PUT')
        @endif

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">Sélectionnez un client</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ isset($expedition) && $expedition->client_id == $client->id ? 'selected' : '' }}>{{ $client->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="expediteur_id" class="form-label">Expéditeur</label>
            <select name="expediteur_id" id="expediteur_id" class="form-select" required>
                <option value="">Sélectionnez un expéditeur</option>
                @foreach($expediteurs as $expediteur)
                <option value="{{ $expediteur->id }}" {{ isset($expedition) && $expedition->expediteur_id == $expediteur->id ? 'selected' : '' }}>{{ $expediteur->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="destinataire_id" class="form-label">Destinataire</label>
            <select name="destinataire_id" id="destinataire_id" class="form-select" required>
                <option value="">Sélectionnez un destinataire</option>
                @foreach($destinataires as $destinataire)
                <option value="{{ $destinataire->id }}" {{ isset($expedition) && $expedition->destinataire_id == $destinataire->id ? 'selected' : '' }}>{{ $destinataire->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6" style="display: none;">
            <label for="nom_client" class="form-label">Nom du client</label>
            <select id="nom_client" name="client_id" class="form-select" required>
                <option value="">Sélectionnez un client</option>
                @foreach($nomsClients as $id => $nom)
                <option value="{{ $id }}">{{ $nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="numeroSuivi" class="form-label">Numéro de suivi</label>
            <input type="text" name="numeroSuivi" id="numeroSuivi" class="form-control" value="{{ isset($expedition) ? $expedition->numeroSuivi : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="type_service" class="form-label">Type de service</label>
            <input type="text" name="type_service" id="type_service" class="form-control" value="{{ isset($expedition) ? $expedition->type_service : '' }}">
        </div>

        <div class="mb-3">
            <label for="assurance" class="form-label">Assurance</label>
            <select name="assurance" id="assurance" class="form-select">
                <option value="1" {{ isset($expedition) && $expedition->assurance ? 'selected' : '' }}>Oui</option>
                <option value="0" {{ isset($expedition) && !$expedition->assurance ? 'selected' : '' }}>Non</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-select" required>
                <option value="en préparation" {{ isset($expedition) && $expedition->statut == 'en préparation' ? 'selected' : '' }}>En préparation</option>
                <option value="en transit" {{ isset($expedition) && $expedition->statut == 'en transit' ? 'selected' : '' }}>En transit</option>
                <option value="arrivé" {{ isset($expedition) && $expedition->statut == 'arrivé' ? 'selected' : '' }}>Arrivé</option>
                <option value="terminé" {{ isset($expedition) && $expedition->statut == 'terminé' ? 'selected' : '' }}>Terminé</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_depart" class="form-label">Date de départ</label>
            <input type="datetime-local" name="date_depart" id="date_depart" class="form-control" value="{{ isset($expedition) ? $expedition->date_depart : '' }}">
        </div>

        <div class="mb-3">
            <label for="date_arrivee_estimee" class="form-label">Date d'arrivée estimée</label>
            <input type="datetime-local" name="date_arrivee_estimee" id="date_arrivee_estimee" class="form-control" value="{{ isset($expedition) ? $expedition->date_arrivee_estimee : '' }}">
        </div>

        <div class="mb-3">
            <label for="date_arrivee_reelle" class="form-label">Date d'arrivée réelle</label>
            <input type="datetime-local" name="date_arrivee_reelle" id="date_arrivee_reelle" class="form-control" value="{{ isset($expedition) ? $expedition->date_arrivee_reelle : '' }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($expedition) ? 'Modifier' : 'Créer' }}</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection