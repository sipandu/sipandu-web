@extends('layouts/admin/admin-layout')

@section('title', 'Detail Profile Super Admin')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Detail Profile Super Admin</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Super Admin') }}">Data Super Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline sticky-top">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Profile Image Admin', $superAdmin->admin->id ) }}?{{date('YmdHis')}}" alt="Foto Profile Super Admin" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{$superAdmin->nama_superAdmin}}</h3>
                        <p class="text-muted text-center">{{$superAdmin->admin->email}}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Jabatan</b>
                                <a class="float-right text-decoration-none link-dark">Super Admin</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Area Tugas</b>
                                @if ($superAdmin->area_tugas == 'Provinsi')
                                    <a class="float-right text-decoration-none link-dark">Provinsi Bali</a>
                                @endif
                                @if ($superAdmin->area_tugas == 'Kabupaten')
                                    <a class="float-right text-decoration-none link-dark">{{$superAdmin->kabupaten->nama_kabupaten}}</a>
                                @endif
                                @if ($superAdmin->area_tugas == 'Kecamatan')
                                    <a class="float-right text-decoration-none link-dark">{{$superAdmin->kecamatan->nama_kecamatan}}</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d M Y', strtotime($superAdmin->created_at)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#profile" id="tabProfile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#ubahProfile" id="tabUbahProfile" data-toggle="tab">Ubah Profile</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $superAdmin->nama_super_admin}}" disabled readonly>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $superAdmin->nik}}" disabled readonly>
                                    <label for="floatingInput">Nomor Induk Kependudukan</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" value="{{ $superAdmin->tempat_lahir }}" disabled readonly>
                                        <label for="floatingInput">Tempat Lahir</label>
                                    </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" value="{{ old('tanggal_lahir', date('d M Y', strtotime($superAdmin->tanggal_lahir))) }}" disabled readonly>
                                        <label for="floatingInput">Tanggal Lahir</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $superAdmin->nomor_telepon ?? 'Belum ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Nomor Telp</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $superAdmin->username_telegram ?? 'Belum ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Username Telegram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <div class="card-body bg-light my-auto">
                                        <p class="fs-5 fw-bold my-auto">Scan KTP</p>
                                    </div>
                                    <img src="{{ route('Get KTP Super Admin', $superAdmin->id ) }}?{{date('YmdHis')}}" class="card-img-buttom" alt="File KTP Super Admin">
                                </div>
                            </div>
                            <div class="tab-pane" id="ubahProfile">
                                <form action="{{ route('Update Profile Super Admin', $superAdmin->id) }}" method="POST" class="needs-validation form-horizontal my-auto" novalidate>
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="floatingInput" value="{{ old('nama', $superAdmin->nama_super_admin) }}" placeholder="Nama Super Admin" required>
                                        <label for="floatingInput">Nama Lengkap<span class="text-danger">*</span></label>
                                        @error('nama')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Nama lengkap super admin wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="floatingInput" value="{{ old('nik', $superAdmin->nik) }}" placeholder="NIK Super Admin" required>
                                        <label for="floatingInput">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
                                        @error('nik')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                NIK wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="floatingInput" value="{{ old('tempat_lahir', $superAdmin->tempat_lahir) }}" placeholder="Tempat Lahir Super Admin" required>
                                                <label for="floatingInput">Tempat Lahir<span class="text-danger">*</span></label>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Tempat lahir super admin wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old( date('d-m-Y', strtotime('tgl_lahir')), date('d-m-Y', strtotime($superAdmin->tanggal_lahir))) }}" id="floatingInput" placeholder="Tanggal Lahir Super Admin" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask required>
                                                    <label for="floatingInput">Tanggal Lahir<span class="text-danger">*</span></label>
                                                    @error('tgl_lahir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Tanggal lahir super admin wajib diisi
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row text-end">
                                        <span class="text-danger">* Data Wajib Diisi</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-grid">
                                            <button type="submit" class="btn btn-outline-success my-1">Simpan Perubahan Data</button>
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
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account').addClass('active');
            $('#data-super-admin').addClass('active');

            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
            $('[data-mask]').inputmask()
        });
    </script>

    @if ($errors->any())
        <script>
            $(document).ready(function(){
                $('#tabProfile').removeClass('active');
                $('#profile').removeClass('active');
                $('#tabUbahProfile').addClass('active');
                $('#ubahProfile').addClass('active');
            });
        </script>
    @endif

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('error'))
        <script>
            $(document).ready(function(){
                alertError('{{$message}}');
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
