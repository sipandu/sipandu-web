@extends('layouts/admin/admin-layout')

@section('title', 'Jenis Vitamin')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Jenis Vitamin</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jenis Vitamin</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 col-sm-6 my-auto">
                                <h3 class="card-title my-auto">Data Vitamin</h3>
                            </div>
                            <div class="col-6 col-sm-6 text-end">
                                @if (auth()->guard('admin')->user()->role == "super admin")
                                    <a href="{{ route("Tambah Vitamin") }}" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Tambah
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive-md">
                        @if ($vitamin->count() > 0)
                            <table id="tbVitamin" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Vitamin</th>
                                        <th class="d-none d-md-table-cell">Kategori</th>
                                        <th>Penerima</th>
                                        <th class="d-md-none">Tindakan</th>
                                        <th class="d-none d-md-table-cell">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vitamin as $data)
                                        <tr class="text-center align-middle my-auto">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $data->nama_vitamin }}</td>
                                            <td class="align-middle d-none d-md-table-cell">{{ $data->status }}</td>
                                            <td class="align-middle">{{ $data->penerima }}</td>
                                            <td class="text-center align-middle d-md-none">
                                                <a href="{{route('Detail Vitamin', [$data->id])}}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                <a href="{{route('Detail Vitamin', [$data->id])}}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Data Imunisasi</p>
                        @endif
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
            $('#list-vitamin').addClass('menu-is-opening menu-open');
            $('#vitamin').addClass('active');
            $('#jenis-vitamin').addClass('active');
        });

        $(function () {
            $("#tbVitamin").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Vitamin",
                    "sSearchPlaceholder": "Cari Vitamin....",
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

