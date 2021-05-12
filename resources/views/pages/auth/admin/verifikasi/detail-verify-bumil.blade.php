@extends('layouts/admin/admin-layout')

@section('title', 'Rincian Verifikasi')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Rincian Verifikasi</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('show.verify') }}">Verifikasi Anggota Posyandu</a></li>
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
                        Verifikasi Ibu Hamil
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ route('verify.get_img', $ibu->id_kk ) }}" class="card-img-bottom" alt="File KK Ibu">
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="namaLansia" value="{{$ibu->kk->no_kk}}" disabled>
                                            <label for="namaLansia">No KK</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="namaLansia" value="{{$ibu->ibu->nama_ibu_hamil}}" disabled>
                                            <label for="namaLansia">Nama Ibu Hamil</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nikLansia" value="{{$ibu->ibu->posyandu->nama_posyandu}}" disabled>
                                            <label for="nikLansia">Lokasi Posyandu</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="noTelp" value="{{$ibu->ibu->posyandu->banjar}}" disabled>
                                            <label for="noTelp">Banjar</label>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{route('tolak.user')}}" class="mb-2">
                                        @csrf
                                        <div class="col-12 p-0 m-0">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan tambahan">
                                                <label for="keterangan">Keterangan Tambahan</label>
                                            </div>
                                            @error('keterangan  ')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            <input type="hidden" name="iduser" class="form-control" id="keterangan" value="{{$ibu->id}}">
                                        </div>
                                        <div class="col-12 text-start p-0 m-0">
                                            <button class="btn btn-block btn-outline-danger btn-sm">Tolak dengan alasan</button>
                                        </div>
                                    </form>
                                    <div class="row p-0 m-0">
                                        <div class="col-sm-12 col-md-6 text-start float-lg-left">
                                            <a href="{{route('show.verify')}}" class="btn btn-outline-primary btn-sm text-end">Kembali</a>
                                        </div>
                                        <div class="col-sm-12 col-md-6 my-auto">
                                            <form method="POST" action="{{route('terima.user')}}" class="p-0 m-0">
                                                @csrf
                                                <input type="hidden" name="iduser" class="form-control" id="keterangan" value="{{$ibu->id}}">
                                                <div class="text-end float-lg-right my-auto">
                                                    <button class="btn btn-outline-success btn-sm">Setujui</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{ date('d-M-Y', strtotime($ibu->created_at)) }}
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
