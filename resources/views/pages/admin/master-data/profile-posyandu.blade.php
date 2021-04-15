@extends('layouts/admin/admin-layout')

@section('title', 'Profile Posyandu')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
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
                                        @if ($currentKegiatan->count() > 0)
                                            @foreach ($currentKegiatan as $kegiatan)
                                                <div class="post">
                                                    <a href="" class="card-title text-decoration-none lh-1 fw-bold">{{ $kegiatan->nama_kegiatan }}</a>
                                                    <p class="card-text lh-1"><small class="text-muted">{{ $kegiatan->tempat }} {{ date('d-M-y', strtotime($kegiatan->start_at)) }} sampai {{ date('d-M-y', strtotime($kegiatan->end_at)) }}</small></p>
                                                    <p>{{ $kegiatan->deskripsi }}</p>
                                                    <p>
                                                        <a href="#" class="link-black text-sm text-decoration-none"><i class="fas fa-link mr-1"></i> Lihat detail</a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="post">
                                                <p class="card-title text-decoration-none lh-1 fw-bold">Tidak Terdapat Kegiatan</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 mt-4">
                                        <h4 class="pb-3 mb-3 mt-5 pt-3 border-bottom border-2 border-primary">Kegiatan Terlaksana</h4>
                                        @if ($lastKegiatan->count() > 0)
                                            @foreach ($lastKegiatan as $kegiatan)
                                                <div class="post">
                                                    <p href="" class="card-title text-decoration-none lh-1 fw-bold">{{ $kegiatan->nama_kegiatan }}</p>
                                                    <p class="card-text lh-1"><small class="text-muted">{{ $kegiatan->tempat }} Berakhir pada {{ date('d-M-y', strtotime($kegiatan->end_at)) }}</small></p>
                                                    <p>{{ $kegiatan->deskripsi }}<p>
                                                        <a href="#" class="link-black text-sm text-decoration-none"><i class="fas fa-link mr-1"></i> Lihat detail</a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="post">
                                                <p class="card-title text-decoration-none lh-1 fw-bold">Belum Terdapat Kegiatan</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <h3 class="text-primary"><i class="fas fa-clinic-medical pe-3"></i> {{ Auth::guard('admin')->user()->pegawai->posyandu->nama_posyandu}}</h3>
                                <h5 class="mt-5 text-muted"><i class="fas fa-user-shield"></i> Ketua Administrator</h5>
                                <ul class="list-unstyled">
                                    @if ($headAdmin->count() < 1)
                                        <li>
                                            <a class="btn-link text-secondary text-decoration-none">Head Admin Belum Ditambahkan</a>
                                        </li>
                                    @else
                                        @foreach ($headAdmin as $admin)
                                            <li>
                                                <a href="{{ route("Detail Admin", [$admin->id])}}" class="btn-link text-secondary text-decoration-none">{{ $admin->nama_pegawai }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <h5 class="mt-3 text-muted"><i class="fas fa-map-marker-alt"></i> Alamat</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a class="btn-link text-secondary text-decoration-none">{{ Auth::guard('admin')->user()->pegawai->posyandu->alamat}}, {{ Auth::guard('admin')->user()->pegawai->posyandu->desa->nama_desa}}, Kecamatan {{ $kecamatan->nama_kecamatan }}, Kabupaten {{ $kabupaten->nama_kabupaten }}</a>
                                    </li>
                                </ul>
                                <h5 class="mt-3 text-muted"><i class="fas fa-map-marked-alt"></i> Lokasi</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary text-decoration-none">Lihat pada peta</a>
                                    </li>
                                </ul>
                                <h5 class="mt-3 text-muted"><i class="fas fa-phone-alt"></i> Nomor Telp</h5>
                                <ul class="list-unstyled">
                                    @if (auth()->guard('admin')->user()->pegawai->posyandu->nomor_telepon == NULL)
                                        <li>
                                            <a class="btn-link text-secondary text-decoration-none">Nomor Telepon belum ditambahkan</a>
                                        </li>
                                    @else
                                        <li>
                                            <a class="btn-link text-secondary text-decoration-none">{{ Auth::guard('admin')->user()->pegawai->posyandu->nomor_telepon }}</a>
                                        </li>
                                    @endif
                                </ul>
                                <h5 class="mt-3 text-muted"><i class="fas fa-users"></i> Jumlah Petugas</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ route('Data Admin') }}" class="btn-link text-secondary text-decoration-none">{{ $cntAdmin->count() }} Administrator</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('Data Kader') }}" class="btn-link text-secondary text-decoration-none">{{ $cntKader->count() }} Kader</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('Data Kader') }}" class="btn-link text-secondary text-decoration-none">{{ $cntNakes->count() }} Tenaga Kesehatan</a>
                                    </li>
                                </ul>
                                <h5 class="mt-5 text-muted">Kegiatan Selanjutnya</h5>
                                <ul class="list-unstyled">
                                    @if ($nextKegiatan->count() > 0)
                                        @foreach ($nextKegiatan as $kegiatan)
                                            <li>
                                                <a href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-long-arrow-alt-right"></i> {{ $kegiatan->nama_kegiatan }}</a>
                                            </li>
                                        @endforeach
                                    @else
                                        <p href="" class="btn-link text-secondary text-decoration-none"><i class="fas fa-long-arrow-alt-right"></i> Tidak Terdapat Kegiatan</p>
                                        
                                    @endif
                                </ul>
                                <div class="text-center mt-5 mb-5">
                                    @if ((Auth::guard('admin')->user()->pegawai->jabatan != 'head admin') && (Auth::guard('admin')->user()->pegawai->jabatan != 'admin'))
                                        <a href="{{ route('Admin Home') }}" class="btn btn-sm btn-primary">Kembali</a>
                                    @else
                                        <a href="{{ route('Admin Home') }}" class="btn btn-sm btn-primary">Kembali</a>
                                        <a href="{{ route('Edit Profile Posyandu', [Auth::guard('admin')->user()->pegawai->id_posyandu]) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endif
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

    @if($message = Session::get('success'))
    <script>
        $(document).ready(function(){
            alertSuccess('{{$message}}');
        });
    </script>
    @endif
@endpush
