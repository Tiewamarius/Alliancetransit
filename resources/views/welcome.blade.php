@extends('layouts.Client')
@section('content')
<section id="hero" class="hero section dark-background">

  <img src="clients/assets/img/Home.jpg" alt="" data-aos="fade-in">

  <div class="container d-flex flex-column align-items-center">
    <h2 data-aos="fade-up" data-aos-delay="100">ALLIANCE-TRANSIT</h2>
    <p data-aos="fade-up" data-aos-delay="200">Nous sommes une équipe commerciale </p>
    <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
      <a href="#about" class="btn-get-started">TRAITER AVEC NOUS</a>
      <a href="{{url('SuiviPage')}}" class="btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>SUIVI-COLIS</span></a>
    </div>
  </div>

</section><!-- /Hero Section -->

<!-- About Section -->
<section class="about section">

  <div class="container">

    <div class="row gy-4">
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <h3>Le travail le plus digne procure du plaisir, à moins que quelqu'un n'en tire profit.</h3>
        <img src="Clients/assets/img/OIP.jpeg" class="img-fluid rounded-4 mb-4" alt="">
        <p>

        </p>
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
        <div class="content ps-0 ps-lg-5">
          <p>
            Expedition de colis de Paris vers Abidjan et d'Abidjan vers Paris. AllianceTransit est une agence de transport aerien qui se dévoue entièrement à la satisfaction de ses clients. Aux fils des années AllianceTransit s'est spécialistée en transport aerien de colis, marchandises, plis et effet divers. AllianceTransit fait preuve d'un service méticuleux et scrupuleux dans l'unique but de répondre au mieu aux besoins de ses clients, ce qui lui donne son positionnement et sa réputation aujourd'hui.

            Livraison de toutes vos expéditions, quelque soit leurs spécificités à Paris et à Abidjan, AllianceTransit c'est des envois réguliers 2 à 3 fois par semaine afin de repopndre aux besoins chaque clients. Avec AllianceTransit, gagnez en performance : respect de nos engagements, intégrité des produits livrés.

            Économique et efficace, nos expedition express 48h, permet la livraison de plis et colis vers Abidjan et Depuis Abidjan vers les autres villes d'Europe. En 24-48 profitez d’un service sur mesure pour vos envois de colis express B to B ou B to C ainsi que de notre réseau de distribution express.
          </p>
        </div>
      </div>
    </div>

  </div>

</section><!-- /About Section -->



<!-- Contact Section -->
<section id="about" class="contact section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact</h2>
    <p>Répondre à vos besoins.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">
      <div class="col-lg-6 ">
        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>France</h3>
              <p>43 avenue du gros chêne 95220 Herblay</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Appelez-nous</h3>
              <p>+33 6 69 43 55 82</p>
              <p>+225 071887 3222</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p>secretariat@transit.com</p>
              <p>alliancetransit@gmail.com</p>
            </div>
          </div><!-- End Info Item -->

        </div>
      </div>

      <div class="col-lg-6">
        <form action="{{ route('contact.send') }}" method="post" class="email-form" data-aos="fade-up" data-aos-delay="500">
          @csrf
          <div class="row gy-4">

            <div class="col-md-6">
              <input type="text" name="name" class="form-control" placeholder="Votre Name" required="">
            </div>

            <div class="col-md-6 ">
              <input type="text" class="form-control" name="phone" placeholder="Votre Numero" required="">
            </div>

            <div class="col-md-6 ">
              <input type="email" class="form-control" name="email" placeholder="Votre Email" required="">
            </div>

            <div class="col-md-6">
              <input type="text" class="form-control" name="subject" placeholder="Objet" required="">
            </div>

            <div class="col-md-12">
              <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
            </div>
            <div style="display: none;">
            <label for="status" class="form-label">lu</label>
                <select name="status" id="status" class="form-control">
                    <option value="unread" {{ old('status') == 'unread' ? 'selected' : '' }}>unread</option>
                </select>
            </div>

            <div class="col-md-12 text-center">

              <button type="submit">Envoyer Message</button>
            </div>

          </div>
        </form>
        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div><!-- End Contact Form -->

    </div>

  </div>

</section><!-- /Contact Section -->


@endsection