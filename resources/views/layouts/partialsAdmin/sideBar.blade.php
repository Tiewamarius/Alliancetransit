<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('admin/dashboard')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <img style="margin:18px" src="Admin/img/gat.png" width="80px"height="40" alt="">
    </div>
    <!--<div class="sidebar-brand-text mx-3">ALLIANCE<sup>Trans</sup></div>-->
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>LES EXPEDITIONS</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('admin/envoi')}}">Creer un encoi</a>
            <a class="collapse-item" href="#">Liste de tous les colis</a>
            <a class="collapse-item" href="#">Creer nouveau colis</a>
            <a class="collapse-item" href="#">Suivie de colis</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>GESTION D'ENTREPOT</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Liste de tous les colis</a>
            <a class="collapse-item" href="#">Creer nouveau colis</a>
            <a class="collapse-item" href="#">Suivie de colis</a>
            <div class="collapse-divider"></div>
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
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>Admin section</strong>Veuillez à noter que vous traitez des Données confidentiel!</p>
    <a class="btn btn-success btn-sm" href="#">Signaler un soucis!</a>
</div>

</ul>