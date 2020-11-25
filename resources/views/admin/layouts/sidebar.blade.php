<!-- Sidebar -->

<ul class="navbar-nav bg-gradient-primary sidebar toggled sidebar-dark" id="accordionSidebar">

    <?php
        $url = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "/admin"));
        //remove the query string part
        if (strpos($url, "?") > 0) $url = substr($url, 0, strpos($url, "?"));

    ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon" style="margin-top: 15px;">
            <img src="{{asset(LOGO_IMAGE_PATH.setting('logo'))}}">
        </div>
        <div class="sidebar-brand-text mx-3">Trust Enterprise</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if (strpos($url, '/admin/dashboard')===0) active @endif">
        <a class="nav-link" href="{{url('admin/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Web CMS</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('getSlider')}}">Slider</a>
                <a class="collapse-item" href="{{route('getGallery')}}">Gallery</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @if (strpos($url, '/admin/sms')===0) active @endif">
        <a class="nav-link" href="{{url('admin/sms')}}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>SMS</span>
        </a>
    </li>

    <li class="nav-item @if (strpos($url, '/admin/leaflet')===0) active @endif">
        <a class="nav-link" href="{{url('/admin/leaflet')}}">
            <i class="fas fa-fw fa-paper-plane"></i>
            <span>Leaflet</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('getAbout')}}">About Us</a>
                <a class="collapse-item" href="{{route('getPeople')}}">People</a>
                <a class="collapse-item" href="{{route('getClient')}}">Client</a>
                <a class="collapse-item" href="{{route('getContact')}}">Contact</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item @if (strpos($url, '/admin/setting')===0) active @endif">
        <a class="nav-link" href="{{url('admin/setting')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    {{-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}

</ul>
<!-- End of Sidebar -->