@extends('layouts/admin/admin-layout')

@section('title', 'Data Posyandu')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Posyandu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 col-sm-6 my-auto">
                                <h3 class="card-title my-auto">Daftar Seluruh Posyandu</h3>
                            </div>
                            <div class="col-6 col-sm-6 text-end">
                                <a href="{{ route("Add Posyandu") }}" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive-md">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Posyandu</th>
                                    <th class="d-none d-sm-table-cell">Lokasi Banjar</th>
                                    <th class="d-none d-md-table-cell">Administrator</th>
                                    <th class="d-md-none">Tindakan</th>
                                    <th class="d-none d-md-table-cell">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posyandu as $data)
                                    <tr class="text-center align-middle">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $data->nama_posyandu}}</td>
                                        <td class="align-middle d-none d-sm-table-cell">{{ $data->banjar }}</td>
                                        <td class="align-middle d-none d-md-table-cell">
                                            @foreach ($pegawai->where('id_posyandu', $data->id) as $pgw)
                                                <ul class="list-unstyled">
                                                    <li> {{ $pgw->nama_pegawai }}</li>
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td class="text-center align-middle d-md-none">
                                            <a href="{{route('Detail Posyandu', [$data->id])}}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="text-center align-middle d-none d-md-table-cell">
                                            <a href="{{route('Detail Posyandu', [$data->id])}}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-eye"></i>
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Posyandu</th>
                                    <th class="d-none d-sm-table-cell">Lokasi Banjar</th>
                                    <th class="d-none d-md-table-cell">Administrator</th>
                                    <th class="d-md-none">Tindakan</th>
                                    <th class="d-none d-md-table-cell">Tindakan</th>
                                </tr>
                            </tfoot>
                        </table>
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
            $('#data-posyandu').addClass('active');
        });

        $(function () {
            $("#example1").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)"
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
                // "buttons": ["colvis"]
                // "buttons": ["excel", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
