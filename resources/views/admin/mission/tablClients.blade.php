@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')
@if (Auth::guard('admin')->user()->role === 'admin')
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
        <!-- Content Row --> 

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h3 mb-0 text-gray-800">TABLEAU DES EXPEDITIONS</h3>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-file-export"></i> Exporter en Excel
            </a>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h3 mb-0 text-gray-800">
                <div class="row py-2">
                    <a href="{{url('admin/tablClient')}}" class="btn btn-outline-secondary" style="margin: 10px;">Devis& Commande</a>
                    <a href="{{url('admin/mission')}}" class="btn btn-primary" style="margin: 10px;">CREER-ENVOI</a>
                </div>
            </h3>
            <input type="text" id="search" name="search" class="form-control" style="min-width:200px; width:350px;" placeholder="Chercher...">
        </div>

        
        <div class="table-data">
        <div style="overflow-x: auto;">
            <table class="table table-striped" id="expeditionsTable">
                <thead>
                    <tr>
                        <th>
                            <a href="{{url('admin/dashboard')}}" class="btn btn-danger" style="color: orangered;width: 40px; padding:5px;">
                            <span aria-hidden="true"style="font-size:16px; color:white;">&times;</span>
                            </a>
                        </th>
                        <th style="color:black;text-align:center;">STATUS</th>
                        <th style="color:black">CREDITS</th>
                        <th>DATE-Enlevements</th>
                        <th>Num° CONTENEURS</th>
                        <th>EXPEDITEURS</th>
                        <th>ADRESSE-Expedit.</th>
                        <th>DESIGNATIONS-Colis</th>
                        <th>Num° SUIVIS</th>
                        <th>DESTINATAIRES</th>
                        <th>ADRESSE-Destinat.</th>
                        <th>DATE-LIVRAISON</th>
                        <th>REMARQUE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        </div>

        @else
        <div class="alert alert-danger" role="alert">
        Vous n'avez pas les autorisations nécessaires pour accéder à cette page.
        </div>
        @endif  

@endsection