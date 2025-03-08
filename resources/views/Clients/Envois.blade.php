@extends('layouts.Client')
@section('content')


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
                    <i class="bi bi-brightness-high"></i>
                    <h4 class="d-none d-lg-block">En savoir plus</h4>
                </a>
            </li>
            <li class="nav-item col-3">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
                    <i class="bi bi-command"></i>
                    <h4 class="d-none d-lg-block">Comment suivre colis</h4>
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
                            <button type="submit" class="btn btn-secondary btn-sm" id="btn-particulier">Personne privée</button>
                            <button type="submit" class="btn btn-secondary btn-sm" id="btn-professionnel">Professionnel</button>
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
                            <form method="POST"  action="{{route('DemandDevis')}}" data-aos="fade-up" data-aos-delay="500">
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


                        <div class="container" display: none; id="form-particulier">
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
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="../Clients/assets/img/jeune.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Tab Content Item -->

            <div class="tab-pane fade" id="features-tab-2">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                        <h3>Neque exercitationem debitis soluta quos debitis quo mollitia officia est</h3>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="../Clients/assets/img/jeune.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Tab Content Item -->

            <div class="tab-pane fade" id="features-tab-3">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                        <h3>Voluptatibus commodi ut accusamus ea repudiandae ut autem dolor ut assumenda</h3>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</span></li>
                        </ul>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="../Clients/assets/img/jeune.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Tab Content Item -->

            <div class="tab-pane fade" id="features-tab-4">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                        <h3>Omnis fugiat ea explicabo sunt dolorum asperiores sequi inventore rerum</h3>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum
                        </p>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="../Clients/assets/img/jeune.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Tab Content Item -->

        </div>

    </div>
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