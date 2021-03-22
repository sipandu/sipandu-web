@extends('layouts/admin/admin-layout')

@section('title', 'Rincian Verifikasi')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Rincian Verifikasi</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('show.verify') }}">Verifikasi Lansia</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rincian Verifikasi</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header">
                        Verifikasi Lansia
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <img src="https://images.unsplash.com/photo-1613244470504-4d0a17ce71d0?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8aWQlMjBjYXJkfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-bottom" alt="...">
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="namaLansia" value="Nama Lansianya" disabled>
                                            <label for="namaLansia">Nama Lansia</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="emailLansia" value="Email Lansia jika ada" disabled>
                                            <label for="emailLansia">Alamat E-Mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="noKK" value="No KK dari lansia" disabled>
                                            <label for="noKK">Nomor KK</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="lokasiPosyandu" value="Dipilih berdasarkan banjar" disabled>
                                            <label for="lokasiPosyandu">Lokasi Posyandu</label>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="kabupaten" value="Badung" disabled>
                                            <label for="kabupaten">Kabupaten/Kota</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="kecamatan" value="Mengwi" disabled>
                                            <label for="kecamatan">Kecamatan</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="desa" value="Sempidi" disabled>
                                            <label for="desa">Desa/Kelurahan</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="banjar" value="Pande" disabled>
                                            <label for="banjar">Banjar</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukan keterangan tambahan">
                                            <label for="keterangan">Keterangan Tambahan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-start">
                                        <a href="#" class="btn btn-primary">Kembali</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-danger btn-sm">Setujui</button>
                                        <button class="btn btn-success btn-sm">Tolak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        12-Mar-2021
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
            $('#list-data-user-verify').addClass('menu-open');
            $('#list-admin-account').addClass('menu-open');
            $('#verify-user').addClass('active');
        });

        $(function () {
            $("#tbBumil").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data....",
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
                    "sSearchPlaceholder": "Cari data....",
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
                    "sSearchPlaceholder": "Cari data....",
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
