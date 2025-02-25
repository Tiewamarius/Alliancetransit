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
                            TOTAL-EXPEDITIONS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$All}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-300" style="color:#2193ea;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-grey text-uppercase mb-1">
                            Article en Entrepot</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stock}}</div>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#36e250;">Colis Expediés
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-success-800"  style="color:#36e250;">{{$coliLivre}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-300" style="color:#36e250;"></i>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Encour}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-plane fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" class="table table-striped">
    <h2>Liste des expéditions</h2>
    <div style="overflow-x: auto" ;>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>DATE-ENLEVEMENTS</th>
                    <th>N° SUIVIS</th>
                    <th>EXPEDITEURS</th>
                    <th>DESIGNATIONS-Colis</th>
                    <th>DESTINATAIRES</th>
                    <th>CREDITS</th>
                    <th>STATUS</th>
                    <th>DATE-LIVRAISON</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expeditions as $expedition)
                <tr>
                    <td>{{ $expedition->dateEnlev }}</td>
                    <td>{{ $expedition->numeroSuivi}}</td>
                    <td>{{ $expedition->nom_expediteur}}</td>
                    <td>{{ $expedition->designation }}</td>
                    <td>{{ $expedition->nom_destinataire}}</td>
                    <td>{{ $expedition->montant_total - $expedition->montant_paye }}</td>
                    <td>
                        @if ($expedition->status === 'encour')
                            @if (Auth::user()->code_unique == $expedition->expediteur_id)
                            <button class="btn btn-warning" type="button" aria-expanded="false">
                                {{ $expedition->status}}
                            </button>
                            @else
                                <button class="btn btn-warning  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $expedition->status }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="dashboard/{{$expedition->id}}">en transit</a></li>
                                    <li><a class="dropdown-item" href="dashboard/{{$expedition->id}}">en stock</a></li>
                                    <li><a class="dropdown-item" href="dashboard/{{$expedition->id}}">terminé</a></li>
                                </ul>
                            @endif

                        @elseif ($expedition->status === 'depot' )
                            @if (Auth::user()->code_unique == $expedition->expediteur_id)
                            <button class="btn btn-secondary" type="button" aria-expanded="false">
                                {{ $expedition->status}}
                            </button>
                            @else
                            <button class="btn btn-secondary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"style="color:white;">
                                {{ $expedition->status }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dashboard/{{$expedition->id}}">en transit</a></li>
                                <li><a class="dropdown-item" href="dashboard/{{$expedition->id}}">en stock</a></li>
                                <li><a class="dropdown-item" href="dashboard/{{$expedition->id}}">terminé</a></li>
                            </ul>
                            @endif
                        @elseif ($expedition->status === 'terminer')
                        <button class="btn btn" type="button" data-bs-toggle="dropdown"  style="color:white; background:#4af444" aria-expanded="false">
                            {{ $expedition->status}}
                        </button>
                        @endif
                    </td>

    </div>
    </td>
    <td>{{ $expedition->dateLivr}}</td>
    <td>
        <button type="button" class="btn btn-outline-primary"><i class="fas fa-sync-alt"></i></button>
    </td>
    <td>
        <button type="button" class="btn btn-outline-danger"><i class="fas fa-edit"></i></button>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>

</div>
</div>


<style>
    .table .btn {
    width: 100px; /* Largeur fixe */
    height: 35px; /* Hauteur fixe */
    white-space: nowrap; /* Empêcher le texte de passer à la ligne */
    overflow: hidden; /* Masquer le texte qui dépasse */
    text-overflow: ellipsis; /* Ajouter des points de suspension si le texte est tronqué */
    /* Ajoute de l'espace interne */
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection