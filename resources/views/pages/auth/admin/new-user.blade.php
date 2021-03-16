@extends('layouts/admin/admin-layout')

@section('title', 'Add User')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Anggota Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Account</li>
                    <li class="breadcrumb-item active" aria-current="page">Add User</li>
                </ol>
            </nav>
        </div>
    </div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-bumil-tab" data-bs-toggle="tab" data-bs-target="#nav-bumil" type="button" role="tab" aria-controls="nav-bumil" aria-selected="true">Ibu Hamil</button>
          <button class="nav-link" id="nav-anak-tab" data-bs-toggle="tab" data-bs-target="#nav-anak" type="button" role="tab" aria-controls="nav-anak" aria-selected="false">Anak</button>
          <button class="nav-link" id="nav-lansia-tab" data-bs-toggle="tab" data-bs-target="#nav-lansia" type="button" role="tab" aria-controls="nav-lansia" aria-selected="false">Lansia</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-bumil" role="tabpanel" aria-labelledby="nav-bumil-tab">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Tambah Anggota Ibu Hamil Baru</h3>
                </div>
                <div class="card-body p-3">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor KK</label>
                            <div class="input-group mb-3">
                                <input name="kk" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari nomor KK">
                                <datalist id="datalistOptions">
                                    @foreach ($kk as $p)
                                        <option value="{{$p->no_kk}}"></option>
                                    @endforeach
                                    {{-- <option value="1805551041">
                                    <option value="1805551042">
                                    <option value="1805551043">
                                    <option value="1805551044">
                                    <option value="1805551045"> --}}
                                </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="kkuser">
                            <label for="exampleInputEmail1">Scan KK</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Upload scan KK</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Bumil</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama lengkap ibu ibu hamil">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Suami</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama lengkap suami">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir Bumil</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tempat lahir ibu hamil">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-map-marked-alt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir Bumil</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tanggal lahir bumil" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIK</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan nomor NIK">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Alamat tempat tinggal">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-road"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat E-Mail</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Alamat email aktif">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Telp</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan nomor telepon">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lokasi Posyandu</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari lokasi posyandu atau puskesmas">
                                <datalist id="datalistOptions">
                                    <option value="Puskesmas A">
                                    <option value="Puskesmas B">
                                    <option value="Puskesmas C">
                                    <option value="Puskesmas D">
                                    <option value="Puskesmas E">
                                </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Masukan Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Masukan kembali Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-anak" role="tabpanel" aria-labelledby="nav-anak-tab">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Tambah Anggota Bayi dan Anak Baru</h3>
                </div>
                <div class="card-body p-3">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor KK</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari nomor KK">
                                <datalist id="datalistOptions">
                                    <option value="1805551041">
                                    <option value="1805551042">
                                    <option value="1805551043">
                                    <option value="1805551044">
                                    <option value="1805551045">
                                </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Scan KK</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Upload scan KK</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Anak</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama lengkap bayi atau balita">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ayah</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama lengkap ayah">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ibu</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama lengkap ibu">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tempat lahir anak">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-map-marked-alt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir Bumil</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tanggal lahir anak" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>Pilih jenis kelamin....</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-venus-mars"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status Anak</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Anak ke...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Alamat tempat tinggal">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-road"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIK</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan nomor NIK">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat E-Mail</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Alamat email aktif">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Telp</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan nomor telepon">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lokasi Posyandu</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari lokasi posyandu atau puskesmas">
                                <datalist id="datalistOptions">
                                    <option value="Puskesmas A">
                                    <option value="Puskesmas B">
                                    <option value="Puskesmas C">
                                    <option value="Puskesmas D">
                                    <option value="Puskesmas E">
                                </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Masukan Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Masukan kembali Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-lansia" role="tabpanel" aria-labelledby="nav-lansia-tab">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Tambah Anggota Lansia Baru</h3>
                </div>
                <div class="card-body p-3">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor KK</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari nomor KK">
                                <datalist id="datalistOptions">
                                    <option value="1805551041">
                                    <option value="1805551042">
                                    <option value="1805551043">
                                    <option value="1805551044">
                                    <option value="1805551045">
                                </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Scan KK</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Upload scan KK</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lansia</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama lengkap ibu lansia">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tempat lahir lansia">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-map-marked-alt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tanggal lahir lansia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>Pilih jenis kelamin....</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-venus-mars"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIK</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan nomor NIK">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Alamat tempat tinggal">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-road"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat E-Mail</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Alamat email aktif">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Telp</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan nomor telepon">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status Lansia</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>Pilih status lansia....</option>
                                    <option value="1">Pra Lansia</option>
                                    <option value="2">Lansia</option>
                                    <option value="2">Lansia Beresiko</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-venus-mars"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lokasi Posyandu</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari lokasi posyandu atau puskesmas">
                                <datalist id="datalistOptions">
                                    <option value="Puskesmas A">
                                    <option value="Puskesmas B">
                                    <option value="Puskesmas C">
                                    <option value="Puskesmas D">
                                    <option value="Puskesmas E">
                                </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Masukan Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Masukan kembali Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- Custom Step Page --}}
    <script src="{{url('admin-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <!-- Custom Input Date -->
    <script src="{{url('admin-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');

            $('#list-admin-account').addClass('menu-is-opening menu-open');
            $('#list-admin-account-link').addClass('active');

            $('#list-account').addClass('menu-is-opening menu-open');
            $('#list-account-link').addClass('active');
            $('#new-user').addClass('active');
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




@endpush
