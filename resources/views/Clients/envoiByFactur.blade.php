@extends('layouts.Client')
@section('content')
<style>
    th {
        white-space: nowrap;
    }
</style>

<section id="features" class="features section" style="margin-top: 90px;">

    <div class="container">

        <ul class="nav nav-tabs row  d-flex" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item col-3">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-1" style="background-color: #cac8c8b9; color:#cac8c8b9; border:1px solid #cac8c8b9;">
                    <i class="bi bi-currency-dollar"></i>
                    <h4 class="d-none d-lg-block" style="color:#cac8c8b9">Obtenir Devis</h4>
                </a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                    <i class="bi bi-box-seam"></i>
                    <h4 class="d-none d-lg-block">ENVOYER UN COLIS</h4>
                </a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3" style="background-color: #cac8c8b9; color:#cac8c8b9; border:1px solid #cac8c8b9;">
                    <i class="bi bi-alarm"></i>
                    <h4 class="d-none d-lg-block" style="color:#cac8c8b9">Rdv d'enlevement</h4>
                </a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4" style="background-color: #cac8c8b9; color:#cac8c8b9; border:1px solid #cac8c8b9;">
                    <i class="bi bi-info-circle"></i>
                    <h4 class="d-none d-lg-block" style="color:#cac8c8b9">Bon a Savoir</h4>
                </a>
            </li>
        </ul>

        <div class="tab-content" data-aos="fade-up">
            <div class="tab-pane fade" id="features-tab-1">
            </div>
            <div class="tab-pane fade active show" id="features-tab-2">
                <div class="row">
                    <h3>J'expédie en tant que...</h3>
                    <div class="tabs">
                        <button type="button" class="btn btn-secondary  btn-lg" id="btnparticul">Particulier</button>
                        <button type="button" class="btn btn-primary  btn-lg" id="btnprofession">Business</button>
                    </div>
                    <div class="container mt-4">
                        <div class="container" id="formparticul" style="display: none;">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form method="POST" action="{{route('EnvoisColis') }}" id="form-particulier-envoi">
                                @csrf
                                <div class="alert alert-info" role="alert">
                                    Vous Expediez en tant qu'une Particulier.
                                </div>
                                <h4>Information de l'Expediteur</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <input type="text" name="particulier" value="particulier" style="display: none;">
                                            <input type="hiden" name="expediteur_id" class="form-control" value="{{ Auth::user()->code_unique}}" style="display: none;">
                                            <div class="col-md-6">
                                                <label for="floatingInputGrid">Expediteur</label>
                                                <input type="text" name="nom_expediteur" class="form-control" id="floatingInputGrid" placeholder="Nom de expediteur" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">Téléphone</label>
                                                <input type="text" id="telephone_client" name="numero_expediteur" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email_client" name="emai_expediteur" class="form-label">Email</label>
                                                <input type="email" id="email_client" name="email_expediteur" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                                                <input type="text" id="adresse_client" name="adresse_expediteur" class="form-control" required>

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
                                                <label for="floatingInputGrid">Destinataire</label>
                                                <input type="text" name="nom_destinataire" class="form-control" id="floatingInputGrid" placeholder="Nom du destinataire" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">Téléphone</label>
                                                <input type="text" id="telephone_client" name="numero_destinataire" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email_client" name="emai_destinataire" class="form-label">Email</label>
                                                <input type="email" id="email_client" name="email_destinataire" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                                                <input type="text" id="adresse_client" name="adresse_destinataire" class="form-control" required>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h4>Information du colis</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6" style="display: none;">
                                                <label for="nom_client" class="form-label">Code de suivi</label>
                                                <input type="text" id="nom_client" name="numeroSuivi" value="{{$code_suivi}}" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="prenom_client" class="form-label">Desigation</label>
                                                <input type="text" id="prenom_client" name="designation" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">N° CONTENEUR</label>
                                                <input type="text" id="telephone_client" name="numeroConteneur" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email_client" class="form-label">Remarque</label>
                                                <input type="text" id="email_client" name="typeService" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6" style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Enlevement</label>
                                                <input type="datetime-local" id="telephone_client" name="dateEnlev" class="form-control">
                                            </div>
                                            <div class="col-md-6" style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Livraison</label>
                                                <input type="datetime-local" id="telephone_client" name="dateLivr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6" style="display: nonfe;">
                                                <label for="montant_total">Montant Total</label>
                                                <input type="number" step="0.01" name="montant_total" id="montant_total" value="{{$devis->montant_total ?? 0}}" readonly>
                                            </div>
                                            <div class="col-md-6" style="display: nonek;">
                                                <label for="montant_paye">Montant Payé</label>
                                                <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="0.0">
                                            </div>
                                            <div class="col-md-6" style="display: non;">
                                                <br><label for="statut" class="form-label">STATUS D'EXP.</label>
                                                <select name="status" id="status">
                                                    <option value="Non Traité" {{ old('status') == 'Non Traité' ? 'selected' : '' }}>Non Traité</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="image_colis">Image du Colis</label>
                                                <input type="file" name="image_colis" id="image_colis" class="form-control-file">
                                            </div>
                                        </div>
                                        <div class="row mb-3" style="float: right;">
                                            <button type="submit" class="btn btn-success expedier submit-form">EXPEDIER</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <div class="container" id="formprofession">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form method="POST" action="{{route('EnvoisColis') }}" id="form-professionnel-envoi">
                                @csrf
                                <div class="alert alert-info" role="alert">
                                    Vous Expediez en tant qu'une Entreprise.
                                </div>
                                <h4>Information de l'Expediteur</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <input type="text" name="particulier" value="entreprise" style="display: none;">
                                            <input type="hiden" name="expediteur_id" class="form-control" value="{{ Auth::user()->code_unique}}" style="display: none;">
                                            <div class="col-md-6">
                                                <label for="floatingInputGrid">Expediteur</label>
                                                <input type="text" name="nom_expediteur" class="form-control" id="floatingInputGrid" placeholder="Nom de expediteur" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">Téléphone</label>
                                                <input type="text" id="telephone_client" name="numero_expediteur" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email_client" name="emai_expediteur" class="form-label">Email</label>
                                                <input type="email" id="email_client" name="email_expediteur" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                                                <input type="text" id="adresse_client" name="adresse_expediteur" class="form-control" required>

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
                                                <label for="floatingInputGrid">Destinataire</label>
                                                <input type="text" name="nom_destinataire" class="form-control" id="floatingInputGrid" placeholder="Nom du destinataire" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">Téléphone</label>
                                                <input type="text" id="telephone_client" name="numero_destinataire" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email_client" name="emai_destinataire" class="form-label">Email</label>
                                                <input type="email" id="email_client" name="email_destinataire" class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                                                <input type="text" id="adresse_client" name="adresse_destinataire" class="form-control" required>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h4>Information du colis</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6" style="display: none;">
                                                <label for="nom_client" class="form-label">Code de suivi</label>
                                                <input type="text" id="nom_client" name="numeroSuivi" value="{{$code_suivi}}" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="prenom_client" class="form-label">Desigation</label>
                                                <input type="text" id="prenom_client" name="designation" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">N° CONTENEUR</label>
                                                <input type="text" id="telephone_client" name="numeroConteneur" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email_client" class="form-label">Remarque</label>
                                                <input type="text" id="email_client" name="typeService" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6" style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Enlevement</label>
                                                <input type="datetime-local" id="telephone_client" name="dateEnlev" class="form-control">
                                            </div>
                                            <div class="col-md-6" style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Livraison</label>
                                                <input type="datetime-local" id="telephone_client" name="dateLivr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6" style="display: nonfe;">
                                                <label for="montant_total">Montant Total</label>
                                                <input type="number" step="0.01" name="montant_total" id="montant_total" value="{{$devis->montant_total ?? 0}}" readonly>
                                            </div>
                                            <div class="col-md-6" style="display: nonek;">
                                                <label for="montant_paye">Montant Payé</label>
                                                <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="0.0">
                                            </div>
                                            <div class="col-md-6" style="display: non;">
                                                <br><label for="statut" class="form-label">STATUS D'EXP.</label>
                                                <select name="status" id="status">
                                                    <option value="Non Traité" {{ old('status') == 'Non Traité' ? 'selected' : '' }}>Non Traité</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="image_colis">Image du Colis</label>
                                                <input type="file" name="image_colis" id="image_colis" class="form-control-file">
                                            </div>
                                        </div>
                                        <div class="row mb-3" style="float: right;">
                                            <button type="submit" class="btn btn-success expedier submit-form">EXPEDIER</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="features-tab-3">
            </div>
            <div class="tab-pane fade" id="features-tab-4">
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnParticulier = document.getElementById('btnparticul');
        const btnProfessionnel = document.getElementById('btnprofession');
        const formParticulier = document.getElementById('formparticul');
        const formProfessionnel = document.getElementById('formprofession');

        // Afficher le formulaire professionnel par défaut
        formParticulier.style.display = 'none';
        formProfessionnel.style.display = 'block';

        btnParticulier.addEventListener('click', function() {
            formParticulier.style.display = 'block';
            formProfessionnel.style.display = 'none';
            btnParticulier.classList.remove('btn-secondary');
            btnParticulier.classList.add('btn-primary');
            btnProfessionnel.classList.remove('btn-primary');
            btnProfessionnel.classList.add('btn-secondary');
        });

        btnProfessionnel.addEventListener('click', function() {
            formParticulier.style.display = 'none';
            formProfessionnel.style.display = 'block';
            btnProfessionnel.classList.remove('btn-secondary');
            btnProfessionnel.classList.add('btn-primary');
            btnParticulier.classList.remove('btn-primary');
            btnParticulier.classList.add('btn-secondary');
        });
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        // Vous aviez un sélecteur de formulaire générique ici ('form').
        // Il faudrait peut-être cibler les formulaires spécifiques si vous avez d'autres formulaires dans la page.
        // Par exemple: document.getElementById('form-particulier-envoi').addEventListener(...)

        // Les vérifications de pays et de designation étaient commentées, je les ai laissées comme ça.
        // const paysDepart = document.querySelector('select[name="paysDepart"]').value;
        // const paysArrivee = document.querySelector('select[name="paysArrivee"]').value;
        // const villeDepart = document.querySelector('input[name="villeDepart"]').value;
        // const villeArrivee = document.querySelector('input[name="villeArrivee"]').value;
        // const designation = document.querySelector('textarea[name="designation"]').value;

        // if (paysDepart === 'Sélectionnez un pays' || paysArrivee === 'Sélectionnez un pays' || villeDepart === '' || villeArrivee === '' || designation === '') {
        //     alert('Veuillez remplir tous les champs obligatoires.');
        //     event.preventDefault(); // Empêche l'envoi du formulaire
        // }
        // if (paysDepart === paysArrivee) {
        //     alert("Les pays de départ et d'arrivée doivent être différents");
        //     event.preventDefault();
        // }
    });


    // script Envois colis

    document.addEventListener('DOMContentLoaded', function() {
        const btnParticul = document.getElementById('btnparticul');
        const btnProfession = document.getElementById('btnprofession');
        const formParticul = document.getElementById('formparticul');
        const formProfession = document.getElementById('formprofession');

        // Afficher le formulaire professionnel par défaut
        formParticul.style.display = 'none';
        formProfession.style.display = 'block';

        btnParticul.addEventListener('click', function() {
            formParticul.style.display = 'block';
            formProfession.style.display = 'none';
            btnParticul.classList.remove('btn-secondary');
            btnParticul.classList.add('btn-primary');
            btnProfession.classList.remove('btn-primary');
            btnProfession.classList.add('btn-secondary');
        });

        btnProfession.addEventListener('click', function() {
            formParticul.style.display = 'none';
            formProfession.style.display = 'block';
            btnProfession.classList.remove('btn-secondary');
            btnProfession.classList.add('btn-primary');
            btnParticul.classList.remove('btn-primary');
            btnParticul.classList.add('btn-secondary');
        });
    });
</script>
@endsection