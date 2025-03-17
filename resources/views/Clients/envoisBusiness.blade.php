<!-- @extends('layouts.Client')
@section('contente')
<style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .tabs {
        display: flex;
        margin-bottom: 20px;
    }

    .tab {
        padding: 10px 20px;
        border: 1px solid #ccc;
        background-color: #f0f0f0;
        cursor: pointer;
        border-radius: 5px 5px 0 0;
        margin-right: 5px;
    }

    .tab.active {
        background-color: #fff;
        border-bottom: none;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 0 5px 5px 5px;
    }

    .import-checkbox {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .import-checkbox label {
        margin-left: 5px;
    }

    .import-checkbox .info {
        margin-left: 5px;
        font-size: 14px;
        color: #888;
    }

    .country-select {
        margin-bottom: 20px;
    }

    .country-select label {
        display: block;
        margin-bottom: 5px;
    }

    .country-dropdown {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 5px;
    }

    .country-dropdown img {
        width: 20px;
        margin-right: 5px;
    }

    .country-dropdown a {
        margin-left: auto;
        text-decoration: none;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
    }

    .input-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .error-message {
        color: red;
        font-size: 12px;
        display: none;
        /* Masqué par défaut */
    }

    .input-group input:invalid+.error-message {
        display: block;
        /* Afficher en cas d'erreur */
    }

    .billing-country {
        font-size: 14px;
        color: #888;
    }
</style>

<div class="container">
    <h1>J'expédie en tant que...</h1>

    <div class="tabs">
        <button class="tab active" data-tab="particulier">Personne privée</button>
        <button class="tab" data-tab="professionnel">Professionnel</button>
    </div>

    <div class="form-container">
        <div class="import-checkbox">
            <input type="checkbox" id="import">
            <label for="import">Créer un envoi d'importation</label>
            <span class="info">ⓘ</span>
        </div>

        <div class="country-select">
            <label for="country">De</label>
            <div class="country-dropdown">
                <img src="france-flag.png" alt="France Flag">
                <span id="country-name">France</span>
                <a href="#">Changer de lieu</a>
            </div>
        </div>

        <div class="input-group">
            <label for="city">Ville</label>
            <input type="text" id="city">
        </div>

        <p class="billing-country">Votre pays</p>

        <div class="destination-container">
            <h2>Vers</h2>
            <div class="input-group">
                <label for="destination-country">Pays ou région *</label>
                <input type="text" id="destination-country" placeholder="Veuillez commencer à taper pour sélectionner un...">
                <span class="error-message">Sélectionner un pays ou une région</span>
            </div>
            <div class="input-group">
                <label for="destination-city">Ville</label>
                <input type="text" id="destination-city">
            </div>
        </div>

        <button class="submit-button">Décrivez votre expédition</button>
    </div>
</div>

<script>
    const tabs = document.querySelectorAll('.tab');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
</script>

@endsection -->