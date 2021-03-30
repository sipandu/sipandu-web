@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Lansia')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Profile Lansia</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Anggota') }}">Data Anggota Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Profile Lansia</li>
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
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ $dataUser->profile_image}}" alt="Profile Admin" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{ $dataUser->lansia->nama_lansia }}</h3>
                        <p class="text-muted text-center">{{ $dataUser->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Status Keluarga</b>
                                <a class="float-right text-decoration-none link-dark">Anak</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Lokasi Posyandu</b>
                                <a class="float-right text-decoration-none link-dark">{{ $dataUser->lansia->posyandu->nama_posyandu}}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d-M-Y', strtotime($dataUser->created_at)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#ubahProfile" data-toggle="tab">Ubah Profile</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->nama_lansia }}" disabled readonly>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->NIK }}" disabled readonly>
                                    <label for="floatingInput">Nomor Induk Kependudukan</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->tempat_lahir }}" disabled readonly>
                                            <label for="floatingInput">Tampat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ date('d-M-Y', strtotime($dataUser->lansia->tanggal_lahir)) }}" disabled readonly>
                                            <label for="floatingInput">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->lansia->nomor_telepon == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Nomor telepon belum dimasukan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->lansia->nomor_telepon }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Nomor Telp</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->username_tele == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Username Telegram belum dimasukan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->username_tele }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Username Telegram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <div class="card-body bg-light my-auto">
                                        <p class="fs-5 fw-bold my-auto">Scan KTP</p>
                                    </div>
                                    <img src="{{ $dataUser->kk->file_kk }}" class="card-img-buttom" alt="{{ $dataUser->kk->no_kk }}">
                                </div>
                            </div>
                            <div class="tab-pane" id="ubahProfile">
                                <form action="{{ route('Update Anggota Lansia', [$dataUser->lansia->id]) }}" method="POST" class="form-horizontal">
                                {{-- <form action="" method="POST" class="form-horizontal"> --}}
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="floatingInput" value="{{ old('nama', $dataUser->lansia->nama_lansia) }}" placeholder="Nama Lengkap Lansia">
                                        <label for="floatingInput">Nama Lengkap</label>
                                        @error('nama')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="floatingInput" value="{{ old('nik', $dataUser->lansia->NIK) }}" placeholder="NIK Lansia">
                                        <label for="floatingInput">Nomor Induk Kependudukan</label>
                                        @error('nik')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="floatingInput" value="{{ old('tempat_lahir', $dataUser->lansia->tempat_lahir) }}" placeholder="Tempat Lahir Lansia">
                                                <label for="floatingInput">Tampat Lahir</label>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', date('d-m-Y', strtotime($dataUser->lansia->tanggal_lahir))) }}" id="floatingInput" placeholder="Tanggal Lahir Lansia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                    <label for="floatingInput">Tanggal Lahir</label>
                                                    @error('tgl_lahir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-grid">
                                            <button type="submit" class="btn btn-outline-success my-1">Simpan Data</button>
                                        </div>
                                    </div>
                                </form>
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
            $('#data-anggota').addClass('active');
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