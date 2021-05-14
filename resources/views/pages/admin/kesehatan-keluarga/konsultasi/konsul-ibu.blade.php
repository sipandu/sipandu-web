@extends('layouts/admin/admin-layout')

@section('title', 'Konsultasi Ibu')

@push('css')
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Konsultasi Ibu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Konsultasi') }}">Konsultasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konsultasi Ibu</li>
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
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-8 order-2 order-md-1 mb-3">
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Data Persalinan Sebelumnya</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahKelahiran" role="button" aria-expanded="false" aria-controls="tambahKelahiran"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahKelahiran">
                                        <form action="{{ route('Tambah Data Persalinan', $dataIbu->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <label for="nama_anak" class="form-label">Nama Anak<span class="text-danger">*</span></label>
                                                    <input class="form-control @error('berat_lahir') is-invalid @enderror" list="dataAnak" id="nama_anak" name="nama_anak" placeholder="Cari nama anak...">
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
                                                        <input type="text" name="berat_lahir" autocomplete="off" class="form-control @error('berat_lahir') is-invalid @enderror" id="berat_lahir" value="{{ old('berat_lahir') }}" placeholder="LK Anak">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text fw-bold">
                                                                Gram
                                                            </div>
                                                        </div>
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
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Konsultasi Ibu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#konsulIbu" role="button" aria-expanded="false" aria-controls="konsulIbu"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="konsulIbu">
                                        <form action="{{ route('Tambah Konsultasi Ibu', [$dataIbu->id]) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="usia_kehamilan" class="form-control @error('usia_kehamilan') is-invalid @enderror" id="usia_kehamilan" value="{{ old('usia_kehamilan') }}" placeholder="Usia Kehamilan dalam minggu">
                                                        <label for="usia_kehamilan">Usia Kehamilan<span class="text-danger">*</span></label>
                                                        @error('usia_kehamilan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan hasil konsultasi"></textarea>
                                                        <label for="diagnosa">Hasil Konsultasi<span class="text-danger">*</span></label>
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
                                                    <button type="submit" class="btn btn-block btn-success">Simpan Catatan Konsultasi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Penyakit Bawaan Ibu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPenyakitBawaan" role="button" aria-expanded="false" aria-controls="tambahPenyakitBawaan"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahPenyakitBawaan">
                                        <form action="{{ route('Tambah Penyakit Bawaan', $dataIbu->id_user) }}" method="POST">
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
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{ $data->jenis_pemeriksaan }} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->pegawai->nama_pegawai}}</p></div>
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
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Konsultasi', $dataIbu->user->id ) }}" alt="..." width="150" height="150">
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
                                            <div class="col-7 my-auto"><span class="fw-bold">Jumlah Kehamilan</span></div>
                                            @if ($dataIbu->kehamilan_ke == NULL)
                                                <div class="col-5 text-end my-auto"><span>Kehamilan pertama</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>Kehamilan ke-{{ $persalinan->count() + 1}}</span></div>
                                            @endif
                                        </div>
                                    </li>
                                    @if ($dataIbu->kehamilan_ke != NULL)
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
                                            @if ($dataIbu->user->tanggungan != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $dataIbu->user->tanggungan }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>Belum ditambahkan</span></div>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Faskes Rujukan</span></div>
                                            @if ($dataIbu->user->faskes_rujukan != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $dataIbu->user->faskes_rujukan }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>Belum ditambahkan</span></div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                                <a href="{{ route('Detail Anggota Ibu', $dataIbu->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Bumil</a>
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
            $('#konsultasi').addClass('active');
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

    @if($message = Session::get('success'))
    <script>
        $(document).ready(function(){
            alertSuccess('{{$message}}');
        });
    </script>
    @endif
@endpush