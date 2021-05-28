@extends('layouts/user/ibu/user-layout')

@section('title', 'Profile Ibu')

@push('css')
    {{-- <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}"> --}}
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Profile Pribadi</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('ibu.home') }}">Smart Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Pribadi</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{Auth::user()->profile_image}}" alt="..." width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center lh-1">{{Auth::user()->ibu->nama_ibu}}</h3>
                        <p class="text-muted text-center lh-1">{{Auth::user()->email}}</p>
                        <p class="text-muted text-center">Ibu </p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Tempat Posyandu</b>
                                <a class="float-right text-decoration-none link-dark">{{Auth::user()->ibu->posyandu->nama_posyandu}}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d-M-Y', strtotime(Auth::user()->created_at)) }}</a>
                            </li>
                        </ul>
                        <form action="{{route('logout.user')}}">
                            @csrf
                            <button href="" class="btn btn-outline-danger btn-block">
                                <b>Keluar</b>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header my-auto d-flex justify-content-center">
                        <h3 class="card-title my-auto">Anggota Keluarga</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-child mr-1"></i> Anak</strong>
                        <p class="text-muted">
                            <span class="tag tag-danger">Nama Anak atau Cucu</span>
                        </p>
                        <hr>
                        <strong><i class="fas fa-male mr-1"></i><i class="fas fa-female mr-1"></i> Orang Dewasa</strong>
                        <p class="text-muted">
                            <span class="tag tag-danger">Nama Menantu atau Orang Tua Anak</span>
                        </p>
                        <hr>
                        <strong><i class="fas fa-wheelchair mr-1"></i> Lansia</strong>
                        <p class="text-muted">
                            <span class="tag tag-danger">Nama Kakek</span>
                            <span class="tag tag-success">Nama Nenek</span>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('Keluarga Ibu') }}" class="btn btn-info btn-block">Lihat Riwayat Keluarga</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal</a></li>
                            <li class="nav-item"><a class="nav-link" href="#account" data-toggle="tab">Akun</a></li>
                            <li class="nav-item"><a class="nav-link" href="#edit-profile" data-toggle="tab">Ubah Profile</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal">
                                <div class="form-group row">
                                    <label for="inputNama" class="col-sm-3 col-form-label">Nama Ibu</label>
                                    <div class="col-sm-9 my-auto">
                                        <input type="email" class="form-control" id="inputNama" placeholder="Nama" disabled readonly value="{{Auth::user()->ibu->nama_ibu_hamil}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNIK" class="col-sm-3 col-form-label">Nama Suami</label>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control" id="inputNIK" placeholder="NIK" disabled readonly value="{{Auth::user()->ibu->nama_suami}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNIK" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control" id="inputNIK" placeholder="NIK" disabled readonly value="{{Auth::user()->ibu->NIK}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTempatLahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control" id="inputTempatLahir" placeholder="Tempat Lahir" disabled readonly value="{{Auth::user()->ibu->tempat_lahir}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-9 my-auto">
                                        <input type="text" class="form-control" id="inputTglLahir" placeholder="Tanggal Lahir" disabled readonly value="{{ date('d-M-Y', strtotime(Auth::user()->ibu->tanggal_lahir)) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputAlamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9 my-auto">
                                        <textarea class="form-control" id="inputAlamat" placeholder="Alamat Lengkap" disabled readonly>{{Auth::user()->ibu->alamat}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="account">
                                <form action="{{route('edit.account.ibu')}}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">E-Mail<span class="text-danger">*</span></label>
                                        <div class="col-sm-10 my-auto">
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Alamat E-Mail" value="{{ old('email', Auth::user()->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTele" class="col-sm-2 col-form-label">Telegram</label>
                                        <div class="col-sm-10 my-auto">
                                            <input name="telegram" type="text" class="form-control @error('telegram') is-invalid @enderror" id="inputEmail" placeholder="Username Telegram" value="{{ old('telegram', Auth::user()->username_tele) }}">
                                            @error('telegram')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-2 col-form-label">Nomor Telp</label>
                                        <div class="col-sm-10 my-auto">
                                            <input name="no_tlpn" type="text" class="form-control @error('no_tlpn') is-invalid @enderror" id="inputEmail" placeholder="Nomor Telepon" value="{{ old('no_tlpn', Auth::user()->ibu->nomor_telepon) }}">
                                            @error('no_tlpn')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-danger text-end">*Data Wajib Diisi</p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-grid">
                                            <button type="submit" class="btn btn-outline-success">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="edit-profile">
                                <form action="{{route('edit.profile.user')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <label class="fs-4 fw-bold text-center d-grid">Ubah Foto Profile</label>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="inputTelp" class="col-sm-3 col-form-label">Foto Profile<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="file" name="file" autocomplete="off" class="custom-file-input @error('file') is-invalid @enderror"  id="inputTelp"autocomplete="off">
                                                <label class="custom-file-label" for="exampleInputFile">Pilih foto profile</label>
                                                @error('file')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-danger text-end">*Data Wajib Diisi</p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-end">
                                            <button id="test" type="submit" class="btn btn-outline-success" >Simpan Foto Profile</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="border border-bottom border-primary my-4"></div>
                                <form action="{{route('edit.password.user')}}" method="POST" class="form-horizontal">
                                    <label class="fs-4 fw-bold text-center d-grid">Ubah Kata Sandi</label>
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-3 col-form-label">Kata Sandi Lama<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 my-auto">
                                            <input type="password" name="password_lama" autocomplete="off" class="form-control @error('password_lama') is-invalid @enderror"  id="inputTelp" placeholder="Password Lama" >
                                            @error('password_lama')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-3 col-form-label">Kata Sandi Baru<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 my-auto">
                                            <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror"   id="inputTelp" placeholder="Password Baru" >
                                            @error('password')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-3 col-form-label">Konfirmasi Kata Sandi Baru<span class="text-danger">*</span></label>
                                        <div class="col-sm-9 my-auto">
                                            <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror"  id="inputTelp" placeholder="Konfirmasi Password" >
                                            @error('password_confirmation')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-danger text-end">*Data Wajib Diisi</p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-end">
                                            <button id="test" type="submit" class="btn btn-outline-success">Simpan Kata Sandi</button>
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
    {{-- Custom Step Page --}}
    <script src="{{url('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <!-- Custom Input Date -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-ibu-account').addClass('menu-is-opening menu-open');
            $('#list-ibu-account-link').addClass('active');
            $('#profile-ibu').addClass('active');
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
                alertDanger('{{$message}}');
            });
        </script>
    @endif

@endpush


