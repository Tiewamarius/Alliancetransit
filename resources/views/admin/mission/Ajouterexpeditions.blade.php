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

    <form method="POST" action="{{ route('storeExpedition') }}" id="expeditionForm">
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
                        <label for="adresse_destinataire" class="form-label">Adresse</label>
                        <input type="text" id="adresse_destinataire" name="adresse_destinataire" class="form-control" >
                    </div>
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
                    <div class="col-md-6">
                        <label for="numeroConteneur" class="form-label">N° CONTENEUR</label>
                        <input type="text" id="numeroConteneur" name="numeroConteneur" class="form-control" >
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
                        <label for="dateLivr" class="form-label">Date de Livraison</label>
                        <input type="datetime-local" id="dateLivr" name="dateLivr" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="montant_total">Montant Total</label>
                        <input type="number" step="0.01" name="montant_total" id="montant_total" value="0" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="montant_paye">Montant Payé</label>
                        <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="0" class="form-control">
                    </div>
                    <div  class="col-md-6">
                        <br><label for="status" class="form-label">STATUS D'EXP.</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Encour" {{ old('status') == 'Encour' ? 'selected' : '' }}>Encour</option>
                            <option value="Arrivé" {{ old('status') == 'Arrivé' ? 'selected' : '' }}>Arrivé</option>
                            <option value="Depot" {{ old('status') == 'Depot' ? 'selected' : '' }}>Depot</option>
                            <option value="Non Livré" {{ old('status') == "Non Livré" ? 'selected' : '' }}>Non Livré</option>
                            <option value="Livré" {{ old('status') == 'Livré' ? 'selected' : '' }}>Livré</option>
                        </select>
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
</script>
@endsection