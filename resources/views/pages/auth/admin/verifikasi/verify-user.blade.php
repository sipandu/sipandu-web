@extends('layouts/admin/admin-layout')

@section('title', 'Verifikasi Anggota')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Verif Anggota Posyandu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verifikasi Anggota</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Anggota</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="nav flex-column nav-pills card-body p-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item d-grid">
                                        <button class="nav-link btn btn-info active text-left" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-female nav-icon"></i> Ibu Hamil
                                            @if ($ibu->count() > 0)
                                                <span class="badge bg-warning float-right">{{ $ibu->count() }}</span>
                                            @endif
                                        </button>
                                    </li>
                                    <li class="nav-item d-grid">
                                        <button class="nav-link text-left btn btn-success" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-child nav-icon"></i> Anak
                                            @if ($anak->count() > 0)
                                                <span class="badge bg-warning float-right">{{ $anak->count() }}</span>
                                            @endif
                                        </button>
                                    </li>
                                    <li class="nav-item d-grid">
                                        <button class="nav-link text-left btn btn-primary" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                            <i class="fas fa-wheelchair nav-icon"></i> Lanjut Usia
                                            @if ($lansia->count() > 0)
                                                <span class="badge bg-warning float-right">{{ $lansia->count() }}</span>
                                            @endif
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                            <div class="card-header my-auto">
                                <h3 class="card-title my-auto">Permintaan Verifikasi</h3>
                            </div>
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="card-body p-0">
                                    @if ($ibu->count() > 0)
                                        <div class="table-responsive mailbox-messages p-2">
                                            <table id="tbBumil" class="table table-bordered table-hover">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Bumil</th>
                                                        <th class="d-none d-md-table-cell">Nama Suami</th>
                                                        <th class="d-none d-md-table-cell">Mendaftar Pada</th>
                                                        <th class="d-md-none">Tindakan</th>
                                                        <th class="d-none d-md-table-cell">Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ibu as $data)
                                                    <tr class="text-center align-middle my-auto">
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $data->nama_ibu_hamil }}</td>
                                                        <td class="align-middle d-none d-md-table-cell">{{ $data->nama_suami }}</td>
                                                        <td class="align-middle d-none d-md-table-cell">{{ date('d-M-Y', strtotime($data->created_at)) }}</td>
                                                        <td class="text-center align-middle d-md-none">
                                                            <a href="{{ route('detail.verify.ibu', [$data->user->id]) }}" class="btn btn-warning btn-sm">
                                                                <i class="far fa-check-square"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center align-middle d-none d-md-table-cell">
                                                            <a href="{{ route('detail.verify.ibu', [$data->user->id]) }}" class="btn btn-warning btn-sm">
                                                                <i class="far fa-check-square"></i>
                                                                Konfirm
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Akun Anak untuk Diverifikasi</p>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="card-body p-0">
                                    @if ($anak->count() > 0)
                                        <div class="table-responsive mailbox-messages p-2">
                                            <table id="tbAnak" class="table table-bordered table-hover">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Anak</th>
                                                        <th class="d-none d-md-table-cell">Nama Ibu</th>
                                                        <th class="d-none d-md-table-cell">Mendaftar Pada</th>
                                                        <th class="d-md-none">Tindakan</th>
                                                        <th class="d-none d-md-table-cell">Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($anak as $data)
                                                    <tr class="text-center align-middle my-auto">
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $data->nama_anak }}</td>
                                                        <td class="align-middle d-none d-md-table-cell">{{ $data->nama_ibu }}</td>
                                                        <td class="align-middle d-none d-md-table-cell">{{ date('d-M-Y', strtotime($data->created_at)) }}</td>
                                                        <td class="text-center align-middle d-md-none">
                                                            <a href="{{ route('detail.verify.anak', [$data->user->id]) }}" class="btn btn-warning btn-sm">
                                                                <i class="far fa-check-square"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center align-middle d-none d-md-table-cell">
                                                            <a href="{{ route('detail.verify.anak', [$data->user->id]) }}" class="btn btn-warning btn-sm">
                                                                <i class="far fa-check-square"></i>
                                                                Konfirm
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Akun Anak untuk Diverifikasi</p>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div class="card-body p-0">
                                    @if ($lansia->count() > 0)
                                        <div class="table-responsive mailbox-messages p-2">
                                            <table id="tbLansia" class="table table-bordered table-hover">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Lansia</th>
                                                        <th class="d-none d-md-table-cell">Kategori</th>
                                                        <th class="d-none d-md-table-cell">Mendaftar Pada</th>
                                                        <th class="d-md-none">Tindakan</th>
                                                        <th class="d-none d-md-table-cell">Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ibu as $data)
                                                    <tr class="text-center align-middle my-auto">
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $data->nama_lansia }}</td>
                                                        <td class="align-middle d-none d-md-table-cell">{{ $data->status }}</td>
                                                        <td class="align-middle d-none d-md-table-cell">{{ date('d-M-Y', strtotime($data->created_at)) }}</td>
                                                        <td class="text-center align-middle d-md-none">
                                                            <a href="{{ route('detail.verify.lansia', [$data->user->id]) }}" class="btn btn-warning btn-sm">
                                                                <i class="far fa-check-square"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center align-middle d-none d-md-table-cell">
                                                            <a href="{{ route('detail.verify.lansia', [$data->user->id]) }}" class="btn btn-warning btn-sm">
                                                                <i class="far fa-check-square"></i>
                                                                Konfirm
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Akun Lansia untuk Diverifikasi</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ url('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-management-account').addClass('menu-is-opening menu-open');
            $('#management-account').addClass('active');
            $('#verify-user').addClass('active');
        });

        $(function () {
            $("#tbBumil").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Akun Ibu Hamil untuk Diverifikasi",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tbAnak").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Akun Anak untuk Diverifikasi",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tbLansia").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Akun Lansia untuk Diverifikasi",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
