@extends('layouts/admin/admin-layout')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Dashboard</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Smart Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>
    @if (auth()->guard('admin')->user()->pegawai->jabatan != "super admin")
        <div class="container-fluid px-0">
            <div class="row text-center">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Anak</h5>
                        <p class="card-text text-muted">{{ $anak->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Bumil</h5>
                        <p class="text-muted card-text">{{ $bumil->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Lansia</h5>
                        <p class="text-muted card-text">{{ $lansia->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Nakes</h5>
                        <p class="text-muted card-text">{{ $nakes->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header my-auto">
                            <p class="text-center my-auto fs-5">Jumlah Pemeriksaan</p>
                        </div>
                        <div class="card-body">
                            <canvas id="jmlhPemeriksaan"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header my-auto">
                            <p class="text-center my-auto fs-5">Jumlah Konsultasi</p>
                        </div>
                        <div class="card-body">
                            <canvas id="jmlhKonsultasi"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (auth()->guard('admin')->user()->pegawai->jabatan == "super admin")
        <div class="container-fluid px-0">
            <div class="row text-center">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Posyandu</h5>
                        <p class="card-text text-muted">{{ $posyandu->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Anggota</h5>
                        <p class="text-muted card-text">{{ $anggota->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Nakes</h5>
                        <p class="text-muted card-text">{{ $nakesAll->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="text-center">Jumlah Kader</h5>
                        <p class="text-muted card-text">{{ $kaderAll->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header my-auto">
                            <p class="text-center my-auto fs-5">Pertambahan Anggota</p>
                        </div>
                        <div class="card-body">
                            <canvas id="pertambahanAnggota"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#admin-dashboard').addClass('active');
        });
    </script>

    @if (auth()->guard('admin')->user()->pegawai->jabatan == "super admin")
        <script>
            var ctx3 = document.getElementById('pertambahanAnggota');
            var myChart3 = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: ['Bumil', 'Anak', 'Lansia'],
                    datasets: [{
                        label: 'Pertambahan',
                        data: ["{{$jumlahIbu}}", "{{$jumlahAnak}}", "{{$jumlahLansia}}"],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                         }]
                    }
                }
            });
        </script>
    @else
        <script>
            var ctx1 = document.getElementById('jmlhPemeriksaan');
            var myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Bumil', 'Anak', 'Lansia'],
                    datasets: [{
                        label: 'Pertambahan',
                        data: ["{{$jumlahPemIbu}}", "{{$jumlahPemAnak}}", "{{$jumlahPemLansia}}"],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                         }]
                    }
                }
            });

            var ctx2 = document.getElementById('jmlhKonsultasi');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Bumil', 'Anak', 'Lansia'],
                    datasets: [{
                        label: 'Pertambahan',
                        data: ["{{$jumlahKonIbu}}", "{{$jumlahKonAnak}}", "{{$jumlahKonLansia}}"],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                         }]
                    }
                }
            });
        </script>
    @endif
@endpush
