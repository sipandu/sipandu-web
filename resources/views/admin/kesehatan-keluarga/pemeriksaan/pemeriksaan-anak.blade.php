@extends('layouts/admin/admin-layout')

@section('title', 'Pemeriksaan Anak')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Pemeriksaan Anak</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Semua Pemeriksaan Anggota') }}">Pemeriksaan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Anak</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                @if ($persalinan == NULL)
                    <div class="alert alert-primary text-center fs-5" role="alert">
                        <span class="text-dark">Silakan isi data kehiran anak terlebih dahulu untuk mulai melakukan pemeriksaan</span>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-8 order-2 order-md-1 mb-3">
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                @if ($persalinan != NULL)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemeriksaan Anak</p></div>
                                            <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPemeriksaan" role="button" aria-expanded="false" aria-controls="tambahPemeriksaan"><i class="fas fa-plus-circle"></i></a></div>
                                        </div>
                                        <div class="collapse my-3" id="tambahPemeriksaan">
                                            <form action="{{ route('Simpan Pemeriksaan Anak', $dataAnak->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="lingkar_kepala">Lingkar Kepala<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="lingkar_kepala" autocomplete="off" class="form-control @error('lingkar_kepala') is-invalid @enderror" id="lingkar_kepala" value="{{ old('lingkar_kepala') }}" placeholder="Lingkar kepada">
                                                            <span class="input-group-text" id="basic-addon2">cm</span>
                                                            @error('lingkar_kepala')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="berat_badan">Berat Badan<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="berat_badan" autocomplete="off" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" value="{{ old('berat_badan') }}" placeholder="Berat Anak">
                                                            <span class="input-group-text" id="basic-addon2">gram</span>
                                                            @error('berat_badan')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="tinggi_badan">Tinggi Badan<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="tinggi_badan" autocomplete="off" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" value="{{ old('tinggi_badan') }}" placeholder="Tinggi Anak">
                                                            <span class="input-group-text" id="basic-addon2">cm</span>
                                                            @error('tinggi_badan')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="tgl_kembali">Tanggal Kembali<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="tgl_kembali" autocomplete="off" class="form-control @error('tgl_kembali') is-invalid @enderror" id="tgl_kembali" value="{{ old('tgl_kembali') }}"  placeholder="Tanggal periksa kembali" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-calendar-check"></i>
                                                                </span>
                                                            </div>
                                                            @error('tgl_kembali')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <label for="status_gizi">Status Gizi<span class="text-danger">*</span></label>
                                                        <select class="form-select @error('status_gizi') is-invalid @enderror" name="status_gizi" id="status_gizi" aria-label="Default select example">
                                                            <option disabled selected>Pilih status gizi anak berdasarkan hasil pemeriksaan</option>
                                                            <option class="text-success" value="Cukup Gizi">Cukup Gizi</option>
                                                            <option class="text-danger" value="Kurang Gizi">Kurang Gizi</option>
                                                            <option class="text-warning" value="Kelebihan Gizi">Kelebihan Gizi</option>
                                                        </select>
                                                        @error('status_gizi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <div class="form-floating">
                                                            <textarea name="lokasiPemeriksaan" class="form-control @error('lokasiPemeriksaan') is-invalid @enderror" id="lokasiPemeriksaan" placeholder="Masukan lokasi pemeriksaan">{{ $dataAnak->posyandu->nama_posyandu }}</textarea>
                                                            <label for="lokasiPemeriksaan">
                                                                Lokasi Pemeriksaan
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            @error('lokasiPemeriksaan')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <div class="form-floating">
                                                            <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan hasil pemeriksaan"></textarea>
                                                            <label for="keterangan">Hasil Pemeriksaan<span class="text-danger">*</span></label>
                                                            @error('diagnosa')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <div class="form-floating">
                                                            <textarea name="pengobatan" class="form-control @error('pengobatan') is-invalid @enderror" id="pengobatan" placeholder="Masukan obat atau resep"></textarea>
                                                            <label for="pengobatan">Pengobatan</label>
                                                            @error('pengobatan')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <div class="form-floating">
                                                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan konsultasi"></textarea>
                                                            <label for="keterangan">Keterangan Tambahan</label>
                                                            @error('keterangan')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                        <button type="submit" class="btn btn-block btn-success">Simpan Pemeriksaan Kesehatan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                @else
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Data Kelahiran Anak</p></div>
                                            <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahKelahiran" role="button" aria-expanded="false" aria-controls="tambahKelahiran"><i class="fas fa-plus-circle"></i></a></div>
                                        </div>
                                        <div class="collapse my-3" id="tambahKelahiran">
                                            <form action="{{ route('Simpan Data Kelahiran Anak', $dataAnak->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="nama_ibu" class="form-label">Nama Ibu<span class="text-danger">*</span></label>
                                                        <input class="form-control @error('nama_ibu') is-invalid @enderror" list="dataIbu" id="nama_ibu" name="nama_ibu" placeholder="Cari nama ibu...">
                                                        <datalist id="dataIbu">
                                                            @foreach ($ibu as $data)
                                                                <option value="{{ $data->nama_ibu_hamil }},{{ $data->NIK }}">
                                                            @endforeach
                                                        </datalist>
                                                        @error('nama_ibu')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="berat_lahir">Berat Lahir Bayi<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="berat_lahir" autocomplete="off" class="form-control @error('berat_lahir') is-invalid @enderror" id="berat_lahir" value="{{ old('berat_lahir') }}" placeholder="Berat lahir">
                                                            <span class="input-group-text" id="basic-addon2">gram</span>
                                                            @error('berat_lahir')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="persalinan">Persalinan<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <select name="persalinan" class="form-control @error('persalinan') is-invalid @enderror" id="persalinan">
                                                                <option selected disabled>Jenis persalinan ...</option>
                                                                <option value="Normal">Normal</option>
                                                                <option value="Sesar">Sesar</option>
                                                                <option value="Vacum">Vacum</option>
                                                            </select>
                                                            @error('persalinan')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="penolong_persalinan">Penolong Persalinan<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <select name="penolong_persalinan" class="form-control @error('penolong_persalinan') is-invalid @enderror" id="penolong_persalinan">
                                                                <option selected disabled>Penolong persalinan ...</option>
                                                                <option value="Dokter">Dokter</option>
                                                                <option value="Bidan">Bidan</option>
                                                                <option value="Dukun Beranak">Dukun Beranak</option>
                                                                <option value="Lain-lain">Lain-lain</option>
                                                            </select>
                                                            @error('penolong_persalinan')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <div class="form-floating mb-3">
                                                            <textarea type="text" name="komplikasi" class="form-control @error('komplikasi') is-invalid @enderror" id="komplikasi" placeholder="Komplikasi kelahiran">{{ old('komplikasi') }}</textarea>
                                                            @error('komplikasi')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="komplikasi">Komplikasi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 my-2">
                                                        <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                        <button type="submit" class="btn btn-block btn-success">Simpan Data Kelahiran</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemberian Imunisasi</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahImunisasi" role="button" aria-expanded="false" aria-controls="tambahImunisasi"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahImunisasi">
                                        <form action="{{ route('Simpan Imunisasi Anak', $dataAnak->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="imunisasi">Jenis Imunisasi<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="imunisasi" class="form-control @error('imunisasi') is-invalid @enderror" value="{{ old('imunisasi') }}" id="imunisasi">
                                                            @if ($jenisImunisasi->count() < 1)
                                                                <option selected disabled>Imunisasi tidak tersedia</option>
                                                            @else
                                                                <option selected disabled>Pilih pemberian imunisasi....</option>
                                                                @foreach ($jenisImunisasi as $data)
                                                                    <option value="{{ $data->id }}">{{ $data->nama_imunisasi }}, {{ $data->status }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-syringe"></span>
                                                            </div>
                                                        </div>
                                                        @error('imunisasi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tgl_kembali_imunisasi">Tanggal Kembali</label>
                                                    <div class="input-group">
                                                        <input type="text" name="tgl_kembali_imunisasi" autocomplete="off" class="form-control @error('tgl_kembali_imunisasi') is-invalid @enderror" id="tgl_kembali_imunisasi" value="{{ old('tgl_kembali_imunisasi') }}"  placeholder="Tanggal imunisasi kembali" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-check"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @error('tgl_kembali_imunisasi')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <textarea name="lokasiImunisasi" class="form-control @error('lokasiImunisasi') is-invalid @enderror" id="lokasiImunisasi" placeholder="Masukan lokasi posyandu"></textarea>
                                                        <label for="lokasiImunisasi">Lokasi Imunisasi<span class="text-danger">*</span></label>
                                                        @error('lokasiImunisasi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <textarea name="keteranganImunisasi" class="form-control @error('keteranganImunisasi') is-invalid @enderror" id="keteranganImunisasi" placeholder="Masukan keterangan tambahan"></textarea>
                                                        <label for="keteranganImunisasi">Keterangan Tambahan</label>
                                                        @error('keteranganImunisasi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Pemberian Imunisasi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemberian Vitamin</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahVitamin" role="button" aria-expanded="false" aria-controls="tambahVitamin"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahVitamin">
                                        <form action="{{ route('Simpan Vitamin Anak', $dataAnak->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="vitamin">Jenis Vitamin<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="vitamin" class="form-control @error('vitamin') is-invalid @enderror" value="{{ old('vitamin') }}" id="vitamin">
                                                            @if ($jenisVitamin->count() < 1)
                                                                <option selected disabled>Vitamin tidak tersedia</option>
                                                            @else
                                                                <option selected disabled>Pilih pemberian vitamin....</option>
                                                                @foreach ($jenisVitamin as $data)
                                                                    <option value="{{ $data->id }}">{{ $data->nama_vitamin }}, {{ $data->status }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-tablets"></span>
                                                            </div>
                                                        </div>
                                                        @error('vitamin')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tgl_kembali_vitamin">Tanggal Kembali</label>
                                                    <div class="input-group">
                                                        <input type="text" name="tgl_kembali_vitamin" autocomplete="off" class="form-control @error('tgl_kembali_vitamin') is-invalid @enderror" id="tgl_kembali_vitamin" value="{{ old('tgl_kembali_vitamin') }}"  placeholder="Tanggal pemberian vitamin kembali" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-check"></i>
                                                            </span>
                                                        </div>
                                                        @error('tgl_kembali_vitamin')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <textarea name="lokasiVitamin" class="form-control @error('lokasiVitamin') is-invalid @enderror" id="lokasiVitamin" placeholder="Masukan lokasi pemberian"></textarea>
                                                        <label for="lokasiVitamin">Lokasi Pemberian Vitamin<span class="text-danger">*</span></label>
                                                        @error('lokasiVitamin')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan tambahan"></textarea>
                                                        <label for="keterangan">Keterangan Tambahan</label>
                                                        @error('keterangan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                    <button class="btn btn-block btn-success">Simpan Pemberian Vitamin</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Data Alergi Anak</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahAlergi" role="button" aria-expanded="false" aria-controls="tambahAlergi"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahAlergi">
                                        <form action="{{ route('Simpan Alergi', $dataAnak->id_user) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control @error('nama_alergi') is-invalid @enderror" value="{{ old('nama_alergi') }}" id="nama_alergi" name="nama_alergi" placeholder="Masukan nama alergi">
                                                        <label for="nama_alergi">Nama Alergi<span class="text-danger">*</span></label>
                                                        @error('nama_alergi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" aria-label="Floating label select example">
                                                            <option selected disabled>Pilih Kategori Alergi</option>
                                                            <option value="Alergi Obat">Alergi Obat</option>
                                                            <option value="Alergi Makanan">Alergi Makanan</option>
                                                            <option value="Alergi Lain">Alergi Lain</option>
                                                        </select>
                                                        @error('kategori')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <label for="kategori">Kategori Alergi<span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Data Alergi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Anak</p>
                                </li>
                                @if ($pemeriksaan->count() > 0)
                                    @foreach ($pemeriksaan as $data)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{$data->jenis_pemeriksaan}} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->nakes->nama_nakes ?? '-'}}</p></div>
                                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#pemeriksaan{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="pemeriksaan{{ $loop->iteration }}"><i class="fas fa-plus-circle"></i></a></div>
                                            </div>
                                            @if ($data->jenis_pemeriksaan == 'Konsultasi')
                                                <div class="collapse my-3" id="pemeriksaan{{ $loop->iteration }}">
                                                    <div class="card card-body">
                                                        <span class="fw-bold">Usia Anak :</span>
                                                        <p>{{ $data->usia_anak }} Tahun</p>
                                                        <span class="fw-bold">Hasil Pemeriksaan :</span>
                                                        <p>{{ $data->diagnosa }}</p>
                                                        <span class="fw-bold">Pengobatan :</span>
                                                        <p>{{ $data->pengobatan }}</p>
                                                        <span class="fw-bold">Keterangan Tambahan :</span>
                                                        <p>{{ $data->keterangan }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($data->jenis_pemeriksaan == 'Pemeriksaan')
                                                <div class="collapse my-3" id="pemeriksaan{{ $loop->iteration }}">
                                                    <div class="card card-body">
                                                        <span class="fw-bold">Usia Anak :</span>
                                                        <p>{{ $data->usia_anak }} Tahun</p>
                                                        <span class="fw-bold">Hasil Pemeriksaan :</span>
                                                        <p>{{ $data->diagnosa }}</p>
                                                        <span class="fw-bold">Pengobatan :</span>
                                                        <p>{{ $data->pengobatan ?? '-' }}</p>
                                                        <span class="fw-bold">Keterangan Tambahan :</span>
                                                        <p>{{ $data->keterangan ?? '-' }}</p>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Lingkar Kelapa :</span>
                                                                <p>{{ $data->lingkar_kepala }} Sentimeter</p>
                                                            </div>
                                                            @if ( $usia < 1)
                                                                <div class="col-6">
                                                                    <span class="fw-bold">Panjang Bayi :</span>
                                                                    <p>{{ $data->tinggi_badan }} Sentimeter</p>
                                                                </div>
                                                            @endif
                                                            @if ( $usia > 1)
                                                                <div class="col-6">
                                                                    <span class="fw-bold">Tinggi Badan :</span>
                                                                    <p>{{ $data->tinggi_badan }} Sentimeter</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Berat Badan :</span>
                                                                <p>{{ $data->berat_badan }} Gram</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Status Gizi :</span>
                                                                <p><span class="rounded bg-success py-1 px-3">Sehat</span></p>
                                                            </div>
                                                        </div>
                                                        <span class="fw-bold text-end mt-2 small">Tanggal Kembali: <span class="fw-normal">{{ date('d M Y', strtotime($data->tanggal_kembali)) ?? '-' }}</span></span>
                                                    </div>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item my-auto">
                                        <p class="text-center my-auto">Belum Pernah Melakukan Konsultasi</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemberian Imunisasi</p>
                                </li>
                                @if ($imunisasi->count() > 0)
                                    @foreach ($imunisasi as $data)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Imunisasi {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{ $data->nakes->nama_nakes ?? '-' }}</p></div>
                                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#imunisasi{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="imunisasi{{ $loop->iteration }}"><i class="fas fa-plus-circle"></i></a></div>
                                            </div>
                                            <div class="collapse my-3" id="imunisasi{{ $loop->iteration }}">
                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <span class="fw-bold">Jenis Umunisasi :</span>
                                                        <p>{{ $data->imunisasi->nama_imunisasi }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="fw-bold">Pemberian Selanjutnya :</span>
                                                        <p>{{ date('d M Y', strtotime($data->tanggal_kembali)) ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="card card-body">
                                                    <span class="fw-bold">Keterangan Tambahan :</span>
                                                    <p>{{ $data->keterangan ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item my-auto">
                                        <p class="text-center my-auto">Belum Pernah Melakukan Imunisasi</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemberian Vitamin</p>
                                </li>
                                @if ($vitamin->count() > 0)
                                    @foreach ($vitamin as $data)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Vitamin {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{ $data->nakes->nama_nakes ?? '-' }}</p></div>
                                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#vitamin{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="vitamin{{ $loop->iteration }}"><i class="fas fa-plus-circle"></i></a></div>
                                            </div>
                                            <div class="collapse my-3" id="vitamin{{ $loop->iteration }}">
                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <span class="fw-bold">Jenis Vitamin :</span>
                                                        <p>{{ $data->vitamin->nama_vitamin }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="fw-bold">Pemberian Selanjutnya :</span>
                                                        <p>{{ date('d M Y', strtotime($data->tanggal_kembali)) ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="card card-body">
                                                    <span class="fw-bold">Keterangan Tambahan :</span>
                                                    <p>{{ $data->keterangan ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item my-auto">
                                        <p class="text-center my-auto">Belum Pernah Menerima Vitamin</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-4 order-1 order-md-2 mb-2">
                        <div class="card card-primary card-outline sticky-top">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Pemeriksaan', $dataAnak->user->id ) }}" alt="Profile Anak" width="150" height="150">
                                    </div>
                                </div>
                                <h3 class="profile-username text-center mt-3">{{ $dataAnak->nama_anak}}</h3>
                                @if ($dataAnak->jenis_kelamin == 'laki-laki')
                                    <p class="text-muted text-center">Laki-laki</p>
                                @endif
                                @if ($dataAnak->jenis_kelamin == 'perempuan')
                                    <p class="text-muted text-center">Perempuan</p>
                                @endif
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5 my-auto"><span class="fw-bold">Ayah</span></div>
                                            <div class="col-7 text-end"><span>{{ $dataAnak->nama_ayah }}</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5 my-auto"><span class="fw-bold">Ibu</span></div>
                                            <div class="col-7 text-end"><span>{{ $dataAnak->nama_ibu }}</span></div>
                                        </div>
                                    </li>
                                    @if ($gizi != NULL)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6 my-auto"><span class="fw-bold">Status Gizi</span></div>
                                                @if ($gizi == 'Cukup Gizi')
                                                    <div class="col-6 text-end my-auto"><span class="btn btn-success btn-sm">Cukup Gizi</span></div>
                                                @endif
                                                @if ($gizi == 'Kurang Gizi')
                                                    <div class="col-6 text-end my-auto"><span class="btn btn-danger btn-sm">Kurang Gizi</span></div>
                                                @endif
                                                @if ($gizi == 'Kelebihan Gizi')
                                                    <div class="col-6 text-end my-auto"><span class="btn btn-warning btn-sm">Kelebihan Gizi</span></div>
                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6 my-auto"><span class="fw-bold">Usia Anak</span></div>
                                            <div class="col-6 text-end my-auto"><span>{{ $usia }}</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6 my-auto"><span class="fw-bold">Status Anak</span></div>
                                            <div class="col-6 text-end my-auto"><span>Anak ke-{{ $dataAnak->anak_ke}}</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6 my-auto"><span class="fw-bold">Kelahiran</span></div>
                                            <div class="col-6 text-end my-auto"><span>{{ $persalinan->persalinan ?? 'Belum Ditambahkan' }}</span></div>
                                        </div>
                                    </li>
                                    @if ($alergi->where('kategori', 'Alergi Makanan')->count() > 0)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-7 my-auto"><span class="fw-bold">Alergi Makanan</span></div>
                                                <div class="col-5 text-end my-auto">
                                                    @foreach ($alergi->where('kategori', 'Alergi Makanan') as $data)
                                                        <span>{{ $data->nama_alergi }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if ($alergi->where('kategori', 'Alergi Obat')->count() > 0)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-7 my-auto"><span class="fw-bold">Alergi Obat</span></div>
                                                <div class="col-5 text-end my-auto">
                                                    @foreach ($alergi->where('kategori', 'Alergi Obat') as $data)
                                                        <span>{{ $data->nama_alergi }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if ($alergi->where('kategori', 'Alergi Lain')->count() > 0)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-7 my-auto"><span class="fw-bold">Alergi Lain</span></div>
                                                <div class="col-5 text-end my-auto">
                                                    @foreach ($alergi->where('kategori', 'Alergi Lain') as $data)
                                                        <span>{{ $data->nama_alergi }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Golongan Darah</span></div>
                                            <div class="col-5 text-end my-auto"><span>{{ $dataAnak->user->golongan_darah ?? '-' }}</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Faskes Rujukan</span></div>
                                            <div class="col-5 text-end my-auto"><span>{{ $dataAnak->user->faskes_rujukan ?? 'Belum Ditambahkan' }}</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="{{ route('Detail Anggota Anak', $dataAnak->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Anak</a>
                                <a href="{{ route('Data Kesehatan Anak', $dataAnak->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Anak</a>
                            </div>
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
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#pemeriksaan-keluarga').addClass('active');

            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
            $('[data-mask]').inputmask()
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