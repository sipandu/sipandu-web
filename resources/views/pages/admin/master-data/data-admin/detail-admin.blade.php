@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Admin')

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

    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Profile Administrator</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Admin') }}">Data Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Profile Admin</li>
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
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{$dataAdmin->profile_image}}" alt="Profile Admin" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{$dataAdmin->pegawai->nama_pegawai}}</h3>
                        <p class="text-muted text-center">{{$dataAdmin->email}}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Jabatan</b>
                                @if ($dataAdmin->pegawai->jabatan == 'admin')
                                    <a class="float-right text-decoration-none link-dark">Administrator</a>                                   
                                @endif
                                @if ($dataAdmin->pegawai->jabatan == 'head admin')
                                    <a class="float-right text-decoration-none link-dark">Head Admin</a>  
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Tempat Tugas</b>
                                <a class="float-right text-decoration-none link-dark">{{$dataAdmin->pegawai->posyandu->nama_posyandu}}</a>
                                @include('modal/admin/status-konsultasi')
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d-M-Y', strtotime($dataAdmin->created_at)) }}</a>
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
                            @if (Auth::guard('admin')->user()->pegawai->jabatan != $dataAdmin->pegawai->jabatan)
                                @if (Auth::guard('admin')->user()->pegawai->jabatan != 'admin')
                                    <li class="nav-item"><a class="nav-link" href="#ubahProfile" data-toggle="tab">Ubah Profile</a></li>
                                @endif
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataAdmin->pegawai->nama_pegawai}}" disabled readonly>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataAdmin->pegawai->nik}}" disabled readonly>
                                    <label for="floatingInput">Nomor Induk Kependudukan</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $dataAdmin->pegawai->tempat_lahir}}" disabled readonly>
                                            <label for="floatingInput">Tampat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ old('email', date('d-M-Y', strtotime($dataAdmin->pegawai->tanggal_lahir))) }}" disabled readonly>
                                            <label for="floatingInput">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataAdmin->pegawai->nomor_telepon == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Nomor telepon belum dimasukan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataAdmin->pegawai->nomor_telepon}}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Nomor Telp</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataAdmin->pegawai->username_telegram == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Username Telegram belum dimasukan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataAdmin->pegawai->username_telegram }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Username Telegram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <div class="card-body bg-light my-auto">
                                        <p class="fs-5 fw-bold my-auto">Scan KTP</p>
                                    </div>
                                    @if ($dataAdmin->pegawai->file_ktp == NULL)
                                        <p class="text-center text-danger my-auto">Anda Belum mengunggah Scan KTP!</p>
                                    @else
                                        <img src="{{ $dataAdmin->pegawai->file_ktp }}" class="card-img-buttom" alt="...">
                                    @endif
                                </div>
                            </div>
                            @if (Auth::guard('admin')->user()->pegawai->jabatan != $dataAdmin->pegawai->jabatan)
                                @if (Auth::guard('admin')->user()->pegawai->jabatan != 'admin')
                                    <div class="tab-pane" id="ubahProfile">
                                        <form action="{{ route('Update Data Admin', [$dataAdmin->pegawai->id]) }}" method="POST" class="form-horizontal">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="floatingInput" value="{{ old('nama', $dataAdmin->pegawai->nama_pegawai) }}" placeholder="Nama Administrator">
                                                <label for="floatingInput">Nama Lengkap</label>
                                                @error('nama')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="floatingInput" value="{{ old('nik', $dataAdmin->pegawai->nik) }}" placeholder="NIK Administrator">
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
                                                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="floatingInput" value="{{ old('tempat_lahir', $dataAdmin->pegawai->tempat_lahir) }}" placeholder="Tampat Lahir Administrator">
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
                                                            <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old( date('d-m-YY', strtotime('tgl_lahir')), date('d-m-YY', strtotime($dataAdmin->pegawai->tanggal_lahir))) }}" id="floatingInput" placeholder="Tanggal Lahir Administrator" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-management-posyandu').addClass('menu-is-opening menu-open');
            $('#management-posyandu').addClass('active');
            $('#data-admin').addClass('active');
        });

        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })

            $('[data-mask]').inputmask()
        })
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
