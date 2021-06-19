@extends('layouts/admin/admin-layout')

@section('title', 'Data Kesehatan Anak')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Kesehatan Anak</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Kesehatan') }}">Data Kesehatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Anak</li>
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
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Pemeriksaan', $dataAnak->id_user) }}" alt="..." width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{ $dataAnak->nama_anak }}</h3>
                        <p class="text-muted text-center">{{ $dataAnak->user->email }}</p>
                        <ul class="list-group list-group-unbordered mb-1">
                            <li class="list-group-item">
                                <b class="fw-bold">Status Anak</b>
                                <a class="float-right text-decoration-none link-dark">Anak ke-{{ $dataAnak->anak_ke }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Usia</b>
                                <a class="float-right text-decoration-none link-dark">{{ $usia }}</a>
                            </li>
                            @if ($dataAnak->user->golongan_darah == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Golongan Darah</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Golongan Darah</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataAnak->user->golongan_darah }}</a>
                                </li>
                            @endif
                            @if ($dataAnak->nomor_telepon == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Nomor Telepon</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Nomor Telpon</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataAnak->nomor_telepon }}</a>
                                </li>
                            @endif
                            @if ($dataAnak->user->telegram == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Telegram</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Telegram</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataAnak->user->username_tele }}</a>
                                </li>
                            @endif
                            @if ($dataAnak->user->tanggungan == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Tanggungan</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Tanggungan</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataAnak->user->tanggungan }}</a>
                                </li>
                            @endif
                            @if ($dataAnak->user->tanggungan == 'Dengan Tanggungan')
                                <li class="list-group-item">
                                    <b class="fw-bold">No JKN</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataAnak->user->no_jkn }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b class="fw-bold">Masa Berlaku</b>
                                    <a class="float-right text-decoration-none link-dark">{{ date('d M Y', strtotime($dataAnak->user->masa_berlaku)) }}</a>
                                </li>
                            @endif
                            @if ($dataAnak->user->faskes_rujukan == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Faskes Rujukan</b>
                                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Faskes Rujukan</b>
                                    <a class="float-right text-decoration-none link-dark">{{ $dataAnak->user->faskes_rujukan }}</a>
                                </li>
                            @endif
                        </ul>
                        <a href="{{ route('Detail Anggota Anak', $dataAnak->id) }}" class="btn btn-sm btn-outline-info btn-block mt-3" target="_blank">Detail Anak</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" value="{{ $dataAnak->nama_anak}}" disabled readonly>
                                    <label for="floatingInput">Nama Anak</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" value="{{ $dataAnak->nama_ayah }}" disabled readonly>
                                    <label for="floatingInput">Nama Ayah</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $dataAnak->nama_ibu }}" disabled readonly>
                                    <label for="floatingInput">Nama Ibu</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="alergi" placeholder="Masukan lokasi pemeriksaan" disabled readonly>@if ($alergi->count() > 0)@foreach ($alergi as $data){{ $data->nama_alergi }}. @endforeach @else{{'Belum ditambahkan'}}@endif
                                    </textarea>
                                    <label for="alergi">Alergi</label>
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
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->lingkar_kepala }} Sentimeter" disabled readonly>
                                        <label for="konsultasi">Lingkar Kepala</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->tinggi_badan }} Sentimeter" disabled readonly>
                                        @if ($umur > 0)
                                            <label for="pemeriksaan">Tinggi Badan</label>
                                        @else
                                            <label for="pemeriksaan">Panjang Badan</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->berat_badan }} Kilogram" disabled readonly>
                                        <label for="konsultasi">Berat Badan</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $dataKesehatan->IMT }}" disabled readonly>
                                        <label for="pemeriksaan">IMT</label>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="konsultasi">Lingkar Kepala</label>
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
                                        <label for="konsultasi">Berat Badan</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="Tidak Tersedia" disabled readonly>
                                        <label for="pemeriksaan">IMT</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    @if($js_berat != null || $js_tinggi != null)
                    <div>
                        <canvas id="bb_tb"></canvas>
                    </div>
                    @else 
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
                        </li>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    @if($js_berat != null || $js_usia != null)
                    <div>
                        <canvas id="bb_umur"></canvas>
                    </div>
                    @else 
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
                        </li>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    @if($js_tinggi != null || $js_usia != null)
                    <div>
                        <canvas id="tb_umur"></canvas>
                    </div>
                    @else 
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
                        </li>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    @if($js_lingkar != null || $js_usia != null)
                    <div>
                        <canvas id="lila"></canvas>
                    </div>
                    @else 
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
                        </li>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Anak</p>
                        </li>
                        @if ($pemeriksaan->count() > 0)
                            @foreach ($pemeriksaan as $data)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">{{$data->jenis_pemeriksaan}} {{ date('d M Y', strtotime($data->created_at)) }} | Oleh {{$data->nakes->nama_nakes}}</p></div>
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
                                <p class="text-center my-auto">Belum Pernah Melakukan Imuniasi</p>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#data-kesehatan-keluarga').addClass('active');
        });
    </script>

    <script>
        const tinggi = JSON.parse("{{$js_tinggi}}");
        const berat = JSON.parse("{{$js_berat}}");
        const umur = JSON.parse("{{$js_usia}}");
        const lingkar = JSON.parse("{{$js_lingkar}}");
        const datatingber = {
            labels: tinggi,
            data: berat,
            datasets: [
                {
                    label: 'Data Berat Berdasarkan Tinggi Badan',
                    data: berat,
                    borderColor: '#111111',
                    fill: false,
                },
            ]
        };

        const databerum = {
            labels: berat,
            data: umur,
            datasets: [
                {
                    label: 'Umur',
                    data: umur,
                    borderColor: '#111111',
                    fill: false,
                },
            ]
        };

        const datatingmur = {
            labels: tinggi,
            data: umur,
            datasets: [
                {
                    label: 'Umur',
                    data: umur,
                    borderColor: '#111111',
                    fill: false,
                },
            ]
        };

        const datalingkar = {
            labels: lingkar,
            data: umur,
            datasets: [
                {
                    label: 'Umur',
                    data: umur,
                    borderColor: '#111111',
                    fill: false,
                },
            ]
        };

        const config1 = {
            type: 'line',
            data: datatingber,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Berat Badan Berdasarkan Tinggi Badan Anak'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Tinggi Badan'
                        },  
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Berat Badan'
                        },
                    }
                }
            },
        };

        const config2 = {
            type: 'line',
            data: databerum,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Berat Badan Berdasarkan Usia Anak'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Berat Badan'
                        },  
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Usia'
                        },
                    }
                }
            },
        };

        const config3 = {
            type: 'line',
            data: datatingmur,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Tinggi Badan Berdasarkan Usia Anak'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Tinggi Badan'
                        },  
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Usia'
                        },
                    }
                }
            },
        };

        const config4 = {
            type: 'line',
            data: datalingkar,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik pertumbuhan Lingkar Kepala Berdasarkan Usia Anak'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Lingkar Kepala'
                        },  
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Usia'
                        },
                    }
                }
            },
        };
        
        var bb_tb = new Chart(
            document.getElementById('bb_tb'),
            config1
        );
        
        var bb_umur = new Chart(
            document.getElementById('bb_umur'),
            config2
        );

        var tb_umur = new Chart(
            document.getElementById('tb_umur'),
            config3
        );

        var lila = new Chart(
            document.getElementById('lila'),
            config4
        );
    </script>
  
@endpush
