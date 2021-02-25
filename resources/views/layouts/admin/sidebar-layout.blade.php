<aside class="main-sidebar sidebar-dark-primary elevation-2">

    {{-- Brand Logo Start --}}
    <a href="{{ route("Admin Home") }}" class="brand-link text-decoration-none">
        <img src="{{ asset('sipandu.png') }}" alt="the praktikum Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light fw-bold">SIPANDU</span>
    </a>
    {{-- Brand Logo End --}}

    <!-- Sidebar Menu Start -->
    <div class="sidebar">
        <nav class="mt-2 mb-5 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- Add icons to the links using the .nav-icon class with
                font-awesome or any other icon font library --}}
                @yield('sidebar')
            </ul>
        </nav>
    </div>
    {{-- Sidebar Menu End --}}

</aside>