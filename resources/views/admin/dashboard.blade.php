@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')
<style>
    th {
    white-space: nowrap;
}
</style>
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            CLIENTS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$nombreClients }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Article en Entrepot</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$colisArrives}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-archive fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Colis Expediés
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$totalExpeditions}}</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Expedition encour</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nombreExpedition}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-plane fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container mt-5"  class="table table-striped">
        <h2>Liste des expéditions</h2>

        
        <div style="overflow-x: auto";>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Expéditeur</th>
                    <th>Destinataire</th>
                    <th>Designation-Colis</th>
                    <th>Numéro de suivi</th>
                    <th>Type de service</th>
                    <th>Assurance</th>
                    <th>Statut</th>
                    <th>Date de départ</th>
                    <th>Date d'arrivée estimée</th>
                    <th>Date d'arrivée réelle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expeditions as $expedition)
                    <tr>
                        <td>{{ $expedition->id }}</td>
                        <td>{{ $expedition->client->nom }}</td>
                        <td>{{ $expedition->expediteur->nom }}</td>
                        <td>{{ $expedition->destinataire->nom }}</td>
                        <td>{{ $expedition->colis->id }}</td>
                        <td>{{ $expedition->numeroSuivi }}</td>
                        <td>{{ $expedition->type_service }}</td>
                        <td>{{ $expedition->assurance ? 'Oui' : 'Non' }}</td>
                        <td>{{ $expedition->statut }}</td>
                        <td>{{ $expedition->date_depart }}</td>
                        <td>{{ $expedition->date_arrivee_estimee }}</td>
                        <td>{{ $expedition->date_arrivee_reelle }}</td>
                        <td>
                            <a href="{{ route('expeditions.edit', $expedition->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                            <form action="{{ route('expeditions.destroy', $expedition->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>{{ $expeditions->links() }}

        </div> 
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection