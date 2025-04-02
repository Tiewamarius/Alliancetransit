<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    @auth
    @if (Auth::guard('admin')->user()->role === 'admin')
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        @if ($devisNonTraites > 0)
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">{{$devisNonTraites}}</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    {{$devisNonTraites}} Devis non traité
                </h6>
                <p>
                    <a class="nav-link" href="{{url('admin/allDevis')}}" style="color:blue">
                        Consulter
                    </a>
                </p>
            </div>
        </li>
        @else
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter"></span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Pas de notification
                </h6>
            </div>
        </li>
            @endif
            <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger badge-counter"></span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
                Pas de Message
            </h6>
        </div>
        </li>
        @else
        @endauth

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="{{url('admin/dashboard')}}" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="../Admin/img/adminIcon.jpg">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href=" ">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Paramètre
                </a>
                @if(Auth::guard('admin')->check())
                <a class="dropdown-item" href="{{url('admin/dashboard')}}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Accès-Admin
                </a>
                @endif
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('destroy') }}">
                    @csrf
                    <a class="dropdown-item" href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Deconnexion') }}
                    </a>
                </form>
            </div>
        </li>
        @else
        <li class="nav-item">
            @if (request()->is('admin/register'))
            <a class="nav-link" href="{{ url('admin/login') }}">Connexion</a>
            @else
            <a class="nav-link" href="{{ url('admin/register') }}">Creer -Compte</a>
            @endif
        </li>
        @endauth
    </ul>
</nav>