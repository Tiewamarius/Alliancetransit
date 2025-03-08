
@if(Auth::guard('admin')->check())

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background:#089ae5";>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin/dashboard')}}">
        <img src="../Admin/img/Logo-remoteBg.png" height="60px">
            <span>allianceTRANS</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    

    <!-- Nav Item - Utilities Collapse Menu -->
    <div class="sidebar-heading">
        TACHES
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-plane"></i>
            <span>MISSIONS</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">EQUIPES-RECEVEURS:</h6><a class="collapse-item"  style="background: #36e250;" href="{{url('admin/mission')}}">CREER ENVOI</a>
            </div>
        </div>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        EQUIPES
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>PARAMETRE</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PARAMETRES UTILES:</h6>
                <a class="collapse-item" href="#">AJOUT-CLIENTS</a>
                <a class="collapse-item" href="#">CREER EXPEDITEUR</a>
                <a class="collapse-item" href="#">CREER RDESTINAIRE</a>
                <a class="collapse-item" href="#">AJOUT-CONTENEUR</a>
                <a class="collapse-item" href="#">LISTE-CLIENTS</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/logo.jpg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> ---</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">---!</a>
    </div>

</ul>
@else

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background:#089ae5";>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin/login')}}">
        <img src="../Admin/img/Logo-remoteBg.png" height="50px">
            <span>HORS LIGNE</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



</ul>
@endauth
