<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Rendi WEB <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('main-dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Category
    </div>

    <!-- Nav Item - Category -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('main-category') }}">
            <i class="fas fa-fw fa-server"></i>
            <span>Managamet Category</span></a>
    </li>
     <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Product
    </div>
    <!-- Nav Item - Category -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('products') }}">
            <i class="fas fa-fw fa-server"></i>
            <span>Managamet Product</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Order
    </div>
    <!-- Nav Item - Category -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>setting</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Profil Management
    </div>
    <!-- Nav Item - Category -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li> --}}
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
