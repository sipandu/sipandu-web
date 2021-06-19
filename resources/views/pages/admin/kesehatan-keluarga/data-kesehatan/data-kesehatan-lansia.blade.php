@extends('layouts/admin/admin-layout')

@section('title', 'Data Kesehatan Lansia')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Kesehatan Lansia</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Kesehatan') }}">Data Kesehatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lansia</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Pemeriksaan', $dataLansia->id_user) }}" alt="..." width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{ $dataLansia->nama_lansia }}</h3>
                        <p class="text-muted text-center">{{ $dataLansia->user->email }}</p>
                        <ul class="list-group list-group-unbordered mb-1">
                            <li class="list-group-item">
                                <b class="fw-bold">Usia</b>
                                <a class="float-right text-decoration-none link-dark">{{ $umur }} Tahun</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Kategori</b>
                                <a class="float-right text-decoration-none link-dark">{{ $dataLansia->status }}</a>
                            </li>
                            @if ($dataLansia->user->golongan_darah == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Golongan Darah</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Golongan Darah</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataLansia->user->golongan_darah }}</a>
                                </li>
                            @endif
                            @if ($dataLansia->nomor_telepon == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Nomor Telepon</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Nomor Telpon</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataLansia->nomor_telepon }}</a>
                                </li>
                            @endif
                            @if ($dataLansia->user->telegram == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Telegram</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Telegram</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataLansia->user->username_tele }}</a>
                                </li>
                            @endif
                            @if ($dataLansia->user->tanggungan == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Tanggungan</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Tanggungan</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataLansia->user->tanggungan }}</a>
                                </li>
                            @endif
                            @if ($dataLansia->user->tanggungan == 'Dengan Tanggungan')
                                <li class="list-group-item">
                                    <b class="fw-bold">No JKN</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataLansia->user->no_jkn }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b class="fw-bold">Masa Berlaku</b>
                                    <a class="float-right text-decoration-none link-dark">{{ date('d M Y', strtotime($dataLansia->user->masa_berlaku)) }}</a>
                                </li>
                            @endif
                            @if ($dataLansia->user->faskes_rujukan == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Faskes Rujukan</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Faskes Rujukan</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataLansia->user->faskes_rujukan }}</a>
                                </li>
                            @endif
                        </ul>
                        <a href="{{ route('Detail Anggota Lansia', $dataLansia->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Lansia</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" value="{{ $dataLansia->nama_lansia }}" disabled readonly>
                                    <label for="floatingInput">Nama Lansia</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $pj->nama ?? "Belum ditambahkan" }}" disabled readonly>
                                    <label for="floatingInput">Nama Keluarga Dekat</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="alergi" placeholder="Masukan lokasi pemeriksaan" disabled readonly>@if ($alergi->count() > 0)@foreach ($alergi as $data){{ $data->nama_alergi }}. @endforeach @else{{'Belum ditambahkan'}}@endif
                                    </textarea>
                                    <label for="alergi">Alergi</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="penyakitBawaan" placeholder="Masukan lokasi pemeriksaan" disabled readonly>@if ($penyakitBawaan->count() > 0)@foreach ($penyakitBawaan as $data){{ $data->nama_penyakit }}. @endforeach @else{{'Belum ditambahkan'}}@endif
                                    </textarea>
                                    <label for="penyakitBawaan">Penyakit Bawaan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="alergi" placeholder="Masukan lokasi pemeriksaan" disabled readonly>@if ($riwayatPenyakit->count() > 0)@foreach ($riwayatPenyakit as $data){{ $data->nama_penyakit }}. @endforeach @else{{'Belum ditambahkan'}}@endif
                                    </textarea>
                                    <label for="alergi">Masalah Kesehatan</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="penyakitBawaan" placeholder="Masukan lokasi pemeriksaan" disabled readonly>Masih Mengalami</textarea>
                                    <label for="penyakitBawaan">Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $vitamin->count() }} Kali" disabled readonly>
                                    <label for="konsultasi">Pemberian Vitamin</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $imunisasi->count() }} Kali" disabled readonly>
                                    <label for="pemeriksaan">Pemberian Imunisasai</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $pemeriksaan->where('jenis_pemeriksaan', 'Konsultasi')->count() }} Kali" disabled readonly>
                                    <label for="konsultasi">Jumlah Konsultasi</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $pemeriksaan->where('jenis_pemeriksaan', 'Pemeriksaan')->count() }} Kali" disabled readonly>
                                    <label for="pemeriksaan">Jumlah Pemeriksaan</label>
                                </div>
                            </div>
                        </div>
                        @if ($dataKesehatan != NULL)
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->suhu_tubuh }}.&deg" disabled readonly>
                                        <label for="konsultasi">Suhu Tubuh</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->berat_badan }} Kilogram" disabled readonly>
                                        <label for="pemeriksaan">Berat Badan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->tinggi_lutut }} Sentimeter" disabled readonly>
                                        <label for="konsultasi">Tinggi Lutut</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->tinggi_badan }} Sentimeter" disabled readonly>
                                        <label for="pemeriksaan">Tinggi Badan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->tekanan_darah }}" disabled readonly>
                                        <label for="konsultasi">Tekanan Darah</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->denyut_nadi }}" disabled readonly>
                                        <label for="pemeriksaan">Denyut Nadi</label>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="konsultasi">Suhu Tubuh</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="pemeriksaan">Berat Badan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="konsultasi">Tinggi Lutut</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="pemeriksaan">Tinggi Badan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="konsultasi">Tekanan Darah</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="pemeriksaan">Denyut Nadi</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Lansia</p>
                        </li>
                        @if ($pemeriksaan->count() > 0)
                            @foreach ($pemeriksaan as $data)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{ $data->jenis_pemeriksaan }} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->nakes->nama_nakes}}</p></div>
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
                        @else
                            <li class="list-group-item my-auto">
                                <p class="text-center my-auto">Belum Pernah Melakukan Pemeriksaan</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card card-primary card-outline">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemberian Imunisasi</p>
                        </li>
                        @if ($imunisasi->count() > 0)
                            @foreach ($imunisasi as $data)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Imunisasi {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{ $data->nakes->nama_nakes }}</p></div>
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
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card card-primary card-outline">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemberian Vitamin</p>
                        </li>
                        @if ($vitamin->count() > 0)
                            @foreach ($vitamin as $data)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Vitamin {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{ $data->nakes->nama_nakes }}</p></div>
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
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#data-kesehatan-keluarga').addClass('active');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // const DATA_COUNT = 12;
    const labels = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42];
    // for (let i = 0; i < DATA_COUNT; ++i) {
    //     labels.push(i.toString());
    // }
    const datapoints = [0, 0.25, 0.4, 0.55, 0.7, 0.8, 0.9, 1, 1.1, 1.2, 1.4, 1.6, 1.8, 2, 2.6, 3.2, 3.8, 4.2, 4.8, 5.4, 6, 6.6, 7.2, 7.8, 8.4, 9, 9.6, 10.2, 10.8, 11.4, 12, 12.6, 13.2, 13.8, 14.4, 15, 15.6, 16.2, 16.8, 17.4, 18];
    const data = {
        labels: labels,
        data: datapoints,
        datasets: [
            {
                label: 'Cubic interpolation (monotone)',
                data: datapoints,
                borderColor: '#111111',
                fill: false,
                // cubicInterpolationMode: 'monotone',
                // tension: 1
            }, 
            // {
            //     label: 'Cubic interpolation',
            //     data: datapoints,
            //     borderColor: '#36a2eb',
            //     fill: false,
            //     tension: 0.4
            // }, 
            // {
            //     label: 'Linear interpolation (default)',
            //     data: datapoints,
            //     borderColor: '#cc65fe',
            //     fill: false
            // }
        ]
    };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Berat Badan'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true
                        },  
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Value'
                        },
                        // suggestedMin: -1,
                        // suggestedMax: 23,
                        // labels: [-3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
                    }
                }
            },
        };
        
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
  
@endpush
