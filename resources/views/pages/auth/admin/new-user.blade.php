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
    <div class="d-flex justify-con
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
                                                <label for="exampleInputEmail1">Nomor KK</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="no_kk" autocomplete="off" class="form-control @error('no_kk') is-invalid @enderror" id="inputNoKK" value="{{ old('no_kk') }}" placeholder="Nomor KK">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('no_kk')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group" id="kkuser">
                                                <label for="exampleInputEmail1">Scan KK</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="file" type="file" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Upload scan KK</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Bumil</label>
                                                <div class="input-group mb-3">
                                                    <input type="text " name="nama_ibu" autocomplete="off" class="form-control @error('nama_ibu') is-invalid @enderror" id="inputNamaIbu" value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu ibu hamil">
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
                                                <label for="exampleInputEmail1">Nama Suami</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_suami" autocomplete="off" class="form-control @error('nama_suami') is-invalid @enderror" value="{{ old('nama_suami') }}" placeholder="Nama lengkap suami">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
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
                                                <label for="exampleInputEmail1">Tempat Lahir Bumil</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="tempat_lahir" autocomplete="off" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}"  placeholder="Tempat lahir ibu hamil">
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
                                            <div class="form-group">
                                                <label>Tanggal Lahir Bumil</label>
                                                <div class="input-group">
                                                    <input type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}"  placeholder="Tanggal lahir bumil" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIK</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nik" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="Masukan nomor NIK">
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
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" autocomplete="off" placeholder="Alamat tempat tinggal">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-road"></span>
                                                        </div>
                                                    </div>
                                                    @error('alamat')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat E-Mail</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="off" placeholder="Alamat email aktif">
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nomor Telp</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="no_tlpn" class="form-control @error('no_tlpn') is-invalid @enderror" value="{{ old('no_tlpn') }}" autocomplete="off" placeholder="Masukan nomor telepon">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('no_tlpn')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi Posyandu</label>
                                                <div class="input-group mb-3">
                                                    <select name="lokasi_posyandu" class="form-control select2 @error('lokasi_posyandu') is-invalid @enderror" style="width: 100%,;" >
                                                        @foreach ($posyandu as $p)
                                                            <option value="{{$p->id}}">{{$p->nama_posyandu}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lokasi_posyandu')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" autocomplete="off" placeholder="Masukan Password" autocomplete="off">
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
                                            <div class="form-group mb-3">
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
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
                                                <label for="exampleInputEmail1">Nomor KK</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="no_kk" autocomplete="off" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk') }}" placeholder="Nomor KK">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('no_kk')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Scan KK</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Upload scan KK</label>
                                                    </div>
                                                    @error('file')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Anak</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_anak" autocomplete="off" class="form-control @error('nama_anak') is-invalid @enderror" value="{{ old('nama_anak') }}" placeholder="Nama lengkap bayi atau balita">
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
                                                <label for="exampleInputEmail1">Nama Ayah</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_ayah" autocomplete="off" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
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
                                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Tempat lahir anak">
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
                                            <div class="form-group">
                                                <label>Tanggal Lahir </label>
                                                <div class="input-group">
                                                    <input type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir anak" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                <div class="input-group mb-3">
                                                    <select name="gender"  class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}" id="inputGroupSelect02">
                                                        <option selected disabled>Pilih jenis kelamin....</option>
                                                        <option value="1">Laki-laki</option>
                                                        <option value="2">Perempuan</option>
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
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Status Anak</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" name="status_anak" autocomplete="off" class="form-control @error('status_anak') is-invalid @enderror" value="{{ old('status_anak') }}" placeholder="Anak ke...">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-address-card"></span>
                                                        </div>
                                                    </div>
                                                    @error('status_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="alamat" autocomplete="off" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Alamat tempat tinggal">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-road"></span>
                                                        </div>
                                                    </div>
                                                    @error('alamat')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIK</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nik" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="Masukan nomor NIK">
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat E-Mail</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Alamat email aktif">
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nomor Telp</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="no_tlpn" autocomplete="off" class="form-control @error('no_tlpn') is-invalid @enderror" value="{{ old('no_tlpn') }}" placeholder="Masukan nomor telepon">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('no_tlpn')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi Posyandu</label>
                                                <div class="input-group mb-3">
                                                    <select name="lokasi_posyandu" class="form-control select2 @error('lokasi_posyandu') is-invalid @enderror" style="width: 100%,;" >
                                                        @foreach ($posyandu as $p)
                                                            <option value="{{$p->id}}">{{$p->nama_posyandu}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lokasi_posyandu')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password">
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan kembali Password">
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
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
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
                                                <label for="exampleInputEmail1">Nomor KK</label>
                                                <div class="input-group mb-3">
                                                    <input type="text"  name="no_kk" autocomplete="off" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk') }}" placeholder="Nomor KK">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('no_kk')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Scan KK</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" value="{{ old('file') }}" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Upload scan KK</label>
                                                    </div>
                                                    @error('file')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Lansia</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nama_lansia" autocomplete="off" class="form-control @error('nama_lansia') is-invalid @enderror" value="{{ old('nama_lansia') }}" placeholder="Nama lengkap ibu lansia">
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
                                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="tempat_lahir" autocomplete="off" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Tempat lahir lansia">
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
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <div class="input-group">
                                                    <input type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir lansia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                <div class="input-group mb-3">
                                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}" id="inputGroupSelect02">
                                                        <option selected disabled>Pilih jenis kelamin....</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIK</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="nik" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="Masukan nomor NIK">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-address-card"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('nik')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="alamat" autocomplete="off" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Alamat tempat tinggal">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-road"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('alamat')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat E-Mail</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Alamat email aktif">
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nomor Telp</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="no_tlpn" autocomplete="off" class="form-control @error('no_tlpn') is-invalid @enderror" value="{{ old('no_tlpn') }}" placeholder="Masukan nomor telepon">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                    @error('no_tlpn')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Status Lansia</label>
                                                <div class="input-group mb-3">
                                                    <select name="status_lansia" autocomplete="off" class="form-control @error('status_lansia') is-invalid @enderror" value="{{ old('status_lansia') }}" id="inputGroupSelect02">
                                                        <option selected disabled>Pilih status lansia....</option>
                                                        <option value="Pra Lansia">Pra Lansia</option>
                                                        <option value="Lansia">Lansia</option>
                                                        <option value="Lansia Beresiko">Lansia Beresiko</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-venus-mars"></span>
                                                        </div>
                                                    </div>
                                                    @error('status_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi Posyandu</label>
                                                <div class="input-group mb-3">
                                                    <select name="lokasi_posyandu" class="form-control select2 @error('lokasi_posyandu') is-invalid @enderror" style="width: 100%,;" >
                                                        <option selected disabled>Pilih Lokasi Posyandu ....</option>
                                                        @foreach ($posyandu as $p)
                                                            <option value="{{$p->id}}">{{$p->nama_posyandu}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lokasi_posyandu')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password">
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
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan kembali Password">
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
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
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
