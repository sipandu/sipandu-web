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
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Anggota</li>
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
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="no_kk_bumil">Nomor KK<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="no_kk_bumil" autocomplete="off" class="form-control @error('no_kk_bumil') is-invalid @enderror" id="no_kk_bumil" value="{{ old('no_kk_bumil') }}" placeholder="Nomor KK">
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
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="nik_bumil">NIK<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="nik_bumil" autocomplete="off" class="form-control @error('nik_bumil') is-invalid @enderror" id="nik_bumil" value="{{ old('nik_bumil') }}" placeholder="Masukan NIK">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="inputTelp">Scan KK<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file_bumil" class="custom-file-input form-control @error('file_bumil') is-invalid @enderror" id="inputTelp" autocomplete="off">
                                                        <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                        @error('file_bumil')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="nama_bumil">Nama Ibu Hamil<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_bumil" autocomplete="off" class="form-control @error('nama_bumil') is-invalid @enderror" id="nama_bumil" value="{{ old('nama_bumil') }}" placeholder="Nama lengkap ibu hamil">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="nama_suami">Nama Suami<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_suami" autocomplete="off" class="form-control @error('nama_suami') is-invalid @enderror" id="nama_suami" value="{{ old('nama_suami') }}" placeholder="Nama lengkap suami">
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
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="tempat_lahir_bumil">Tempat Lahir Bumil<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="tempat_lahir_bumil" autocomplete="off" class="form-control @error('tempat_lahir_bumil') is-invalid @enderror" id="tempat_lahir_bumil" value="{{ old('tempat_lahir_bumil') }}"  placeholder="Tempat lahir ibu hamil">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="tgl_lahir_bumil">Tanggal Lahir Bumil<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="tgl_lahir_bumil" autocomplete="off" class="form-control @error('tgl_lahir_bumil') is-invalid @enderror" id="tgl_lahir_bumil" value="{{ old('tgl_lahir_bumil') }}"  placeholder="Tanggal lahir bumil" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="agama_bumil">Agama<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="agama_bumil" class="form-control @error('agama_bumil') is-invalid @enderror" value="{{ old('agama_bumil') }}" id="agama_bumil">
                                                        @if ( old('agama_bumil') )
                                                            <option selected value="{{ old('agama_bumil') }}">{{ old('agama_bumil') }}</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Katolik">Katolik</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        @else
                                                            <option selected disabled>Pilih agama....</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Katolik">Katolik</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('agama_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="goldar_bumil">Golongan Darah</label>
                                                <div class="input-group">
                                                    <select name="goldar_bumil" class="form-control @error('goldar_bumil') is-invalid @enderror" value="{{ old('goldar_bumil') }}" id="goldar_bumil">
                                                        @if ( old('goldar_bumil') )
                                                            <option selected value="{{ old('goldar_bumil') }}">{{ old('goldar_bumil') }}</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @else
                                                            <option selected disabled>Golongan darah ...</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('goldar_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="tanggungan_bumil">Tanggungan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="tanggungan_bumil" class="form-control @error('tanggungan_bumil') is-invalid @enderror" value="{{ old('tanggungan_bumil') }}" id="tanggungan_bumil">
                                                        @if ( old('tanggungan_bumil') )
                                                            <option selected value="{{ old('tanggungan_bumil') }}">{{ old('tanggungan_bumil') }}</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @else
                                                            <option selected disabled>Tanggungan ibu....</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('tanggungan_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="faskes_bumil">Faskes Rujukan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="faskes_bumil" class="form-control @error('faskes_bumil') is-invalid @enderror" value="{{ old('faskes_bumil') }}" autocomplete="off" placeholder="Faskes rujukan bumil" id="faskes_bumil">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('faskes_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="jkn_bumil">Nomor JKN</label>
                                                <div class="input-group">
                                                    <input type="text" name="jkn_bumil" class="form-control @error('jkn_bumil') is-invalid @enderror" value="{{ old('jkn_bumil') }}" autocomplete="off" placeholder="Nomor JKN" id="jkn_bumil">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('jkn_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="masa_berlaku_bumil">Masa Belaku</label>
                                                <div class="input-group">
                                                    <input type="text" name="masa_berlaku_bumil" autocomplete="off" class="form-control @error('masa_berlaku_bumil') is-invalid @enderror" value="{{ old('masa_berlaku_bumil') }}" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask id="masa_berlaku_bumil">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    @error('masa_berlaku_bumil')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="no_tlpn_bumil">Nomor Telp</label>
                                                <div class="input-group">
                                                    <input type="text" name="no_tlpn_bumil" class="form-control @error('no_tlpn_bumil') is-invalid @enderror" id="no_tlpn_bumil" value="{{ old('no_tlpn_bumil') }}" autocomplete="off" placeholder="Nomor telepon">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="telegram_bumil">Telegram</label>
                                                <div class="input-group">
                                                    <input type="text" name="telegram_bumil" class="form-control @error('telegram_bumil') is-invalid @enderror" id="telegram_bumil" value="{{ old('telegram_bumil') }}" autocomplete="off" placeholder="Username Telegram">
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
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alamat_bumil">Alamat<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="alamat_bumil" class="form-control @error('alamat_bumil') is-invalid @enderror" id="alamat_bumil" value="{{ old('alamat_bumil') }}" autocomplete="off" placeholder="Alamat tempat tinggal">
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
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email_bumil">Alamat E-Mail<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="email" name="email_bumil" class="form-control @error('email_bumil') is-invalid @enderror" id="email_bumil" value="{{ old('email_bumil') }}" autocomplete="off" placeholder="Alamat email aktif">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="passwordBumil">Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" name="passwordBumil" class="form-control @error('passwordBumil') is-invalid @enderror" id="passwordBumil" value="{{ old('passwordBumil') }}" autocomplete="off" placeholder="Masukkan Password" autocomplete="off">
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
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="mt-3">
                                                    <p class="text-danger small text-end"><span>*</span>Data Wajib Diisi</p>
                                                </div>
                                                <div class="input-group justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
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
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="no_kk_anak">Nomor KK<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="no_kk_anak" autocomplete="off" class="form-control @error('no_kk_anak') is-invalid @enderror" id="no_kk_anak" value="{{ old('no_kk_anak') }}" placeholder="Nomor KK">
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
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="nik_anak">NIK<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nik_anak" autocomplete="off" class="form-control @error('nik_anak') is-invalid @enderror" id="nik_anak" value="{{ old('nik_anak') }}" placeholder="Masukan NIK">
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
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="inputTelp">Scan KK<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file_anak" autocomplete="off" class="custom-file-input @error('file_anak') is-invalid @enderror"  id="inputTelp" autocomplete="off">
                                                        <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                        @error('file_anak')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="nama_anak">Nama Anak<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_anak" autocomplete="off" class="form-control @error('nama_anak') is-invalid @enderror" id="nama_anak" value="{{ old('nama_anak') }}" placeholder="Nama lengkap anak">
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
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="tempat_lahir_anak">Tempat Lahir<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="tempat_lahir_anak" class="form-control @error('tempat_lahir_anak') is-invalid @enderror" id="tempat_lahir_anak" value="{{ old('tempat_lahir_anak') }}" placeholder="Tempat lahir anak">
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
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal Lahir<span class="text-danger">*</span></label>
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
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="gender_anak">Jenis Kelamin<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="gender_anak" class="form-control @error('gender_anak') is-invalid @enderror" value="{{ old('gender_anak') }}" id="gender_anak">
                                                        @if ( old('gender_anak') )
                                                            <option selected value="{{ old('gender_anak') }}">{{ old('gender_anak') }}</option>
                                                            <option value="laki-laki">Laki-laki</option>
                                                            <option value="perempuan">Perempuan</option>
                                                        @else
                                                            <option selected disabled>Pilih jenis kelamin....</option>
                                                            <option value="laki-laki">Laki-laki</option>
                                                            <option value="perempuan">Perempuan</option>
                                                        @endif
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
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="status_anak">Status Anak<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="status_anak" autocomplete="off" class="form-control @error('status_anak') is-invalid @enderror" id="status_anak" value="{{ old('status_anak') }}" placeholder="Anak ke...">
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
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="agama_anak">Agama<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="agama_anak" class="form-control @error('agama_anak') is-invalid @enderror" value="{{ old('agama_anak') }}" id="agama_anak">
                                                        @if ( old('agama_anak') )
                                                            <option selected value="{{ old('agama_anak') }}">{{ old('agama_anak') }}</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Katolik">Katolik</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        @else
                                                            <option selected disabled>Pilih agama....</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Katolik">Katolik</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('agama_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="goldar_anak">Golongan Darah</label>
                                                <div class="input-group">
                                                    <select name="goldar_anak" class="form-control @error('goldar_anak') is-invalid @enderror" value="{{ old('goldar_anak') }}" id="goldar_anak">
                                                        @if ( old('goldar_anak') )
                                                            <option selected value="{{ old('goldar_anak') }}">{{ old('goldar_anak') }}</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @else
                                                            <option selected disabled>Golongan darah ...</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('goldar_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="nama_ayah">Nama Ayah<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_ayah" autocomplete="off" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="nama_ibu">Nama Ibu<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_ibu" autocomplete="off" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu">
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
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="tanggungan_anak">Tanggungan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="tanggungan_anak" class="form-control @error('tanggungan_anak') is-invalid @enderror" value="{{ old('tanggungan_anak') }}" id="tanggungan_anak">
                                                        @if ( old('tanggungan_anak') )
                                                            <option selected value="{{ old('tanggungan_anak') }}">{{ old('tanggungan_anak') }}</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @else
                                                            <option selected disabled>Tanggungan anak....</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('tanggungan_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="faskes_anak">Faskes Rujukan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="faskes_anak" class="form-control @error('faskes_anak') is-invalid @enderror" value="{{ old('faskes_anak') }}" autocomplete="off" placeholder="Faskes rujukan anak" id="faskes_anak">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('faskes_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="jkn_anak">Nomor JKN</label>
                                                <div class="input-group">
                                                    <input type="text" name="jkn_anak" class="form-control @error('jkn_anak') is-invalid @enderror" value="{{ old('jkn_anak') }}" autocomplete="off" placeholder="Nomor JKN" id="jkn_anak">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('jkn_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="masa_berlaku_anak">Masa Belaku</label>
                                                <div class="input-group">
                                                    <input type="text" name="masa_berlaku_anak" autocomplete="off" class="form-control @error('masa_berlaku_anak') is-invalid @enderror" value="{{ old('masa_berlaku_anak') }}" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask id="masa_berlaku_anak">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    @error('masa_berlaku_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="no_tlpn_anak">Nomor Telp</label>
                                                <div class="input-group">
                                                    <input type="text" name="no_tlpn_anak" autocomplete="off" class="form-control @error('no_tlpn_anak') is-invalid @enderror" id="no_tlpn_anak" value="{{ old('no_tlpn_anak') }}" placeholder="Nomor telepon">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="telegram_anak">Telegram</label>
                                                <div class="input-group">
                                                    <input type="text" name="telegram_anak" autocomplete="off" class="form-control @error('telegram_anak') is-invalid @enderror" id="telegram_anak" value="{{ old('telegram_anak') }}" placeholder="Username Telegram">
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
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alamat_anak">Alamat<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="alamat_anak" autocomplete="off" class="form-control @error('alamat_anak') is-invalid @enderror" id="alamat_anak" value="{{ old('alamat_anak') }}" placeholder="Alamat tempat tinggal">
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
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email_anak">Alamat E-Mail<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="email" name="email_anak" autocomplete="off" class="form-control @error('email_anak') is-invalid @enderror" id="email_anak" value="{{ old('email_anak') }}" placeholder="Alamat email aktif">
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
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="passwordAnak">Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" name="passwordAnak" autocomplete="off" class="form-control @error('passwordAnak') is-invalid @enderror" id="passwordAnak" value="{{ old('passwordAnak') }}" placeholder="Masukkan Password">
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
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="mt-3">
                                                    <p class="text-danger small text-end"><span>*</span>Data Wajib Diisi</p>
                                                </div>
                                                <div class="input-group justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
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
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="no_kk_lansia">Nomor KK<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="no_kk_lansia" autocomplete="off" class="form-control @error('no_kk_lansia') is-invalid @enderror" id="no_kk_lansia" value="{{ old('no_kk_lansia') }}" placeholder="Nomor KK">
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
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="nik_lansia">NIK<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nik_lansia" autocomplete="off" class="form-control @error('nik_lansia') is-invalid @enderror" id="nik_lansia" value="{{ old('nik_lansia') }}" placeholder="Masukan NIK">
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
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="file_lansia">Scan KK<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file_lansia" autocomplete="off" class="custom-file-input @error('file_lansia') is-invalid @enderror" id="file_lansia" autocomplete="off">
                                                        <label class="custom-file-label" for="exampleInputFile">Unggah Scan KK</label>
                                                        @error('file_lansia')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="nama_lansia">Nama Lansia<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_lansia" autocomplete="off" class="form-control @error('nama_lansia') is-invalid @enderror" id="nama_lansia" value="{{ old('nama_lansia') }}" placeholder="Nama lengkap lansia">
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
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="tempat_lahir_lansia">Tempat Lahir<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="tempat_lahir_lansia" autocomplete="off" class="form-control @error('tempat_lahir_lansia') is-invalid @enderror" id="tempat_lahir_lansia" value="{{ old('tempat_lahir_lansia') }}" placeholder="Tempat lahir lansia">
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
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <label for="tgl_lahir_lansia">Tanggal Lahir<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="tgl_lahir_lansia" autocomplete="off" class="form-control @error('tgl_lahir_lansia') is-invalid @enderror" id="tgl_lahir_lansia" value="{{ old('tgl_lahir_lansia') }}" placeholder="Tanggal lahir lansia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="gender_lansia">Jenis Kelamin<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="gender_lansia" class="form-control @error('gender_lansia') is-invalid @enderror" value="{{ old('gender_lansia') }}" id="gender_lansia">
                                                        @if ( old('gender_lansia') )
                                                            <option selected value="{{ old('gender_lansia') }}">{{ old('gender_lansia') }}</option>
                                                            <option value="laki-laki">Laki-laki</option>
                                                            <option value="perempuan">Perempuan</option>
                                                        @else
                                                            <option selected disabled>Pilih jenis kelamin....</option>
                                                            <option value="laki-laki">Laki-laki</option>
                                                            <option value="perempuan">Perempuan</option>
                                                        @endif
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
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="status_lansia">Status Lansia<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="status_lansia" autocomplete="off" class="form-control @error('status_lansia') is-invalid @enderror" id="status_lansia" value="{{ old('status_lansia') }}" id="status_lansia">
                                                        @if ( old('status_lansia') )
                                                            <option selected value="{{ old('status_lansia') }}">{{ old('status_lansia') }}</option>
                                                            <option value="Pra Lansia">Pra Lansia</option>
                                                            <option value="Lansia">Lansia</option>
                                                            <option value="Lansia Beresiko">Lansia Beresiko</option>
                                                        @else
                                                            <option selected disabled>Pilih status lansia....</option>
                                                            <option value="Pra Lansia">Pra Lansia</option>
                                                            <option value="Lansia">Lansia</option>
                                                            <option value="Lansia Beresiko">Lansia Beresiko</option>
                                                        @endif
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
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="agama_lansia">Agama<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="agama_lansia" class="form-control @error('agama_lansia') is-invalid @enderror" value="{{ old('agama_lansia') }}" id="agama_lansia">
                                                        @if ( old('agama_lansia') )
                                                            <option selected value="{{ old('agama_lansia') }}">{{ old('agama_lansia') }}</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Katolik">Katolik</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        @else
                                                            <option selected disabled>Pilih agama....</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Budha">Budha</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Katolik">Katolik</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('agama_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="goldar_lansia">Golongan Darah</label>
                                                <div class="input-group">
                                                    <select name="goldar_lansia" class="form-control @error('goldar_lansia') is-invalid @enderror" value="{{ old('goldar_lansia') }}" id="goldar_lansia">
                                                        @if ( old('goldar_lansia') )
                                                            <option selected value="{{ old('goldar_lansia') }}">{{ old('goldar_lansia') }}</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @else
                                                            <option selected disabled>Golongan darah ...</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('goldar_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="tanggungan_lansia">Tanggungan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="tanggungan_lansia" class="form-control @error('tanggungan_lansia') is-invalid @enderror" value="{{ old('tanggungan_lansia') }}" id="tanggungan_lansia">
                                                        @if ( old(' tanggungan_lansia') )
                                                            <option selected value="{{ old('tanggungan_lansia') }}">{{ old('tanggungan_lansia') }}</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @else
                                                            <option selected disabled>Tanggungan lansia....</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @endif
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('tanggungan_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="faskes_lansia">Faskes Rujukan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="faskes_lansia" class="form-control @error('faskes_lansia') is-invalid @enderror" value="{{ old('faskes_lansia') }}" autocomplete="off" placeholder="Faskes rujukan lansia" id="faskes_lansia">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('faskes_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="jkn_lansia">Nomor JKN</label>
                                                <div class="input-group">
                                                    <input type="text" name="jkn_lansia" class="form-control @error('jkn_lansia') is-invalid @enderror" value="{{ old('jkn_lansia') }}" autocomplete="off" placeholder="Nomor JKN" id="jkn_lansia">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-arrow-left"></span>
                                                        </div>
                                                    </div>
                                                    @error('jkn_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="masa_berlaku_lansia">Masa Belaku</label>
                                                <div class="input-group">
                                                    <input type="text" name="masa_berlaku_lansia" autocomplete="off" class="form-control @error('masa_berlaku_lansia') is-invalid @enderror" value="{{ old('masa_berlaku_lansia') }}" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask id="masa_berlaku_lansia">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    @error('masa_berlaku_lansia')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="no_tlpn_lansia">Nomor Telp</label>
                                                <div class="input-group">
                                                    <input type="text" name="no_tlpn_lansia" autocomplete="off" class="form-control @error('no_tlpn_lansia') is-invalid @enderror" id="no_tlpn_lansia" value="{{ old('no_tlpn_lansia') }}" placeholder="Nomor telepon">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="telergam_lansia">Telegram</label>
                                                <div class="input-group">
                                                    <input type="text" name="telegram_lansia" autocomplete="off" class="form-control @error('telegram_lansia') is-invalid @enderror" id="telergam_lansia" value="{{ old('telegram_lansia') }}" placeholder="Username Telegram">
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
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alamat_lansia">Alamat<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="alamat_lansia" autocomplete="off" class="form-control @error('alamat_lansia') is-invalid @enderror" id="alamat_lansia" value="{{ old('alamat_lansia') }}" placeholder="Alamat tempat tinggal">
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
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="email_lansia">Alamat E-Mail<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="email" name="email_lansia" autocomplete="off" class="form-control @error('email_lansia') is-invalid @enderror" id="email_lansia" value="{{ old('email_lansia') }}" placeholder="Alamat email aktif">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="passwordLansia">Password<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="password" name="passwordLansia" autocomplete="off" class="form-control @error('passwordLansia') is-invalid @enderror" id="passwordLansia" value="{{ old('passwordLansia') }}" placeholder="Masukkan Password">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="mt-3">
                                                    <p class="text-danger small text-end"><span>*</span>Data Wajib Diisi</p>
                                                </div>
                                                <div class="input-group justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
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
            $('#list-management-account').addClass('menu-is-opening menu-open');
            $('#management-account').addClass('active');
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


    @if($message = Session::get('failed'))
    <script>
        $(document).ready(function(){
            alertDanger('{{$message}}');
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
