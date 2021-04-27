@extends('layouts/admin/admin-layout')

@section('title', 'Pemeriksaan Ibu')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Pemeriksaan Kesehatan Ibu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Pemeriksaan') }}">Pemeriksaan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pemeriksaan Ibu</li>
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
                                @if (auth()->guard('admin')->user()->pegawai->jabatan == "tenaga kesehatan")
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemeriksaan Ibu</p></div>
                                            <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPemeriksaan" role="button" aria-expanded="false" aria-controls="tambahPemeriksaan"><i class="fas fa-plus-circle"></i></a></div>
                                        </div>
                                        <div class="collapse my-3" id="tambahPemeriksaan">
                                            <form action="{{ route('Tambah Pemeriksaan Ibu', [$dataIbu->id]) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="usia_kandungan">Usia Kandungan<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="usia_kandungan" autocomplete="off" class="form-control @error('usia_kandungan') is-invalid @enderror" id="usia_kandungan" value="{{ old('usia_kandungan') }}" placeholder="Usia kehamilan">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-calendar-week"></span>
                                                                </div>
                                                            </div>
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
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-circle-notch"></span>
                                                                </div>
                                                            </div>
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
                                                        <label for="tinggi_rahim">Tinggi Rahim<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="tinggi_rahim" class="form-control @error('tinggi_rahim') is-invalid @enderror" id="tinggi_rahim" value="{{ old('tinggi_rahim') }}" placeholder="Tinggi rahim">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-ruler-vertical"></span>
                                                                </div>
                                                            </div>
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
                                                        <label for="detak_jantung_bayi">Detak Jantung Bayi<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="detak_jantung_bayi" class="form-control @error('detak_jantung_bayi') is-invalid @enderror" id="detak_jantung_bayi" value="{{ old('detak_jantung_bayi') }}" placeholder="Detak jantung bayi">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-heart"></span>
                                                                </div>
                                                            </div>
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
                                                            <textarea name="lokasiPemeriksaan" class="form-control @error('lokasiPemeriksaan') is-invalid @enderror" id="lokasiPemeriksaan" placeholder="Masukan lokasi pemeriksaan"></textarea>
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
                                @endif
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemberian Imunisasi</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahImunisasi" role="button" aria-expanded="false" aria-controls="tambahImunisasi"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahImunisasi">
                                        <form action="{{ route('Imunisasi Ibu', [$dataIbu->id]) }}" method="POST">
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
                                                        @error('tgl_kembali_vitamin')
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
                                        <form action="{{ route('Vitamin Ibu', [$dataIbu->id]) }}" method="POST">
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
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Pemberian Vitamin</button>
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
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Konsultasi Ibu</p>
                                </li>
                                @if ($pemeriksaan->count() > 0)
                                    @foreach ($pemeriksaan as $data)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{ $data->jenis_pemeriksaan }} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->pegawai->nama_pegawai}}</p></div>
                                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#pemeriksaan{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="pemeriksaan{{ $loop->iteration }}"><i class="fas fa-plus-circle"></i></a></div>
                                            </div>
                                            @if ($data->jenis_pemeriksaan == 'Konsultasi')
                                                <div class="collapse my-3" id="pemeriksaan{{ $loop->iteration }}">
                                                    <div class="card card-body">
                                                        <span class="fw-bold">Usia Kehamilan :</span>
                                                        <p>{{ $usia_kandungan }} Bulan</p>
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
                                                        @if ($data->pengobatan != NULL)
                                                            <p>{{ $data->pengobatan }}</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
                                                        <span class="fw-bold">Keterangan Tambahan :</span>
                                                        @if ($data->keterangan != NULL)
                                                            <p>{{ $data->keterangan }}</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
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
                                                                <p>{{ $data->denyut_nadi }}</p>
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
                                                        @if ($data->tanggal_kembali != NULL)
                                                            <span class="fw-bold text-end mt-2 small">Tanggal Kembali: <span class="fw-normal">{{ date('d M Y', strtotime($data->tanggal_kembali)) }}</span></span>
                                                        @else
                                                            <span class="fw-bold text-end mt-2 small">Tanggal Kembali: <span class="fw-normal">-</span></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
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
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemberian Imunisasi</p>
                                </li>
                                @if ($imunisasi->count() > 0)
                                    @foreach ($imunisasi as $data)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Imunisasi {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{ $data->pegawai->nama_pegawai }}</p></div>
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
                                                        @if ($data->tanggal_kembali != NULL)
                                                            <p>{{ date('d M Y', strtotime($data->tanggal_kembali)) }}</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card card-body">
                                                    <span class="fw-bold">keterangan Tambahan :</span>
                                                    @if ($data->keterangan != NULL)
                                                        <p>{{ $data->keterangan }}</p>
                                                    @else
                                                        <p>-</p>
                                                    @endif
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
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Vitamin {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{ $data->pegawai->nama_pegawai }}</p></div>
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
                                                        @if ($data->tanggal_kembali != NULL)
                                                            <p>{{ date('d M Y', strtotime($data->tanggal_kembali)) }}</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card card-body">
                                                    <span class="fw-bold">keterangan Tambahan :</span>
                                                    @if ($data->keterangan != NULL)
                                                        <p>{{ $data->keterangan }}</p>
                                                    @else
                                                        <p>-</p>    
                                                    @endif
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
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Pemeriksaan', $dataIbu->user->id ) }}" alt="..." width="150" height="150">
                                    </div>
                                </div>
                                <h3 class="profile-username text-center mt-3">{{ $dataIbu->nama_ibu_hamil }}</h3>
                                <p class="text-muted text-center">{{ $umur }}</p>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6 my-auto"><span class="fw-bold">Suami</span></div>
                                            <div class="col-6 text-end"><span>{{ $dataIbu->nama_suami }}</span></div>
                                        </div>
                                    </li>
                                    {{-- <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Kesehatan Ibu</span></div>
                                            <div class="col-5 text-end my-auto"><span class="btn btn-success btn-sm">Sehat</span></div>
                                        </div>
                                    </li> --}}
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Usia Kandungan</span></div>
                                            <div class="col-5 text-end my-auto"><span>{{ $usia_kandungan }}</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Jumlah Kehamilan</span></div>
                                            @if ($dataIbu->kehamilan_ke == NULL)
                                                <div class="col-5 text-end my-auto"><span>-</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>Kehamilan ke-{{ $dataIbu->kehamilan_ke}}</span></div>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Jarak Anak Sebelumnya</span></div>
                                            @if ($dataIbu->jarak_anak_sebelumnya == NULL)
                                                <div class="col-5 text-end my-auto"><span>-</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>{{ $dataIbu->jarak_anak_sebelumnya }} Tahun</span></div>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Golongan Darah</span></div>
                                            @if ($dataIbu->user->golongan_darah != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $dataIbu->user->golongan_darah }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>-</span></div>
                                            @endif
                                        </div>
                                    </li>
                                    @if ($penyakitBawaan->count() > 0)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-7 my-auto"><span class="fw-bold">Penyakit Bawaan</span></div>
                                                @foreach ($penyakitBawaan as $data)
                                                    <div class="col-5 text-end my-auto">
                                                        <span>{{ $data->jenis_penyakit }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endif
                                    @if ($alergi->count() > 0)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-7 my-auto"><span class="fw-bold">Alergi {{ $alergi->kategori }}</span></div>
                                                <div class="col-5 text-end my-auto">
                                                    @foreach ($alergi as $data)
                                                        <span>{{ $data->jenis_alergi }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Bumil</a>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Bumil</a>
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