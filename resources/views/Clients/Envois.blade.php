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
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                    <i class="bi bi-currency-dollar"></i>
                    <h4 class="d-none d-lg-block">Obtenir Devis</h4>
                </a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                    <i class="bi bi-box-seam"></i>
                    <h4 class="d-none d-lg-block">ENVOYER UN COLIS</h4>
                </a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                    <i class="bi bi-alarm"></i>
                    <h4 class="d-none d-lg-block">Rdv d'enlevement</h4>
                </a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
                    <i class="bi bi-info-circle"></i>
                    <h4 class="d-none d-lg-block">Bon a Savoir</h4>
                </a>
            </li>
        </ul>

        <!-- End Tab Nav -->

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            <div class="tab-pane fade active show" id="features-tab-1">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                        <h3>Je Demande en tant que...</h3>
                        <div class="tabs">
                            <button type="submit" class="btn btn-secondary  btn-lg" id="btn-particulier">Particulier</button>
                            <button type="submit" class="btn btn-secondary  btn-lg" id="btn-professionnel">Business</button>
                            <br>
                        </div>
                        <div class="container" style="margin-top: 15px;" id="form-professionnel">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <!-- Demande devis Entreprise -->
                            <form method="POST" action="{{route('DemandDevis')}}" data-aos="fade-up" data-aos-delay="500" id="form-professionnel-devis">
                                @csrf
                                <div class="row gy-4">
                                    <div class="alert alert-info" role="alert">
                                        Vous demandez en tant qu'une Entreprise.
                                    </div>
                                    <input type="hiden" name="user_id" value="{{Auth::user()->code_unique}}"  style="display: none;">
                                    <input type="text" name="particulier" value="entreprise" style="display: none;">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Pays-Depart:</label>
                                        <select class="form-select form-select-lg mb-3" aria-label="Default select example" name="paysDepart">
                                            <option selected>Sélectionnez un pays</option>
                                            <option value="afrique du sud">Afrique du Sud</option>
                                            <option value="algerie">Algérie</option>
                                            <option value="angola">Angola</option>
                                            <option value="benin">Bénin</option>
                                            <option value="burundi">Burundi</option>
                                            <option value="cameroun">Cameroun</option>
                                            <option value="cap_vert">Cap-Vert</option>
                                            <option value="congo">Congo</option>
                                            <option value="cote_divoire">Côte d'Ivoire</option>
                                            <option value="djibouti">Djibouti</option>
                                            <option value="egypte">Égypte</option>
                                            <option value="france">France</option>
                                            <option value="gabon">Gabon</option>
                                            <option value="guinee">Guinée</option>
                                            <option value="guinee_bissau">Guinée-Bissau</option>
                                            <option value="guinee_equatoriale">Guinée équatoriale</option>
                                            <option value="kenya">Kenya</option>
                                            <option value="lesotho">Lesotho</option>
                                            <option value="liberia">Liberia</option>
                                            <option value="libye">Libye</option>
                                            <option value="madagascar">Madagascar</option>
                                            <option value="malawi">Malawi</option>
                                            <option value="mali">Mali</option>
                                            <option value="maroc">Maroc</option>
                                            <option value="mozambique">Mozambique</option>
                                            <option value="namibie">Namibie</option>
                                            <option value="niger">Niger</option>
                                            <option value="nigeria">Nigeria</option>
                                            <option value="ouganda">Ouganda</option>
                                            <option value="republique_democratique_du_congo">République démocratique du Congo</option>
                                            <option value="rwanda">Rwanda</option>
                                            <option value="sao_tome_et_principe">Sao Tomé-et-Principe</option>
                                            <option value="senegal">Sénégal</option>
                                            <option value="seychelles">Seychelles</option>
                                            <option value="sierra_leone">Sierra Leone</option>
                                            <option value="somalie">Somalie</option>
                                            <option value="soudan">Soudan</option>
                                            <option value="soudan_du_sud">Soudan du Sud</option>
                                            <option value="swaziland">Swaziland</option>
                                            <option value="tanzanie">Tanzanie</option>
                                            <option value="tchad">Tchad</option>
                                            <option value="togo">Togo</option>
                                            <option value="tunisie">Tunisie</option>
                                            <option value="zambie">Zambie</option>
                                            <option value="zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Vers :</label>
                                        <select class="form-select form-select-lg mb-3" aria-label="Default select example" name="paysArrivee">
                                            <option selected>Sélectionnez un pays</option>
                                            <option value="algerie">Algérie</option>
                                            <option value="angola">Angola</option>
                                            <option value="benin">Bénin</option>
                                            <option value="burundi">Burundi</option>
                                            <option value="cameroun">Cameroun</option>
                                            <option value="cap_vert">Cap-Vert</option>
                                            <option value="congo">Congo</option>
                                            <option value="cote_divoire">Côte d'Ivoire</option>
                                            <option value="djibouti">Djibouti</option>
                                            <option value="egypte">Égypte</option>
                                            <option value="france">France</option>
                                            <option value="gabon">Gabon</option>
                                            <option value="guinee">Guinée</option>
                                            <option value="guinee_bissau">Guinée-Bissau</option>
                                            <option value="guinee_equatoriale">Guinée équatoriale</option>
                                            <option value="kenya">Kenya</option>
                                            <option value="lesotho">Lesotho</option>
                                            <option value="liberia">Liberia</option>
                                            <option value="libye">Libye</option>
                                            <option value="madagascar">Madagascar</option>
                                            <option value="malawi">Malawi</option>
                                            <option value="mali">Mali</option>
                                            <option value="maroc">Maroc</option>
                                            <option value="mozambique">Mozambique</option>
                                            <option value="namibie">Namibie</option>
                                            <option value="niger">Niger</option>
                                            <option value="nigeria">Nigeria</option>
                                            <option value="ouganda">Ouganda</option>
                                            <option value="republique_democratique_du_congo">République démocratique du Congo</option>
                                            <option value="rwanda">Rwanda</option>
                                            <option value="sao_tome_et_principe">Sao Tomé-et-Principe</option>
                                            <option value="senegal">Sénégal</option>
                                            <option value="seychelles">Seychelles</option>
                                            <option value="sierra_leone">Sierra Leone</option>
                                            <option value="somalie">Somalie</option>
                                            <option value="soudan">Soudan</option>
                                            <option value="soudan_du_sud">Soudan du Sud</option>
                                            <option value="swaziland">Swaziland</option>
                                            <option value="tanzanie">Tanzanie</option>
                                            <option value="tchad">Tchad</option>
                                            <option value="togo">Togo</option>
                                            <option value="tunisie">Tunisie</option>
                                            <option value="zambie">Zambie</option>
                                            <option value="zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Ville-Depart</label>
                                        <input type="text" class="form-control" name="villeDepart" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Ville-Arrivée</label>
                                        <input type="text" class="form-control" name="villeArrivee" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="designation" rows="4" placeholder="Details de votre colis" required=""></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="exampleFormControlInpu1" class="form-label">Montant du devis qui vous sera communiqué</label>
                                        <input type="text" readonly class="form-control" name="montant_total" value="0,0">
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm">Envoyer</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                        <div class="container" display: none; style="margin-top: 15px;" id="form-particulier">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <!-- Devis Particulier  -->
                            <form method="POST" action="{{route('DemandDevis')}}" data-aos="fade-up" data-aos-delay="500" id="form-particulier-devis">
                                @csrf
                                <div class="row gy-4">
                                    <div class="alert alert-info" role="alert">
                                        Vous demandez en tant qu'un Particulier.
                                    </div>
                                        <input type="hiden" name="user_id" value="{{ Auth::user()->code_unique}}"  style="display: none;">
                                        <input type="text" name="particulier" value="particulier" style="display: none;">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Pays-Depart:</label>
                                        <select class="form-select form-select-lg mb-3" name="paysDepart">
                                            <option selected>Sélectionnez un pays</option>
                                            <option value="afrique du sud">Afrique du Sud</option>
                                            <option value="algerie">Algérie</option>
                                            <option value="angola">Angola</option>
                                            <option value="benin">Bénin</option>
                                            <option value="burundi">Burundi</option>
                                            <option value="cameroun">Cameroun</option>
                                            <option value="cap_vert">Cap-Vert</option>
                                            <option value="congo">Congo</option>
                                            <option value="cote_divoire">Côte d'Ivoire</option>
                                            <option value="djibouti">Djibouti</option>
                                            <option value="egypte">Égypte</option>
                                            <option value="france">France</option>
                                            <option value="gabon">Gabon</option>
                                            <option value="guinee">Guinée</option>
                                            <option value="guinee_bissau">Guinée-Bissau</option>
                                            <option value="guinee_equatoriale">Guinée équatoriale</option>
                                            <option value="kenya">Kenya</option>
                                            <option value="lesotho">Lesotho</option>
                                            <option value="liberia">Liberia</option>
                                            <option value="libye">Libye</option>
                                            <option value="madagascar">Madagascar</option>
                                            <option value="malawi">Malawi</option>
                                            <option value="mali">Mali</option>
                                            <option value="maroc">Maroc</option>
                                            <option value="mozambique">Mozambique</option>
                                            <option value="namibie">Namibie</option>
                                            <option value="niger">Niger</option>
                                            <option value="nigeria">Nigeria</option>
                                            <option value="ouganda">Ouganda</option>
                                            <option value="republique_democratique_du_congo">République démocratique du Congo</option>
                                            <option value="rwanda">Rwanda</option>
                                            <option value="sao_tome_et_principe">Sao Tomé-et-Principe</option>
                                            <option value="senegal">Sénégal</option>
                                            <option value="seychelles">Seychelles</option>
                                            <option value="sierra_leone">Sierra Leone</option>
                                            <option value="somalie">Somalie</option>
                                            <option value="soudan">Soudan</option>
                                            <option value="soudan_du_sud">Soudan du Sud</option>
                                            <option value="swaziland">Swaziland</option>
                                            <option value="tanzanie">Tanzanie</option>
                                            <option value="tchad">Tchad</option>
                                            <option value="togo">Togo</option>
                                            <option value="tunisie">Tunisie</option>
                                            <option value="zambie">Zambie</option>
                                            <option value="zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Vers :</label>
                                        <select class="form-select form-select-lg mb-3" aria-label="Default select example" name="paysArrivee">
                                            <option selected>Sélectionnez un pays</option>
                                            <option value="algerie">Algérie</option>
                                            <option value="angola">Angola</option>
                                            <option value="benin">Bénin</option>
                                            <option value="burundi">Burundi</option>
                                            <option value="cameroun">Cameroun</option>
                                            <option value="cap_vert">Cap-Vert</option>
                                            <option value="congo">Congo</option>
                                            <option value="cote_divoire">Côte d'Ivoire</option>
                                            <option value="djibouti">Djibouti</option>
                                            <option value="egypte">Égypte</option>
                                            <option value="france">France</option>
                                            <option value="gabon">Gabon</option>
                                            <option value="guinee">Guinée</option>
                                            <option value="guinee_bissau">Guinée-Bissau</option>
                                            <option value="guinee_equatoriale">Guinée équatoriale</option>
                                            <option value="kenya">Kenya</option>
                                            <option value="lesotho">Lesotho</option>
                                            <option value="liberia">Liberia</option>
                                            <option value="libye">Libye</option>
                                            <option value="madagascar">Madagascar</option>
                                            <option value="malawi">Malawi</option>
                                            <option value="mali">Mali</option>
                                            <option value="maroc">Maroc</option>
                                            <option value="mozambique">Mozambique</option>
                                            <option value="namibie">Namibie</option>
                                            <option value="niger">Niger</option>
                                            <option value="nigeria">Nigeria</option>
                                            <option value="ouganda">Ouganda</option>
                                            <option value="republique_democratique_du_congo">République démocratique du Congo</option>
                                            <option value="rwanda">Rwanda</option>
                                            <option value="sao_tome_et_principe">Sao Tomé-et-Principe</option>
                                            <option value="senegal">Sénégal</option>
                                            <option value="seychelles">Seychelles</option>
                                            <option value="sierra_leone">Sierra Leone</option>
                                            <option value="somalie">Somalie</option>
                                            <option value="soudan">Soudan</option>
                                            <option value="soudan_du_sud">Soudan du Sud</option>
                                            <option value="swaziland">Swaziland</option>
                                            <option value="tanzanie">Tanzanie</option>
                                            <option value="tchad">Tchad</option>
                                            <option value="togo">Togo</option>
                                            <option value="tunisie">Tunisie</option>
                                            <option value="zambie">Zambie</option>
                                            <option value="zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Ville-Depart</label>
                                        <input type="text" class="form-control" name="villeDepart" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Ville-Arrivée</label>
                                        <input type="text" class="form-control" name="villeArrivee" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="designation" rows="4" placeholder="Information du colis" required=""></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="exampleFormControlInpu1" class="form-label">Montant du devis qui vous sera communiqué</label>
                                        <input type="text" readonly class="form-control" name="montant_total" value="0,0">
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm">Envoyer</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="../Clients/assets/img/jeune.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
<!-- End Tab Content Devis -->
            <div class="tab-pane fade" id="features-tab-2">
                <div class="row">
                    <h3>J'expédie en tant que...</h3>
                    <div class="tabs">
                        <button type="submit" class="btn btn-secondary  btn-lg" id="btnparticul">Particulier</button>
                        <button type="submit" class="btn btn-secondary  btn-lg" id="btnprofession">Business</button>
                    </div>
                    <div class="container mt-4">
                        <div class="container" id="formparticul">
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
                                    Vous demandez en tant qu'une Particulier.
                                </div>
                                <h4>Information de l'Expediteur</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <input type="text" name="particulier" value="particulier" style="display: none;">
                                            <input type="hiden" name="expediteur_id" class="form-control" value="{{ Auth::user()->code_unique}}"  style="display: none;">
                                            <div class="col-md-6">
                                                <label for="floatingInputGrid">Expediteur</label>
                                                <input type="text" name="nom_expediteur" class="form-control" id="floatingInputGrid" placeholder="Nom de expediteur" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">Téléphone</label>
                                                <input type="text" id="telephone_client" name="numero_expediteur" class="form-control" value="" required>
                                                
                                            <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                                            <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
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
                        <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
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
                                                <input type="text" id="nom_client" name="numeroSuivi" value="{{$code_suivi}}" class="form-control"  style="display: none;">
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
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Enlevement</label>
                                                <input type="datetime-local" id="telephone_client" name="dateEnlev" class="form-control">
                                            </div>
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Livraison</label>
                                                <input type="datetime-local" id="telephone_client" name="dateLivr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="montant_total"  style="display: none;">Montant Total</label>
                                                <input type="number" step="0.01" name="montant_total" id="montant_total" value="0" required>
                                            </div>
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="montant_paye">Montant Payé</label>
                                                <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="0">
                                            </div>
                                            <div class="col-md-6"  style="display: nne;">
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
                                    Vous demandez en tant qu'une Entreprise.
                                </div>
                                <h4>Information de l'Expediteur</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <input type="text" name="particulier" value="entreprise" style="display: none;">
                                            <input type="hiden" name="expediteur_id" class="form-control" value="{{ Auth::user()->code_unique}}"  style="display: none;">
                                            <div class="col-md-6">
                                                <label for="floatingInputGrid">Expediteur</label>
                                                <input type="text" name="nom_expediteur" class="form-control" id="floatingInputGrid" placeholder="Nom de expediteur" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telephone_client" class="form-label">Téléphone</label>
                                                <input type="text" id="telephone_client" name="numero_expediteur" class="form-control" value="" required>
                                                
                        <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
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
                                                
                        <small class="form-text text-muted">Format: 33XXXXXXXXX ou 225XXXXXXXXXXX</small>
                        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format 33XXXXXXXXX ou 225XXXXXXXXXXX.</div>
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
                                            <div class="col-md-6"  style="display: none;">
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
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Enlevement</label>
                                                <input type="datetime-local" id="telephone_client" name="dateEnlev" class="form-control">
                                            </div>
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="telephone_client" class="form-label">Date-Livraison</label>
                                                <input type="datetime-local" id="telephone_client" name="dateLivr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="montant_total">Montant Total</label>
                                                <input type="number" step="0.01" name="montant_total" id="montant_total" value="0" required>
                                            </div>
                                            <div class="col-md-6"  style="display: none;">
                                                <label for="montant_paye">Montant Payé</label>
                                                <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="0">
                                            </div>
                                            <div class="col-md-6"  style="display: non;">
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
 <!--End table Envois colis  -->
             <div class="tab-pane fade" id="features-tab-3">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">

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
                            <div class="alert alert-warning" role="alert">
                                <center> Veuillez noter que le nombre de Rdv est limité à 30/Jr.<br>
                                    Rdv restant: <mark>{{ $remaining }}</mark></center>
                            </div>

                            @if ($dailyCount->count < 30)
                                <form method="POST" action="{{route('storeRdv')}}" data-aos="fade-up" data-aos-delay="500">
                                @csrf
                                <div class="row gy-4">
                                    @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    <div>
                                        <label for="nom">Nom et prénom :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required placeholder="Votre Nom Ou Nom complet du preneur">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">N° Telephpone</label>
                                        <input type="text" class="form-control" name="telephone" placeholder="N° Tel" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Numero Suivie</label>
                                        <input type="text" class="form-control" name="numero_suivi" placeholder="Numero Suivi de votre colis" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Date du retrait</label>
                                        <input type="date" class="form-control" name="date_retrait" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Heure souhaitée (plage horaire):</label>
                                        <select class="form-select form-select-sm" name="heure_retrait" required>
                                            <option selected>Sélectionnez une plage</option>
                                            <option value="matin_9-12">Matin (9h-12h)</option>
                                            <option value="soir_14-17">Après-midi (14h-17h)</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="designation" rows="4" placeholder="Details de votre colis" required=""></textarea>
                                    </div>

                                    <div class="col-md-6 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg submit-form">Envoyer</button>
                                    </div>
                                </div>
                                </form>
                                @endif
                        </div>


                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="../Clients/assets/img/jeune.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <!-- End Tab Content Item -->

            <div class="tab-pane fade" id="features-tab-4">

                    INFOS UTILES
                    1 Tout colis dont le poids est inferieur à 2kg sera facturé au prix de 2kg sauf tarification spéciale.
                    2 3 Jours après la disponibilité du colis, des frais supplémenatires de garde à hauteur de 4€ à paris et de 1.500F à Abidjan sont appliqués. Nous vous invitons à prendre toutes les mesures nécessaires afin de proceder au retrait du colis au plus vite.
                    3 Tout colis dont le poids présente une décimale est comptabilisé au demi supérieure. (Exemple : un colis de 2,10kg à 2,49kg sera comptabilisé à 2,50kg ou encore un colis de 2,51kg à 2,99kg seracompté comme 3kg)
                    ASSURANCE & INDEMNISATION EN CAS DE PERTE
                    3 EN CAS DE SOUSCRIPTION A L'ASSURANCE
                    - Aircolis rembourse la valeur déclarée du colis ainsi que les frais d'expédition payés
                    - Indemnisation Ad Valorem : Selon la valeur déclarée (max 1000€), Si plus favorable pour le client : AirColis indemnise à hauteur de 21€/kg
                    3 EN CAS DE NON SOUSCRIPTION A L'ASSURANCE
                    - AirColis indemnise le client uniquement à hauteur de 21€/kg peut importe la valeur du colis.

                    Dans les deux cas, les frais d'expeditions sont déduits dans le montant à rembourser, si le client choisi le règlement à la livraison.
                </div>

            </div>
        </div>
    </div>
<!-- End Tab Content Item -->
</section>
<!-- /Features Section -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnParticulier = document.getElementById('btn-particulier');
        const btnProfessionnel = document.getElementById('btn-professionnel');
        const formParticulier = document.getElementById('form-particulier');
        const formProfessionnel = document.getElementById('form-professionnel');

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
        const paysDepart = document.querySelector('select[name="paysDepart"]').value;
        const paysArrivee = document.querySelector('select[name="paysArrivee"]').value;
        const villeDepart = document.querySelector('input[name="villeDepart"]').value;
        const villeArrivee = document.querySelector('input[name="villeArrivee"]').value;
        const designation = document.querySelector('textarea[name="designation"]').value;

        if (paysDepart === 'Sélectionnez un pays' || paysArrivee === 'Sélectionnez un pays' || villeDepart === '' || villeArrivee === '' || designation === '') {
            alert('Veuillez remplir tous les champs obligatoires.');
            event.preventDefault(); // Empêche l'envoi du formulaire
        }
        if (paysDepart === paysArrivee) {
            alert("Les pays de départ et d'arrivée doivent être différents");
            event.preventDefault();
        }
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