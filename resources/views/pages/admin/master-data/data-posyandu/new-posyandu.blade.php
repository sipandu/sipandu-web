@extends('layouts/admin/admin-layout')

@section('title', 'Add Posyandu')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">   
    <link rel="stylesheet" href="{{url('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/dropzone/min/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Tambah Posyandu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger text-center" role="alert">
                        <span>Terdapat kesalahan dalam penginputan data. Periksa kembali input data sebelumnya!</span>
                    </div>
                @endif
                <div class="card card-primary">
                    <div class="card-header my-auto">
                      <h3 class="card-title my-auto">Tambahkan Posyandu Baru</h3>
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
                            <form action="{{ route('New Posyandu') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="bs-stepper-content p-3">
                                    <div id="data-pertama" class="content" role="tabpanel" aria-labelledby="data-pertama-trigger">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="inputNamaPosyandu">Nama Posyandu<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="nama_posyandu" class="form-control @error('nama_posyandu') is-invalid @enderror" id="inputNamaPosyandu" value="{{ old('nama_posyandu') }}" placeholder="Nama Posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-clinic-medical"></span>
                                                            </div>
                                                        </div>
                                                        @error('nama_posyandu')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor Telp Posyandu<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('telp_posyandu') is-invalid @enderror" name="telp_posyandu" value="{{ old('telp_posyandu') }}" placeholder="Masukan nomor telepon aktif" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('telp_posyandu')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Kabupaten/Kota<span class="text-danger">*</span></label>
                                                    <select id="kabupaten" name="kabupaten" class="form-control select2 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                                        <option selected disabled>Pilih Kabupaten/Kota</option>
                                                        @foreach ($kabupaten as $k)
                                                            <option value="{{$k->id}}">{{ucfirst($k->nama_kabupaten)}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kabupaten')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="inputKecamatan">Kecamatan<span class="text-danger">*</span></label>
                                                    <select id="kecamatan" name="kecamatan" class="form-control select2 kecamatan @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                                        <option selected disabled>Pilih Kecamatan</option>
                                                    </select>
                                                    @error('kecamatan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Desa/Kelurahan<span class="text-danger">*</span></label>
                                                    <select id="desa" name="desa" class="form-control select2 @error('desa') is-invalid @enderror" style="width: 100%;">
                                                        <option selected disabled>Pilih Desa/Kelurahan</option>
                                                    </select>
                                                    @error('desa')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Banjar<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('banjar') is-invalid @enderror" name="banjar" id="inputBanjar" value="{{ old('banjar') }}" placeholder="Masukan lokasi banjar" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-city"></span>
                                                            </div>
                                                        </div>
                                                        @error('banjar')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="inputLat">Koordinat Latitude<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('lat') is-invalid @enderror" name="lat" id="inputLat" value="{{ old('lat') }}" placeholder="Koordinat Latitude posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marker-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('lat')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="inputLng">Koordinat Longitude<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('lng') is-invalid @enderror" name="lng" id="inputLng" value="{{ old('lng') }}" placeholder="Koordinat Longitude posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marker-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('lng')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="inputAlamat">Alamat Posyandu<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('alamat_posyandu') is-invalid @enderror" name="alamat_posyandu" id="inputAlamat" value="{{ old('alamat_posyandu') }}" placeholder="Masukan alamat lengkap posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-road"></span>
                                                            </div>
                                                        </div>
                                                        @error('alamat_posyandu')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="konfirmasiPass">Password Konfirmasi<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control @error('passwordAdmin') is-invalid @enderror" name="passwordAdmin" id="konfirmasiPass" placeholder="Konfirmasi password anda">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                        </div>
                                                        @error('passwordAdmin')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-danger small text-end"><span>*</span>Data Wajib Diisi</p>
                                            </div>                                          
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 d-flex justify-content-between">
                                                <a href="{{ route("Data Posyandu") }}" class="btn btn-danger">Batalkan</a>
                                                <a class="btn btn-primary" onclick="stepper.next()">Berikutnya</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="data-kedua" class="content" role="tabpanel" aria-labelledby="data-kedua-trigger">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai') }}" placeholder="Nama lengkap admin" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                        @error('nama_pegawai')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenis Kelamin<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="inputGroupSelect02">
                                                            <option value="" selected>Pilih jenis kelamin....</option>
                                                            <option value="laki-laki">Laki-laki</option>
                                                            <option value="perempuan">Perempuan</option>
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
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Masukan nomor NIK" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-address-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('nik')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Scan KTP<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="file_ktp" class="custom-file-input @error('file_ktp') is-invalid @enderror" id="exampleInputFile">
                                                            @error('file_ktp')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label class="custom-file-label" for="exampleInputFile">Upload scan KTP</label>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tempat Lahir<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Tempat lahir" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marked-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('tempat_lahir')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        @error('tgl_lahir')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor Telp Admin</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('telp_pegawai') is-invalid @enderror" name="telp_pegawai" value="{{ old('telp_pegawai') }}" placeholder="Masukan nomor telepon aktif" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('telp_pegawai')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Username Telegram</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('telegram') is-invalid @enderror" name="telegram" value="{{ old('telegram') }}" placeholder="Masukan Username Telegram aktif" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fab fa-telegram"></span>
                                                            </div>
                                                        </div>
                                                        @error('telegram')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat E-Mail<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Alamat email aktif" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-envelope"></span>
                                                            </div>
                                                        </div>
                                                        @error('email')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('alamat_pegawai') is-invalid @enderror" name="alamat_pegawai" value="{{ old('alamat_pegawai') }}" placeholder="Alamat tempat tinggal" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-road"></span>
                                                            </div>
                                                        </div>
                                                        @error('alamat_pegawai')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Password<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukan Password" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                        </div>
                                                        @error('password')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Konfirmasi Password<span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Masukan kembali Password" autocomplete="off">
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
                                                <p class="text-danger small text-end"><span>*</span>Data Wajib Diisi</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-6 justify-content-start d-flex align-items-start">
                                                        <a class="btn btn-primary my-2" onclick="stepper.previous()">Sebelumnya</a>
                                                    </div>
                                                    <div class="col-6 justify-content-end text-end">
                                                        <a href="{{ route("Data Posyandu") }}" class="btn btn-danger my-1">Batalkan</a>
                                                        <button type="submit" class="btn btn-success my-1">Tambah Posyandu</button>
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
    {{-- Custom Step Page --}}
    <script src="{{url('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <script src="{{url('base-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('base-template/dist/js/adminlte.js')}}"></script>

    <!-- Custom Input Date -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-management-posyandu').addClass('menu-is-opening menu-open');
            $('#management-posyandu').addClass('active');
            $('#data-posyandu').addClass('active');
        });

        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
            $('[data-mask]').inputmask()
        })

        // Custom Step Page
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>

    <script>
        $(document).ready(function(){
            // Kabupaten AJAX //
            $('#kabupaten').on('change', function () {
                let id = $(this).val();
                $('#kecamatan').empty();
                $('#kecamatan').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#kecamatan').empty();
                        $('#kecamatan').append(`<option value="0" disabled selected>Pilih Kecamatan/Kota</option>`);
                        response.forEach(element => {
                            $('#kecamatan').append(`<option value="${element['id']}">${element['nama_kecamatan']}</option>`);
                        });
                    }
                });
            });

            // Kecamatan AJAX //
            $('#kecamatan').on('change', function () {
                let idDesa = $(this).val();
                $('#desa').empty();
                $('#desa').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
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

            // Banjar AJAX //
            $('#desa').on('change', function () {
                let id = $(this).val();
                $('#banjar').empty();
                $('#banjar').append(`<option value="0" disabled selected>Silakan tunggu....</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/banjar/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#banjar').empty();
                        $('#banjar').append(`<option value="0" disabled selected>Pilih Banjar</option>`);
                        response.forEach(element => {
                            $('#banjar').append(`<option value="${element['id']}">${element['banjar']}</option>`);
                        });
                    }
                });
            });


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
