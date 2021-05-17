@extends('layouts/admin/admin-layout')

@section('title', 'Konsultasi Anak')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Konsultasi Anak</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Konsultasi') }}">Konsultasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konsultasi Anak</li>
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
                                @if ($persalinan == NULL)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Data Kelahiran Anak</p></div>
                                            <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahKelahiran" role="button" aria-expanded="false" aria-controls="tambahKelahiran"><i class="fas fa-plus-circle"></i></a></div>
                                        </div>
                                        <div class="collapse my-3" id="tambahKelahiran">
                                            <form action="{{ route('Tambah Data Kelahiran Anak', [$dataAnak->id]) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 my-2">
                                                        <label for="nama_ibu" class="form-label">Nama Ibu<span class="text-danger">*</span></label>
                                                        <input class="form-control @error('berat_lahir') is-invalid @enderror" list="dataIbu" id="nama_ibu" name="nama_ibu" placeholder="Cari nama ibu...">
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
                                                            <input type="text" name="berat_lahir" autocomplete="off" class="form-control @error('berat_lahir') is-invalid @enderror" id="berat_lahir" value="{{ old('berat_lahir') }}" placeholder="LK Anak">
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
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Konsultasi Anak</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#konsulAnak" role="button" aria-expanded="false" aria-controls="konsulAnak"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="konsulAnak">
                                        <form action="{{ route('Tambah Konsultasi Anak', [$dataAnak->id]) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <div class="form-floating">
                                                        <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan hasil konsultasi"></textarea>
                                                        <label for="keterangan">Hasil Konsultasi<span class="text-danger">*</span></label>
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
                                                    <button class="btn btn-block btn-success">Simpan Catatan Konsultasi</button>
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
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Konsultasi Anak</p>
                                </li>
                                @if ($pemeriksaan->count() > 0)
                                    @foreach ($pemeriksaan as $data)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{$data->jenis_pemeriksaan}} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->pegawai->nama_pegawai}}</p></div>
                                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#pemeriksaan{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="pemeriksaan{{ $loop->iteration }}"><i class="fas fa-plus-circle"></i></a></div>
                                            </div>
                                            @if ($data->jenis_pemeriksaan == 'Konsultasi')
                                                <div class="collapse my-3" id="pemeriksaan{{ $loop->iteration }}">
                                                    <div class="card card-body">
                                                        <span class="fw-bold">Usia Anak :</span>
                                                        <p>{{ $usia }}</p>
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
                                                        <p>{{ $usia }}</p>
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
                                                                <span class="fw-bold">Lingkar Kelapa :</span>
                                                                <p>{{ $data->langkar_kepala }} Sentimeter</p>
                                                            </div>
                                                            @if ( $usia < 2)
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
                                                    <span class="fw-bold">Keterangan Tambahan :</span>
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
                                                    <span class="fw-bold">Keterangan Tambahan :</span>
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
                    <div class="col-sm-12 col-md-5 col-lg-4 order-1 order-md-2 mb-2">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Konsultasi', $dataAnak->user->id ) }}" alt="..." width="150" height="150">
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
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6 my-auto"><span class="fw-bold">Status Gizi</span></div>
                                            <div class="col-6 text-end my-auto"><span class="btn btn-danger btn-sm">Kurang Gizi</span></div>
                                        </div>
                                    </li>
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
                                            @if ($persalinan != NULL)
                                                <div class="col-6 text-end my-auto"><span>{{ $persalinan->persalinan }}</span></div>
                                            @else
                                                <div class="col-6 text-end my-auto"><span>Belum ditambahkan</span></div>
                                            @endif
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
                                            @if ($dataAnak->user->golongan_darah != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $dataAnak->user->golongan_darah }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>-</span></div>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Faskes Rujukan</span></div>
                                            @if ($dataAnak->user->faskes_rujukan != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $dataAnak->user->faskes_rujukan }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>Belum ditambahkan</span></div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                                <a href="{{ route('Detail Anggota Anak', $dataAnak->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Anak</a>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Anak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#konsultasi').addClass('active');
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