<header id="header" class="header d-flex align-items-center fixed-top" style="background-color:hsl(189, 48.70%, 92.40%);">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto">
      <img src="{{ asset('Clients/assets/img/Logonew.png')}}" data-aos="fade-in">

    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('/')}}">Accueil</a></li>
        <li class="nav-item">
          <a class="nav-link me-lg-3" href="{{url('/SuiviPage')}}"> Suivi</a>
        </li>
        <li class="dropdown"><a href="{{url('/Envois')}}"><span>Envoi</span></a></li>
        @guest
        <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('/login')}}">Mon espace</a></li>
        @else
        @if ($EnlevTraites > 0)
        <li class="nav-item dropdown no-arrow mx-1">
        <a href="{{ url('/compte#rendezvous') }}" id="rdv-notification-link">
              <button type="button" class="btn btn-outline-primary position-relative">
                  <i class="fas fa-bell fa-fw"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      {{ $EnlevTraites }}
                      <span class="visually-hidden">nouveaux rendez-vous</span>
                  </span>
              </button>
          </a>
      </li>
        @else
        <li class="nav-item dropdown no-arrow mx-1" style="color:bleu;">
        <a href="#"><i class="fas fa-bell fa-fw"></i></a>
        
        </li>
        @endif

        @if ($DevisTraites > 0)
        <li class="nav-item dropdown no-arrow mx-1">
            <a href="{{ url('/compte#factures') }}" id="fact-notification-link">
                <button type="button" class="btn btn-outline-primary position-relative">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $DevisTraites }}
                        <span class="visually-hidden">nouveaux devis</span>
                    </span>
                </button>
            </a>
        </li>
        @else
        <li class="nav-item dropdown no-arrow mx-1">
        <a href="#"><i class="fas fa-envelope fa-fw"></i></a>
        </li>
        @endif
        <li class="nav-item"> <a class="nav-link me-lg-3" href="{{url('/compte')}}">Mon compte</a></li>
        <li class="nav-item">
          <a class="nav-link me-lg-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
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