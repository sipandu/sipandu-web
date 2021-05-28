@extends('layouts/admin/admin-layout')

@section('title', 'Data Kesehatan')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Kesehatan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Smart Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kehatan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-bumil-tab" data-bs-toggle="tab" data-bs-target="#nav-bumil" type="button" role="tab" aria-controls="nav-bumil" aria-selected="true">Ibu Hamil</button>
                        <button class="nav-link" id="nav-anak-tab" data-bs-toggle="tab" data-bs-target="#nav-anak" type="button" role="tab" aria-controls="nav-anak" aria-selected="true">Anak</button>
                        <button class="nav-link" id="nav-lansia-tab" data-bs-toggle="tab" data-bs-target="#nav-lansia" type="button" role="tab" aria-controls="nav-lansia" aria-selected="true">Lansia</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-bumil" role="tabpanel" aria-labelledby="nav-bumil-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 my-auto">
                                        <h3 class="card-title my-auto">Anggota Ibu Hamil</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive-md">
                                @if ($ibu->count() > 0)
                                    <table id="tbIbu" class="table table-bordered table-hover">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Bumil</th>
                                                <th class="d-none d-md-table-cell">Nama Suami</th>
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
                                                    <td class="text-center align-middle d-md-none">
                                                        <a href="{{route('Data Kesehatan Ibu', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle d-none d-md-table-cell">
                                                        <a href="{{route('Data Kesehatan Ibu', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Data Lansia</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-anak" role="tabpanel" aria-labelledby="nav-anak-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 my-auto">
                                        <h3 class="card-title my-auto">Anggota Anak</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive-md">
                                @if ($anak->count() > 0)
                                    <table id="tbAnak" class="table table-bordered table-hover">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anak</th>
                                                <th class="d-none d-md-table-cell">Nama Ibu</th>
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
                                                    <td class="text-center align-middle d-md-none">
                                                        <a href="{{route('Data Kesehatan Anak', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle d-none d-md-table-cell">
                                                        <a href="{{route('Data Kesehatan Anak', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Data Anak</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-lansia" role="tabpanel" aria-labelledby="nav-lansia-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 my-auto">
                                        <h3 class="card-title my-auto">Anggota Lansia</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive-md">
                                @if ($lansia->count() > 0)
                                    <table id="tbLansia" class="table table-bordered table-hover">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lansia</th>
                                                <th class="d-none d-md-table-cell">Kategori</th>
                                                <th class="d-md-none">Tindakan</th>
                                                <th class="d-none d-md-table-cell">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lansia as $data)
                                                <tr class="text-center align-middle my-auto">
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $data->nama_lansia }}</td>
                                                    <td class="align-middle d-none d-md-table-cell">{{ $data->status }}</td>
                                                    <td class="text-center align-middle d-md-none">
                                                        <a href="{{route('Data Kesehatan Lansia', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle d-none d-md-table-cell">
                                                        <a href="{{route('Data Kesehatan Lansia', [$data->id])}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Data Lansia</p>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#data-kesehatan-keluarga').addClass('active');
        });

        $(function () {
            $("#tbIbu").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Anggota Ibu Hamil",
                    "sSearchPlaceholder": "Cari ibu hamil....",
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

        $(function () {
            $("#tbAnak").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Anggota Anak",
                    "sSearchPlaceholder": "Cari anak....",
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

        $(function () {
            $("#tbLansia").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Anggota Lansia",
                    "sSearchPlaceholder": "Cari lansia....",
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
