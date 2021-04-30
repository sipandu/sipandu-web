@extends('layouts/admin/admin-layout')

@section('title', 'Data Kesehatan Anak')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Kesehatan Anak</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Kesehatan') }}">Kesehatan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kehatan Anak</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card card-primary card-outline p-3">
                    <span class="fw-bold">Nama Anak</span>
                    <p>Nama Anaknya</p>
                    <span class="fw-bold">Nama Ibu</span>
                    <p>Nama Ibunya</p>
                    <span class="fw-bold">Nama Ayah</span>
                    <p>Nama Ayahnya</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-primary card-outline p-3">
                    <span class="fw-bold">Usia Anak</span>
                    <p>60 Bulan</p>
                    <span class="fw-bold">Status Anak</span>
                    <p>Anak ke-2</p>
                    <span class="fw-bold">Indeks Masa Tubuh</span>
                    <p>Ideal</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-primary card-outline p-3">
                    <span class="fw-bold">Berat Badan Rata-rata</span>
                    <p>50 Kg</p>
                    <span class="fw-bold">Tinggi Badan Rata-rata</span>
                    <p>Ideal</p>
                    <span class="fw-bold">Lingkar Kelapa Rata-rata</span>
                    <p>Ideal</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
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
        </div>
        <div class="row">
            <div class="col-12">
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
        </div>
        <div class="row">
            <div class="col-12">
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
        </div>
        <div class="row">
            <div class="col-12">
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
        <!-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div>
                        <canvas id="kms"></canvas>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Anak</p>
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
                                            <span class="fw-bold">Usia Anak :</span>
                                            <p>15 Tahun</p>
                                        </div>
                                        <div class="col-6">
                                            <span class="fw-bold">Berat Badan :</span>
                                            <p>15 Kilogram</p>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <span class="fw-bold">Lingkar Kelapa :</span>
                                            <p>40 Sentimeter</p>
                                        </div>
                                        <div class="col-6">
                                            <span class="fw-bold">Tinggi Badan :</span>
                                            <p>15 Sentimeter</p>
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
                                    <span class="fw-bold">Hasil Konsultasi :</span>
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
        // const labels = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42];
        // const datapoints = [0, 0.25, 0.4, 0.55, 0.7, 0.8, 0.9, 1, 1.1, 1.2, 1.4, 1.6, 1.8, 2, 2.6, 3.2, 3.8, 4.2, 4.8, 5.4, 6, 6.6, 7.2, 7.8, 8.4, 9, 9.6, 10.2, 10.8, 11.4, 12, 12.6, 13.2, 13.8, 14.4, 15, 15.6, 16.2, 16.8, 17.4, 18];
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

        // const datatingber = {
        //     labels: tinggi,
        //     data: berat,
        //     datasets: [
        //         {
        //             label: 'Data Berat Berdasarkan Tinggi Badan',
        //             data: berat,
        //             borderColor: '#111111',
        //             fill: false,
        //         },
        //     ]
        // };

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
                        // suggestedMin: -1,
                        // suggestedMax: 23,
                        // labels: [-3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
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
                        // suggestedMin: -1,
                        // suggestedMax: 23,
                        // labels: [-3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
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
                        // suggestedMin: -1,
                        // suggestedMax: 23,
                        // labels: [-3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
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
                        // suggestedMin: -1,
                        // suggestedMax: 23,
                        // labels: [-3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
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

        // var kms = new Chart(
        //     document.getElementById('kms'),
        //     config
        // );
    </script>
  
@endpush
