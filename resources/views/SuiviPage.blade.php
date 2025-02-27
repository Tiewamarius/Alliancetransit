@extends('layouts.Client')
@section('contente')
<style>
    .containers {
        max-width: 600px;
        margin-top: 50px;
        background: transparent;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
h2{
    color: #0793ff;
}
    .row {
        display: flex;
        padding: 25px;
    }

    .search-box {
        text-align: center;
    }

    .tracking-container {
        margin-top: 20px;
    }

    .timeline {
        list-style: none;
        padding: 0;
        position: relative;
    }

    .timeline li {
        padding: 10px 20px;
        border-left: 4px solid #ddd;
        position: relative;
        margin-left: 20px;
    }

    .timeline li::before {
        content: "";
        width: 10px;
        height: 10px;
        background: #ddd;
        position: absolute;
        left: -6px;
        top: 20px;
        border-radius: 50%;
    }

    .timeline li.completed {
        border-left-color: #28a745;
    }

    .timeline li.completed::before {
        background: #28a745;
    }

    .timeline li.current {
        border-left-color: rgb(255, 156, 7);
    }

    .timeline li.current::before {
        background: #0793ff;
    }
</style>
<div class="row">
    <div class="containers" id="suivi" style="margin-bottom: 35px;">
        <h2 class="text-center mt-4">Suivi de colis</h2>
        <div class="search-box">
            <form method="GET" action="{{ route('rechercher.suivi') }}">
                <input type="text" id="trackingNumber" name="numeroSuivi" class="form-control" placeholder="Entrez votre numéro de suivi">
                <button  type="submit" style="background-color: #0793ff;" class="btn btn-warning mt-2" onclick="trackPackage()">
                    Suivre
                </button>
            </form>
        </div>


        @if (isset($expedition))
        
        <div id="trackingResult" class="tracking-container d-none">
            <h4 class="mt-4">Détails du suivi</h4>
            <div class="tracking-status">
                <ul class="timeline">
                    <li class="completed"><span>Expédié à</span><br><small>{{ $expedition->dateEnlev}}</small></li>
                    <li class="completed"><span>Encour</span><br><small>2024-02-19 14:30</small></li>
                    <li class="current"><span>{{ $expedition->dateLivr}}</span><br><small>2024-02-20 08:15</small></li>
                    <li><span>En livraison</span></li>
                    <li><span>{{ $expedition->status }}</span></li>
                </ul>
            </div>
        </div>
        <script>
            function trackPackage() {
                let trackingNumber = document.getElementById("trackingNumber").value;

                if (trackingNumber.trim() === "") {
                    alert("Veuillez entrer un numéro de suivi !");
                    return;
                }

                document.getElementById("trackingResult").classList.remove("d-none");
            }
        </script>
        @endif
    </div>
    <div class="card" style="width:20rem; height: 20rem; 
            max-width: 400px; margin:10px;background-image: url('../Admin/img/Logo-remoteBg.png');
        background-size: contain;
        background-repeat: no-repeat;
        filter: blur(0.1px);">
        <div class="card-body">
            <h5 class="card-title">Aide</h5>
            <p class="card-text">
                Voici comment suivre vos/votre colis
            </p>
        </div>
    </div>
</div>
</div>
@endsection