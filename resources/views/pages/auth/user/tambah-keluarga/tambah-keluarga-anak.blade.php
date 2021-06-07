@extends('layouts/user/anak/user-layout')

@section('title', 'Tambah Keluarga Anak')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Daftarkan Anggota Keluarga</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Keluarga</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-bumil-tab" data-bs-toggle="tab" data-bs-target="#nav-bumil" type="button" role="tab" aria-controls="nav-bumil" aria-selected="true">Ibu Hamil</button>
                      <button class="nav-link" id="nav-anak-tab" data-bs-toggle="tab" data-bs-target="#nav-anak" type="button" role="tab" aria-controls="nav-anak" aria-selected="false">Anak</button>
                      <button class="nav-link" id="nav-lansia-tab" data-bs-toggle="tab" data-bs-target="#nav-lansia" type="button" role="tab" aria-controls="nav-lansia" aria-selected="false">Lansia</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-bumil" role="tabpanel" aria-labelledby="nav-bumil-tab">
                        <div class="card card-primary">
                            <div class="card-header my-auto">
                              <p class="card-title my-auto">Tambah Anggota Ibu Hamil Baru</p>
                            </div>
                            <div class="card-body p-3">
                                <form action="{{route('ibu.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nama Ibu<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_ibu" autocomplete="off" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}" placeholder="Masukan nama lengkap ibu">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('nama_ibu')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>E-Mail<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email_ibu" autocomplete="off" class="form-control @error('email_ibu') is-invalid @enderror" value="{{ old('email_ibu') }}" placeholder="Masukan E-Mail ibu">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                    @error('email_ibu')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Kata Sandi<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" name="passwordIbu" autocomplete="off" class="form-control @error('passwordIbu') is-invalid @enderror" value="{{ old('passwordIbu') }}" placeholder="Masukan kata sandi">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-key"></span>
                                                        </div>
                                                    </div>
                                                    @error('passwordIbu')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Konfirmasi Kata Sandi<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordIbu_confirmation" autocomplete="off" class="form-control @error('passwordIbu_confirmation') is-invalid @enderror" value="{{ old('passwordIbu_confirmation') }}" placeholder="Masukan kembali kata sandi">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-danger text-end">*Data Wajib Diisi</p>
                                        </div>
                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Daftarkan Akun</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-anak" role="tabpanel" aria-labelledby="nav-anak-tab">
                        <div class="card card-primary">
                            <div class="card-header my-auto">
                              <h3 class="card-title my-auto">Tambah Anggota Bayi dan Anak Baru</h3>
                            </div>
                            <form action="{{route('anak.store')}}" method="POST">
                                @csrf
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nama Anak<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_anak" autocomplete="off" class="form-control @error('nama_anak') is-invalid @enderror" value="{{ old('nama_anak') }}" placeholder="Masukan nama lengkap anak">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('nama_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>E-Mail<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email_anak" autocomplete="off" class="form-control @error('email_anak') is-invalid @enderror" value="{{ old('email_anak') }}" placeholder="Masukan E-Mail anak">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                    @error('email_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Kata Sandi<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" name="passwordAnak" autocomplete="off" class="form-control @error('passwordAnak') is-invalid @enderror" value="{{ old('passwordAnak') }}" placeholder="Masukan kata sandi">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-key"></span>
                                                        </div>
                                                    </div>
                                                    @error('passwordAnak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Konfirmasi Kata Sandi<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordAnak_confirmation" autocomplete="off" class="form-control @error('passwordAnak_confirmation') is-invalid @enderror" value="{{ old('passwordAnak_confirmation') }}" placeholder="Masukan kembali kata sandi">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('passwordAnak_confirmation')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-danger text-end">*Data Wajib Diisi</p>
                                        </div>
                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Daftarkan Akun</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-lansia" role="tabpanel" aria-labelledby="nav-lansia-tab">
                        <div class="card card-primary">
                            <div class="card-header my-auto">
                              <h3 class="card-title my-auto">Tambah Anggota Lansia Baru</h3>
                            </div>
                            <form action="{{route('lansia.store')}}" method="POST">
                                @csrf
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nama Lansia<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_lansia" autocomplete="off" class="form-control @error('nama_lansia') is-invalid @enderror" value="{{ old('nama_lansia') }}" placeholder="Masukan nama lengkap lansia">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('nama_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>E-Mail<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email_lansia" autocomplete="off" class="form-control @error('email_lansia') is-invalid @enderror" value="{{ old('email_lansia') }}" placeholder="Masukan E-Mail lansia">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                    @error('email_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Kata Sandi<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" name="passwordLansia" autocomplete="off" class="form-control @error('passwordLansia') is-invalid @enderror" value="{{ old('passwordLansia') }}" placeholder="Masukan kata sandi">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-key"></span>
                                                        </div>
                                                    </div>
                                                    @error('passwordLansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Konfirmasi Kata Sandi<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordLansia_confirmation" autocomplete="off" class="form-control @error('passwordLansia_confirmation') is-invalid @enderror" value="{{ old('passwordLansia_confirmation') }}" placeholder="Masukan kembali kata sandi">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('passwordLansia_confirmation')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-danger text-end">*Data Wajib Diisi</p>
                                        </div>
                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Daftarkan Akun</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
            $('#list-anak-account').addClass('menu-is-opening menu-open');
            $('#list-anak-account-link').addClass('active');
            $('#tambah-keluarga').addClass('active');
        });

        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
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
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(document).ready(function(){
            // Kabupaten AJAX //
            $('#kabupatenIbu').on('change', function () {
                let id = $(this).val();
                $('#kecamatanIbu').empty();
                $('#kecamatanIbu').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#kecamatanIbu').empty();
                        $('#kecamatanIbu').append(`<option value="0" disabled selected>Pilih Kecamatan....</option>`);
                        response.forEach(element => {
                            $('#kecamatanIbu').append(`<option value="${element['id']}">${element['nama_kecamatan']}</option>`);
                        });
                    }
                });
            });

            // Kecamatan AJAX //
            $('#kecamatanIbu').on('change', function () {
                let idDesa = $(this).val();
                $('#desaIbu').empty();
                $('#desaIbu').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/desa/' + idDesa,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#desaIbu').empty();
                        $('#desaIbu').append(`<option value="0" disabled selected>Pilih Desa/Kelurahan....</option>`);
                        response.forEach(element => {
                            $('#desaIbu').append(`<option value="${element['id']}">${element['nama_desa']}</option>`);
                        });
                    }
                });
            });

            // Banjar AJAX //
            $('#desaIbu').on('change', function () {
                let id = $(this).val();
                $('#banjarIbu').empty();
                $('#banjarIbu').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/banjar/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#banjarIbu').empty();
                        $('#banjarIbu').append(`<option value="0" disabled selected>Pilih Banjar....</option>`);
                        response.forEach(element => {
                            $('#banjarIbu').append(`<option value="${element['id']}">${element['banjar']}</option>`);
                        });
                    }
                });
            });


        });
    </script>

    <script>
        $(document).ready(function(){
            // Kabupaten AJAX //
            $('#kabupatenAnak').on('change', function () {
                let id = $(this).val();
                $('#kecamatanAnak').empty();
                $('#kecamatanAnak').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#kecamatanAnak').empty();
                        $('#kecamatanAnak').append(`<option value="0" disabled selected>Pilih Kecamatan....</option>`);
                        response.forEach(element => {
                            $('#kecamatanAnak').append(`<option value="${element['id']}">${element['nama_kecamatan']}</option>`);
                        });
                    }
                });
            });

            // Kecamatan AJAX //
            $('#kecamatanAnak').on('change', function () {
                let idDesa = $(this).val();
                $('#desaAnak').empty();
                $('#desaAnak').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/desa/' + idDesa,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#desaAnak').empty();
                        $('#desaAnak').append(`<option value="0" disabled selected>Pilih Desa/Kelurahan....</option>`);
                        response.forEach(element => {
                            $('#desaAnak').append(`<option value="${element['id']}">${element['nama_desa']}</option>`);
                        });
                    }
                });
            });

            // Banjar AJAX //
            $('#desaAnak').on('change', function () {
                let id = $(this).val();
                $('#banjarAnak').empty();
                $('#banjarAnak').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/banjar/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#banjarAnak').empty();
                        $('#banjarAnak').append(`<option value="0" disabled selected>Pilih Banjar....</option>`);
                        response.forEach(element => {
                            $('#banjarAnak').append(`<option value="${element['id']}">${element['banjar']}</option>`);
                        });
                    }
                });
            });


        });
    </script>

    <script>
        $(document).ready(function(){
            // Kabupaten AJAX //
            $('#kabupatenLansia').on('change', function () {
                let id = $(this).val();
                $('#kecamatanLansia').empty();
                $('#kecamatanLansia').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#kecamatanLansia').empty();
                        $('#kecamatanLansia').append(`<option value="0" disabled selected>Pilih Kecamatan....</option>`);
                        response.forEach(element => {
                            $('#kecamatanLansia').append(`<option value="${element['id']}">${element['nama_kecamatan']}</option>`);
                        });
                    }
                });
            });

            // Kecamatan AJAX //
            $('#kecamatanLansia').on('change', function () {
                let idDesa = $(this).val();
                $('#desaLansia').empty();
                $('#desaLansia').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/desa/' + idDesa,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#desaLansia').empty();
                        $('#desaLansia').append(`<option value="0" disabled selected>Pilih Desa/Kelurahan....</option>`);
                        response.forEach(element => {
                            $('#desaLansia').append(`<option value="${element['id']}">${element['nama_desa']}</option>`);
                        });
                    }
                });
            });

            // Banjar AJAX //
            $('#desaLansia').on('change', function () {
                let id = $(this).val();
                $('#banjarLansia').empty();
                $('#banjarLansia').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/banjar/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#banjarLansia').empty();
                        $('#banjarLansia').append(`<option value="0" disabled selected>Pilih Banjar....</option>`);
                        response.forEach(element => {
                            $('#banjarLansia').append(`<option value="${element['id']}">${element['banjar']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('error'))
        <script>
            $(document).ready(function(){
                alertError('{{$message}}');
            });
        </script>
    @endif




@endpush
