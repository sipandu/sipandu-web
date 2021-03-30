@extends('layouts/admin/admin-layout')

@section('title', 'Data Anggota Posyandu')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Anggota Posyandu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#tbIbu" data-toggle="tab">Ibu Hamil</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tbAnak" data-toggle="tab">Anak</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tbLansia" data-toggle="tab">Lansia</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="tbIbu">
                                @if ($ibu->count() > 0)
                                    <table id="dataIbu" class="table table-bordered table-hover table-responsive-sm">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anak</th>
                                                <th>Lokasi Posyandu</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ibu as $data)
                                                <tr class="text-center align-middle my-auto">
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $data->nama_ibu_hamil }}</td>
                                                    <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                                                    <td class="text-center align-middle d-md-none">
                                                        <a href="{{route('Detail Anggota Ibu', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle d-none d-md-block">
                                                        <a href="{{route('Detail Anggota Ibu', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anak</th>
                                                <th>Lokasi Posyandu</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center my-auto">Tidak Terdapat Anggota Posyandu Lanjut Usia</p>
                                @endif
                            </div>
                            <div class="tab-pane" id="tbAnak">
                                @if ($anak->count() > 0)
                                    <table id="dataAnak" class="table table-bordered table-hover table-responsive-sm">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anak</th>
                                                <th>Lokasi Posyandu</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($anak as $data)
                                                <tr class="text-center align-middle my-auto">
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $data->nama_anak }}</td>
                                                    <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                                                    <td class="text-center align-middle d-md-none">
                                                        <a href="{{route('Detail Anggota Anak', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle d-none d-md-block">
                                                        <a href="{{route('Detail Anggota Anak', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anak</th>
                                                <th>Lokasi Posyandu</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center my-auto">Tidak Terdapat Anggota Posyandu Bayi dan Balitas</p>
                                @endif
                            </div>
                            <div class="tab-pane" id="tbLansia">
                                @if ($lansia->count() > 0)
                                    <table id="dataLansia" class="table table-bordered table-hover table-responsive-sm">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lansia</th>
                                                <th>Jabatan</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lansia as $data)
                                                <tr class="text-center align-middle my-auto">
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $data->nama_lansia }}</td>
                                                    <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                                                    <td class="text-center align-middle d-md-none">
                                                        <a href="{{route('Detail Anggota Lansia', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle d-none d-md-block">
                                                        <a href="{{route('Detail Anggota Lansia', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lansia</th>
                                                <th>Jabatan</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <p class="text-center my-auto">Tidak Terdapat Anggota Posyandu Lanjut Usia</p>
                                @endif
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
            $('#list-management-posyandu').addClass('menu-is-opening menu-open');
            $('#management-posyandu').addClass('active');
            $('#data-anggota').addClass('active');
        });
        
        $(function () {
            $("#dataLansia").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data....",
                },
                "language": {
                    "buttons": {
                        "colvis": 'Tampilkan kolom',
                        // "excel": 'Unduh',
                    },
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(function () {
            $("#dataAnak").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data....",
                },
                "language": {
                    "buttons": {
                        "colvis": 'Tampilkan kolom',
                        // "excel": 'Unduh',
                    },
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(function () {
            $("#dataIbu").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data....",
                },
                "language": {
                    "buttons": {
                        "colvis": 'Tampilkan kolom',
                        // "excel": 'Unduh',
                    },
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
