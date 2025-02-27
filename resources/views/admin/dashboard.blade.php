@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')
<style>
        th {
            white-space: nowrap;
        }
    </style>
    <div class="row">
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
                                <div class="h5 mb-0 mr-3 font-weight-bold text-success-800" style="color:#36e250;">{{$coliLivre}}</div>
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

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800">TABLEAU DES EXPEDITIONS</h3>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Exporter en Excel
    </a>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800">
        <div class="row py-2">
        <a href="#" class="btn btn-outline-secondary" style="margin: 10px;">Passer-Commande</a>
            <a href="{{url('admin/mission')}}" class="btn btn-primary" style="margin: 10px;">CREER-ENVOI</a>
        </div>
    </h3>
    <input type="text" id="searchInput" class="form-control" style="min-width:200px; width:350px;" placeholder="Chercher..." onkeyup="searchTable()">
</div>
<div style="overflow-x: auto;">
<table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th style="color:black;text-align:center;">STATUS</th>
                    <th style="color:black">CREDITS</th>
                    <th>DATE-ENLEVEMENTS</th>
                    <th>NUMERO-SUIVIS</th>
                    <th>EXPEDITEURS</th>
                    <th>DESIGNATIONS-Colis</th>
                    <th>DESTINATAIRES</th>
                    <th>DATE-LIVRAISON</th>
                    <th>REMARQUE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expeditions as $expedition)
                <tr>
                    <td>
                        <a href="editExpedition/{{$expedition->id}}" class="btn btn-outline-danger" style="width: 40px; padding:5px;"><i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        @if ($expedition->status === 'encour')
                            @if (Auth::user()->code_unique == $expedition->expediteur_id)
                            <div class="dropdown">
                                <a class="btn btn-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                                </a>
                            </div>
                            @else
                            <form method="POST" action="{{ route('update.status', $expedition->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="dropdown">
                                    <a class="btn btn-warning dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $expedition->status }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('update.status', $expedition->id) }}" onclick="updateStatus('{{ $expedition->id }}', 'encour')">ENCOUR</a></li>
                                        <li><a class="dropdown-item" href="{{ route('update.status', $expedition->id) }}" onclick="updateStatus('{{ $expedition->id }}', 'depot')">STOCK</a></li>
                                        <li><a class="dropdown-item" href="{{ route('update.status', $expedition->id) }}" onclick="updateStatus('{{ $expedition->id }}', 'terminer')">TERMINER</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="status" id="statusInput">
                            </form>
                            @endif
                        @elseif ($expedition->status === 'depot' )
                            @if (Auth::user()->code_unique == $expedition->expediteur_id)
                            <div class="dropdown">
                                <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                                </a>
                            </div>
                            @else
                            <form method="POST" action="{{ route('update.status', $expedition->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $expedition->status }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $expedition->id }}', 'encour')">ENCOUR</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $expedition->id }}', 'depot')">STOCK</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $expedition->id }}', 'terminer')">TERMINER</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="status" id="statusInput">
                            </form>
                            @endif
                        @elseif ($expedition->status === 'terminer')
                            <a class="btn btn-success"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        @endif
                        
                    </td>
                    <td>{{ $expedition->montant_total - $expedition->montant_paye }}</td>
                    <td>{{ $expedition->dateEnlev }}</td>
                    <td>{{ $expedition->numeroSuivi}}</td>
                    <td>{{ $expedition->nom_expediteur}}</td>
                    <td>{{ $expedition->designation }}</td>
                    <td>{{ $expedition->nom_destinataire}}</td>
            </td>
        <td>{{ $expedition->dateLivr}}</td>
        <td>{{ $expedition->typeService}}</td>
        </tr>
        @endforeach
        </tbody>
</table>
</div>
    </div>
</div>


<style>
    .table .btn {
        width: 95px;
        /* Largeur fixe */
        height: 35px;
        /* Hauteur fixe */
        white-space: nowrap;
        /* Empêcher le texte de passer à la ligne */
        overflow: hidden;
        /* Masquer le texte qui dépasse */
        text-overflow: ellipsis;
        /* Ajouter des points de suspension si le texte est tronqué */
        /* Ajoute de l'espace interne */
    }
</style>


<script>
    function updateStatus(expeditionId, status) {
        document.getElementById('statusInput').value = status;
        document.querySelector('form').submit();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection