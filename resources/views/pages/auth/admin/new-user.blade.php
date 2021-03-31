@extends('layouts/admin/admin-layout')

@section('title', 'Add User')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Tambah Anggota Posyandu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Anggota</li>
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
                        <div class="card card-primary">
                            <div class="card-header my-auto">
                                <h3 class="card-title my-auto">Tambah Anggota Ibu Hamil Baru</h3>
                            </div>
                            <div class="card-body p-3">
                                <form action="{{ route('create.account.ibu') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Nomor KK</label>
                                                        <div class="input-group">
                                                            <input type="text" name="no_kk_bumil" autocomplete="off" class="form-control @error('no_kk_bumil') is-invalid @enderror" id="inputNoKK" value="{{ old('no_kk_bumil') }}" placeholder="Nomor KK">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-id-card"></span>
                                                                </div>
                                                            </div>
                                                            @error('no_kk_bumil')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">NIK</label>
                                                        <div class="input-group">
                                                            <input type="text" name="nik_bumil" autocomplete="off" class="form-control @error('nik_bumil') is-invalid @enderror" value="{{ old('nik_bumil') }}" placeholder="Masukan NIK">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-address-card"></span>
                                                                </div>
                                                            </div>
                                                            @error('nik_bumil')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group" id="kkuser">
                                                <label for="exampleInputEmail1">Scan KK</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="file" type="file" class="custom-file-input @error('file_bumil') is-invalid @enderror" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Unggah scan KK</label>
                                                        @error('file_bumil')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="inputTelp" class="col-sm-3 col-form-label">Scan KK</label>
                                                <div class="col-sm-12">
                                                    <input type="file" name="file_bumil" autocomplete="off" class="custom-file-input @error('file_bumil') is-invalid @enderror"  id="inputTelp" autocomplete="off">
                                                    <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                    @error('file_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Ibu Hamil</label>
                                                <div class="input-group mb-3">
                                                    <input type="text " name="nama_bumil" autocomplete="off" class="form-control @error('nama_bumil') is-invalid @enderror" id="inputNamaIbu" value="{{ old('nama_bumil') }}" placeholder="Nama lengkap ibu hamil">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-female"></span>
                                                        </div>
                                                    </div>
                                                    @error('nama_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Suami</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_suami" autocomplete="off" class="form-control @error('nama_suami') is-invalid @enderror" value="{{ old('nama_suami') }}" placeholder="Nama lengkap suami">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-male"></span>
                                                        </div>
                                                    </div>
                                                    @error('nama_suami')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Tempat Lahir Bumil</label>
                                                        <div class="input-group">
                                                            <input type="text" name="tempat_lahir_bumil" autocomplete="off" class="form-control @error('tempat_lahir_bumil') is-invalid @enderror" value="{{ old('tempat_lahir_bumil') }}"  placeholder="Tempat lahir ibu hamil">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-map-marker-alt"></span>
                                                                </div>
                                                            </div>
                                                            @error('tempat_lahir_bumil')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label>Tanggal Lahir Bumil</label>
                                                        <div class="input-group">
                                                            <input type="text" name="tgl_lahir_bumil" autocomplete="off" class="form-control @error('tgl_lahir_bumil') is-invalid @enderror" value="{{ old('tgl_lahir_bumil') }}"  placeholder="Tanggal lahir ibu hamil" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                </span>
                                                            </div>
                                                            @error('tgl_lahir_bumil')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="alamat_bumil" class="form-control @error('alamat_bumil') is-invalid @enderror" value="{{ old('alamat_bumil') }}" autocomplete="off" placeholder="Alamat tempat tinggal">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-road"></span>
                                                        </div>
                                                    </div>
                                                    @error('alamat_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat E-Mail</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email_bumil" class="form-control @error('email_bumil') is-invalid @enderror" value="{{ old('email_bumil') }}" autocomplete="off" placeholder="Alamat email aktif">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                    @error('email_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Nomor Telp</label>
                                                        <div class="input-group">
                                                            <input type="text" name="no_tlpn_bumil" class="form-control @error('no_tlpn_bumil') is-invalid @enderror" value="{{ old('no_tlpn_bumil') }}" autocomplete="off" placeholder="Nomor telepon">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-phone"></span>
                                                                </div>
                                                            </div>
                                                            @error('no_tlpn_bumil')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Telegram</label>
                                                        <div class="input-group">
                                                            <input type="text" name="telegram_bumil" class="form-control @error('telegram_bumil') is-invalid @enderror" value="{{ old('telegram_bumil') }}" autocomplete="off" placeholder="Username Telegram">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fab fa-telegram-plane"></span>
                                                                </div>
                                                            </div>
                                                            @error('telegram_bumil')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi Posyandu</label>
                                                <div class="input-group mb-3">
                                                    <select name="lokasi_posyandu_bumil" class="form-control select2 @error('lokasi_posyandu_bumil') is-invalid @enderror">
                                                            <option selected disabled>Pilih Lokasi Posyandu ....</option>
                                                        @foreach ($posyandu as $p)
                                                            <option value="{{$p->id}}">{{$p->nama_posyandu}}, {{$p->desa->nama_desa}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lokasi_posyandu_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordBumil" class="form-control @error('passwordBumil') is-invalid @enderror" value="{{ old('passwordBumil') }}" autocomplete="off" placeholder="Masukan Password" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('passwordBumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control @error('passwordBumil_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Masukan kembali Password" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('passwordBumil_confirmation')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group pt-2">
                                                <div class="input-group mb-3 justify-content-end">
                                                    <button type="submit" class="btn btn-primary mt-4">Daftarkan Akun</button>
                                                </div>
                                            </div>
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
                            <div class="card-body p-3">
                                <form action="{{ route('create.account.anak') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Nomor KK</label>
                                                        <div class="input-group">
                                                            <input type="text" name="no_kk_anak" autocomplete="off" class="form-control @error('no_kk_anak') is-invalid @enderror" value="{{ old('no_kk_anak') }}" placeholder="Nomor KK">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-id-card"></span>
                                                                </div>
                                                            </div>
                                                            @error('no_kk_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">NIK</label>
                                                        <div class="input-group">
                                                            <input type="text" name="nik_anak" autocomplete="off" class="form-control @error('nik_anak') is-invalid @enderror" value="{{ old('nik_anak') }}" placeholder="Masukan NIK">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-address-card"></span>
                                                                </div>
                                                            </div>
                                                            @error('nik_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="exampleInputEmail1">Scan KK</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file_anak" class="custom-file-input @error('file_anak') is-invalid @enderror" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                    </div>
                                                    @error('file_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="inputTelp" class="col-sm-3 col-form-label">Scan KK</label>
                                                <div class="col-sm-12">
                                                    <input type="file" name="file_anak" autocomplete="off" class="custom-file-input @error('file_anak') is-invalid @enderror"  id="inputTelp" autocomplete="off">
                                                    <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                    @error('file_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Anak</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_anak" autocomplete="off" class="form-control @error('nama_anak') is-invalid @enderror" value="{{ old('nama_anak') }}" placeholder="Nama lengkap anak">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-child"></span>
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
                                                <label for="exampleInputEmail1">Nama Ayah</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_ayah" autocomplete="off" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-male"></span>
                                                        </div>
                                                    </div>
                                                    @error('nama_ayah')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Ibu</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_ibu" autocomplete="off" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-female"></span>
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
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Tempat Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text" name="tempat_lahir_anak" class="form-control @error('tempat_lahir_anak') is-invalid @enderror" value="{{ old('tempat_lahir_anak') }}" placeholder="Tempat lahir anak">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-map-marker-alt"></span>
                                                                </div>
                                                            </div>
                                                            @error('tempat_lahir_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label>Tanggal Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text" name="tgl_lahir_anak" autocomplete="off" class="form-control @error('tgl_lahir_anak') is-invalid @enderror" value="{{ old('tgl_lahir_anak') }}" placeholder="Tanggal lahir anak" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                </span>
                                                            </div>
                                                            @error('tgl_lahir_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-7">
                                                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                        <div class="input-group mb-3">
                                                            <select name="gender_anak"  class="form-control @error('gender_anak') is-invalid @enderror" value="{{ old('gender_anak') }}" id="inputGroupSelect02">
                                                                <option selected disabled>Pilih jenis kelamin....</option>
                                                                <option value="1">Laki-laki</option>
                                                                <option value="2">Perempuan</option>
                                                            </select>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-venus-mars"></span>
                                                                </div>
                                                            </div>
                                                            @error('gender_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-5">
                                                        <label for="exampleInputEmail1">Status Anak</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="status_anak" autocomplete="off" class="form-control @error('status_anak') is-invalid @enderror" value="{{ old('status_anak') }}" placeholder="Anak ke...">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-user-friends"></span>
                                                                </div>
                                                            </div>
                                                            @error('status_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="alamat_anak" autocomplete="off" class="form-control @error('alamat_anak') is-invalid @enderror" value="{{ old('alamat_anak') }}" placeholder="Alamat tempat tinggal">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-road"></span>
                                                        </div>
                                                    </div>
                                                    @error('alamat_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat E-Mail</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email_anak" autocomplete="off" class="form-control @error('email_anak') is-invalid @enderror" value="{{ old('email_anak') }}" placeholder="Alamat email aktif">
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
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Nomor Telp</label>
                                                        <div class="input-group">
                                                            <input type="text" name="no_tlpn_anak" autocomplete="off" class="form-control @error('no_tlpn_anak') is-invalid @enderror" value="{{ old('no_tlpn_anak') }}" placeholder="Nomor telepon">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-phone"></span>
                                                                </div>
                                                            </div>
                                                            @error('no_tlpn_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Telegram</label>
                                                        <div class="input-group">
                                                            <input type="text" name="telegram_anak" autocomplete="off" class="form-control @error('telegram_anak') is-invalid @enderror" value="{{ old('telegram_anak') }}" placeholder="Username Telegram">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fab fa-telegram-plane"></span>
                                                                </div>
                                                            </div>
                                                            @error('telegram_anak')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi Posyandu</label>
                                                <div class="input-group mb-3">
                                                    <select name="lokasi_posyandu_anak" class="form-control select2 @error('lokasi_posyandu_anak') is-invalid @enderror" style="width: 100%">
                                                        <option selected disabled>Pilih Lokasi Posyandu ....</option>
                                                        @foreach ($posyandu as $p)
                                                            <option value="{{$p->id}}">{{$p->nama_posyandu}}, {{$p->desa->nama_desa}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lokasi_posyandu_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordAnak" autocomplete="off" class="form-control @error('passwordAnak') is-invalid @enderror" value="{{ old('passwordAnak') }}" placeholder="Masukan Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
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
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordAnak_confirmation" autocomplete="off" class="form-control @error('passwordAnak_confirmation') is-invalid @enderror" value="{{ old('passwordAnak_confirmation') }}" placeholder="Masukan kembali Password">
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
                                            <div class="form-group pt-2">
                                                <div class="input-group mb-3 justify-content-end">
                                                    <button type="submit" class="btn btn-primary mt-4">Daftarkan Akun</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-lansia" role="tabpanel" aria-labelledby="nav-lansia-tab">
                        <div class="card card-primary">
                            <div class="card-header my-auto">
                                <h3 class="card-title my-auto">Tambah Anggota Lansia Baru</h3>
                            </div>
                            <div class="card-body p-3">
                                <form action="{{ route('create.account.lansia') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Nomor KK</label>
                                                        <div class="input-group">
                                                            <input type="text"  name="no_kk_lansia" autocomplete="off" class="form-control @error('no_kk_lansia') is-invalid @enderror" value="{{ old('no_kk_lansia') }}" placeholder="Nomor KK">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-id-card"></span>
                                                                </div>
                                                            </div>
                                                            @error('no_kk_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">NIK</label>
                                                        <div class="input-group">
                                                            <input type="text" name="nik_lansia" autocomplete="off" class="form-control @error('nik_lansia') is-invalid @enderror" value="{{ old('nik_lansia') }}" placeholder="Masukan NIK">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-address-card"></span>
                                                                </div>
                                                            </div>
                                                            @error('nik_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="exampleInputEmail1">Scan KK</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file_lansia" class="custom-file-input @error('file_lansia') is-invalid @enderror" value="{{ old('file_lansia') }}" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                    </div>
                                                    @error('file_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="inputTelp" class="col-sm-3 col-form-label">Scan KK</label>
                                                <div class="col-sm-12">
                                                    <input type="file" name="file_lansia" autocomplete="off" class="custom-file-input @error('file_lansia') is-invalid @enderror"  id="inputTelp" autocomplete="off">
                                                    <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                    @error('file_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Lansia</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_lansia" autocomplete="off" class="form-control @error('nama_lansia') is-invalid @enderror" value="{{ old('nama_lansia') }}" placeholder="Nama lengkap lansia">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-wheelchair"></span>
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
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Tempat Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text" name="tempat_lahir_lansia" autocomplete="off" class="form-control @error('tempat_lahir_lansia') is-invalid @enderror" value="{{ old('tempat_lahir_lansia') }}" placeholder="Tempat lahir lansia">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-map-marker-alt"></span>
                                                                </div>
                                                            </div>
                                                            @error('tempat_lahir_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label>Tanggal Lahir</label>
                                                        <div class="input-group">
                                                            <input type="text" name="tgl_lahir_lansia" autocomplete="off" class="form-control @error('tgl_lahir_lansia') is-invalid @enderror" value="{{ old('tgl_lahir_lansia') }}" placeholder="Tanggal lahir lansia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-calendar-alt"></i>
                                                                </span>
                                                            </div>
                                                            @error('tgl_lahir_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                        <div class="input-group">
                                                            <select name="gender_lansia" class="form-control @error('gender_lansia') is-invalid @enderror" value="{{ old('gender_lansia') }}" id="inputGroupSelect02">
                                                                <option selected disabled>Pilih jenis kelamin....</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-venus-mars"></span>
                                                                </div>
                                                            </div>
                                                            @error('gender_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Status Lansia</label>
                                                        <div class="input-group">
                                                            <select name="status_lansia" autocomplete="off" class="form-control @error('status_lansia') is-invalid @enderror" value="{{ old('status_lansia') }}" id="inputGroupSelect02">
                                                                <option selected disabled>Pilih status lansia....</option>
                                                                <option value="Pra Lansia">Pra Lansia</option>
                                                                <option value="Lansia">Lansia</option>
                                                                <option value="Lansia Beresiko">Lansia Beresiko</option>
                                                            </select>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-user-friends"></span>
                                                                </div>
                                                            </div>
                                                            @error('status_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <div class="input-group">
                                                    <input type="text" name="alamat_lansia" autocomplete="off" class="form-control @error('alamat_lansia') is-invalid @enderror" value="{{ old('alamat_lansia') }}" placeholder="Alamat tempat tinggal">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-road"></span>
                                                        </div>
                                                    </div>
                                                    @error('alamat_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat E-Mail</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email_lansia" autocomplete="off" class="form-control @error('email_lansia') is-invalid @enderror" value="{{ old('email_lansia') }}" placeholder="Alamat email aktif">
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
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Nomor Telp</label>
                                                        <div class="input-group">
                                                            <input type="text" name="no_tlpn_lansia" autocomplete="off" class="form-control @error('no_tlpn_lansia') is-invalid @enderror" value="{{ old('no_tlpn_lansia') }}" placeholder="Nomor telepon">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-phone"></span>
                                                                </div>
                                                            </div>
                                                            @error('no_tlpn_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <label for="exampleInputEmail1">Telegram</label>
                                                        <div class="input-group">
                                                            <input type="text" name="telegram_lansia" autocomplete="off" class="form-control @error('telegram_lansia') is-invalid @enderror" value="{{ old('telegram_lansia') }}" placeholder="Username Telegram">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fab fa-telegram-plane"></span>
                                                                </div>
                                                            </div>
                                                            @error('telegram_lansia')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi Posyandu</label>
                                                <div class="input-group mb-3">
                                                    <select name="lokasi_posyandu_lansia" class="form-control select2 @error('lokasi_posyandu_lansia') is-invalid @enderror" style="width: 100%" >
                                                        <option selected disabled>Pilih Lokasi Posyandu ....</option>
                                                        @foreach ($posyandu as $p)
                                                            <option value="{{$p->id}}">{{$p->nama_posyandu}}, {{$p->desa->nama_desa}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lokasi_posyandu_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordLansia" autocomplete="off" class="form-control @error('passwordLansia') is-invalid @enderror" value="{{ old('passwordLansia') }}" placeholder="Masukan Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
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
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="passwordLansia_confirmation" autocomplete="off" class="form-control @error('passwordLansia_confirmation') is-invalid @enderror" placeholder="Masukan kembali Password">
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
                                            <div class="form-group pt-2">
                                                <div class="input-group mb-3 justify-content-end">
                                                    <button type="submit" class="btn btn-primary mt-4">Daftarkan Akun</button>
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
    </div>
@endsection

@push('js')
    {{-- Custom Step Page --}}
    <script src="{{url('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <!-- Custom Input Date -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');

            $('#list-admin-account').addClass('menu-is-opening menu-open');
            $('#list-admin-account-link').addClass('active');

            $('#list-account').addClass('menu-is-opening menu-open');
            $('#list-account-link').addClass('active');
            $('#new-user').addClass('active');


        });

        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })

            $('[data-mask]').inputmask()
        })

        // Custom Step Page
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>


    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif

@endpush
