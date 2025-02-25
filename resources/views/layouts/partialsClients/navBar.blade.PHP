<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="{{url('layouts/SuiviPage')}}">
            <img src="../Admin/img/Logo.jpg" height="60px;" width="60px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('layouts/SuiviPage')}}">Suivi</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Particulier</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Business</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Download</a></li>
            </ul>
            <button style="background-color: #0793ff;" class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                <span class="d-flex align-items-center">
                    <i class="bi-chat-text-fill me-2"></i>
                    <span class="small">Contacter-Nous</span>
                </span>
            </button>
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                @guest
                    <li class="nav-item"><a class="nav-link me-lg-3" href="{{url('layouts/login')}}">Mon espace</a></li>
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
        </div>
    </div>
</nav>