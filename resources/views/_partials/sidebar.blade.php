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

    <li class="nav-item">
        <a class="nav-link" href="{{ route('videos.index') }}">
            <i class="fas fa-video"></i>
            <span>Videos</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('teams.index') }}">
            <i class="fas fa-users-cog"></i>
            <span>Team</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('blogs.index') }}">
            <i class="far fa-folder-open"></i>
            <span>Blog</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Site
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('specializes.index') }}">
            <i class="fas fa-user-graduate"></i>
            <span>Specialize</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact.index') }}">
            <i class="fas fa-phone"></i>
            <span>Contact</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('about.index') }}">
            <i class="fas fa-book-reader"></i>
            <span>About Us</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('settings.index') }}">
            <i class="fas fa-info-circle"></i>
            <span>Info</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('backup.index') }}">
            <i class="fas fa-clock"></i>
            <span>Backup</span></a>
    </li>


    <!-- Heading -->
    <div class="sidebar-heading">
        Pages
    </div>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.home') }}">
            <i class="fas fa-home"></i>
            <span>Home</span></a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
