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
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Pemeriksaan') }}">Pemeriksaan Keluarga</a></li>
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
                                @if (auth()->guard('admin')->user()->pegawai->jabatan == "tenaga kesehatan")
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemeriksaan Lansia</p></div>
                                            <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPemeriksaan" role="button" aria-expanded="false" aria-controls="tambahPemeriksaan"><i class="fas fa-plus-circle"></i></a></div>
                                        </div>
                                        <div class="collapse my-3" id="tambahPemeriksaan">
                                            <form action="{{ route('Tambah Pemeriksaan Lansia', [$dataLansia->id]) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="berat_badan">Berat Badan<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="berat_badan" autocomplete="off" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" value="{{ old('berat_badan') }}" placeholder="Berat badan">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-weight"></span>
                                                                </div>
                                                            </div>
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
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-thermometer"></span>
                                                                </div>
                                                            </div>
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
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-ruler-vertical"></span>
                                                                </div>
                                                            </div>
                                                            @error('tinggi_lutut')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="tinggi_badan">Tinggi badan<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="tinggi_badan" autocomplete="off" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" value="{{ old('tinggi_badan') }}" placeholder="Tinggi badan">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-ruler-vertical"></span>
                                                                </div>
                                                            </div>
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
                                                            <input type="text" name="tekanan_darah" autocomplete="off" class="form-control @error('tekanan_darah') is-invalid @enderror" id="tekanan_darah" value="{{ old('tekanan_darah') }}" placeholder="Tekanan Darah">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-plus"></span>
                                                                </div>
                                                            </div>
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
                                                            <input type="text" name="denyut_nadi" autocomplete="off" class="form-control @error('denyut_nadi') is-invalid @enderror" id="denyut_nadi" value="{{ old('denyut_nadi') }}" placeholder="Denyut Nadi">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-plus"></span>
                                                                </div>
                                                            </div>
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
                                @endif
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemberian Imunisasi</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahImunisasi" role="button" aria-expanded="false" aria-controls="tambahImunisasi"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahImunisasi">
                                        <form action="{{ route('Imunisasi Lansia', [$dataLansia->id]) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="imunisasi">Jenis Imunisasi<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="imunisasi" class="form-control @error('imunisasi') is-invalid @enderror" value="{{ old('imunisasi') }}" id="imunisasi">
                                                            @if ($imunisasi->count() < 1)
                                                                <option selected disabled>Imunisasi tidak tersedia</option>
                                                            @else
                                                                <option selected disabled>Pilih pemberian imunisasi....</option>
                                                                @foreach ($imunisasi as $data)
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
                                        <form action="{{ route('Vitamin Lansia', [$dataLansia->id]) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 my-2">
                                                    <label for="vitamin">Jenis Vitamin<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <select name="vitamin" class="form-control @error('vitamin') is-invalid @enderror" value="{{ old('vitamin') }}" id="vitamin">
                                                            @if ($vitamin->count() < 1)
                                                                <option selected disabled>Vitamin tidak tersedia</option>
                                                            @else
                                                                <option selected disabled>Pilih pemberian vitamin....</option>
                                                                @foreach ($vitamin as $data)
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
                                                        <label for="lokasiVitamin">Lokasi Vitamin<span class="text-danger">*</span></label>
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
                                                    <button class="btn btn-block btn-success">Simpan Pemberian Vitamin</button>
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
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Pemeriksaan 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar12-2020" role="button" aria-expanded="false" aria-controls="mar12-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar12-2020">
                                        <div class="card card-body">
                                            <span class="fw-bold">Hasil Pemeriksaan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Pengobatan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Usia :</span>
                                                    <p>50 Kilogram</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Berat Badan :</span>
                                                    <p>120/80</p>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Denyut Nadi :</span>
                                                    <p>120/80</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Tekanan Darah :</span>
                                                    <p>50 Kilogram</p>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Suhu Tubuh :</span>
                                                    <p>15 Tahun</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Tinggi Lutut :</span>
                                                    <p>50 Minggu</p>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">IMT :</span>
                                                    <p>Kemahilan ke-2</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">MNA :</span>
                                                    <p>4 Tahun</p>
                                                </div>
                                            </div>
                                            <span class="fw-bold text-end mt-2 small">Tanggal Kembali: <span class="fw-normal">21 Mei 2021</span></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Konsultasi 10 Mar 2020 | Oleh Dr. Made Ayu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar10-2020" role="button" aria-expanded="false" aria-controls="mar10-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar10-2020">
                                        <div class="card card-body">
                                            <span class="fw-bold">Hasil Pemeriksaan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Pengobatan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemberian Imunisasi</p>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Imunisasi 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#imunisasi1" role="button" aria-expanded="false" aria-controls="imunisasi1"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="imunisasi1">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <span class="fw-bold">Jenis Umunisasi :</span>
                                                <p>50 Minggu</p>
                                            </div>
                                            <div class="col-6">
                                                <span class="fw-bold">Pemberian Selanjutnya :</span>
                                                <p>30 Jun 2021</p>
                                            </div>
                                        </div>
                                        <div class="card card-body">
                                            <span class="fw-bold">keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Imunisasi 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#imunisasi2" role="button" aria-expanded="false" aria-controls="imunisasi2"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="imunisasi2">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <span class="fw-bold">Jenis Umunisasi :</span>
                                                <p>50 Minggu</p>
                                            </div>
                                            <div class="col-6">
                                                <span class="fw-bold">Pemberian Selanjutnya :</span>
                                                <p>30 Jun 2021</p>
                                            </div>
                                        </div>
                                        <div class="card card-body">
                                            <span class="fw-bold">keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemberian Vitamin</p>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Vitamin 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#vitamin1" role="button" aria-expanded="false" aria-controls="vitamin1"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="vitamin1">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <span class="fw-bold">Jenis Vitamin :</span>
                                                <p>50 Minggu</p>
                                            </div>
                                            <div class="col-6">
                                                <span class="fw-bold">Pemberian Selanjutnya :</span>
                                                <p>30 Jun 2021</p>
                                            </div>
                                        </div>
                                        <div class="card card-body">
                                            <span class="fw-bold">keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Vitamin 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#vitamin2" role="button" aria-expanded="false" aria-controls="vitamin2"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="vitamin2">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <span class="fw-bold">Jenis Vitamin :</span>
                                                <p>50 Minggu</p>
                                            </div>
                                            <div class="col-6">
                                                <span class="fw-bold">Pemberian Selanjutnya :</span>
                                                <p>30 Jun 2021</p>
                                            </div>
                                        </div>
                                        <div class="card card-body">
                                            <span class="fw-bold">keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-4 order-1 order-md-2">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="https://images.unsplash.com/photo-1537111166787-cac8c5491c6c?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDU4fHRvd0paRnNrcEdnfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Profile Admin" width="150" height="150">
                                    </div>
                                </div>
                                <h3 class="profile-username text-center mt-3">I Gede Hadi Darmawan</h3>
                                <p class="text-muted text-center">68 Tahun</p>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5 my-auto"><span class="fw-bold">Kategori Lansia</span></div>
                                            <div class="col-7 text-end my-auto"><span>Lansia Beresiko</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Keluarga Dekat</span></div>
                                            <div class="col-5 text-end my-auto"><span>Hadi Darmawan</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Penyakit Bawaan</span></div>
                                            <div class="col-5 text-end my-auto"><span>Hipertensi</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Masalah Kesehatan</span></div>
                                            <div class="col-5 text-end my-auto"><span>Dimensia</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Alergi Obat</span></div>
                                            <div class="col-5 text-end my-auto"><span>Penisilin</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Alergi Makanan</span></div>
                                            <div class="col-5 text-end my-auto"><span>Makanan Laut</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Alergi Lain</span></div>
                                            <div class="col-5 text-end my-auto"><span>Debu, Dingin</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Lansia</a>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Lansia</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Custom Input Date -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#pemeriksaan-keluarga').addClass('active');
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