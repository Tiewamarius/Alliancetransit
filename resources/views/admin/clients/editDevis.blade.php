@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Modifier le Devis</h1>

        <form action="{{ route('updateDevis', $devis->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <label for="floatingInputGrid">Type</label>
                            <input type="text"  name="particulier" class="form-control" id="floatingInputGrid" readonly value="{{ $devis->particulier}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone_client" class="form-label">Montant Devis</label>
                        <input type="text" id="telephone_client" name="montant_total" class="form-control" value="{{ $devis->montant_total}}">
                    </div>
                    <div class="col-md-6">
                        <label for="email_client" name="emai_destin" class="form-label">De:</label>
                        <input type="email" id="email_client" name="paysDepart" class="form-control" readonly value="{{$devis->paysDepart}}">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_client" name="adresse" class="form-label">Vers:</label>
                        <input type="text" id="adresse_client" name="paysArrivee" class="form-control" readonly value="{{$devis->paysArrivee}}" >

                    </div>
                </div>
                <div class=" row mb-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-control">
                            <option value="encour" {{ $devis->status === 'encour' ? 'selected' : '' }}>En cours</option>
                            <option value="traite" {{ $devis->status === 'traite' ? 'selected' : '' }}>Traité</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="prenom_client" class="form-label">Designation</label>
                        <input type="text" id="prenom_client" readonly name="designation"  value="{{$devis->designation}}" class="form-control"  >
                    </div>
                </div>
            </div><div class="col-md-6">
            <button type="submit" class="btn btn-success">METTRE à JOUR</button>
            </div>
        </form>
    </div>
@endsection