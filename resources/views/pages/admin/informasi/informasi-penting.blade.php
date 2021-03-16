@extends('layouts/admin/admin-layout')
@section('title', 'Informasi Penting')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#informasi-penting').addClass('active');
        });
    </script>
@endpush