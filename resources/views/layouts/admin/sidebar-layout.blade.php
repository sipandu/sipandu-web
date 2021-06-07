<aside class="main-sidebar sidebar-dark-primary elevation-2">

  {{-- Brand Logo Start --}}
    <a href="{{ route("Admin Home") }}" class="brand-link text-decoration-none">
      <img src="{{ asset('/images/sipandu-logo.png') }}" alt="Smart Posyandu 5.0 Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text fw-bold fs-6">Smart Posyandu 5.0</span>
    </a>
  {{-- Brand Logo End --}}

  <!-- Sidebar Menu Start -->
    <div class="sidebar">
      <nav class="mt-2 mb-5 pb-5">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item" id="list-admin-account">
            <a href="#" class="nav-link" id="list-admin-account-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                @if (Auth::guard('admin')->user()->role == 'super admin')
                  Super Admin
                @endif
                @if (Auth::guard('admin')->user()->role == 'tenaga kesehatan')
                  Nakes
                @endif
                @if (Auth::guard('admin')->user()->role == 'pegawai')
                  @if (Auth::guard('admin')->user()->pegawai->jabatan == 'head admin')
                    Head Admin
                  @endif
                  @if (Auth::guard('admin')->user()->pegawai->jabatan == 'admin')
                    Admin
                  @endif
                  @if (Auth::guard('admin')->user()->pegawai->jabatan == 'kader')
                    Kader
                  @endif
                @endif
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profile.admin') }}" id="profile-admin" class="nav-link">
                  <i class="nav-icon fas fa-id-badge"></i>
                  <p>Profile Pribadi</p>
                </a>
              </li>
              <li class="nav-item">
                <form action="{{route('logout.admin')}}" class="nav-link p-0 m-0">
                  @csrf
                  <button class="nav-link text-danger text-start btn-block">
                    <i class="nav-icon fas fa-power-off"></i>
                    <p>Logout</p>
                  </button>
                </form>
              </li>
            </ul>
          </li>
          <div class="dropdown-divider"></div>
          <li class="nav-item">
            <a href="{{ route("Admin Home") }}" id="admin-dashboard" class="nav-link">
              <i class="nav-icon fas fa-house-user"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if (auth()->guard('admin')->user()->role != 'pegawai')
            <li class="nav-item">
              <a href="{{ route("Data Posyandu") }}" id="data-posyandu" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>Data Posyandu</p>
              </a>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route("Detail Posyandu", auth()->guard('admin')->user()->pegawai->id_posyandu) }}" id="data-posyandu" class="nav-link">
                  <i class="nav-icon fas fa-hospital-user"></i>
                  <p>Profile Posyandu</p>
                </a>
              </li>
          @endif
          <li class="nav nav-treeview">
						<li class="nav-item" id="account-management">
							<a href="#" class="nav-link" id="account">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  Manajemen Akun
                  <i class="fas fa-angle-left right"></i>
                </p>
							</a>
							<ul class="nav nav-treeview ms-3">
								<li class="nav-item">
									<a href="{{ route("Data Super Admin") }}" class="nav-link" id="data-super-admin">
										<i class="nav-icon fas fa-user-cog"></i>
										<p>Data Super Admin</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="{{ route("Data Nakes") }}" class="nav-link" id="data-nakes">
										<i class="nav-icon fas fa-user-nurse"></i>
										<p>Data Nakes</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="{{ route("Data Admin") }}" class="nav-link" id="data-admin">
										<i class="nav-icon fas fa-user-lock"></i>
										<p>Data Admin</p>
									</a>
								</li>
								@if (auth()->guard('admin')->user()->role != 'super admin')
									<li class="nav-item">
										<a href="{{ route("Data Kader") }}" class="nav-link" id="data-kader">
											<i class="nav-icon fas fa-user-tag"></i>
											<p>Data Kader</p>
										</a>
									</li>
										<li class="nav-item">
											<a href="{{ route('Data Anggota') }}" class="nav-link" id="data-anggota">
												<i class="nav-icon fas fa-users"></i>
												<p>Anggota Posyandu</p>
											</a>
									</li>
									<li class="nav-item" id="list-data-user-verify">
										<a href="{{route('show.verify')}}" id="konfirmasi-anggota" class="nav-link">
											<i class="nav-icon fas fa-user-check"></i>
											<p>Konfirmasi Anggota</p>
										</a>
									</li>
								@else
									<li class="nav-item">
										<a href="{{ route('Ganti Jabatan') }}" id="ganti-jabatan" class="nav-link">
											<i class="nav-icon fas fa-people-arrows"></i>
											<p>Ganti Jabatan</p>
										</a>
									</li>
								@endif

								{{-- @if (Auth::guard('admin')->user()->role == 'super admin')
										<li class="nav-item">
												<a href="{{ route('Add Super Admin') }}" id="new-super-admin" class="nav-link">
														<i class="fas fa-user-cog nav-icon"></i>
														<p>Tambah Super Admin</p>
												</a>
										</li>
										<li class="nav-item">
												<a href="{{ route('Add Nakes') }}" id="new-kader" class="nav-link">
														<i class="fas fa-user-md nav-icon"></i>
														<p>Tambah Nakes</p>
												</a>
										</li>
										<li class="nav-item">
												<a href="{{ route('Add Admin') }}" id="new-admin" class="nav-link">
														<i class="fas fa-user-shield nav-icon"></i>
														<p>Tambah Pengurus</p>
												</a>
										</li>
										<li class="nav-item">
												<a href="{{ route('Ganti Jabatan') }}" id="change-role" class="nav-link">
														<i class="nav-icon fas fa-layer-group"></i>
														<p>Ganti Jabatan</p>
												</a>
										</li>
								@endif
								@if (Auth::guard('admin')->user()->role == 'pegawai')
										@if (auth()->guard('admin')->user()->pegawai->jabatan == 'head admin')
												<li class="nav-item">
														<a href="{{ route('Add Admin') }}" id="new-admin" class="nav-link">
																<i class="fas fa-user-shield nav-icon"></i>
																<p>Tambah Admin</p>
														</a>
												</li>
												<li class="nav-item">
														<a href="{{ route('Add Kader') }}" id="new-kader" class="nav-link">
																<i class="fas fa-user-tag nav-icon"></i>
																<p>Tambah Kader</p>
														</a>
												</li>
												<li class="nav-item">
														<a href="{{ route('Add User') }}" id="new-user" class="nav-link">
																<i class="fas fa-user nav-icon"></i>
																<p>Tambah Anggota</p>
														</a>
												</li>
										@endif
										@if (Auth::guard('admin')->user()->pegawai->jabatan == "admin")
												<li class="nav-item">
														<a href="{{ route('Add Kader') }}" id="new-kader" class="nav-link">
																<i class="fas fa-user-tag nav-icon"></i>
																<p>Tambah Kader</p>
														</a>
												</li>
												<li class="nav-item">
														<a href="{{ route('Add User') }}" id="new-user" class="nav-link">
																<i class="fas fa-user nav-icon"></i>
																<p>Tambah Anggota</p>
														</a>
												</li>
										@endif
										@if (auth()->guard('admin')->user()->pegawai->jabatan == "kader")
												<li class="nav-item">
														<a href="{{ route('Add Kader') }}" id="new-kader" class="nav-link">
																<i class="fas fa-user-tag nav-icon"></i>
																<p>Tambah Kader</p>
														</a>
												</li>
												<li class="nav-item">
														<a href="{{ route('Add User') }}" id="new-user" class="nav-link">
																<i class="fas fa-user nav-icon"></i>
																<p>Tambah Anggota</p>
														</a>
												</li>
										@endif
								@endif
								@if (Auth::guard('admin')->user()->role == 'tenaga kesehatan')
										<li class="nav-item">
												<a href="{{ route('Add User') }}" id="new-user" class="nav-link">
														<i class="fas fa-user nav-icon"></i>
														<p>Tambah Anggota</p>
												</a>
										</li>
								@endif
								@if (Auth::guard('admin')->user()->role != 'super admin')
											<li class="nav-item" id="list-data-user-verify">
													<a href="{{route('show.verify')}}" id="verify-user" class="nav-link">
															<i class="nav-icon fas fa-user-check"></i>
															<p>Konfirmasi Anggota</p>
													</a>
											</li>
								@endif --}}
							</ul>
						</li>
          </li>
          {{-- <li class="nav nav-treeview">
              <li class="nav-item" id="list-management-posyandu">
                  <a href="#" class="nav-link" id="management-posyandu">
                      <i class="nav-icon fas fa-hospital-user"></i>
                      <p>
                          Manajemen Posyandu
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview ms-3">
                      @if (Auth::guard('admin')->user()->role == 'super admin')
                          <li class="nav-item">
                              <a href="{{ route("Data Admin") }}" class="nav-link" id="data-admin">
                                  <i class="nav-icon fas fa-user-cog"></i>
                                  <p>Data Admin</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('Data Nakes') }}" class="nav-link" id="data-nakes">
                                  <i class="nav-icon fas fa-user-md"></i>
                                  <p>Data Nakes</p>
                              </a>
                          </li>
                      @endif
                      @if (Auth::guard('admin')->user()->role == 'pegawai')
                          @if (Auth::guard('admin')->user()->pegawai->jabatan == 'head admin' || Auth::guard('admin')->user()->pegawai->jabatan == 'admin')
                              <li class="nav-item">
                                  <a href="{{ route("Data Admin") }}" class="nav-link" id="data-admin">
                                      <i class="nav-icon fas fa-user-cog"></i>
                                      <p>Data Admin</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route("Profile Posyandu") }}" class="nav-link" id="profile-posyandu">
                                      <i class="nav-icon fas fa-clinic-medical"></i>
                                      <p>Profile Posyandu</p>
                                  </a>
                              </li>
                          @endif
                      @endif
                      @if (Auth::guard('admin')->user()->role != 'super admin')
                          <li class="nav-item">
                              <a href="{{ route('Data Anggota') }}" class="nav-link" id="data-anggota">
                                  <i class="nav-icon fas fa-user-friends"></i>
                                  <p>Anggota Posyandu</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('Data Kader') }}" class="nav-link" id="data-kader">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>Kader Posyandu</p>
                              </a>
                          </li>
                      @endif
                  </ul>
              </li>
          </li> --}}
          @if (Auth::guard('admin')->user()->role == 'tenaga kesehatan')
              <li class="nav nav-treeview">
                  <li class="nav-item" id="list-kesehatan">
                      <a href="#" class="nav-link" id="kesehatan">
                          <i class="nav-icon fas fa-hand-holding-medical"></i>
                          <p>
                              Kesehatan Keluarga
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview ms-3">
                          <li class="nav-item" >
                              <a href="{{ route('Tambah Pemeriksaan') }}" class="nav-link" id="pemeriksaan-keluarga">
                                  <i class="fas fa-stethoscope nav-icon"></i>
                                  <p>Pemeriksaan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('Data Kesehatan') }}" class="nav-link" id="data-kesehatan-keluarga">
                                  <i class="fas fa-file-medical-alt nav-icon"></i>
                                  <p>Data Kesehatan</p>
                              </a>
                          </li>
                          <li class="nav-item" >
                            <a href="{{ route("konsultasi-bot.home") }}" class="nav-link" id="konsultasi-bot">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>Konsultasi Bot</p>
                            </a>
                        </li>
                      </ul>
                  </li>
              </li>
          @endif
          <li class="nav nav-treeview">
              <li class="nav-item" id="list-imunisasi">
                  <a href="#" class="nav-link" id="imunisasi">
                      <i class="nav-icon fas fa-syringe"></i>
                      <p>
                          Imunisasi
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview ms-3">
                      @if (Auth::guard('admin')->user()->role == 'super admin')
                          <li class="nav-item">
                              <a href="{{ route('Tambah Imunisasi') }}" class="nav-link" id="tambah-imunisasi">
                                  <i class="fas fa-vials nav-icon"></i>
                                  <p>Tambah Imunisasi</p>
                              </a>
                          </li>
                      @endif
                      <li class="nav-item">
                          <a href="{{ route('Jenis Imunisasi') }}" class="nav-link" id="jenis-imunisasi">
                              <i class="fas fa-crutch nav-icon"></i>
                              <p>Jenis Imunisasi</p>
                          </a>
                      </li>
                  </ul>
              </li>
          </li>
          <li class="nav nav-treeview">
              <li class="nav-item" id="list-vitamin">
                  <a href="#" class="nav-link" id="vitamin">
                      <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                      <p>
                          Vitamin
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview ms-3">
                      @if (Auth::guard('admin')->user()->role == 'super admin')
                          <li class="nav-item">
                              <a href="{{ route('Tambah Vitamin') }}" class="nav-link" id="tambah-vitamin">
                                  <i class="fas fa-pills nav-icon"></i>
                                  <p>Tambah Vitamin</p>
                              </a>
                          </li>
                      @endif
                      <li class="nav-item">
                          <a href="{{ route('Jenis Vitamin') }}" class="nav-link" id="jenis-vitamin">
                              <i class="fas fa-capsules nav-icon"></i>
                              <p>Jenis Vitamin</p>
                          </a>
                      </li>
                  </ul>
              </li>
          </li>
          <li class="nav nav-treeview">
              <li class="nav-item" id="informasi">
                  <a href="#" class="nav-link" id="informasi-link">
                      <i class="nav-icon fas fa-info"></i>
                      <p>
                          Informasi
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview ms-3">
                      @if (Auth::guard('admin')->user()->role == 'super admin')
                          <li class="nav-item">
                              <a href="{{ route('informasi_penting.home') }}" class="nav-link" id="informasi-penting">
                                  <i class="fas fa-exclamation nav-icon"></i>
                                  <p>Informasi Penting</p>
                              </a>
                          </li>
                          @endif
                      @if (Auth::guard('admin')->user()->role == 'pegawai')
                          <li class="nav-item">
                              <a href="{{ route('penyuluhan.home') }}" class="nav-link" id="penyuluhan">
                                  <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                  <p>Penyuluhan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('pengumuman.home') }}" class="nav-link" id="pengumuman">
                                  <i class="fas fa-bullhorn nav-icon"></i>
                                  <p>Pengumuman</p>
                              </a>
                          </li>
                      @endif
                      <li class="nav-item">
                          <a href="{{ route("sig-posyandu.home")}}" id="sig-posyandu" class="nav-link">
                              <i class="fas fa-map-marked-alt nav-icon"></i>
                              <p>Persebaran Posyandu</p>
                          </a>
                      </li>
                  </ul>
              </li>
          </li>
          <li class="nav nav-treeview">
              <li class="nav-item" id="kegiatan-posyandu">
                  <a href="#" class="nav-link" id="kegiatan">
                      <i class="nav-icon fas fa-briefcase-medical"></i>
                      <p>
                          Kegiatan Posyandu
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview ms-3">
                          @if (Auth::guard('admin')->user()->role == 'pegawai')
                              <li class="nav-item">
                                  <a href="{{ url('/admin/kegiatan/home') }}" class="nav-link" id="tambah-kegiatan">
                                      <i class="nav-icon fas fa-notes-medical"></i>
                                      <p>Kegiatan</p>
                                  </a>
                              </li>
                          @endif
                          <li class="nav-item">
                              <a href="{{ route('riwayat_kegiatan.home') }}" class="nav-link" id="riwayat-kegiatan">
                                  <i class="nav-icon fas fa-history"></i>
                                  <p>Riwayat Kegiatan</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </li>
          <div class="dropdown-divider"></div>
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
                          <a href="/admin/laporan/kegiatan" class="nav-link">
                              <i class="fas fa-file-alt nav-icon"></i>
                              <p>Laporan Kegiatan</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="/admin/laporan/bulanan" class="nav-link">
                              <i class="fas fa-clipboard-check nav-icon"></i>
                              <p>Laporan Bulanan</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="/admin/laporan/tahunan" class="nav-link">
                              <i class="fas fa-clipboard-check nav-icon"></i>
                              <p>Laporan Tahunan</p>
                          </a>
                      </li>
                  </ul>
              </li>
          </li>
          @if (auth()->guard('admin')->user()->role == 'super admin')
            <li class="nav nav-treeview">
                <li class="nav-item" id="setting-bot">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-robot"></i>
                        <p>
                            Setting Bot
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-3">
                        <li class="nav-item">
                            <a href="{{ route('pertanyaan-konsultasi.home') }}" class="nav-link" id="pertanyaan-konsultasi">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Pertanyaan Konsultasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pertanyaan-satu-arah.home') }}" class="nav-link" id="pertanyaan-statis">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Pertanyaan Statis</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </li>
            @endif
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
