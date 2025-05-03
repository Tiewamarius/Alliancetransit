@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')
<style>
    h4{
        color:blue;
    }
    label{
        color:black;
        font-weight: 400;
    }
    .form-control{
        border: 1px solid blue;
        color:black;
        font-weight:800;
    }
    .is-invalid {
        border-color: red !important;
    }
    .invalid-feedback {
        color: red;
        display: none;
    }
</style>
<div class="container mt-4">
    <h2>Créer une expédition</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <form method="POST" action="{{ route('storeExpedition') }}" id="expeditionForm" enctype="multipart/form-data">
        @csrf

        <br>

        <h4>Information de l'Expéditeur</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                <input type="hidden" name="expediteur_id" class="form-control" value="{{ Auth::user()->code_unique}}"  style="display: none;" >
                    <div class="col-md-6">
                        <div class="form-floating">
                            <label for="nom_expediteur">Nom Expéditeur</label>
                            <input type="text" name="nom_expediteur" class="form-control" id="nom_expediteur" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="numero_expediteur" class="form-label">Téléphone</label>
                        <input type="tel" id="numero_expediteur" name="numero_expediteur" class="form-control" value="">
                        <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email_expediteur" class="form-label">Email Expéditeur</label>
                        <input type="email" id="email_expediteur" name="email_expediteur" class="form-control" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_expediteur" class="form-label">Adresse Expéditeur</label>
                        <input type="text" id="adresse_expediteur" name="adresse_expediteur" class="form-control" value="">
                    </div>

                    <div class="col-md-6" id="code_postal_container">
                        <label for="code_postal">Code postal:</label>
                        <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Code postal (Facultatif)">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h4>Information du Destinataire</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <label for="nom_destinataire">Destinataire</label>
                            <input type="text"  name="nom_destinataire" class="form-control" id="nom_destinataire" placeholder="Nom du destinataire" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="numero_destinataire" class="form-label">Téléphone</label>
                        <input type="tel" id="numero_destinataire" name="numero_destinataire" class="form-control" value="">
                        <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email_destinataire" class="form-label">Email</label>
                        <input type="email" id="email_destinataire" name="email_destinataire" class="form-control" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse_destinataire" class="form-label">Adresse Ou Ville</label>
                            <input type="text" id="adresse_destinataire" name="adresse_destinataire" class="form-control">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="nom">Code Postal:</label>
                        <input type="text" class="form-control" id="nom" name="code_postal"placeholder="Code postal">
                    </div>

                    <div class="col-md-6" id="commune_container" style="display: none;">
                    <label for="code_postal">Commune (Ou Quartier):</label>
                        <input type="text" class="form-control" id="code_postal" name="commune" placeholder="Commune ou Quartier">
                        <div class="ifnvalid-feedback">Veuillez noter que certaines villes ou quartiers ne sont pas dans nos royon de livraison.</div>
                        
                    </div>

                    <script>
                        const adresseDestinataireInput = document.getElementById('adresse_destinataire');
                        const communeContainer = document.getElementById('commune_container');

                        adresseDestinataireInput.addEventListener('input', function() {
                            const villeSaisie = this.value.trim().toLowerCase();

                            if (villeSaisie.includes('abidjan')) {
                                communeContainer.style.display = 'block';
                            } else {
                                communeContainer.style.display = 'none';
                            }
                        });
                    </script>
                </div>
            </div>

        </div>
        <br>
        <h4>Information du colis</h4>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="numeroSuivi" class="form-label">Code de suivi</label>
                        <input type="text" readonly id="numeroSuivi" name="numeroSuivi" value="{{$code_suivi}}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Désignation</label>
                        <input type="text" id="designation" name="designation" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div  class="col-md-6">
                        <label for="status" class="form-label">Conteneur.</label>
                        <select name="conteneur_id" id="status" class="form-control">
                            @foreach($conteneur as $unConteneur)
                                <option value="{{ $unConteneur->nom}}">{{$unConteneur->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="typeService" class="form-label">Remarque</label>
                        <input type="text" id="typeService" name="typeService" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dateEnlev" class="form-label">Date d'Enlèvement</label>
                        <input type="datetime-local" id="dateEnlev" name="dateEnlev" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="dateEnlev" class="form-label">Date chargement</label>
                        <input type="datetime-local" id="dateCharg" name="dateCharg" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dateLivr" class="form-label">Date de Livraison</label>
                        <input type="datetime-local" id="dateLivr" name="dateLivr" class="form-control" >
                    </div>
                    <div  class="col-md-6">
                        <label for="status" class="form-label">STATUS D'EXP.</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Encour" {{ old('status') == 'Encour' ? 'selected' : '' }}>Encour</option>
                            <option value="Arrivé" {{ old('status') == 'Arrivé' ? 'selected' : '' }}>Arrivé</option>
                            <option value="Depot" {{ old('status') == 'Depot' ? 'selected' : '' }}>Depot</option>
                            <option value="Non Livré" {{ old('status') == "Non Livré" ? 'selected' : '' }}>Non Livré</option>
                            <option value="Livré" {{ old('status') == 'Livré' ? 'selected' : '' }}>Livré</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6" style="display: flex; align-items: center;">
                        <label for="montant_total" style="margin-right: 10px;">Montant Total:</label>
                        <input type="number" step="0.01" name="montant_total" id="montant_total" value="0" class="form-control" style="flex-grow: 1; margin-right: 5px;">
                        <select class="form-select" id="devise" name="devise" style="max-width: 80px;">
                            <option value="EUR" selected>EUR</option>
                            <option value="XOF">FCFA</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="display: flex; align-items: center;">
                        <label for="montant_total" style="margin-right: 10px;">Montant Versé:</label>
                        <input type="number" step="0.01" name="montant_paye" id="montant_total" value="0" class="form-control" style="flex-grow: 1; margin-right: 5px;">
                        <select class="form-select" id="devise" name="devise" style="max-width: 80px;">
                            <option value="EUR" selected>EUR</option>
                            <option value="XOF">FCFA</option>
                        </select>
                    </div>
                </div>
                    
                <div class="row mb-3">
                                            <div class="col-md-6" style="display: none;">
                                                <label for="montant_total">Montant Total</label>
                                                <input type="number" step="0.01" name="montant_total" id="montant_total" value="0" required>
                                            </div>
                                            <div class="col-md-6" style="display: none;">
                                                <label for="montant_paye">Montant Payé</label>
                                                <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="0">
                                            </div>
                                            <div class="col-md-6" style="display: non;">
                                                <br><label for="statut" class="form-label">Mode de paiement.</label>
                                                <select name="mode_paiement" id="status">
                                                    <option value="espece" {{ old('mode_paiement') == 'espece' ? 'selected' : '' }}>Espèce</option>
                                                    <option value="chèque" {{ old('mode_paiement') == 'chèque' ? 'selected' : '' }}>Chèque</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="image_colis">Image du Colis(Facultatif)</label>
                                                <input type="file" name="image_colis" id="image_colis" class="form-control-file">
                                            </div>
                                        </div>

            <div class="row mb-3" style="float: right;">
                <button type="submit" class="btn btn-success expedier">EXPEDIER</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const telephoneExpediteurInput = document.getElementById('numero_expediteur');
    const telephoneDestinataireInput = document.getElementById('numero_destinataire');
    const expeditionForm = document.getElementById('expeditionForm');

    function validatePhoneNumber(inputElement) {
        inputElement.addEventListener('input', function() {
            const value = this.value;
            const isValid = /^(33\d{9}|225\d{10})$/.test(value);

            if (!isValid && value.length > 0) {
                this.classList.add('is-invalid');
                this.nextElementSibling.style.display = 'block';
            } else {
                this.classList.remove('is-invalid');
                if (this.nextElementSibling) {
                    this.nextElementSibling.style.display = 'none';
                }
            }
        });
    }

    validatePhoneNumber(telephoneExpediteurInput);
    validatePhoneNumber(telephoneDestinataireInput);

    expeditionForm.addEventListener('submit', function(event) {
        const expediteurTel = telephoneExpediteurInput.value;
        const destinataireTel = telephoneDestinataireInput.value;

        const isValidExpediteur = /^(33\d{9}|225\d{10})$/.test(expediteurTel.trim()); // Ajout de .trim()
        const isValidDestinataire = /^(33\d{9}|225\d{10})$/.test(destinataireTel.trim()); // Ajout de .trim()

        if (!isValidExpediteur) {
            event.preventDefault();
            telephoneExpediteurInput.classList.add('is-invalid');
            if (telephoneExpediteurInput.nextElementSibling) {
                telephoneExpediteurInput.nextElementSibling.style.display = 'block';
            }
        }

        if (!isValidDestinataire) {
            event.preventDefault();
            telephoneDestinataireInput.classList.add('is-invalid');
            if (telephoneDestinataireInput.nextElementSibling) {
                telephoneDestinataireInput.nextElementSibling.style.display = 'block';
            }
        }
    });


    
    // const montantInput = document.getElementById('montant_total');
    // const devise = ' FCFA';

    // montantInput.addEventListener('blur', function() {
    //     if (this.value !== '') {
    //         this.value = this.value + devise;
    //     }
    // });

    // montantInput.addEventListener('focus', function() {
    //     if (this.value.endsWith(devise)) {
    //         this.value = this.value.slice(0, -devise.length);
    //     }
    // });
</script>
@endsection