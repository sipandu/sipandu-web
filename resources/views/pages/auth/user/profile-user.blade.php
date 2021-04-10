@extends('layouts/user/user-layout')

@section('title', 'My Profile')

@push('css')
    {{-- <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}"> --}}
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
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Profile</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="" alt="..." width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center"></h3>
                        <p class="text-muted text-center"></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Tempat Tugas</b>
                                <a class="float-right text-decoration-none link-dark"></a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Konsultasi</b>
                                <a href="" class="float-right text-decoration-none link-primary" data-bs-toggle="modal" data-bs-target="#statusKonsultasi">Available</a>
                                @include('modal/admin/status-konsultasi')
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d-M-Y', strtotime(Auth::user()->created_at)) }}</a>
                            </li>
                        </ul>
                        <form action="{{route('logout.admin')}}">
                            @csrf
                            <button href="" class="btn btn-danger btn-block">
                                <b>Logout</b>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#account" data-toggle="tab">Akun</a></li>
                            <li class="nav-item"><a class="nav-link" href="#personal" data-toggle="tab">Personal</a></li>
                            <li class="nav-item"><a class="nav-link" href="#jabatan" data-toggle="tab">Jabatan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#edit-profile" data-toggle="tab">Edit</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="account">
                                <form action="{{route('edit.account')}}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">E-Mail</label>
                                        <div class="col-sm-10 my-auto">
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Alamat E-Mail" value="{{ old('email', Auth::user()->email) }}">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTele" class="col-sm-2 col-form-label">Telegram</label>
                                        <div class="col-sm-10 my-auto">
                                            <input name="telegram" type="text" class="form-control @error('telegram') is-invalid @enderror" id="inputEmail" placeholder="Username Telegram" value="{{ old('telegram') }}">
                                        </div>
                                        @error('telegram')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-2 col-form-label">Nomor Telp</label>
                                        <div class="col-sm-10 my-auto">
                                            <input name="no_tlpn" type="text" class="form-control @error('no_tlpn') is-invalid @enderror" id="inputEmail" placeholder="Nomor Telepon" value="{{ old('no_tlpn') }}">
                                        </div>
                                        @error('no_tlpn')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-grid">
                                            <button type="submit" class="btn btn-success my-1">Save Change</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="personal">
                                <form action="#" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10 my-auto">
                                            <input type="email" class="form-control" id="inputNama" placeholder="Nama" disabled readonly value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputNIK" class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-10 my-auto">
                                            <input type="text" class="form-control" id="inputNIK" placeholder="NIK" disabled readonly value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-10 my-auto">
                                            <input type="text" class="form-control" id="inputTempatLahir" placeholder="Tempat Lahir" disabled readonly value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTglLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10 my-auto">
                                            <input type="text" class="form-control" id="inputTglLahir" placeholder="Tanggal Lahir" disabled readonly value="{{ date('d-M-yy', strtotime(Auth::user()->created_at)) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row my-auto">
                                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputAlamat" placeholder="Alamat Lengkap" disabled readonly></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-4">
                                        <div class="d-grid col-sm-12">
                                            <button type="submit" class="btn btn-success">Save Change</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="jabatan">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Tempat Tugas</label>
                                    <div class="col-sm-10 my-auto">
                                        <input type="email" class="form-control" id="inputName" placeholder="Tempat Tugas" disabled readonly value="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10 my-auto">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Jabatan" disabled readonly value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Terdaftar Sejak</label>
                                    <div class="col-sm-10 my-auto">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Terdaftar Sejak" disabled readonly value="">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="edit-profile">
                                <form action="{{route('edit.profile')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <label class="fs-4 fw-bold text-center d-grid">Ubah Foto Profile</label>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Profile Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="file" type="file" class="custom-file-input  @error('file') is-invalid @enderror" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih foto profile</label>
                                                </div>
                                                @error('file')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-end">
                                            <button id="test" type="submit" class="btn btn-success my-1" >Simpan Foto Profile</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="border border-bottom border-primary my-4"></div>
                                <form action="{{route('edit.password')}}" method="POST" class="form-horizontal">
                                    <label class="fs-4 fw-bold text-center d-grid">Ubah Password</label>
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-3 col-form-label">Password Lama</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password_lama" autocomplete="off" class="form-control @error('password_lama') is-invalid @enderror"  id="inputTelp" placeholder="Password Lama" >
                                            @error('password_lama')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-3 col-form-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror"  id="inputTelp" placeholder="Password Baru" >
                                            @error('password')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror"   id="inputTelp" placeholder="Konfirmasi Password Baru" >
                                        </div>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-end">
                                            <button id="test" type="submit" class="btn btn-success my-1">Simpan Password Baru</button>
                                        </div>
                                    </div>
                                </form>
                                @include('modal/admin/change-profile')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- Custom Step Page --}}
    <script src="{{url('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <!-- Custom Input Date -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-admin-account').addClass('menu-is-opening menu-open');
            $('#list-admin-account-link').addClass('active');
            $('#profile-admin').addClass('active');
        });
        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            $('[data-mask]').inputmask()
        })
        // Custom Step Page
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
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

@endpush


