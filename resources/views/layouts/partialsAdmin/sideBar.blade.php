


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background:#089ae5";>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin/dashboard')}}">
            <img src="../Admin/img/Logo.png" height="100px" width="200px">
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
@auth
    @if (Auth::guard('admin')->user()->role === 'admin')
    <!-- Heading -->
    

    <!-- Nav Item - Utilities Collapse Menu -->
        <!-- Divider -->
    <div class="sidebar-heading">
        TACHES
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-plane"></i>
            <span>MISSIONS</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('admin/mission')}}">CREER UN ENVOI</a>
                <a class="collapse-item" href="#">DEVIS DEMANDER</a>
            </div>
        </div>
    </li>
    <div class="sidebar-heading">
        TACHES
    </div>
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
                <a class="collapse-item" href="{{url('admin/allRdv')}}">LISTE RDV</a>
            </div>
        </div>
    </li>
    
@else
<hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/logo.jpg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> </p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">---!</a>
    </div>

    @endif
@endauth
    <!-- Divider -->
    

</ul>
