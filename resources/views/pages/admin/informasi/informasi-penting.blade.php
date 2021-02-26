@extends('layouts/admin/AdminLayout')
@section('title', 'Informasi Penting')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@section('sidebar')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
                1805551041
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-id-badge"></i>
                    <p>My Profile</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Add Account
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview ms-3">
                    <li class="nav-item">
                        <a href="pages/examples/lockscreen.html" class="nav-link">
                            <i class="fas fa-user-shield nav-icon"></i>
                            <p>Add Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                            <i class="fas fa-user-tag nav-icon"></i>
                            <p>Add Kader</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                            <i class="fas fa-user nav-icon"></i>
                            <p>Add User</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-item menu-open">
        <a href="{{ route("Admin Home") }}" class="nav-link active">
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
                {{-- <i class="fas fa-prescription-bottle-alt"></i> --}}
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
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-info"></i>
                <p>
                    Informasi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ms-3">
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
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
                    <a href="{{ url('/admin/informasi/persebaran-posyandu/home') }}" class="nav-link">
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
    {{-- <li class="nav-item">
        <a href="" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Report</p>
        </a>
    </li> --}}
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
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Informasi Penting</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item">Informasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi Penting</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Data Informasi Penting</h3>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="data" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Jenis Informasi</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Jenis Informasi</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{url('admin-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(function () {
            $('#data').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush