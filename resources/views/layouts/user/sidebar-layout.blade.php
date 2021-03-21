<aside style="width: 280px" class="main-sidebar sidebar-dark-primary elevation-2">

    {{-- Brand Logo Start --}}
    <a href="#" class="brand-link text-decoration-none">
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            {{Auth::user()->email}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('profile.user')}}" class="nav-link">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form.add.anggota.keluarga') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Register Anggota Keluarga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout.user') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open" id="list-admin-dashboard">
                    <a href="#" id="admin-dashboard" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Detail Posyandu
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-calendar nav-icon"></i>
                                    <p>Daftar Jadwal Posyandu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-history nav-icon"></i>
                                    <p>Riwayat kegiatan posyandu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-reply nav-icon"></i>
                                    <p>Pengajuan Perpindahan </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Riwayat Kesehatan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-file-medical-alt nav-icon"></i>
                                    <p>Data Kesehatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Kesehatan Keluarga</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                {{-- @if (Auth::user()->anak->id_user != null) --}}
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
                                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                        <i class="fas fa-file-medical nav-icon"></i>
                                        <p>Daftar Imunisasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/lockscreen.html" class="nav-link">
                                        <i class="fas fa-crutch nav-icon"></i>
                                        <p>Jadwal Imunisasi</p>
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
                                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                        <i class="fas fa-file-medical nav-icon"></i>
                                        <p>Daftar Vitamin</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/lockscreen.html" class="nav-link">
                                        <i class="fas fa-capsules nav-icon"></i>
                                        <p>Jadwal Vitamin</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </li>
                {{-- @endif --}}

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>Informasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Penyuluhan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>Konsultasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>KMS</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    {{-- Sidebar Menu End --}}

</aside>
