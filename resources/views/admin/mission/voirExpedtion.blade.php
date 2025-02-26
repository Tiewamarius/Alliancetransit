@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Reçu d'Expédition</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 15px;
        }
        .info strong {
            display: inline-block;
            width: 150px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reçu d'Expédition</h1>
            <p>Date : [Date de l'expédition]</p>
        </div>

        <div class="info">
            <strong>Numéro de Suivi :</strong> [Numéro de suivi]
        </div>

        <div class="info">
            <strong>Expéditeur :</strong> [Nom de l'expéditeur]
        </div>

        <div class="info">
            <strong>Adresse de l'expéditeur :</strong> [Adresse de l'expéditeur]
        </div>

        <div class="info">
            <strong>Destinataire :</strong> [Nom du destinataire]
        </div>

        <div class="info">
            <strong>Adresse du destinataire :</strong> [Adresse du destinataire]
        </div>

        <div class="info">
            <strong>Description du colis :</strong> [Description du colis]
        </div>

        <div class="info">
            <strong>Poids :</strong> [Poids du colis]
        </div>

        <div class="info">
            <strong>Type de service :</strong> [Type de service]
        </div>

        <div class="info">
            <strong>Montant total :</strong> [Montant total]
        </div>

        <div class="info">
            <strong>Montant payé :</strong> [Montant payé]
        </div>

        <div class="info">
            <strong>Date d'enlèvement :</strong> [Date d'enlèvement]
        </div>

        <div class="info">
            <strong>Date de livraison prévue :</strong> [Date de livraison prévue]
        </div>

        <div class="footer">
            <p>Merci de votre confiance.</p>
            <p>[Nom de votre entreprise] - [Adresse de votre entreprise] - [Numéro de téléphone] - [Adresse e-mail]</p>
        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection