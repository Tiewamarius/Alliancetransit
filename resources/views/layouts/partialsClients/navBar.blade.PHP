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
            <div class="dropdown-center">
                <button class="btn btn" style="background-color: #0793ff; color:azure;" dropdown-toggle type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi-chat-text-fill me-2"></i>Contactez-Nous
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i style="color:green;" class="bi bi-whatsapp"></i> WhatsApp</a></li>
                    <li><a class="dropdown-item" href="#"><i style="color:red;" class="bi bi-envelope"></i> Email</a></li>
                    <li><a class="dropdown-item" href="#"><i style="color:blue;"class="bi bi-chat-text-fill"></i> Sms</a></li>
                </ul>
            </div>
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