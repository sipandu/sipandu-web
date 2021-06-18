@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Lansia')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <style>
        .image {
            width: 150px;
            height: 150px;
            overflow: hidden;
        }
        .image img {
            object-fit: cover;
            width: 150px;
            height: 150px;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Profile Lansia</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Anggota') }}">Data Anggota Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Profile Lansia</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline sticky-top">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Profile Image Anggota', $anggota->id ) }}?{{date('YmdHis')}}" alt="Profile Anggota Lansia" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{ $anggota->lansia->nama_lansia }}</h3>
                        <p class="text-muted text-center">{{ $anggota->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Status Keluarga</b>
                                <a class="float-right text-decoration-none link-dark">Lansia</a>
                            </li>
                            @if ( $anggota->lansia->jenis_kelamin == 'laki-laki')
                                <li class="list-group-item">
                                    <b class="fw-bold">Jenis Kelamin</b>
                                    <a class="float-right text-decoration-none link-dark">Laki-laki</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Jenis Kelamin</b>
                                    <a class="float-right text-decoration-none link-dark">Perempuan</a>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <b class="fw-bold">Usia</b>
                                <a class="float-right text-decoration-none link-dark">{{ $umur }} Tahun</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d M Y', strtotime($anggota->created_at)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item"><a class="nav-link active" id="tabProfile" href="#profile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabInfo" href="#info" data-toggle="tab">Informasi</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabUbahProfile" href="#ubahProfile" data-toggle="tab">Ubah Data</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabPj" href="#pj" data-toggle="tab">Penanggung Jawab</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->lansia->nama_lansia }}" disabled readonly>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->lansia->NIK ?? 'Belum Ditambahkan' }}" disabled readonly>
                                    <label for="floatingInput">Nomor Induk Kependudukan</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->lansia->tempat_lahir ??'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Tempat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ date('d M Y', strtotime($anggota->lansia->tanggal_lahir)) ?? '' }}" disabled readonly>
                                            <label for="floatingInput">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->lansia->nomor_telepon ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Nomor Telp</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->username_tele ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Username Telegram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <div class="card-body bg-light my-auto">
                                        <p class="fs-5 fw-bold my-auto">Scan Kartu Keluarga</p>
                                    </div>
                                    <img src="{{ route('Get KK Anggota', $anggota->id_kk ) }}" class="card-img-buttom" alt="Scan KK Anggota Lansia">
                                </div>
                            </div>
                            <div class="tab-pane" id="info">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->pendidikan_terakhir ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Pendidikan Terakhir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->pekerjaan ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Pekerjaan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->status_perkawinan ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Status Perkawinan</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->sumber_biaya_hidup ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Sumber Biaya Hidup</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->jumlah_keluarga_serumah ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Jumlah Keluarga Serumah</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->jumlah_anak ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Jumlah Anak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->jumlah_cucu ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Jumlah Cucu</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->lansia->jumlah_cicit ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Jumlah Cicit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $anggota->lansia->tempat_tinggal ?? 'Belum Ditambahkan' }}" disabled readonly>
                                    <label for="floatingInput">Tempat Tinggal</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $anggota->lansia->alamat ?? 'Belum Ditambahkan' }}" disabled readonly>
                                    <label for="floatingInput">Alamat</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->agama ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->tanggungan ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Tanggungan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->no_jkn ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Nomor JKN</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ date('d-M-Y', strtotime($anggota->masa_berlaku)) ?? '' }}" disabled readonly>
                                            <label for="floatingInput">Masa Berlaku</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $anggota->faskes_rujukan ?? 'Belum Ditambahkan' }}" disabled readonly>
                                    <label for="floatingInput">Faskes Rujukan</label>
                                </div>
                            </div>
                            <div class="tab-pane" id="ubahProfile">
                                <form action="{{ route('Update Anggota Lansia', $anggota->lansia->id) }}" method="POST" class="form-horizontal needs-validation my-auto" novalidate>
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama_lansia" class="form-control @error('nama_lansia') is-invalid @enderror" id="nama_lansia" value="{{ old('nama_lansia', $anggota->lansia->nama_lansia) }}" placeholder="Nama lengkap lansia" required autocomplete="off">
                                        <label for="nama_lansia">Nama Lengkap<span class="text-danger">*</span></label>
                                        @error('nama_lansia')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Nama lansia wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik', $anggota->lansia->NIK) }}" placeholder="NIK lansia" required autocomplete="off">
                                        <label for="nik">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
                                        @error('nik')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                NIK lansia wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir', $anggota->lansia->tempat_lahir) }}" placeholder="Tempat lahir lansia" required>
                                                <label for="tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Tempat lahir lansia wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', date('d-m-Y', strtotime($anggota->lansia->tanggal_lahir))) }}" id="tgl_lahir" placeholder="Tanggal Lahir Lansia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask required>
                                                    <label for="tgl_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                                                    @error('tgl_lahir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Tanggal lahir lansia wajib diisi
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="pendidikan_terakhir" class="form-select @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir" required>
                                                        @if ( $anggota->lansia->pendidikan_terakhir == NULL )
                                                            <option selected disabled>Pendidikan Terakhir ...</option>
                                                            <option value="SD">Sekolah Dasar</option>
                                                            <option value="SMP">Sekolah Menengah Pertama</option>
                                                            <option value="SMA">Sekolah Menengah Atas</option>
                                                            <option value="SMK">Sekolah Menengah Kejuruan</option>
                                                            <option value="SLTA">SLTA</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="S1">Strata Satu</option>
                                                            <option value="S2">Strata Dua</option>
                                                            <option value="S3">Strata Tiga</option>
                                                            <option value="Tidak Bersekolah">Tidak Bersekolah</option>
                                                        @endif
                                                        @if ( $anggota->lansia->pendidikan_terakhir != NULL )
                                                            <option selected value="{{ $anggota->lansia->pendidikan_terakhir }}">{{ $anggota->lansia->pendidikan_terakhir }}</option>
                                                            <option value="SD">Sekolah Dasar</option>
                                                            <option value="SMP">Sekolah Menengah Pertama</option>
                                                            <option value="SMA">Sekolah Menengah Atas</option>
                                                            <option value="SMK">Sekolah Menengah Kejuruan</option>
                                                            <option value="SLTA">SLTA</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="S1">Strata Satu</option>
                                                            <option value="S2">Strata Dua</option>
                                                            <option value="S3">Strata Tiga</option>
                                                            <option value="Tidak Bersekolah">Tidak Bersekolah</option>
                                                        @endif
                                                    </select>
                                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                                    @error('pendidikan_terakhir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Pendidikan Terakhir lansia wajib dipilih
                                                        </div>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" id="pekerjaan" required>
                                                    @if ( $anggota->lansia->pekerjaan == NULL )
                                                        <option selected disabled>Pilih pekerjaan terakhir ...</option>
                                                        <option value="Pegawai Swasta">Pegawai Swasta</option>
                                                        <option value="PNS">PNS</option>
                                                        <option value="Guru">Guru</option>
                                                        <option value="TNI">TNI</option>
                                                        <option value="Polri">Polri</option>
                                                        <option value="Tenaga Kesehatan">Tenaga Kesehatan</option>
                                                        <option value="Pemilik Usaha">Pemilik Usaha</option>
                                                        <option value="Dosen">Dosen</option>
                                                        <option value="Petani">Petani</option>
                                                        <option value="Lain-lain">Lain-lain</option>
                                                    @endif
                                                    @if ( $anggota->lansia->pekerjaan != NULL )
                                                        <option selected value="{{ $anggota->lansia->pekerjaan }}">{{ $anggota->lansia->pekerjaan }}</option>
                                                        <option value="Pegawai Swasta">Pegawai Swasta</option>
                                                        <option value="PNS">PNS</option>
                                                        <option value="Guru">Guru</option>
                                                        <option value="TNI">TNI</option>
                                                        <option value="Polri">Polri</option>
                                                        <option value="Tenaga Kesehatan">Tenaga Kesehatan</option>
                                                        <option value="Pemilik Usaha">Pemilik Usaha</option>
                                                        <option value="Dosen">Dosen</option>
                                                        <option value="Petani">Petani</option>
                                                        <option value="Lain-lain">Lain-lain</option>
                                                    @endif
                                                </select>
                                                <label for="pekerjaan">Pekerjaan Terakhir</label>
                                                @error('pekerjaan')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Pekerjaan terakhir lansia wajib dipilih
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan">
                                                    @if ( $anggota->lansia->status_perkawinan == NULL )
                                                        <option selected disabled>Pilih status perkawinan ...</option>
                                                        <option value="Menikah/Kawin">Menikah/Kawin</option>
                                                        <option value="Tidak Menikah/Kawin">Tidak Menikah/Kawin</option>
                                                        <option value="Janda">Janda</option>
                                                        <option value="Duda">Duda</option>
                                                    @endif
                                                    @if ( $anggota->lansia->status_perkawinan != NULL )
                                                        <option selected value="{{ $anggota->lansia->status_perkawinan }}">{{ $anggota->lansia->status_perkawinan }}</option>
                                                        <option value="Menikah/Kawin">Menikah/Kawin</option>
                                                        <option value="Tidak Menikah/Kawin">Tidak Menikah/Kawin</option>
                                                        <option value="Janda">Janda</option>
                                                        <option value="Duda">Duda</option>
                                                    @endif
                                                </select>
                                                <label for="floatingSelect">Status Perkawinan</label>
                                                @error('status_perkawinan')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Status perkawinan lansia wajib dipilih
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control @error('jumlah_anak') is-invalid @enderror" name="jumlah_anak" value="{{ old('jumlah_anak', $anggota->lansia->jumlah_anak) }}" placeholder="Jumlah Anak*">
                                                <label for="jumlah_anak">Jumlah Anak</label>
                                                @error('jumlah_anak')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="sumber_biaya_hidup" class="form-select @error('sumber_biaya_hidup') is-invalid @enderror" id="sumber_biaya_hidup">
                                                    @if ( $anggota->lansia->sumber_biaya_hidup == NULL )
                                                        <option selected disabled>Sumber biaya hidup ...</option>
                                                        <option value="Uang Pensiunan">Uang Pensiunan</option>
                                                        <option value="Ditanggung Anak">Ditanggung Anak</option>
                                                        <option value="Ditanggung Kerabat/Saudara">Ditanggung Kerabat/Saudara</option>
                                                        <option value="Ditanggung Pemerintah">Ditanggung Pemerintah</option>
                                                        <option value="Ditanggung Pihak Swasta">Ditanggung Pihak Swasta</option>
                                                        <option value="Penghasilan Pribadi">Penghasilan Pribadi</option>
                                                    @endif
                                                    @if ( $anggota->lansia->sumber_biaya_hidup != NULL )
                                                        <option selected value="{{ $anggota->lansia->sumber_biaya_hidup }}">{{ $anggota->lansia->sumber_biaya_hidup }}</option>
                                                        <option value="Uang Pensiunan">Uang Pensiunan</option>
                                                        <option value="Ditanggung Anak">Ditanggung Anak</option>
                                                        <option value="Ditanggung Kerabat/Saudara">Ditanggung Kerabat/Saudara</option>
                                                        <option value="Ditanggung Pemerintah">Ditanggung Pemerintah</option>
                                                        <option value="Ditanggung Pihak Swasta">Ditanggung Pihak Swasta</option>
                                                        <option value="Penghasilan Pribadi">Penghasilan Pribadi</option>
                                                    @endif
                                                </select>
                                                <label for="sumber_biaya_hidup">Sumber Biaya Hidup</label>
                                                @error('sumber_biaya_hidup')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Sumber biaya hidup lansia wajib dipilih
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control @error('jumlah_keluarga_serumah') is-invalid @enderror" name="jumlah_keluarga_serumah" id="jumlah_keluarga_serumah" value="{{ old('jumlah_keluarga_serumah', $anggota->lansia->jumlah_keluarga_serumah) }}" placeholder="Jumlah keluarga serumah" required>
                                                <label for="jumlah_keluarga_serumah">Jumlah Keluarga Serumah</label>
                                                @error('jumlah_keluarga_serumah')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Jumlah keluarga serumah wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control @error('jumlah_cucu') is-invalid @enderror" name="jumlah_cucu" value="{{ old('jumlah_cucu', $anggota->lansia->jumlah_cucu) }}" placeholder="Jumlah cucu kandung" required>
                                                <label for="jumlah_cucu">Jumlah Cucu</label>
                                                @error('jumlah_cucu')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Jumlah cucu wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control @error('jumlah_cicit') is-invalid @enderror" name="jumlah_cicit" value="{{ old('jumlah_cicit', $anggota->lansia->jumlah_cicit) }}" placeholder="Jumlah cicit kandung" required>
                                                <label for="jumlah_cicit">Jumlah Cicit</label>
                                                @error('jumlah_cicit')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Jumlah cicit wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan" required>
                                                    @if ( $anggota->tanggungan == NULL )
                                                        <option selected disabled>Pilih tanggungan ...</option>
                                                        <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                        <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                    @endif
                                                    @if ( $anggota->tanggungan == 'Dengan Tanggungan' )
                                                        <option selected value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                        <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                    @endif
                                                    @if ( $anggota->tanggungan == 'Tanpa Tanggungan' )
                                                        <option selected value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                    @endif
                                                </select>
                                                <label for="tanggungan">Tanggungan</label>
                                                @error('tanggungan')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Tanggungan lansia wajib dipilih
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                                    @if ($anggota->golongan_darah == NULL)
                                                        <option selected disabled>Pilih golongan darah ...</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    @endif
                                                    @if ($anggota->golongan_darah == 'A')
                                                        <option selected value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    @endif
                                                    @if ($anggota->golongan_darah == 'B')
                                                        <option selected value="B">B</option>
                                                        <option value="A">A</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    @endif
                                                    @if ($anggota->golongan_darah == 'AB')
                                                        <option selected value="AB">AB</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="O">O</option>
                                                    @endif
                                                    @if ($anggota->golongan_darah == 'O')
                                                        <option selected value="O">O</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                    @endif
                                                </select>
                                                <label for="goldar">Golongan Darah</label>
                                                @error('goldar')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Golongan darah lansia wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" value="{{ old('no_jkn', $anggota->no_jkn ?? '') }}" placeholder="Nomor JKN">
                                                <label for="no_jkn">Nomor JKN</label>
                                                @error('no_jkn')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    @if ($anggota->no_jkn == NULL)
                                                        <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <label for="masa_berlaku">Masa Berlaku</label>
                                                    @else
                                                        <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" value="{{ old('masa_berlaku', date('d-m-Y', strtotime($anggota->masa_berlaku)) ) }}" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <label for="masa_berlaku">Masa Berlaku<span class="text-danger">*</span></label>
                                                    @endif
                                                    @error('masa_berlaku')
                                                        <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="faskes_rujukan" class="form-control @error('faskes_rujukan') is-invalid @enderror" id="faskes_rujukan" value="{{ old('faskes_rujukan', $anggota->faskes_rujukan ?? '' ) }}" placeholder="Fasker rujukan">
                                        <label for="faskes_rujukan">Faskes Rujukan<span class="text-danger">*</span></label>
                                        @error('faskes_rujukan')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Faskes rujukan lansia wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group row m-0 p-0">
                                        <div class="col-sm-12 text-end">
                                            <p class="text-danger">* Data Wajib Diisi</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-grid">
                                            <button type="submit" class="btn btn-outline-success my-1">Simpan Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if ($pj != NULL)
                                <div class="tab-pane" id="pj">
                                    <form action="{{ route('Update PJ Lansia', $pj->id) }}" method="POST" class="form-horizontal needs-validation my-auto" novalidate>
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama_pj" value="{{ old('nama', $pj->nama) }}" placeholder="Nama lengkap penanggung jawab lansia" required>
                                            <label for="nama_pj">Nama Lengkap<span class="text-danger">*</span></label>
                                            @error('nama')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Nama penanggung jawab lansia wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" aria-label="Floating label select example">
                                                <option value="{{ $pj->hubungan_keluarga }}" selected>{{ $pj->hubungan_keluarga }}</option>
                                                <option value="Anak">Anak</option>
                                                <option value="Cucu">Cucu</option>
                                                <option value="Cicit">Cicit</option>
                                                <option value="Keponakan">Keponakan</option>
                                                <option value="Saudara/Kerabat">Saudara/Kerabat</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Status hubungan keluarga wajib diisi
                                                </div>
                                            @enderror
                                            <label for="status">Hubungan Keluarga<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" value="{{ old('no_telp', $pj->nomor_telepon) }}" placeholder="Nomor telepon penanggung jawab lansia">
                                            <label for="no_telp">Nomor Telepon<span class="text-danger">*</span></label>
                                            @error('no_telp')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Nomor telepon penangggung jawab lansia wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat tempat tinggal" style="height: 100px">{{ old('alamat', $pj->alamat) }}</textarea>
                                            <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                            @error('alamat')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Alamat penanggung jawab lansia wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group row m-0 p-0">
                                            <div class="col-sm-12 text-end">
                                                <p class="text-danger">* Data Wajib Diisi</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 d-grid">
                                                <button type="submit" class="btn btn-outline-success my-1">Simpan Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="tab-pane" id="pj">
                                    <form action="{{ route('Tambah PJ Lansia', $anggota->lansia->id) }}" method="POST" cclass="form-horizontal needs-validation my-auto" novalidate>
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama_pj" value="{{ old('nama') }}" placeholder="Nama lengkap penanggung jawab lansia">
                                            <label for="nama_pj">Nama Lengkap<span class="text-danger">*</span></label>
                                            @error('nama')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Nama penanggung jawab lansia wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" aria-label="Floating label select example">
                                                <option selected disabled>Pilih hubungan keluarga</option>
                                                <option value="Anak">Anak</option>
                                                <option value="Cucu">Cucu</option>
                                                <option value="Cicit">Cicit</option>
                                                <option value="Keponakan">Keponakan</option>
                                                <option value="Saudara/Kerabat">Saudara/Kerabat</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Status hubungan keluarga wajib diisi
                                                </div>
                                            @enderror
                                            <label for="status">Hubungan Keluarga<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" value="{{ old('no_telp') }}" placeholder="Nomor telepon penanggung jawab lansia">
                                            <label for="no_telp">Nomor Telepon<span class="text-danger">*</span></label>
                                            @error('no_telp')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Nomor telepon penangggung jawab lansia wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat tempat tinggal" style="height: 100px">{{ old('alamat') }}</textarea>
                                            <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                            @error('alamat')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Alamat penanggung jawab lansia wajib diisi
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group row m-0 p-0">
                                            <div class="col-sm-12 text-end">
                                                <p class="text-danger">* Data Wajib Diisi</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 d-grid">
                                                <button type="submit" class="btn btn-outline-success my-1">Simpan Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    
@push('js')    
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account').addClass('active');
            $('#data-anggota').addClass('active');

            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
            $('[data-mask]').inputmask()
        });
    </script>

    @if ($errors->has('nama_lansia') || $errors->has('nik') || $errors->has('tempat_lahir') || $errors->has('tgl_lahir') || $errors->has('pedidikan_terakhir') || $errors->has('pekerjaan') || $errors->has('status_perkawinan') || $errors->has('jumlah_anak') || $errors->has('sumber_biaya_hidup') || $errors->has('jumlah_keluarga_serumah') || $errors->has('jumlah_cucu') || $errors->has('jumlah_cicit') || $errors->has('tanggungan') || $errors->has('goldar') || $errors->has('no_jkn') || $errors->has('masa_berlaku') || $errors->has('faskes_rujukan'))
        <script>
            $(document).ready(function(){
                $('#tabProfile').removeClass('active');
                $('#profile').removeClass('active');
                $('#tabUbahProfile').addClass('active');
                $('#ubahProfile').addClass('active');
            });
        </script>
    @endif

    @if ($errors->has('nama') || $errors->has('status') || $errors->has('no_telp') || $errors->has('alamat'))
        <script>
            $(document).ready(function(){
                $('#tabProfile').removeClass('active');
                $('#profile').removeClass('active');
                $('#tabPj').addClass('active');
                $('#pj').addClass('active');
            });
        </script>
    @endif
    
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
