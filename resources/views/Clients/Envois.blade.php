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
                    <i class="bi bi-house"></i>
                    <h4 class="d-none d-lg-block">MON COMPTE</h4>
                </a>
            </li>
        </ul>

        <!-- End Tab Nav -->

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            <div class="tab-pane fade active show" id="features-tab-1">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                        <p class="fst-italic">
                            Demander un devis Maintenant pour.........
                        </p>
                        <h3>J'expédie en tant que...</h3>
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
                            <form method="POST" action="{{route('DemandDevis')}}" data-aos="fade-up" data-aos-delay="500">
                                @csrf
                                <div class="row gy-4">

                                    <div class="alert alert-info" role="alert">
                                        Vous demandez en tant qu'une Entreprise.
                                    </div>
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
                                            <option value="cote_divoire">France</option>
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
                                            <option value="cote_divoire">France</option>
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
                            <form method="POST" action="{{route('DemandDevis')}}" data-aos="fade-up" data-aos-delay="500">
                                @csrf
                                <div class="row gy-4">
                                    <div class="alert alert-info" role="alert">
                                        Vous demandez en tant qu'un Particulier.
                                    </div><input type="text" name="particulier" value="particulier" style="display: none;">
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
                                            <option value="cote_divoire">France</option>
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
                                            <option value="cote_divoire">France</option>
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
                    <h3>Neque exercitationem debitis soluta quos debitis quo mollitia officia est</h3>
                    <div class="container mt-4">
                        <h3>Envois de colis</h3>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('storeExpedition') }}">
                            @csrf
                            <br>
                            <div class="card" style="display: none;">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <input type="hiden" name="expediteur_id" class="form-control" value="{{ Auth::user()->code_unique}}">
                                        <div class="col-md-6">
                                            <input type="text" name="nom_expediteur" class="form-control" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="tel" id="telephone_client" name="numero_expediteur" class="form-control" value="{{ Auth::user()->numero}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" id="email_client" name="email" class="form-control" value="{{ Auth::user()->email}}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" id="adresse_client" name="adresse_expediteur" class="form-control" value="{{ Auth::user()->adresse}}">
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
                                            <input type="text" name="nom_destinataire" class="form-control" id="floatingInputGrid" placeholder="Nom du destinataire" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="telephone_client" class="form-label">Téléphone</label>
                                            <input type="text" id="telephone_client" name="numero_destinataire" class="form-control" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email_client" name="emai_destin" class="form-label">Email</label>
                                            <input type="email" id="email_client" name="email_destinataire" class="form-control" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="adresse_client" name="adresse" class="form-label">Adresse</label>
                                            <input type="text" id="adresse_client" name="adresse_destinataire" class="form-control">

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
                                            <label for="nom_client" class="form-label">Code de suivi</label>
                                            <input type="text" id="nom_client" name="numeroSuivi" value="{{$code_suivi}}" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="prenom_client" class="form-label">Desigation</label>
                                            <input type="text" id="prenom_client" name="designation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="telephone_client" class="form-label">N° CONTENEUR</label>
                                            <input type="text" id="telephone_client" name="numeroConteneur" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email_client" class="form-label">Remarque</label>
                                            <input type="text" id="email_client" name="typeService" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="telephone_client" class="form-label">Date-Enlevement</label>
                                            <input type="datetime-local" id="telephone_client" name="dateEnlev" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="telephone_client" class="form-label">Date-Livraison</label>
                                            <input type="datetime-local" id="telephone_client" name="dateLivr" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="montant_total">Montant Total</label>
                                            <input type="number" step="0.01" name="montant_total" id="montant_total" value="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="montant_paye">Montant Payé</label>
                                            <input type="number" step="0.01" name="montant_paye" id="montant_paye" value="0">
                                        </div>
                                        <div class="col-md-6">
                                            <br><label for="statut" class="form-label">STATUS D'EXP.</label>
                                            <select name="status" id="status">
                                                <option value="encour" {{ old('status') == 'encour' ? 'selected' : '' }}>Encours</option>
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
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Tab Content  colis evois -->
            <div class="tab-pane fade" id="features-tab-3">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">

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
                            <form method="POST" action="{{route('DemandDevis')}}" data-aos="fade-up" data-aos-delay="500">
                                @csrf
                                <div class="row gy-4">
                                    <div class="alert alert-warning" role="alert">
                                        <center> Veuillez noté le nombre de Rdv est Limité à 30/Jr.<br>
                                            Rvd restant: <mark>25</mark></center>
                                    </div>
                                    <div>
                                        <label for="nom">Nom et prénom :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required placeholder="Votre Nom Ou Nom complet du preneur">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">N° Telephpone</label>
                                        <input type="text" class="form-control" name="villeArrivee" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Numero Suivie</label>
                                        <input type="text" class="form-control" name="villeArrivee" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Date du retrait</label>
                                        <input type="date" class="form-control" name="villeArrivee" placeholder="Précisez la Ville" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Heure souhaitée (plage horaire):</label>
                                        <select class="form-select form-select-sm" name="paysArrivee">
                                            <option selected>Sélectionnez une plage</option>
                                            <option value="matin">Matin (9h-12h)</option>
                                            <option value="apres-midi">Après-midi (14h-17h)</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="designation" rows="4" placeholder="Details de votre colis" required=""></textarea>
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
            <!-- End Tab Content Item -->

            <div class="tab-pane fade" id="features-tab-4">
                <div class="row">
                    <div class="table-data">
                        <div style="overflow-x: auto;">
                            <table class="table table-striped" id="expeditionsTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="color:black;text-align:center;">STATUS</th>
                                        <th style="color:black">CREDITS</th>
                                        <th>DATE-Enlevements</th>
                                        <th>Num° CONTENEURS</th>
                                        <th>Num° SUIVIS</th>
                                        <th>EXPEDITEURS</th>
                                        <th>ADRESSE-Expedit.</th>
                                        <th>DESIGNATIONS-Colis</th>
                                        <th>DATE-LIVRAISON</th>
                                        <th>REMARQUE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($devis_colis as $devis_colis)
                                    <tr>
                                        <td>
                                            <a href="editExpedition/{{$devis_colis->id}}" class="btn btn-outline-danger" style="color: orangered;width: 40px; padding:5px;"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            @if ($devis_colis->status === 'encour')
                                            @if (Auth::user()->code_unique == $devis_colis->expediteur_id)
                                            <div class="dropdown">
                                                <a class="btn btn-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $devis_colis->status}}
                                                </a>
                                            </div>
                                            @else
                                            <form method="POST" action="{{ route('update.status', $devis_colis->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="dropdown">
                                                    <a class="btn btn-warning dropdowntoggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ $devis_colis->status }}
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ route('update.status', $devis_colis->id) }}" onclick="updateStatus('{{ $devis_colis->id }}', 'encour')">ENCOUR</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('update.status', $devis_colis->id) }}" onclick="updateStatus('{{ $devis_colis->id }}', 'depot')">STOCK</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('update.status', $devis_colis->id) }}" onclick="updateStatus('{{ $devis_colis->id }}', 'terminer')">TERMINER</a></li>
                                                    </ul>
                                                </div>
                                                <input type="hidden" name="status" id="statusInput">
                                            </form>
                                            @endif
                                            @elseif ($devis_colis->status === 'Non Livré' )
                                            @if (Auth::user()->code_unique == $devis_colis->expediteur_id)
                                            <div class="dropdown">
                                                <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $devis_colis->status}}
                                                </a>
                                            </div>
                                            @else
                                            <form method="POST" action="{{ route('update.status', $devis_colis->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="dropdown">
                                                    <a class="btn btn-secondary dropdowntoggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ $devis_colis->status }}
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $devis_colis->id }}', 'encour')">ENCOUR</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $devis_colis->id }}', 'depot')">STOCK</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $devis_colis->id }}', 'terminer')">Livré</a></li>
                                                    </ul>
                                                </div>
                                                <input type="hidden" name="status" id="statusInput">
                                            </form>
                                            @endif
                                            @elseif ($devis_colis->status === 'Livré')
                                            <a class="btn btn-success" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $devis_colis->status}}
                                            </a>
                                            @endif

                                        </td>
                                        <td>{{ $devis_colis->montant_total - $devis_colis->montant_paye }}</td>
                                        <td>{{ $devis_colis->dateEnlev }}</td>
                                        <td>{{ $devis_colis->numeroConteneur}}</td>
                                        <td>{{ $devis_colis->nom_expediteur}}</td>
                                        <td>{{ $devis_colis->adresse_expediteur}}</td>
                                        <td>{{ $devis_colis->designation }}</td>
                                        <td>{{ $devis_colis->numeroSuivi}}</td>
                                        <td>{{ $devis_colis->nom_destinataire}}</td>
                                        <td>{{ $devis_colis->adresse_expediteur}}</td>
                                        <td>{{ $devis_colis->dateLivr}}</td>
                                        <td>{{ $devis_colis->typeService}}</td>
                                        <td>
                                            <a href="{{ route('expeditions.delete', $devis_colis->id) }}" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expédition ?')"><i class="fas fa-trash-alt"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
</script>
@endsection