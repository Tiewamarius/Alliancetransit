@extends('layouts.Client')
@section('contente')
<div class="container">
    <h2 class="text-center mt-4">Suivi de colis</h2>
    
    <div class="search-box">
        <input type="text" id="trackingNumber" class="form-control" placeholder="Entrez votre numéro de suivi">
        <button class="btn btn-warning mt-2" onclick="trackPackage()">Suivre</button>
    </div>

    <div id="trackingResult" class="tracking-container d-none">
        <h4 class="mt-4">Détails du suivi</h4>
        <div class="tracking-status">
            <ul class="timeline">
                <li class="completed"><span>Expédié</span><br><small>2024-02-18 10:00</small></li>
                <li class="completed"><span>En transit</span><br><small>2024-02-19 14:30</small></li>
                <li class="current"><span>Arrivé à l'entrepôt</span><br><small>2024-02-20 08:15</small></li>
                <li><span>En livraison</span></li>
                <li><span>Livré</span></li>
            </ul>
        </div>
    </div>
</div>
@endsection