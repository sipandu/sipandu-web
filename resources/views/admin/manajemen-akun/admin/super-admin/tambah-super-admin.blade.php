@extends('layouts/admin/admin-layout')

@section('title', 'Tambah Super Admin')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Tambah Super Admin</h1>
        <div class="col-auto ml-auto my-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Super Admin') }}">Data Super Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header my-auto">
                        <h3 class="card-title my-auto">Form Tambah Super Admin Baru</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="bs-stepper py-3">
                            <div class="bs-stepper-header px-3 d-flex justify-content-center" role="tablist">
                                <div class="step" data-target="#data-pertama">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="data-pertama" id="data-pertama-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Data Pertama</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#data-kedua">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="data-kedua" id="data-kedua-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Data Kedua</span>
                                    </button>
                                </div>
                            </div>
                            <form action="{{ route('Simpan Super Admin') }}" enctype="multipart/form-data" method="post" class="needs-validation my-auto" novalidate>
                                @csrf
                                <div class="bs-stepper-content p-3">
                                    <div id="data-pertama" class="content" role="tabpanel" aria-labelledby="data-pertama-trigger">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nama Lengkap<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="name" id="name" autocomplete="off" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  placeholder="Masukan nama lengkap" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user-shield"></span>
                                                            </div>
                                                        </div>
                                                        @error('name')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                Nama lengkap super admin wajib diisi
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">Jenis Kelamin<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}" required>
                                                            @if (old('gender'))
                                                                <option selected value="{{ old('gender') }}">{{ old('gender') }}</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            @else
                                                                <option selected disabled>Pilih jenis kelamin ...</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            @endif
                                                        </select>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-venus-mars"></span>
                                                            </div>
                                                        </div>
                                                        @error('gender')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                Jenis kelamin super admin wajib dipilih
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="nik">NIK<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="nik" id="nik" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="Masukan NIK" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-address-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('nik')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                NIK super admin wajib diisi
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="fileKTP">Scan KTP<span class="text-danger">*</span></label>
                                                    <div class="col-sm-12 px-0">
                                                        <div class="custom-file">
                                                            <input type="file" name="file" autocomplete="off" class="custom-file-input @error('file') is-invalid @enderror" id="fileKTP" autocomplete="off" required>
                                                            <label class="custom-file-label" for="fileKTP" style="overflow-y: hidden">Unggah scan KTP</label>
                                                            @error('file')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @else
                                                                <div class="invalid-feedback">
                                                                    File KTP super admin wajib diunggah
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input  type="text" name="tempat_lahir" id="tempat_lahir" autocomplete="off" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Tempat lahir" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marker-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('tempat_lahir')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                Tempat lahir super admin wajib diisi
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="tgl_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input  type="text" name="tgl_lahir" id="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask required>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        @error('tgl_lahir')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                Tanggal lahir super admin wajib diisi
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Alamat E-Mail<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="email" name="email" id="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Alamat email aktif" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-envelope"></span>
                                                            </div>
                                                        </div>
                                                        @error('email')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                Email super admin wajib diisi
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="alamat" id="alamat" autocomplete="off" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Alamat tempat tinggal" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-road"></span>
                                                            </div>
                                                        </div>
                                                        @error('alamat')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                Alamat super admin wajib diisi
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="text-danger text-end"><span>*</span> Data wajib diisi</p>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <a class="btn btn-primary text-end" onclick="stepper.next()">Berikutnya</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="data-kedua" class="content" role="tabpanel" aria-labelledby="data-kedua-trigger">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Kabupaten/Kota<span class="text-danger">*</span></label>
                                                    <select id="kabupaten" name="kabupaten" class="form-control select2 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilih Kabupaten/Kota ..." required>
                                                        <option selected disabled>Pilih Kabupaten/Kota</option>
                                                        @foreach ($kabupaten as $k)
                                                            <option value="{{$k->id}}">{{ucfirst($k->nama_kabupaten)}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kabupaten')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Kabupaten wajib dipilih
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="tlpn">Area Tugas</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select @error('area_tugas') is-invalid @enderror" name="area_tugas" required autocomplete="off">
                                                            <option selected disabled>Pilih area tugas</option>
                                                            <option value="Provinsi">Provinsi</option>
                                                            <option value="Kabupaten">Kabupaten</option>
                                                            <option value="Kecamatan">Kecamatan</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-bookmark"></span>
                                                            </div>
                                                        </div>
                                                        @error('tlpn')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Kecamatan<span class="text-danger">*</span></label>
                                                    <select id="kecamatan" name="kecamatan" class="form-control select2 kecamatan @error('kecamatan') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilih Kecamatan ..." required>
                                                        <option selected disabled>Pilih Kecamatan</option>
                                                    </select>
                                                    @error('kecamatan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Kecamatan wajib diisi
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="tlpn">Nomor Telp</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="tlpn" id="tlpn" autocomplete="off" class="form-control @error('tlpn') is-invalid @enderror" value="{{ old('tlpn') }}" placeholder="Masukan nomor telepon aktif">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fas fa-phone"></span>
                                                                    </div>
                                                                </div>
                                                                @error('tlpn')
                                                                    <div class="invalid-feedback text-start">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="telegram">Username Telegram</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="telegram" id="telegram" autocomplete="off" class="form-control @error('telegram') is-invalid @enderror" value="{{ old('telegram') }}"  placeholder="Masukan username telegram aktif">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fab fa-telegram-plane"></span>
                                                                    </div>
                                                                </div>
                                                                @error('telegram')
                                                                    <div class="invalid-feedback">
                                                                        Telegram super admin wajib diisi
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Desa<span class="text-danger">*</span></label>
                                                    <select id="desa" name="desa" class="form-control select2 desa @error('desa') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilih Desa/Kelurahan ..." required>
                                                        <option selected disabled>Pilih Desa/Kelurahan</option>
                                                    </select>
                                                    @error('desa')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Desa wajib diisi
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Password<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" name="password" id="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan password" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                        </div>
                                                        @error('password')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                Password super admin wajib diisi
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="text-danger text-end"><span>*</span> Data wajib diisi</p>
                                                <div class="row">
                                                    <div class="col-6 justify-content-start">
                                                        <a class="btn btn-warning" onclick="stepper.previous()">Sebelumnya</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <button type="submit" class="btn btn-primary my-1">Daftarkan Akun</button>
                                                    </div>
                                                </div>
                                            </div>
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
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account').addClass('active');
            $('#data-super-admin').addClass('active');

            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
            $('[data-mask]').inputmask()

            // Kabupaten to Kecamatan AJAX //
            $('#kabupaten').on('change', function () {
                let id = $(this).val();
                $('#kecamatan').empty();
                $('#kecamatan').append(`<option value="0" disabled selected>Silahkan tunggu ...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#kecamatan').empty();
                        $('#kecamatan').append(`<option value="0" disabled selected>Pilih Kecamatan</option>`);
                        response.forEach(element => {
                            $('#kecamatan').append(`<option value="${element['id']}">${element['nama_kecamatan']}</option>`);
                        });
                    }
                });
            });

            // Kecamatan to Desa AJAX //
            $('#kecamatan').on('change', function () {
                let idDesa = $(this).val();
                $('#desa').empty();
                $('#desa').append(`<option value="0" disabled selected>Silahkan tunggu ...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/desa/' + idDesa,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#desa').empty();
                        $('#desa').append(`<option value="0" disabled selected>Pilih Desa/Kelurahan</option>`);
                        response.forEach(element => {
                            $('#desa').append(`<option value="${element['id']}">${element['nama_desa']}</option>`);
                        });
                    }
                });
            });
        });

        // Custom Input Date
        // $(function () {
            // bsCustomFileInput.init();

            
        // })

        // Custom Step Page
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
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

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush
