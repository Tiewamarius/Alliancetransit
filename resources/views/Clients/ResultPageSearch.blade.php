@extends('layouts.Client')
@section('content')
<br><br><br>
<style>
    .suivBg{
        background-image: url("Clients/assets/img/suiBg.jpg");
        background-size: cover;

    }

    .tracking-container {
        width: 90%;
        /* max-width: 800px; */
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;background-color: rgba(255, 255, 255, 0.7); /* Blanc semi-transparent */
        backdrop-filter: blur(70px); /* Ajustez la valeur de blur selon votre préférence */
        background-color: transparent;
        /* background-color: #f9f9f9; */
    }

    .tracking-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .tracking-steps {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .step {
        text-align: center;
        position: relative;
        flex: 1 1 150px;
        margin: 10px;
        display: flex; /* Ajout de flexbox pour l'alignement vertical */
        flex-direction: column; /* Organisation verticale des éléments */
        align-items: center; /* Centrage horizontal des éléments */
    }

    .step::before, .step::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 20px;
        height: 2px;
        background-color: #ddd;
    }

    .step::before {
        right: 100%;
        margin-right: 2px;
    }

    .step::after {
        left: 100%;
        margin-left: 2px;
    }

    .step:first-child::before, .step:last-child::after {
        display: none;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 5px;
    }

    .step-icon i {
        font-size: 20px;
        color:#cecbcb;
    }

    .step.completed .step-icon {
        background-color: rgb(23, 244, 30);
    }

    .step.completed .step-icon i {
        color: white;
    }

    .step-label {
        font-size: 12px;
        margin-top: 5px; /* Ajout d'une marge supérieure pour l'espacement */
    }

    .tracking-details {
        text-align: center;
        margin-top: 20px;
    }

    @media (max-width: 600px) {
        .tracking-steps {
            flex-direction: column;
        }

        .step {
            flex: 1 1 auto;
            margin: 10px 0;
        }

        .step::before, .step::after {
            display: none;
        }
    }
</style>

<section class="suivBg">
    <div class="tracking-container" style="z-index: 10;">
            <div class="tracking-header">
                <h2>Résultat de Suivi</h2>
            </div>
                    @foreach($expeditions as $expedition)
                    <div class="tracking-steps">
                        <div class="step {{ $expedition->status == 'Non Traité' ? 'completed' : '' }}">
                            <div class="step-icon"><i class="fas fa-clipboard-list"></i></div>
                            <div class="step-label">Colis en préparation</div>
                        </div>
                        <div class="step {{ $expedition->status == 'Encour' ? 'completed' : '' }}">
                            <div class="step-icon"><i class="fas fa-truck"></i></div>
                            <div class="step-label">Expédition Encour</div>
                        </div>
                        <div class="step {{ $expedition->status == 'Arrivé' ? 'completed' : '' }}">
                            <div class="step-icon"><i class="fas fa-check-double"></i></div>
                            <div class="step-label">Colis Arrivé</div>
                        </div>
                        <div class="step {{ $expedition->status == 'Depot' ? 'completed' : '' }}">
                            <div class="step-icon"><i class="fas fa-store-alt"></i></div>
                            <div class="step-label">Prêt pour Retrait</div>
                        </div>
                        <div class="step {{ $expedition->status == 'Non Livré' ? 'completed' : '' }}">
                            <div class="step-icon"><i class="fas fa-hourglass-half"></i></div>
                            <div class="step-label">Encour d'échéance</div>
                        </div>
                        <div class="step {{ $expedition->status == 'Livré' ? 'completed' : '' }}">
                            <div class="step-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="step-label">Colis Livré</div>
                        </div>
                    </div>

                    <div class="tracking-details">
                        <p  style="text-align:left";><strong>Numéro de Suivi:</strong> {{ $expedition->numeroSuivi }}</p>
                        <p  style="text-align:left"><strong>Date de Livraison:</strong> {{ $expedition->dateLivr }}</p>
                        <p  style="text-align:left"><strong>Status Actuel:</strong> {{ $expedition->status }}</p>
                        <p  style="text-align:left"><strong>Designation:</strong> {{ $expedition->designation }}</p>
                    </div>
                @endforeach
    </div>
</section>

@endsection