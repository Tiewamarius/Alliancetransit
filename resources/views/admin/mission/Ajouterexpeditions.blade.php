@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

<style>
    
        .container {
            max-width: 960px; /* Limite la largeur du conteneur sur les grands écrans */
        }
        .form-group {
            margin-bottom: 15px; /* Espacement entre les groupes de champs */
        }
        label {
            font-weight: bold;
        }
        /* Style pour les dimensions du colis */
        .dimensions {
            display: flex;
            align-items: center; /* Aligne verticalement les éléments */
        }
        .dimensions input {
            width: 80px; /* Ajuste la largeur des champs de dimension */
            margin-right: 5px;
        }
        /* Style pour le bouton soumettre */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        /* Media queries pour les écrans plus petits */
        @media (max-width: 768px) {
            .dimensions input {
                width: 60px; /* Réduit la largeur des champs de dimension sur les petits écrans */
            }
        }
</style>

</head>
<body>

<div class="container">
    <h2>Créer un nouvel envoi</h2>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    <form method="POST" action="#">
        @csrf
        <h3>Informations sur l'expédition</h3>
        <div class="form-group">
            <label for="typeExpedition">Type d'expédition:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="typeExpedition" id="pickup" value="pickup" checked>
                <label class="form-check-label" for="pickup">Pickup (livraison porte à porte)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="typeExpedition" id="depot" value="depot">
                <label class="form-check-label" for="depot">Dépôt (livraison depuis la succursale)</label>
            </div>
        </div>
        <div  class="row mb-3">
            <div class="form-group">
                <label for="branche">Conteneur:</label>
                <select id="choix" class="form-control" >
                    <option value="">Choisir ou saisi N° conteneur</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="autre">Saisir N° Conteneur</option>
                </select>
                <input type="text" id="saisie" class="form-control" style="display: none;" placeholder="Saisir N° Conteneur">
            </div>
            <div class="form-group">
            <label for="dateExpedition">Date d'expédition :</label>
            <input type="date" class="form-control" id="dateExpedition" required>
        </div>
        <div class="form-group">
            <label for="heureCollecte">Heure de collecte :</label>
            <input type="time" class="form-control" id="heureCollecte" required>
        </div>

        </div>

       
        <h3>Client/Expéditeur</h3>
        <div class="form-group">
            <label for="branche">clients:</label>
            <select id="choixc" class="form-control" >
                <option value="">Choisir ou saisi Nom client</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="autre">Saisir Nom client</option>
            </select>
        <input type="text" id="saisic" class="form-control" style="display: none;" placeholder="Saisir N° Client">
        </div>
        <h3>Destinataire</h3>
        <div class="form-group">
            <label for="branche">clients:</label>
            <select id="choixc" class="form-control" >
                <option value="">Choisir ou saisi Nom client</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="autre">Saisir Nom client</option>
            </select>
        <input type="text" id="saisic" class="form-control" style="display: none;" placeholder="Saisir N° Client">
        </div>
        <div class="row mb-3">

        <div class="form-group">
            <label for="paysArrivee">Au pays :</label>
            <select class="form-control" id="paysArrivee">
                <option>Choisir le pays</option>
            </select>
        </div>
        <div class="form-group">
            <label for="regionDepart">De la région :</label>
            <select class="form-control" id="regionDepart">
                <option>Choisir la région</option>
            </select>
        </div>
        <div class="form-group">
            <label for="regionArrivee">Vers la région :</label>
            <select class="form-control" id="regionArrivee">
                <option>Choisir la région</option>
            </select>
        </div>
        <div class="form-group">
            <label for="zoneDepart">De la zone :</label>
            <select class="form-control" id="zoneDepart">
                <option>Choisir la zone</option>
            </select>
        </div>
        <div class="form-group">
            <label for="zoneArrivee">Vers la zone :</label>
            <select class="form-control" id="zoneArrivee">
                <option>Choisir la zone</option>
            </select>
        </div>
        </div>
        

        <h3>Paiement</h3>
        <div class="form-group">
            <label for="typePaiement">Type de paiement :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="typePaiement" id="portPaye" value="portPaye" checked>
                <label class="form-check-label" for="portPaye">Port payé</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="typePaiement" id="prepaye" value="prepaye">
                <label class="form-check-label" for="prepaye">Prépayé</label>
            </div>
        </div>

        <h3>Informations sur le colis</h3>
        <div class="form-group">
            <label for="type_emballage">Type d'emballage:</label>
            <select id="type_emballage" name="type_emballage" class="form-control">
                <option value="carton">Carton</option>
                <option value="enveloppe">Enveloppe</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité:</label>
            <input type="number" id="quantite" name="quantite" value="1" min="1" class="form-control">
        </div>
    <button class="btn btn-primary" type="submit">Validé</button>
       </form>


<script>
    const choix = document.getElementById('choix');
    const saisie = document.getElementById('saisie');


choix.addEventListener('change', function() {
  if (this.value === 'autre') {
    saisie.style.display = 'block';
    
    choix.style.display = 'none';
  } else {
    saisie.style.display = 'none';
  }
});

// Client

const choixc = document.getElementById('choixc');
const saisic = document.getElementById('saisic');


choix.addEventListener('change', function() {
  if (this.value === 'autre') {
    saisic.style.display = 'block';
    
    choixc.style.display = 'none';
  } else {
    saisic.style.display = 'none';
  }
});

</script>

@endsection