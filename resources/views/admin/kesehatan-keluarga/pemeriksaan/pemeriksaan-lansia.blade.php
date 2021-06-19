@extends('layouts/admin/admin-layout')

@section('title', 'Pemeriksaan Lansia')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Pemeriksaan Kesehatan Lansia</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Semua Pemeriksaan Anggota') }}">Pemeriksaan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pemeriksaan lansia</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 col-md-8 order-2 order-md-1 mb-3">
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemeriksaan Lansia</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPemeriksaan" role="button" aria-expanded="false" aria-controls="tambahPemeriksaan"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahPemeriksaan">
                                        <form action="{{ route('Simpan Pemeriksaan Lansia', $dataLansia->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="berat_badan">Berat Badan<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="berat_badan" autocomplete="off" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" value="{{ old('berat_badan') }}" placeholder="Berat badan">
                                                        <span class="input-group-text" id="basic-addon2">kg</span>
                                                        @error('berat_badan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="suhu_tubuh">Suhu Tubuh<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="suhu_tubuh" autocomplete="off" class="form-control @error('suhu_tubuh') is-invalid @enderror" id="suhu_tubuh" value="{{ old('suhu_tubuh') }}" placeholder="Suhu tubuh">
                                                        <span class="input-group-text" id="basic-addon2">C&deg</span>
                                                        @error('suhu_tubuh')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tinggi_lutut">Tinggi Lutut<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="tinggi_lutut" autocomplete="off" class="form-control @error('tinggi_lutut') is-invalid @enderror" id="tinggi_lutut" value="{{ old('tinggi_lutut') }}" placeholder="Tinggi lutut">
                                                        <span class="input-group-text" id="basic-addon2">cm</span>
                                                        @error('tinggi_lutut')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tinggi_badan">Tinggi Badan<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="tinggi_badan" autocomplete="off" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" value="{{ old('tinggi_badan') }}" placeholder="Tinggi badan">
                                                        <span class="input-group-text" id="basic-addon2">cm</span>
                                                        @error('tinggi_badan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tekanan_darah">Tekanan Darah<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="tekanan_darah" autocomplete="off" class="form-control @error('tekanan_darah') is-invalid @enderror" id="tekanan_darah" value="{{ old('tekanan_darah') }}" placeholder="Tekanan darah">
                                                        <span class="input-group-text" id="basic-addon2">mmHG</span>
                                                        @error('tekanan_darah')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="denyut_nadi">Denyut Nadi<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="denyut_nadi" autocomplete="off" class="form-control @error('denyut_nadi') is-invalid @enderror" id="denyut_nadi" value="{{ old('denyut_nadi') }}" placeholder="Denyut nadi">
                                                        <span class="input-group-text" id="basic-addon2">BPM</span>
                                                        @error('denyut_nadi')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="lokasi_pemeriksaan">Lokasi Pemeriksaan<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="lokasi_pemeriksaan" autocomplete="off" class="form-control @error('lokasi_pemeriksaan') is-invalid @enderror" id="lokasi_pemeriksaan" value="{{ old('lokasi_pemeriksaan') }}" placeholder="Masukan lokasi pemeriksaan">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marker-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('lokasi_pemeriksaan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="tgl_kembali">Tanggal Pemberian Kembali<span class="text-danger">*</span></label>
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
                                                        <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan hasil pemeriksaan">{{ $dataLansia->posyandu->nama_posyandu }}</textarea>
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
                                                        <textarea name="keteranganPemeriksaan" class="form-control @error('keteranganPemeriksaan') is-invalid @enderror" id="keteranganPemeriksaan" placeholder="Masukan keterangan tambahan"></textarea>
                                                        <label for="keterangan">Keterangan Tambahan</label>
                                                        @error('keteranganPemeriksaan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                    <button class="btn btn-block btn-success">Simpan Pemeriksaan Kesehatan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemberian Imunisasi</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahImunisasi" role="button" aria-expanded="false" aria-controls="tambahImunisasi"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahImunisasi">
                                        <form action="{{ route('Simpan Imunisasi Lansia', $dataLansia->id) }}" method="POST">
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
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahVitamin" role="button" aria-expanded="false" aria-controls="tambahVitamin"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahVitamin">
                                        <form action="{{ route('Simpan Vitamin Lansia', $dataLansia->id) }}" method="POST">
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
                                                    <label for="tgl_kembali_vitamin">Tanggal Kembali<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" name="tgl_kembali_vitamin" autocomplete="off" class="form-control @error('tgl_kembali_vitamin') is-invalid @enderror" id="tgl_kembali_vitamin" value="{{ old('tgl_kembali_vitamin') }}"  placeholder="Tanggal vitamin kembali" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Data Alergi Lansia</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahRiwayatPenyakit" role="button" aria-expanded="false" aria-controls="tambahRiwayatPenyakit"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahRiwayatPenyakit">
                                        <form action="{{ route('Simpan Alergi', $dataLansia->id_user) }}" method="POST">
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
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Penyakit Bawaan Lansia</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPenyakitBawaan" role="button" aria-expanded="false" aria-controls="tambahPenyakitBawaan"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahPenyakitBawaan">
                                        <form action="{{ route('Simpan Penyakit Bawaan', $dataLansia->id_user) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control @error('nama_penyakit') is-invalid @enderror" value="{{ old('nama_penyakit') }}" id="nama_penyakit" name="nama_penyakit" placeholder="Masukan penyakit bawaan lansia">
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
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Penyakit Bawaan Lansia</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Masalah Kesehatan Lansia</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahAlergi" role="button" aria-expanded="false" aria-controls="tambahAlergi"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahAlergi">
                                        <form action="{{ route('Simpan Riwayat Penyakit', $dataLansia->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control @error('nama_penyakit') is-invalid @enderror" value="{{ old('nama_penyakit') }}" id="nama_penyakit" name="nama_penyakit" placeholder="Masukan nama penyakit lansia">
                                                        <label for="nama_penyakit">Nama Penyakit<span class="text-danger">*</span></label>
                                                        @error('nama_penyakit')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" aria-label="Floating label select example">
                                                            <option selected disabled>Pilih status penyakit</option>
                                                            <option value="Sudah Sembuh">Sudah Sembuh</option>
                                                            <option value="Sedang Mengalami">Sedang Mengalami</option>
                                                        </select>
                                                        @error('status')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <label for="status">Status Penyakit<span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Riwayat Penyakit</button>
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
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Lansia</p>
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
                                                        <span class="fw-bold">Usia :</span>
                                                        <p>{{ $data->usia_lansia }} Tahun</p>
                                                        <span class="fw-bold">Hasil Pemeriksaan :</span>
                                                        <p>{{ $data->diagnosa }}</p>
                                                        <span class="fw-bold">Pengobatan :</span>
                                                        <p>{{ $data->pengobatan ?? '-' }}</p>
                                                        <span class="fw-bold">Keterangan Tambahan :</span>
                                                        <p>{{ $data->keterangan ?? '-' }}</p>
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
                                                                <span class="fw-bold">Usia :</span>
                                                                <p>{{ $data->usia_lansia }} Tahun</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Berat Badan :</span>
                                                                <p>{{ $data->berat_badan }} Kilogram</p>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Suhu Tubuh :</span>
                                                                <p>{{ $data->suhu_tubuh }}&deg Celcius</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Tinggi Lutut :</span>
                                                                <p>{{ $data->tinggi_lutut }} Sentimeter</p>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Tinggi Badan :</span>
                                                                <p>{{ $data->tinggi_badan }} Sentimeter</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">Tekanan Darah :</span>
                                                                <p>{{ $data->tekanan_darah }} mmHG</p>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <span class="fw-bold">Denyut Nadi :</span>
                                                                <p>{{ $data->denyut_nadi }} BPM</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="fw-bold">IMT :</span>
                                                                <p>{{ $data->IMT }}</p>
                                                            </div>
                                                        </div>
                                                        <span class="fw-bold text-end mt-2 small">Tanggal Kembali: <span class="fw-normal">21 Mei 2021</span></span>
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
                    <div class="col-sm-12 col-md-5 col-lg-4 order-1 order-md-2">
                        <div class="card card-primary card-outline sticky-top">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Pemeriksaan', $dataLansia->user->id ) }}" alt="Profile Lansia" width="150" height="150">
                                    </div>
                                </div>
                                <h3 class="profile-username text-center mt-3">{{ $dataLansia->nama_lansia }}</h3>
                                <p class="text-muted text-center">{{ $umur }} Tahun</p>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5 my-auto"><span class="fw-bold">Kategori Lansia</span></div>
                                            <div class="col-7 text-end my-auto"><span>{{ $dataLansia->status }}</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Keluarga Dekat</span></div>
                                            <div class="col-5 text-end my-auto"><span>{{ $pj->nama ?? 'Belum Ditambahkan' }}</span></div>
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
                                    @if ($penyakitBawaan->count() > 0)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-7 my-auto"><span class="fw-bold">Penyakit Bawaan</span></div>
                                                <div class="col-5 text-end my-auto">
                                                    @foreach ($penyakitBawaan as $data)
                                                        <span>{{ $data->nama_penyakit }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Golongan Darah</span></div>
                                            <div class="col-5 text-end my-auto"><span>{{ $dataLansia->user->golongan_darah ?? 'Belum Ditambahkan' }}</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Faskes Rujukan</span></div>
                                            <div class="col-5 text-end my-auto"><span>{{ $dataLansia->user->faskes_rujukan ?? 'Belum Ditambahkan' }}</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="list-group list-group-unbordered mt-3">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-12 my-auto text-center"><span class="fw-bold fs-6">Masalah Kesehatan Lansia</span></div>
                                        </div>
                                    </li>
                                    @if ($riwayatPenyakit->count() < 1)
                                        <li class="list-group-item">
                                            <div class="row px-2 text-center">
                                                <div class="col-12 my-3">
                                                    <span>Tidak terdapat riwayat penyakit lansia</span>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <div class="row px-2 text-center">
                                                @foreach ($riwayatPenyakit as $data)
                                                    <div class="col-12 mt-3"><span class="fw-bold">{{ $data->nama_penyakit }}</span></div>
                                                    @if ($data->status == 'Sedang Mengalami')
                                                        <div class="col-12 text-center my-auto"><span class="btn-sm btn-warning">Sedang Mengalami</span></div>
                                                    @else
                                                        <div class="col-12 text-center my-auto"><span class="btn-sm btn-success">Sudah Sembuh</span></div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                                <a href="{{ route('Detail Anggota Lansia', $dataLansia->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Lansia</a>
                                <a href="{{ route('Data Kesehatan Lansia', $dataLansia->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Lansia</a>
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