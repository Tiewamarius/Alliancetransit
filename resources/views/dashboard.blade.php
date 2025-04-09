@extends('layouts.Client')
@section('content')
<section id="hero" class="hero section dark-background">

  <img src="clients/assets/img/Home.jpg" alt="" data-aos="fade-in">

  <div class="container d-flex flex-column align-items-center">
    <h2 data-aos="fade-up" data-aos-delay="100">ALLIANCE-TRANSIT</h2>
    <p data-aos="fade-up" data-aos-delay="200">Nous sommes une équipe commerciale </p>
    <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
      <a href="#about" class="btn-get-started">TRAITER AVEC NOUS</a>
      <a href="{{url('layouts/SuiviPage')}}" class="btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>SUIVI-COLIS</span></a>
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
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
        <div class="content ps-0 ps-lg-5">
          <p class="fst-italic">
            En tant qu'entreprise de logistique mondiale de premier rang, nous nous efforçons de rester à l'avant-garde du développement
            durable dans le secteur de la logistique
          </p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
          </ul>
          <p>
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
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
    <p>Répondre à ses besoins.</p>
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
              <h3>Email</h3>
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