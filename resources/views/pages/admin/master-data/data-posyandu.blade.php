@extends('layouts/admin/admin-layout')

@section('title', 'List Posyandu')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Management Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
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
                            <div class="col-sm-6">
                                <h3 class="card-title">Data Daftar Seluruh Posyandu Posyandu</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a href="{{ route("Add Posyandu") }}" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Posyandu</th>
                                    <th>Lokasi Banjar</th>
                                    <th>Administrator</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posyandu as $data)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_posyandu}}</td>
                                        <td>{{ $data->banjar }}</td>
                                        @foreach ($pegawai->where('id_posyandu', $data->id) as $pgw)
                                            <td>{{ $pgw->nama_pegawai }}</td>
                                        @endforeach
                                        <td class="text-center">
                                        {{-- <form action="{{route('Detail Posyandu', [$data->id])}}" method="POST">
                                            @csrf --}}
                                            <a href="{{route('Detail Posyandu', [$data->id])}}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                                 Detail
                                            </a>
                                        {{-- </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Posyandu</th>
                                    <th>Lokasi Banjar</th>
                                    <th>Administrator</th>
                                    <th>Action</th>
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
    <script src="{{ url('admin-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ url('admin-template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('admin-template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('admin-template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-data-posyandu').addClass('menu-open');
            $('#data-posyandu').addClass('active');
        });
        
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush