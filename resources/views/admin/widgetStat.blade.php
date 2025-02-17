@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Accueil</h1>
    <a href="{{url('admin/envoi')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-pencil fa-sm text-white-50"></i>Creer un Envoi</a>
</div>

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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">411</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
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
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">15</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-plane fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
        <h2>Expéditions</h2>
        <div class="card p-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Rechercher">
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary">Afficher ▼</button>
                    <button class="btn btn-secondary">🔄</button>
                    <button class="btn btn-info">Filtrer</button>
                    <button class="btn btn-success">Exporter ▼</button>
                    <button class="btn btn-primary">Ajouter un envoi</button>
                </div>
            </div>
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>CODE</th>
                        <th>TYPE</th>
                        <th>BRANCHE</th>
                        <th>CLIENT</th>
                        <th>FRAIS D'EXPÉDITION</th>
                        <th>MÉTHODE DE PAIEMENT</th>
                        <th>PAYÉ</th>
                        <th>DE LA RÉGION</th>
                        <th>VERS LA RÉGION</th>
                        <th>DATE D'EXPÉDITION</th>
                        <th>CRÉÉ LE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="13">Aucune donnée disponible dans le tableau</td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <span>Affichage de l'élément 0 à 0 sur 0 éléments</span>
                <div>
                    <button class="btn btn-light" disabled>Précédent</button>
                    <button class="btn btn-light" disabled>Suivant</button>
                </div>
            </div>
        </div>
    </div>
@endsection