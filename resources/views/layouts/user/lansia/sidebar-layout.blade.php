<aside class="main-sidebar sidebar-dark-primary elevation-2">

    {{-- Brand Logo Start --}}
    <a href="{{ route("lansia.home") }}" class="brand-link text-decoration-none">
        <img src="{{ asset('/images/sipandu-logo.png') }}" alt="Smart Posyandu 5.0 Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light fw-bold">Smart Posyandu 5.0</span>
    </a>
    {{-- Brand Logo End --}}

    <!-- Sidebar Menu Start -->
    <div class="sidebar">
        <nav class="mt-2 mb-5 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- Add icons to the links using the .nav-icon class with
                font-awesome or any other icon font library --}}
                <li class="nav-item" id="list-lansia-account">
                    <a href="#" class="nav-link" id="list-lansia-account-link">
                        <i class="nav-icon fas fa-wheelchair"></i>
                        <p>
                            Lansia
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('lansia.profile')}}" class="nav-link" id="profile-lansia">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Tambah Keluarga Lansia') }}" class="nav-link" id="tambah-keluarga">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Tambah Keluarga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{route('logout.user')}}" class="nav-link p-0 m-0">
                                @csrf
                                <button class="nav-link text-danger btn-block text-start">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Keluar</p>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a href="{{ route("lansia.home") }}" id="lansia-dashboard" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>Beranda</p>
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
                                    <p>Jadwal Posyandu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-history nav-icon"></i>
                                    <p>Riwayat Kegiatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-reply nav-icon"></i>
                                    <p>Pindah Posyandu</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item" id="list-riwayat-kesehatan">
                        <a href="#" class="nav-link" id="list-riwayat-kesehatan-link">
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
                                    <p>Kesehatan Pribadi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Keluarga Lansia') }}" class="nav-link" id="kesehatan-keluarga">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Kesehatan Keluarga</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                    <i class="fas fa-user-md nav-icon"></i>
                                    <p>Riwayat Konsultasi</p>
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
                <div class="dropdown-divider"></div>
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
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Tentang</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
