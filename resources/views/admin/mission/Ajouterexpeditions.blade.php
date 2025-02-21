@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')
<div class="container mt-5">
        <h2>{{ isset($expedition) ? 'Modifier l\'expédition' : 'Créer une expédition' }}</h2>

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

            <div class="mb-3">
                <label for="colis_id" class="form-label">Colis</label>
                <select name="colis_id" id="colis_id" class="form-select" required>
                    <option value="">Sélectionnez un colis</option>
                    @foreach($colis as $coli)
                        <option value="{{ $coli->id }}" {{ isset($expedition) && $expedition->colis_id == $coli->id ? 'selected' : '' }}>{{ $coli->id }}</option>
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