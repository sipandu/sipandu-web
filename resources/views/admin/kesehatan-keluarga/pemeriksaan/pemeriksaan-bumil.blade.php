@extends('layouts/admin/admin-layout')

@section('title', 'Pemeriksaan Ibu')

@push('css')
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Pemeriksaan Ibu Hamil</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Semua Pemeriksaan Anggota') }}">Pemeriksaan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ibu Hamil</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-8 order-2 order-md-1 mb-3">
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Data Persalinan Sebelumnya</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahKelahiran" role="button" aria-expanded="false" aria-controls="tambahKelahiran">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse my-3" id="tambahKelahiran">
                                        <form action="{{ route('Simpan Persalinan Bumil', $dataIbu->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <label for="nama_anak" class="form-label">Nama Anak<span class="text-danger">*</span></label>
                                                    <input class="form-control @error('nama_anak') is-invalid @enderror" list="dataAnak" id="nama_anak" name="nama_anak" placeholder="Cari nama anak...">
                                                    <datalist id="dataAnak">
                                                        @foreach ($anak as $data)
                                                            <option value="{{ $data->nama_anak }},{{ $data->NIK }}">
                                                        @endforeach
                                                    </datalist>
                                                    @error('nama_anak')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tanggal_persalinan">Tanggal Persalinan<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="tanggal_persalinan" autocomplete="off" class="form-control @error('tanggal_persalinan') is-invalid @enderror" id="tanggal_persalinan" value="{{ old('tanggal_persalinan') }}"  placeholder="Tanggal persalinan" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-check"></i>
                                                            </span>
                                                        </div>
                                                        @error('tanggal_persalinan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="berat_lahir">Berat Lahir Bayi<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="berat_lahir" autocomplete="off" class="form-control @error('berat_lahir') is-invalid @enderror" id="berat_lahir" value="{{ old('berat_lahir') }}" placeholder="Berat lahir anak">
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
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemeriksaan Ibu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPemeriksaan" role="button" aria-expanded="false" aria-controls="tambahPemeriksaan">
                                            <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse my-3" id="tambahPemeriksaan">
                                        <form action="{{ route('Simpan Pemeriksaan Bumil', $dataIbu->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="usia_kandungan">Usia Kandungan<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="usia_kandungan" autocomplete="off" class="form-control @error('usia_kandungan') is-invalid @enderror" id="usia_kandungan" value="{{ old('usia_kandungan') }}" placeholder="Usia kandungan">
                                                        <span class="input-group-text" id="basic-addon2">minggu</span>
                                                        @error('usia_kandungan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="lingkar_lengan">Lingkar Lengan<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="lingkar_lengan" class="form-control @error('lingkar_lengan') is-invalid @enderror" id="lingkar_lengan" value="{{ old('lingkar_lengan') }}" placeholder="Lingkar Lengan Atas">
                                                        <span class="input-group-text" id="basic-addon2">cm</span>
                                                        @error('lingkar_lengan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="berat_badan">Berat Badan<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="berat_badan" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" value="{{ old('berat_badan') }}" placeholder="Berat badan">
                                                        <span class="input-group-text" id="basic-addon2">kg</span>
                                                        @error('berat_badan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tinggi_rahim">Tinggi Rahim<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="tinggi_rahim" class="form-control @error('tinggi_rahim') is-invalid @enderror" id="tinggi_rahim" value="{{ old('tinggi_rahim') }}" placeholder="Tinggi rahim">
                                                        <span class="input-group-text" id="basic-addon2">cm</span>
                                                        @error('tinggi_rahim')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="denyut_nadi">Denyut Nadi<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="denyut_nadi" class="form-control @error('denyut_nadi') is-invalid @enderror" id="denyut_nadi" value="{{ old('denyut_nadi') }}" placeholder="Denyut nadi ibu">
                                                        <span class="input-group-text" id="basic-addon2">BPM</span>
                                                        @error('denyut_nadi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="detak_jantung_bayi">Detak Jantung Bayi<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="detak_jantung_bayi" class="form-control @error('detak_jantung_bayi') is-invalid @enderror" id="detak_jantung_bayi" value="{{ old('detak_jantung_bayi') }}" placeholder="Detak jantung bayi">
                                                        <span class="input-group-text" id="basic-addon2">BPM</span>
                                                        @error('detak_jantung_bayi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tekanan_darah">Tekanan Darah<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="tekanan_darah" class="form-control @error('tekanan_darah') is-invalid @enderror" id="tekanan_darah" value="{{ old('tekanan_darah') }}" placeholder="Tekanan darah">
                                                        <span class="input-group-text" id="basic-addon2">mmHG</span>
                                                        @error('tekanan_darah')
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
                                                    <div class="form-floating">
                                                        <textarea name="lokasiPemeriksaan" class="form-control @error('lokasiPemeriksaan') is-invalid @enderror" id="lokasiPemeriksaan" placeholder="Masukan lokasi pemeriksaan">{{ $dataIbu->posyandu->nama_posyandu }}</textarea>
                                                        <label for="lokasiPemeriksaan">Lokasi Pemeriksaan<span class="text-danger">*</span></label>
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
                                                        <label for="diagnosa">Hasil Pemeriksaan<span class="text-danger">*</span></label>
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
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Pemeriksaan Kesehatan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemberian Imunisasi</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahImunisasi" role="button" aria-expanded="false" aria-controls="tambahImunisasi">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse my-3" id="tambahImunisasi">
                                        <form action="{{ route('Simpan Imunisasi Bumil', $dataIbu->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="imunisasi">Jenis Imunisasi<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="imunisasi" class="form-control @error('imunisasi') is-invalid @enderror" value="{{ old('imunisasi') }}" id="imunisasi">
                                                            @if ($jenisImunisasi->count() < 1)
                                                                <option selected disabled>Imunisasi tidak tersedia</option>
                                                            @else
                                                                <option selected disabled>Pilih jenis imunisasi....</option>
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
                                                        @error('tgl_kembali_imunisasi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <textarea name="lokasiImunisasi" class="form-control @error('lokasiImunisasi') is-invalid @enderror" id="lokasiImunisasi" placeholder="Masukan lokasi pemberian"></textarea>
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
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahVitamin" role="button" aria-expanded="false" aria-controls="tambahVitamin">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse my-3" id="tambahVitamin">
                                        <form action="{{ route('Simpan Vitamin Bumil', $dataIbu->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="vitamin">Jenis Vitamin<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="vitamin" class="form-control @error('vitamin') is-invalid @enderror" value="{{ old('vitamin') }}" id="vitamin">
                                                            @if ($jenisVitamin->count() < 1)
                                                                <option selected disabled>Vitamin tidak tersedia</option>
                                                            @else
                                                                <option selected disabled>Pilih jenis vitamin ...</option>
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
                                                        <input type="text" name="tgl_kembali_vitamin" autocomplete="off" class="form-control @error('tgl_kembali_vitamin') is-invalid @enderror" id="tgl_kembali_vitamin" value="{{ old('tgl_kembali_vitamin') }}"  placeholder="Tanggal kembali" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                                        <textarea name="keteranganVitamin" class="form-control @error('keteranganVitamin') is-invalid @enderror" id="keteranganVitamin" placeholder="Masukan keterangan tambahan"></textarea>
                                                        <label for="keteranganVitamin">Keterangan Tambahan</label>
                                                        @error('keteranganVitamin')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Pemberian Vitamin</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Data Alergi Ibu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahAlergi" role="button" aria-expanded="false" aria-controls="tambahAlergi">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse my-3" id="tambahAlergi">
                                        <form action="{{ route('Simpan Alergi', $dataIbu->id_user) }}" method="POST">
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
                                                        <label for="kategori">Works with selects<span class="text-danger">*</span></label>
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
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Penyakit Bawaan Ibu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end">
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPenyakitBawaan" role="button" aria-expanded="false" aria-controls="tambahPenyakitBawaan">
                                            <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse my-3" id="tambahPenyakitBawaan">
                                        <form action="{{ route('Simpan Penyakit Bawaan', $dataIbu->id_user) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control @error('nama_penyakit') is-invalid @enderror" value="{{ old('nama_penyakit') }}" id="nama_penyakit" name="nama_penyakit" placeholder="Masukan penyakit bawaan">
                                                        <label for="nama_penyakit">Nama Penyakit<span class="text-danger">*</span></label>
                                                        @error('nama_penyakit')
                                                            <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                            </div>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Penyakit Bawaan</button>
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
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Ibu</p>
                                </li>
                                @if ($pemeriksaan->count() > 0)
                                    @foreach ($pemeriksaan as $data)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{ $data->jenis_pemeriksaan }} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->nakes->nama_nakes ?? '-'}}</p></div>
                                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#pemeriksaan{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="pemeriksaan{{ $loop->iteration }}"><i class="fas fa-plus-circle"></i></a></div>
                                            </div>
                                            @if ($data->jenis_pemeriksaan == 'Konsultasi')
                                                <div class="collapse my-3" id="pemeriksaan{{ $loop->iteration }}">
                                                    <div class="card card-body">
                                                        <span class="fw-bold">Usia Kehamilan :</span>
                                                        <p>{{ $usia_kandungan }} Minggu</p>
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
                                                        <span class="fw-bold">Hasil Pemeriksaan :</span>
                                                        <p>{{ $data->diagnosa }}</p>
                                                        <span class="fw-bold">Pengobatan :</span>
                                                        <p>{{ $data->pengobatan ?? '-' }}</p>
                                                        <span class="fw-bold">Keterangan Tambahan :</span>
                                                        <p>{{ $data->keterangan ?? '-' }}</p>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Usia Ibu :</span>
                                                                <p>{{ $umur }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Usia Kehamilan :</span>
                                                                <p>{{ $usia_kandungan }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Lingkar Lengan :</span>
                                                                <p>{{ $data->lingkar_lengan }} Sentimeter</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Berat Badan :</span>
                                                                <p>{{ $data->berat_badan }} Kilogram</p>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Tinggi Rahim :</span>
                                                                <p>{{ $data->tinggi_rahim }} Sentimeter</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Denyut Nadi :</span>
                                                                <p>{{ $data->denyut_nadi_ibu }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Tekanan Darah :</span>
                                                                <p>{{ $data->tekanan_darah }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Detak Jantung Bayi :</span>
                                                                <p>{{ $data->detak_jantung_bayi }}</p>
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
                                        <p class="text-center my-auto">Belum Pernah Melakukan Pemeriksaan</p>
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
                    <div class="col-sm-12 col-md-5 col-lg-4 order-1 order-md-2 mb-3">
                        <div class="card card-primary card-outline sticky-top">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Pemeriksaan', $dataIbu->user->id ) }}" alt="Profile Ibu Hamil" width="150" height="150">
                                    </div>
                                </div>
                                <h3 class="profile-username text-center mt-3">{{ $dataIbu->nama_ibu_hamil }}</h3>
                                <p class="text-muted text-center">{{ $umur }} Tahun</p>
                                <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="row">
                                    <div class="col-6 my-auto"><span class="fw-bold">Suami</span></div>
                                    <div class="col-6 text-end"><span>{{ $dataIbu->nama_suami }}</span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-7 my-auto"><span class="fw-bold">Usia Kandungan</span></div>
                                        <div class="col-5 text-end my-auto"><span>{{ $usia_kandungan }} Minggu</span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-7 my-auto">
                                            <span class="fw-bold">Jumlah Kehamilan</span>
                                        </div>
                                        <div class="col-5 text-end my-auto"><span>Kehamilan ke-{{ $persalinan->count() + 1 ?? 'Kehamilan Pertama'}}</span></div>
                                    </div>
                                </li>
                                @if ($dataIbu->kehamilan_ke != NULL)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Jarak Anak Sebelumnya</span></div>
                                            <div class="col-5 text-end my-auto"><span>{{ $dataIbu->jarak_anak_sebelumnya ?? '-' }} Tahun</span></div>
                                        </div>
                                    </li>
                                @endif
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
                                        <div class="col-5 text-end my-auto"><span>{{ $dataIbu->user->golongan_darah ?? '-' }}</span></div>
                                    </div>
                                </li>
                                @if ($penyakitBawaan->count() > 0)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Penyakit Bawaan</span></div>
                                            <div class="col-5 text-end my-auto">
                                                @foreach ($penyakitBawaan as $data)
                                                    <span>{{ $data->nama_penyakit }}. </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-7 my-auto"><span class="fw-bold">Tanggungan</span></div>
                                        <div class="col-5 text-end my-auto"><span>{{ $dataIbu->user->tanggungan ?? 'Belum Ditambahkan' }}</span></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-7 my-auto"><span class="fw-bold">Faskes Rujukan</span></div>
                                        <div class="col-5 text-end my-auto"><span>{{ $dataIbu->user->faskes_rujukan ?? 'Belum Ditambahkan' }}</span></div>
                                    </div>
                                </li>
                                </ul>
                                <a href="{{ route('Detail Anggota Bumil', $dataIbu->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Bumil</a>
                                <a href="{{ route('Data Kesehatan Ibu', $dataIbu->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Bumil</a>
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

        // Custom Input Date
        $(function () {
        })
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