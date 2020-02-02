<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">JD ADMIN</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('services.index') }}">
            <i class="fas fa-server"></i>
            <span>Services</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('testimonials.index') }}">
            <i class="fas fa-book"></i>
            <span>Testimonials</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('locations.index') }}">
            <i class="fas fa-location-arrow"></i>
            <span>Locations</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('sliders.index') }}">
            <i class="fas fa-image"></i>
            <span>Hero Slides</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Site
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('settings.index') }}">
            <i class="fas fa-info-circle"></i>
            <span>Info</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
