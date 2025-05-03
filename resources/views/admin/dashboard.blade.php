@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

@if (Auth::guard('admin')->user()->role === 'admin')
<style>
    th {
        white-space: nowrap;
    }
</style>
<div class="row">

</div>
<div class="row">

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
@if(Session::has('success'))
<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill" />
    </svg>
    <div>
        {{Session::get('success')}}
    </div>
</div>
@endif
@if(Session::has('fail'))
<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
    <div>
        {{Session::get('fail')}}
    </div>
</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800">TABLEAU DES EXPEDITIONS</h3>
    <div>
        <select class="form-control form-control-sm" style="width: 100px; display: inline-block; margin-right: 10px;" id="yearFilter">
            <option value=" ">Année</option>
            @for ($year = 2023; $year <= 2030; $year++)
                <option value="{{ $year }}">{{ $year }}</option>
                @endfor
        </select>
        <a href="#" id="exportExcelBtn" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-file-export"></i> Exporter en Excel
        </a>
    </div>
    <div>
        <select class="form-control form-control-sm" style="width: 100px; display: inline-block; margin-right: 10px;" id="yearFilter">
            <option value=" ">Année</option>
            @for ($year = 2023; $year <= 2030; $year++)
                <option value="{{ $year }}">{{ $year }}</option>
                @endfor
        </select>
        <a href="#" id="exportExcelBtn" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="fas fa-file-export"></i> EXPORTER POUR LIVRAISON
        </a>
    </div>
</div>
<div class="d-sm-flex align-items-center">
    <a href="{{url('admin/mission')}}" class="btn btn-primary" style="margin: 10px;">CREER-ENVOI</a>
</div>

<tr>
    <td colspan="14">
        <div class="d-sm-flex align-items-center">
            <select class="form-control form-control-sm" style="width: 140px; display: inline-block; margin-right: 10px;" id="conteneurs">
                <option value="">Tous les conteneurs</option>
                @foreach($conteneur as $conteneur)
                <option value="{{ $conteneur->nom }}">{{ $conteneur->nom }}</option>
                @endforeach
            </select>
            <select class="form-control form-control-sm" style="width: 100px; display: inline-block; margin-right: 10px;" id="localite">
                <option value="">Localité</option>
                <option value="Bingerville">Bingerville</option>
                <option value="Abobo">Abobo</option>
                <option value="Adjamé">Adjamé</option>
                @foreach(App\Models\Expeditions::distinct()->pluck('adresse_expediteur')->filter() as $local)
                <option value="{{ $local }}">{{ $local }}</option>
                @endforeach
                <option value="Saisi autre endroi">Saisi autre endroi</option>
            </select>
            <input type="text" id="search" name="search" class="form-control" style="min-width:200px; width:350px;margin-right: 10px;" placeholder="Chercher...">

        </div>
    </td>
</tr>
<div class="table-data">
    <div style="overflow-x: auto;">
        <table class="table table-striped" id="expeditionsTable">
            <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll" style="width: 15px; height: 15px;">
                            <label class="form-check-label" for="selectAll"></label>
                        </div>
                    </th>
                    <th>Tous</th>
                    <th style="color:black;text-align:center;">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="bulkUpdateStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 120px">
                                STATUS
                            </button>
                            <ul class="dropdown-menu" id="bulkUpdateStatusDropdown">
                                <li><a class="dropdown-item" href="#" data-status="Encour">En Cour</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Arrivé"> Arrivé</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Depot"> En Depot</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Non Livré"> Non Livré</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Livré"> Livré</a></li>
                            </ul>
                        </div>
                    </th>
                    <th style="color:black">TOTAL</th>
                    <th style="color:black">PAYE</th>
                    <th style="color:black">CREDITS</th>
                    <th>DATE-Enlevements</th>
                    <th>CONTENEURS</th>
                    <th>EXPEDITEURS</th>
                    <th>Numero-Exp.</th>
                    <th>ADRESSE-Expedit.</th>
                    <th>DESIGNATIONS-Colis</th>
                    <th>N° SUIVIS</th>
                    <th>DESTINATAIRES</th>
                    <th>Numero-Dest.</th>
                    <th>ADRESSE-Destinat.</th>
                    <th>DATE-LIVRAISON</th>
                    <th>REMARQUE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($expeditions as $expedition)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input row-checkbox" type="checkbox" value="{{ $expedition->id }}" style="width: 15px; height: 15px;">
                            <label class="form-check-label" for="rowCheckbox_{{ $expedition->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="editExpedition/{{$expedition->id}}" class="btn btn-outline-danger" style="color: orangered;width: 40px; padding:5px;">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        @if ($expedition->status === 'Non Traité')
                        <div class="dropdown">
                            <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Encour' )
                        <div class="dropdown">
                            <a class="btn btn-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Arrivé' )
                        <div class="dropdown">
                            <a class="btn btn-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Depot' )
                        <div class="dropdown">
                            <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Non Livré' )
                        <div class="dropdown">
                            <a class="btn btn-secondary" style="background-color: #c9f20f;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Livré')
                        <a class="btn btn-success" style="background-color:#0ee92b;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $expedition->status}}
                        </a>
                        @endif
                    </td>
                    <td>{{$expedition->montant_total}}</td>
                    <td>{{$expedition->montant_paye}}</td>
                    <td>{{ $expedition->montant_total - $expedition->montant_paye }}</td>
                    <td>{{ \Carbon\Carbon::parse(substr($expedition->dateEnlev, 0, 10))->format('d-m-Y') }}</td>
                    <td>{{ $expedition->conteneur_id}}</td>
                    <td>{{ $expedition->nom_expediteur}}</td>
                    <td>{{ $expedition->numero_expediteur}}</td>
                    <td>{{ $expedition->adresse_expediteur}}</td>
                    <td>{{ $expedition->designation }}</td>
                    <td>{{ $expedition->numeroSuivi}}</td>
                    <td>{{ $expedition->nom_destinataire}}</td>
                    <td>{{ $expedition->numero_destinataire}}</td>
                    <td>{{ $expedition->adresse_expediteur}}</td>
                    <td>{{ \Carbon\Carbon::parse(substr($expedition->dateLivr, 0, 10))->format('d-m-Y') }}</td>
                    <td>{{ $expedition->typeService}}</td>
                    <td>
                        <a href="{{ route('expeditions.delete', $expedition->id) }}" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expédition ?')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $expeditions->links() !!}
    </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@else
<div class="alert alert-danger" role="alert">
    Vous n'avez pas les autorisations nécessaires pour accéder à cette page.
</div>
@endif

@endsection