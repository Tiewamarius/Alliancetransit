<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Alliance transit</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <link href="Clients/asset/img/favicon.png" rel="icon">
  <link href="Clients/asset/img/apple-touch-icon.png" rel="apple-touch-icon">

  
  <link rel="stylesheet" href="styleCompte.css">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('Clients/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('Clients/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('Clients/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('Clients/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('Clients/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('Clients/assets/css/main.css')}}" rel="stylesheet">
</head>

<body class="index-page">
@include('layouts.partialsClients.navBar')
<main class="main">

<!-- Hero Section -->

    @yield('content')



    <!-- Stats Section -->
<section id="stats" class="stats section light-background">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
            <p>Clients Satisfaits</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
            <p>Projets</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="bi bi-headset color-green flex-shrink-0"></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
            <p>Heures de support</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="bi bi-people color-pink flex-shrink-0"></i>
          <div>
            <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
            <p>Travailleurs acharnés</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

  </div>

</div>

</section><!-- /Stats Section -->
<section id="testimonials" class="testimonials section dark-background">

  <img src="Clients/assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="swiper init-swiper">
    <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 600,
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": "auto",
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        }
      }
    </script>
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="Clients/asset/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
          <h3>Anah Trah</h3>
          <!-- <h4>IT &amp; Developper</h4> -->
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>je recommande vivement ALLIANCE TRANSIT à tous ceux qui recherchent un service de transit de colis fiable, efficace et abordable. Leur engagement envers la satisfaction du client est tout simplement exceptionnel. Merci encore pour cette expérience de livraison sans faille ! », [Ville, France]</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div>
      <!-- End testimonial item -->
      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="Clients/assets/img/temoigna.jpg" class="testimonial-img" alt="">
          <h3>Turbo-D!ESEL</h3>
          <h4>IT &amp; Developper</h4>
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>J'ai récemment utilisé ALLIANCE TRANSIT pour expédier un colis important à l'étranger, et je suis absolument ravi du service que j'ai reçu. Du début à la fin, l'équipe a été professionnelle, courtoise et extrêmement compétente</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="Clients/asset/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
          <h3>Cheick</h3>
          <!-- <h4>IT &amp; Developper</h4> -->
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Ce qui m'a vraiment impressionné, c'est la transparence et la communication tout au long du processus. J'ai été tenu informé à chaque étape, et j'ai pu suivre mon colis en temps réel grâce à leur système de suivi en ligne. De plus, le colis est arrivé à destination plus tôt que prévu, et en parfait état !</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div>
      <!-- End testimonial item -->

      
      <div class="swiper-slide">
        <div class="testimonial-item">
          <img src="Clients/asset/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
          <h3>Turbo-D!ESEL</h3>
          <h4>IT &amp; Developper</h4>
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>J'ai récemment utilisé ALLIANCE TRANSIT pour expédier un colis important à l'étranger, et je suis absolument ravi du service que j'ai reçu. Du début à la fin, l'équipe a été professionnelle, courtoise et extrêmement compétente</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
        </div>
      </div>
      <!-- End testimonial item -->

      

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>

</section><!-- /Testimonials Section -->

@include('layouts.partialsClients.footer')
</main>
</body>

</html>