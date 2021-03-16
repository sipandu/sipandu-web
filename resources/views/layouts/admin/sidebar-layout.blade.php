<aside class="main-sidebar sidebar-dark-primary elevation-2">

    {{-- Brand Logo Start --}}
    <a href="{{ route("Admin Home") }}" class="brand-link text-decoration-none">
        <img src="{{ asset('/images/sipandu-logo.png') }}" alt="the praktikum Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light fw-bold">SIPANDU</span>
    </a>
    {{-- Brand Logo End --}}

    <!-- Sidebar Menu Start -->
    <div class="sidebar">
        <nav class="mt-2 mb-5 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- Add icons to the links using the .nav-icon class with
                font-awesome or any other icon font library --}}
                <li class="nav-item" id="list-admin-account">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            {{Auth::guard('admin')->user()->pegawai->jabatan}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile.admin') }}" id="profile-admin" class="nav-link">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item" id="list-account">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Add Account
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ms-3">
                                @if (Auth::guard('admin')->user()->pegawai->jabatan == "super admin")
                                    <li class="nav-item">
                                        <a href="{{ route('Add Admin') }}" id="new-admin" class="nav-link">
                                            <i class="fas fa-user-shield nav-icon"></i>
                                            <p>Add Admin</p>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->pegawai->jabatan == "admin" || "super admin")
                                    <li class="nav-item">
                                        <a href="{{ route('Add Kader') }}" id="new-kader" class="nav-link">
                                            <i class="fas fa-user-tag nav-icon"></i>
                                            <p>Add Kader</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('Add User') }}" id="new-user" class="nav-link">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('logout.admin')}}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item menu-open" id="list-admin-dashboard">
                    <a href="{{ route("Admin Home") }}" id="admin-dashboard" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>Tambah Posyandu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Data Posyandu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kader Posyandu</p>
                    </a>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Kesehatan Keluarga
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="pages/examples/lockscreen.html" class="nav-link">
                                    <i class="fas fa-female nav-icon"></i>
                                    <p>Pemeriksaan Ibu Hamil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-baby nav-icon"></i>
                                    <p>Pemeriksaan Bayi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-child nav-icon"></i>
                                    <p>Pemeriksaan Balita</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-wheelchair nav-icon"></i>
                                    <p>Pemeriksaan Lansia</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-file-medical-alt nav-icon"></i>
                                    <p>Data Kesehatan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-syringe"></i>
                            <p>
                                Imunisasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="pages/examples/lockscreen.html" class="nav-link">
                                    <i class="fas fa-crutch nav-icon"></i>
                                    <p>Pemberian Imunisasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    {{-- <i class="fal fa-crutches"></i> --}}
                                    <i class="fas fa-vials nav-icon"></i>
                                    <p>Jenis Imunisasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-file-medical nav-icon"></i>
                                    <p>Data Imunisasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                            <p>
                                Vitamin
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="pages/examples/lockscreen.html" class="nav-link">
                                    <i class="fas fa-capsules nav-icon"></i>
                                    <p>Pemberian Vitamin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-pills nav-icon"></i>
                                    <p>Jenis Vitamin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-file-medical nav-icon"></i>
                                    <p>Data Vitamin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item" id="list-informasi">
                        <a href="#" id="admin-informasi" class="nav-link">
                            <i class="nav-icon fas fa-info"></i>
                            <p>
                                Informasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="{{ route("informasi-penting.home") }}" id="informasi-penting" class="nav-link">
                                    <i class="fas fa-exclamation nav-icon"></i>
                                    <p>Informasi Penting</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/lockscreen.html" class="nav-link">
                                    <i class="fas fa-bullhorn nav-icon"></i>
                                    <p>Pengumuman</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                    <p>Penyuluhan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("sig-posyandu.home")}}" id="sig-posyandu" class="nav-link">
                                    <i class="fas fa-map-marked-alt nav-icon"></i>
                                    <p>Persebaran Posyandu</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-hospital-alt"></i>
                        <p>Tambah Kegiatan</p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Kegiatan</p>
                    </a>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="pages/examples/lockscreen.html" class="nav-link">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Laporan Kegiatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/lockscreen.html" class="nav-link">
                                    <i class="fas fa-clipboard-check nav-icon"></i>
                                    <p>Laporan Bulanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-clipboard-check nav-icon"></i>
                                    <p>Laporan Tahunan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="far fa-chart-bar nav-icon"></i>
                                    <p>Grafik Kesehatan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Tentang</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    {{-- Sidebar Menu End --}}

</aside>
