@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Lansia')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
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
        @if ($errors->any())
            <div class="alert alert-danger text-center" role="alert">
                <span>Terdapat kesalahan dalam penginputan data. Periksa kembali input data sebelumnya!</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Data Anggota', $dataUser->id ) }}?{{date('YmdHis')}}" alt="Profile Admin" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{ $dataUser->lansia->nama_lansia }}</h3>
                        <p class="text-muted text-center">{{ $dataUser->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Status Keluarga</b>
                                <a class="float-right text-decoration-none link-dark">Lansia</a>
                            </li>
                            @if ( $dataUser->lansia->jenis_kelamin == 'laki-laki')
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
                                <a class="float-right text-decoration-none link-dark">{{ date('d-M-Y', strtotime($dataUser->created_at)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#info" data-toggle="tab">Informasi</a></li>
                            <li class="nav-item"><a class="nav-link" href="#ubahData" data-toggle="tab">Ubah Data</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pj" data-toggle="tab">Penanggung Jawab</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->nama_lansia }}" disabled readonly>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->NIK }}" disabled readonly>
                                    <label for="floatingInput">Nomor Induk Kependudukan</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->tempat_lahir }}" disabled readonly>
                                            <label for="floatingInput">Tempat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ date('d-M-Y', strtotime($dataUser->lansia->tanggal_lahir)) }}" disabled readonly>
                                            <label for="floatingInput">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->nomor_telepon == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->nomor_telepon }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Nomor Telp</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->username_tele == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Username Telegram belum dimasukan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->username_tele }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Username Telegram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <div class="card-body bg-light my-auto">
                                        <p class="fs-5 fw-bold my-auto">Scan Kartu Keluarga</p>
                                    </div>
                                    <img src="{{ route('Get Image Data Anggota KK', $dataUser->id_kk ) }}" class="card-img-buttom" alt="{{ $dataUser->kk->no_kk }}">
                                </div>
                            </div>
                            <div class="tab-pane" id="info">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->pendidikan_terakhir == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->pendidikan_terakhir }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Pendidikan Terakhir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->pekerjaan == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->pekerjaan }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Pekerjaan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->status_perkawinan == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->status_perkawinan }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Status Perkawinan</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->sumber_biaya_hidup == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->sumber_biaya_hidup }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Sumber Biaya Hidup</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->jumlah_keluarga_serumah == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->jumlah_keluarga_serumah }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Jumlah Keluarga Serumah</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->jumlah_anak == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->jumlah_anak }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Jumlah Anak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->jumlah_cucu == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->jumlah_cucu }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Jumlah Cucu</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->jumlah_cicit == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->lansia->jumlah_cicit }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Jumlah Cicit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    @if ($dataUser->lansia->tempat_tinggal == NULL)
                                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                    @else
                                        <input type="text" class="form-control" value="{{ $dataUser->lansia->tempat_tinggal }}" disabled readonly>
                                    @endif
                                    <label for="floatingInput">Tempat Tinggal</label>
                                </div>
                                <div class="form-floating mb-3">
                                    @if ($dataUser->lansia->alamat == NULL)
                                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                    @else
                                        <input type="text" class="form-control" value="{{ $dataUser->lansia->alamat }}" disabled readonly>
                                    @endif
                                    <label for="floatingInput">Alamat</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->agama == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{    $dataUser->agama }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->tanggungan == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->tanggungan }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Tanggungan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->no_jkn == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{   $dataUser->no_jkn }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Nomor JKN</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->masa_berlaku == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ date('d-M-Y', strtotime($dataUser->masa_berlaku)) }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Masa Berlaku</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    @if ($dataUser->faskes_rujukan == NULL)
                                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                    @else
                                        <input type="text" class="form-control" value="{{ $dataUser->faskes_rujukan }}" disabled readonly>
                                    @endif
                                    <label for="floatingInput">Faskes Rujukan</label>
                                </div>
                            </div>
                            <div class="tab-pane" id="ubahData">
                                <form action="{{ route('Update Anggota Lansia', [$dataUser->lansia->id]) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama_lansia" value="{{ old('nama', $dataUser->lansia->nama_lansia) }}" placeholder="Nama Lengkap Lansia">
                                        <label for="nama_lansia">Nama Lengkap<span class="text-danger">*</span></label>
                                        @error('nama')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik', $dataUser->lansia->NIK) }}" placeholder="NIK Lansia">
                                        <label for="nik">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
                                        @error('nik')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir', $dataUser->lansia->tempat_lahir) }}" placeholder="Tempat Lahir Lansia">
                                                <label for="tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', date('d-m-Y', strtotime($dataUser->lansia->tanggal_lahir))) }}" id="tgl_lahir" placeholder="Tanggal Lahir Lansia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                    <label for="tgl_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                                                    @error('tgl_lahir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    @if ( $dataUser->lansia->pendidikan_terakhir == NULL )
                                                        <select name="pendidikan_terakhir" class="form-select @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir">
                                                            <option selected disabled>Pendidikan Terakhir* ...</option>
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
                                                        </select>
                                                    @endif
                                                    @if ( $dataUser->lansia->pendidikan_terakhir != NULL )
                                                        <select name="pendidikan_terakhir" class="form-select @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir">
                                                            <option selected value="{{ $dataUser->lansia->pendidikan_terakhir }}">{{ $dataUser->lansia->pendidikan_terakhir }}</option>
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
                                                        </select>
                                                    @endif
                                                    @error('pendidikan_terakhir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="input-group mb-3">
                                                @if ( $dataUser->lansia->pekerjaan == NULL )
                                                    <select name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" id="pekerjaan">
                                                        <option selected disabled>Pekerjaan Terakhir* ...</option>
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
                                                    </select>
                                                @endif
                                                @if ( $dataUser->lansia->pekerjaan != NULL )
                                                    <select name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" id="pekerjaan">
                                                        <option selected value="{{ $dataUser->lansia->pekerjaan }}">{{ $dataUser->lansia->pekerjaan }}</option>
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
                                                    </select>
                                                @endif
                                                @error('pekerjaan')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    @if ( $dataUser->lansia->status_perkawinan == NULL )
                                                        <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan">
                                                            <option selected disabled>Pilih Status Perkawinan* ...</option>
                                                            <option value="Menikah/Kawin">Menikah/Kawin</option>
                                                            <option value="Tidak Menikah/Kawin">Tidak Menikah/Kawin</option>
                                                            <option value="Janda">Janda</option>
                                                            <option value="Duda">Duda</option>
                                                        </select>
                                                    @endif
                                                    @if ( $dataUser->lansia->status_perkawinan != NULL )
                                                        <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan">
                                                            <option selected value="{{ $dataUser->lansia->status_perkawinan }}">{{ $dataUser->lansia->status_perkawinan }}</option>
                                                            <option value="Menikah/Kawin">Menikah/Kawin</option>
                                                            <option value="Tidak Menikah/Kawin">Tidak Menikah/Kawin</option>
                                                            <option value="Janda">Janda</option>
                                                            <option value="Duda">Duda</option>
                                                        </select>
                                                    @endif
                                                    @error('status_perkawinan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control @error('jumlah_anak') is-invalid @enderror" name="jumlah_anak" value="{{ old('jumlah_anak', $dataUser->lansia->jumlah_anak) }}" placeholder="Jumlah Anak*">
                                                    @error('jumlah_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    @if ( $dataUser->lansia->sumber_biaya_hidup == NULL )
                                                        <select name="sumber_biaya_hidup" class="form-select @error('sumber_biaya_hidup') is-invalid @enderror" id="sumber_biaya_hidup">
                                                            <option selected disabled>Sumber Biaya Hidup* ...</option>
                                                            <option value="Uang Pensiunan">Uang Pensiunan</option>
                                                            <option value="Ditanggung Anak">Ditanggung Anak</option>
                                                            <option value="Ditanggung Kerabat/Saudara">Ditanggung Kerabat/Saudara</option>
                                                            <option value="Ditanggung Pemerintah">Ditanggung Pemerintah</option>
                                                            <option value="Ditanggung Pihak Swasta">Ditanggung Pihak Swasta</option>
                                                            <option value="Penghasilan Pribadi">Penghasilan Pribadi</option>
                                                        </select>
                                                    @endif
                                                    @if ( $dataUser->lansia->sumber_biaya_hidup != NULL )
                                                        <select name="sumber_biaya_hidup" class="form-select @error('sumber_biaya_hidup') is-invalid @enderror" id="sumber_biaya_hidup">
                                                            <option selected value="{{ $dataUser->lansia->sumber_biaya_hidup }}">{{ $dataUser->lansia->sumber_biaya_hidup }}</option>
                                                            <option value="Uang Pensiunan">Uang Pensiunan</option>
                                                            <option value="Ditanggung Anak">Ditanggung Anak</option>
                                                            <option value="Ditanggung Kerabat/Saudara">Ditanggung Kerabat/Saudara</option>
                                                            <option value="Ditanggung Pemerintah">Ditanggung Pemerintah</option>
                                                            <option value="Ditanggung Pihak Swasta">Ditanggung Pihak Swasta</option>
                                                            <option value="Penghasilan Pribadi">Penghasilan Pribadi</option>
                                                        </select>
                                                    @endif
                                                    @error('sumber_biaya_hidup')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control @error('jumlah_keluarga_serumah') is-invalid @enderror" name="jumlah_keluarga_serumah" value="{{ old('jumlah_keluarga_serumah', $dataUser->lansia->jumlah_keluarga_serumah) }}" placeholder="Jumlah Keluarga Serumah*">
                                                    @error('jumlah_keluarga_serumah')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control @error('jumlah_cucu') is-invalid @enderror" name="jumlah_cucu" value="{{ old('jumlah_cucu', $dataUser->lansia->jumlah_cucu) }}" placeholder="Jumlah Cucu Kandung*">
                                                    @error('jumlah_cucu')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control @error('jumlah_cicit') is-invalid @enderror" name="jumlah_cicit" value="{{ old('jumlah_cicit', $dataUser->lansia->jumlah_cicit) }}" placeholder="Jumlah Cicit Kandung*">
                                                    @error('jumlah_cicit')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    @if ( $dataUser->tanggungan == NULL )
                                                        <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan">
                                                            <option selected disabled>Pilih tanggungan* ...</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        </select>
                                                    @endif
                                                    @if ( $dataUser->tanggungan == 'Dengan Tanggungan' )
                                                        <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan">
                                                            <option selected value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        </select>
                                                    @endif
                                                    @if ( $dataUser->tanggungan == 'Tanpa Tanggungan' )
                                                        <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan">
                                                            <option selected value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                        </select>
                                                    @endif
                                                    @error('tanggungan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    @if ($dataUser->golongan_darah == NULL)
                                                        <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                                            <option selected disabled>Pilih golongan darah ...</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        </select>
                                                    @endif
                                                    @if ($dataUser->golongan_darah == 'A')
                                                        <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                                            <option selected value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        </select>
                                                    @endif
                                                    @if ($dataUser->golongan_darah == 'B')
                                                        <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                                            <option selected value="B">B</option>
                                                            <option value="A">A</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        </select>
                                                    @endif
                                                    @if ($dataUser->golongan_darah == 'AB')
                                                        <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                                            <option selected value="AB">AB</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="O">O</option>
                                                        </select>
                                                    @endif
                                                    @if ($dataUser->golongan_darah == 'O')
                                                        <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                                            <option selected value="O">O</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                        </select>
                                                    @endif
                                                    @error('goldar')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                @if ($dataUser->no_jkn == NULL && $dataUser->tanggungan == NULL)
                                                    <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" placeholder="Nomor JKN">
                                                    <label for="no_jkn">Nomor JKN<span class="text-danger">*</span></label>
                                                @else
                                                    @if ( $dataUser->no_jkn == NULL)
                                                        <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" value="{{ old('no_jkn', $dataUser->no_jkn) }}" placeholder="Nomor JKN">
                                                        <label for="no_jkn">Nomor JKN</label>
                                                    @else
                                                        <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" value="{{ old('no_jkn', $dataUser->no_jkn) }}" placeholder="Nomor JKN">
                                                        <label for="no_jkn">Nomor JKN<span class="text-danger">*</span></label>
                                                    @endif
                                                @endif
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
                                                    @if ($dataUser->no_jkn == NULL && $dataUser->tanggungan == NULL)
                                                        <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <label for="masa_berlaku">Masa Berlaku<span class="text-danger">*</span></label>
                                                    @else
                                                        @if ($dataUser->no_jkn == NULL)
                                                            <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <label for="masa_berlaku">Masa Berlaku</label>
                                                        @else
                                                            <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" value="{{ old('masa_berlaku', date('d-m-Y', strtotime($dataUser->masa_berlaku)) ) }}" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <label for="masa_berlaku">Masa Berlaku<span class="text-danger">*</span></label>
                                                        @endif
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
                                        <input type="text" name="faskes_rujukan" class="form-control @error('faskes_rujukan') is-invalid @enderror" id="faskes_rujukan" value="{{ old('faskes_rujukan', $dataUser->faskes_rujukan) }}" placeholder="Fasker rujukan">
                                        <label for="faskes_rujukan">Faskes Rujukan<span class="text-danger">*</span></label>
                                        @error('faskes_rujukan')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
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
                                    <form action="{{ route('Update Pj Lansia', $pj->id) }}" method="POST" class="form-horizontal">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama_pj" value="{{ old('nama', $pj->nama) }}" placeholder="Nama lengkap penanggung jawab lansia">
                                            <label for="nama_pj">Nama Lengkap<span class="text-danger">*</span></label>
                                            @error('nama')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-control select2 kabupaten @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" aria-label="Floating label select example">
                                                <option value="{{ $dataKabupaten->id_kabupaten }}" selected>{{ $dataKabupaten->nama_kabupaten }}</option>
                                                @foreach ($kabupaten as $k)
                                                    <option value="{{$k->id}}">{{ucfirst($k->nama_kabupaten)}}</option>
                                                @endforeach
                                            </select>
                                            <label for="kabupaten">Pilih Kabupaten<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select id="kecamatan" class="form-control select2 kecamatan @error('kecamatan') is-invalid @enderror" name="kecamatan" aria-label="Floating label select example">
                                                <option value="{{ $dataKecamatan->id_kecamatan }}" selected>{{ $dataKecamatan->nama_kecamatan }}</option>
                                            </select>
                                            <label for="kecamatan">Pilih Kecamatan<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select id="desa" name="desa" class="form-control select2 @error('desa') is-invalid @enderror" aria-label="Floating label select example">
                                                <option value="{{ $pj->id_desa }}" selected>{{ $pj->desa->nama_desa }}</option>
                                            </select>
                                            @error('desa')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label for="desa">Pilih Desa<span class="text-danger">*</span></label>
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
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat tempat tinggal">{{ old('alamat', $pj->alamat) }}</textarea>
                                            <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                            @error('alamat')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
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
                                    <form action="{{ route('Tambah Pj Lansia', $dataUser->lansia->id) }}" method="POST" class="form-horizontal">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama_pj" value="{{ old('nama') }}" placeholder="Nama lengkap penanggung jawab lansia">
                                            <label for="nama_pj">Nama Lengkap<span class="text-danger">*</span></label>
                                            @error('nama')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select kabupaten @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" aria-label="Floating label select example">
                                                <option disabled selected>Silakan pilih Kabupaten</option>
                                                @foreach ($kabupaten as $k)
                                                    <option value="{{$k->id}}">{{ucfirst($k->nama_kabupaten)}}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelect">Pilih Kabupaten</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select id="kecamatan" class="form-select kecamatan @error('kecamatan') is-invalid @enderror" name="kecamatan" aria-label="Floating label select example">
                                                <option disabled selected>Pilih Kabupaten terlebih dahulu</option>
                                            </select>
                                            @error('kecamatan')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label for="kecamatan">Pilih Kecamatan<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select id="desa" name="desa" class="form-select @error('desa') is-invalid @enderror" aria-label="Floating label select example">
                                                <option disabled selected>Pilih Kecamatan terlebih dahulu</option>
                                            </select>
                                            @error('kecamatan')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label for="desa">Pilih Desa<span class="text-danger">*</span></label>
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
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat tempat tinggal">{{ old('alamat') }}</textarea>
                                            <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                            @error('alamat')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
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
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-management-posyandu').addClass('menu-is-opening menu-open');
            $('#management-posyandu').addClass('active');
            $('#data-anggota').addClass('active');

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

            // Kabupaten to Kecamatan AJAX //
            $('#kabupaten').on('change', function () {
                let id = $(this).val();
                $('#kecamatan').empty().append(`<option disabled selected>Silakan pilih Kabupaten</option>`);
                $('#kecamatan').append(`<option value="0" disabled selected>Silakan tunggu ...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#kecamatan').empty();
                        $('#kecamatan').append(`<option value="0" disabled selected>Silakan pilih Kecamatan</option>`);
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
                        $('#desa').append(`<option value="0" disabled selected>Silakan pilih Desa/Kelurahan</option>`);
                        response.forEach(element => {
                            $('#desa').append(`<option value="${element['id']}">${element['nama_desa']}</option>`);
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
