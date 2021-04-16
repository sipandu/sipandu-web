@extends('layouts/admin/admin-layout')

@section('title', 'Data Kesehatan Ibu')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Kesehatan Ibu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Kesehatan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kehatan Ibu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-4">
                <div class="card card-primary card-outline p-3">
                    <span class="fw-bold">Nama Ibu</span>
                    <p>Nama ibu hamilnya</p>
                    <span class="fw-bold">Nama Suami</span>
                    <p>Nama suaminya ibu</p>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-primary card-outline p-3">
                    <span class="fw-bold">Usia Ibu</span>
                    <p>Usia Ibunya</p>
                    <span class="fw-bold">Usia Kehamilan</span>
                    <p>Usia kehamilan terbaru</p>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-primary card-outline p-3">
                    <span class="fw-bold">Berat Badan Rata-rata</span>
                    <p>50 Kg</p>
                    <span class="fw-bold">Indeks Masa Tubuh</span>
                    <p>Ideal</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Ibu</p>
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
                                            <span class="fw-bold">Usia Ibu :</span>
                                            <p>50 Minggu</p>
                                        </div>
                                        <div class="col-6">
                                            <span class="fw-bold">Usia Kehamilan :</span>
                                            <p>20 Sentimeter</p>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <span class="fw-bold">Lingkar Lengan :</span>
                                            <p>80 Kilogram</p>
                                        </div>
                                        <div class="col-6">
                                            <span class="fw-bold">Berat Badan :</span>
                                            <p>30 Sentimeter</p>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <span class="fw-bold">Tinggi Rahim :</span>
                                            <p>130</p>
                                        </div>
                                        <div class="col-6">
                                            <span class="fw-bold">Denyut Nadi :</span>
                                            <p>80</p>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <span class="fw-bold">Tekanan Darah :</span>
                                            <p>120/80</p>
                                        </div>
                                        <div class="col-6">
                                            <span class="fw-bold">Detak Jantung Bayi :</span>
                                            <p>21 Mei 2021</p>
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
