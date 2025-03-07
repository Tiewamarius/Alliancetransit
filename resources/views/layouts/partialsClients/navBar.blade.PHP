<header id="header" class="header d-flex align-items-center fixed-top" style="background-color: white;">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <img src="clients/assets/img/Logo.jpg" alt="" data-aos="fade-in">
        <h5 style="color:#1797ff;">Alliance</br>Transit</h5>
      </a>

      <nav id="navmenu" class="navmenu">
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
            <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('layouts/SuiviPage')}}"><i class="bi bi-geo-alt"></i> Suivi</a></li>
            <li class="nav-item"><a class="nav-link me-lg-3" href="#features"><i class="bi bi-person-lines-fill"></i> Particulier</a></li>
            <li class="nav-item"><a class="nav-link me-lg-3" href="#features"><i class="bi bi-building"></i> Business</a></li>
            <li class="nav-item"><a class="nav-link me-lg-3" href="#download"> <img src="{{ asset('Admin/img/android-IOSpng.png') }}" alt="Android Logo" width="32" height="32">Download</a></li>
          </ul>


        </div>
        <ul>
          <li class="nav-item">
            <a class="nav-link me-lg-3" href="{{url('layouts/SuiviPage')}}"> Suivi</a>
          </li>
          
          
          <li class="dropdown"><a href="#"><span>Envoyer</span></a>
            <ul>
              <li>
                <a href=" "> Particulier</a>
              </li>
              
              <li>
                <a href=" ">Business</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link me-lg-3" href="https://play.google.com/store"> <img src="{{ asset('Admin/img/android-IOSpng.png') }}" alt="Android Logo" width="32" height="32">Download</a>
          </li>
          <li class="dropdown"><a href="#"><span>Contactez-Nous</span><i class="bi-chat-text-fill me-2"></i></a>
            <ul>
              <li>
                <a href="https://wa.me/01649504"><i style="color:green;" class="bi bi-whatsapp"></i></a>
              </li>
              <li>
                <a href="mailto:tiewamaruis@gmail.com"><i style="color:red;" class="bi bi-envelope"></i></a>
              </li>
              <li>
                <a href="sms:01649504?body=Bonjour%20!%20Comment%20Vous allez%20?"><i style="color:blue;" class="bi bi-chat-text-fill"></i></a>
              </li>
            </ul>
          </li>

          @guest
          <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('/login')}}"><i class="bi bi-person"></i> Mon espace</a></li>
          @else
          <li class="nav-item">
            <a class="nav-link me-lg-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Déconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          @endguest
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>