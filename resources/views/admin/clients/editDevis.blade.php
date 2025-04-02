@extends('layouts.admin')
@section('title', 'Modifier le Devis')

@section('content')
<form action="{{ route('updateDevis', $devis->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="particulier">Particulier:</label>
    <input type="text" name="particulier" value="{{ $devis->particulier }}">

    <label for="numero">Numéro:</label>
    <input type="text" name="numero" value="{{ $devis->numero }}">

    <label for="paysDepart">Pays de Départ:</label>
    <input type="text" name="paysDepart" value="{{ $devis->paysDepart }}">

    <label for="paysArrivee">Pays d'Arrivée:</label>
    <input type="text" name="paysArrivee" value="{{ $devis->paysArrivee }}">

    <label for="villeDepart">Ville de Départ:</label>
    <input type="text" name="villeDepart" value="{{ $devis->villeDepart }}">

    <label for="villeArrivee">Ville d'Arrivée:</label>
    <input type="text" name="villeArrivee" value="{{ $devis->villeArrivee }}">

    <label for="designation">Désignation:</label>
    <textarea name="designation">{{ $devis->designation }}</textarea>

    <label for="montant_total">Montant Total:</label>
    <input type="text" name="montant_total" value="{{ $devis->montant_total }}">

    <label for="status">Statut:</label>
    <select name="status">
        <option value="nontraite" {{ $devis->status === 'nontraite' ? 'selected' : '' }}>Non traité</option>
        <option value="traite" {{ $devis->status === 'traite' ? 'selected' : '' }}>Traité</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>
@endsection