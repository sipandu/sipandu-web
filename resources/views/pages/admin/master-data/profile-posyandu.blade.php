@extends('layouts/admin/admin-layout')

@section('title', 'Profile Posyandu')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Profile Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-title h4 my-auto">Profile Posyandu</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Jumlah Ibu Hamil</span>
                                                <span class="info-box-number text-center text-muted mb-0">180</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Jumlah Anak</span>
                                                <span class="info-box-number text-center text-muted mb-0">555</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Jumlah Lansia</span>
                                                <span class="info-box-number text-center text-muted mb-0">1041</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-5">
                                        <h4 class="pb-3 mb-3 border-bottom border-2 border-primary">Kegiatan Berjalan</h4>
                                        <div class="post">
                                            <a href="" class="card-title text-decoration-none lh-1 fw-bold">Nama Kegiatan</a>
                                            <p class="card-text lh-1"><small class="text-muted">Tempat Kegiatan 17-Mar-2021 sampai 20-Mar-2021</small></p>
                                            <p>Deskripsi dari kegiatan posyandu yang tengah berjalan</p>
                                            <p>
                                                <a href="#" class="link-black text-sm text-decoration-none"><i class="fas fa-link mr-1"></i> Lihat detail</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <h4 class="pb-3 mb-3 mt-5 pt-3 border-bottom border-2 border-primary">Kegiatan Terlaksana</h4>
                                        <div class="post">
                                            <p href="" class="card-title text-decoration-none lh-1 fw-bold">Nama Kegiatan</p>
                                            <p class="card-text lh-1"><small class="text-muted">Tempat Kegiatan. Berakhir pada 12-Mar-2020</small></p>
                                            <p>Deskripsi dari kegiatan posyandu yang telah terlaksana<p>
                                                <a href="#" class="link-black text-sm text-decoration-none"><i class="fas fa-link mr-1"></i> Lihat detail</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <h3 class="text-primary"><i class="fas fa-clinic-medical pe-3"></i> Posyandu Seger Urip</h3>
                                <h5 class="mt-5 text-muted">Administrator</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-user-shield"></i> I Gede Hadi Darmawan</a>
                                    </li>
                                </ul>
                                <h5 class="mt-3 text-muted">Alamat</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-map-marker-alt"></i> Jalan Raya Sempidi, Br. Pande, Sempidi, Mengwi, Badung</a>
                                    </li>
                                </ul>
                                <h5 class="mt-3 text-muted">Lokasi</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-map-marked-alt"></i> Lihat pada peta</a>
                                    </li>
                                </ul>
                                <h5 class="mt-3 text-muted">Nomor Telp</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-phone-square-alt"></i> 0361 1234567</a>
                                    </li>
                                </ul>
                                <h5 class="mt-3 text-muted">Jumlah Petugas</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-user-shield"></i> 1 Administrator</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-user-tag"></i> 10 Kader</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-user-nurse"></i> 41 Tenaga Kesehatan</a>
                                    </li>
                                </ul>
                                <h5 class="mt-5 text-muted">Kegiatan Selanjutnya</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-long-arrow-alt-right"></i> Kegiatan Selanjutnya Pertama</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-long-arrow-alt-right"></i> Kegiatan Selanjutnya Kedua</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-long-arrow-alt-right"></i> Kegiatan Selanjutnya Ketiga</a>
                                    </li>
                                </ul>
                                <div class="text-center mt-5 mb-5">
                                    <a href="{{ route('Admin Home') }}" class="btn btn-sm btn-primary">Kembali</a>
                                    <a href="{{ route('Edit Profile Posyandu') }}" class="btn btn-sm btn-warning">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-management-posyandu').addClass('menu-is-opening menu-open');
            $('#management-posyandu').addClass('active');
            $('#profile-posyandu').addClass('active');
        });
    </script>
@endpush
