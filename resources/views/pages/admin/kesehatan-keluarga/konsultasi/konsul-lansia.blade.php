@extends('layouts/admin/admin-layout')

@section('title', 'Konsultasi Lansia')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Konsultasi Lansia</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Konsultasi') }}">Konsultasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konsultasi Lansia</li>
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
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Konsultasi Lansia</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#konsulLansia" role="button" aria-expanded="false" aria-controls="konsulLansia"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="konsulLansia">
                                        <form action="{{ route('Tambah Konsultasi Lansia', [$dataLansia->id]) }}">
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
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Penyakit Bawaan Lansia</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPenyakitBawaan" role="button" aria-expanded="false" aria-controls="tambahPenyakitBawaan"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahPenyakitBawaan">
                                        <form action="{{ route('Tambah Penyakit Bawaan', $dataLansia->id_user) }}" method="POST">
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
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Lansia</p>
                                </li>
                                @foreach ($pemeriksaan as $data)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{ $data->jenis_pemeriksaan }} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->pegawai->nama_pegawai}}</p></div>
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
                                                            <p>{{ $data->tekanan_darah }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center">
                                                        <div class="col-6">
                                                            <span class="fw-bold">Denyut Nadi :</span>
                                                            <p>{{ $data->denyut_nadi }}</p>
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
                                                        <p>{{ $data->nama_vitamin }}</p>
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
                    <div class="col-sm-12 col-md-5 col-lg-4 order-1 order-md-2">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Konsultasi', $dataLansia->user->id ) }}" alt="..." width="150" height="150">
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
                                            @if ($pj != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $pj->nama }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>Belum ditambahkan</span></div>
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
                                            @if ($dataLansia->user->golongan_darah != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $dataLansia->user->golongan_darah }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>-</span></div>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Faskes Rujukan</span></div>
                                            @if ($dataLansia->user->faskes_rujukan != NULL)
                                                <div class="col-5 text-end my-auto"><span>{{ $dataLansia->user->faskes_rujukan }}</span></div>
                                            @else
                                                <div class="col-5 text-end my-auto"><span>Belum ditambahkan</span></div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                                <a href="{{ route('Detail Anggota Lansia', $dataLansia->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Lansia</a>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Lansia</a>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 my-auto text-center"><span class="fw-bold fs-5">Masalah Kesehatan Lansia</span></div>
                                    </div>
                                </li>
                                @if ($riwayatPenyakit->count() < 1)
                                    <li class="list-group-item">
                                        <div class="row px-2 text-center">
                                            <div class="col-12 my-3">
                                                <span class="fw-bold">Tidak terdapat riwayat penyakit lansia</span>
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