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
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-8 order-2 order-md-1 mb-3">
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
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
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Konsultasi', $dataIbu->user->id ) }}" alt="..." width="150" height="150">
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