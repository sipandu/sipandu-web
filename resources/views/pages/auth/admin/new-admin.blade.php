@extends('layouts/admin/admin-layout')

@section('title', 'Add Admin')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">New Admin</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Account</li>
                    <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Tambah Admin Baru</h3>
        </div>
        <div class="card-body p-0">
            <div class="bs-stepper py-3">
                <div class="bs-stepper-header px-3 d-flex justify-content-center" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#data-pertama">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-pertama" id="data-pertama-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Data Pertama</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#data-kedua">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-kedua" id="data-kedua-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Data Kedua</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content p-3">
                <!-- your steps content here -->
                    <div id="data-pertama" class="content" role="tabpanel" aria-labelledby="data-pertama-trigger">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama lengkap admin">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
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
                            <label for="exampleInputEmail1">Scan KTP</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Upload scan KTP</label>
                                </div>
                            </div>
                            {{-- <div class="input-group-append">
                                <input class="form-control" type="file" id="formFile">
                                <div class="input-group-text">
                                    <span class="fas fa-folder-open"></span>
                                </div>
                            </div> --}}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kabupaten/kota</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari desa/kelurahan tempat tinggal">
                                    <datalist id="datalistOptions">
                                        <option value="Denpasar Selatan">
                                        <option value="Mengwi">
                                        <option value="Kuta Utara">
                                        <option value="Kuta Selatan">
                                        <option value="Denpasar Timur">
                                    </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-city"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kecamatan</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari kecamatan/kota tempat tinggal">
                                    <datalist id="datalistOptions">
                                        <option value="Denpasar Selatan">
                                        <option value="Mengwi">
                                        <option value="Kuta Utara">
                                        <option value="Kuta Selatan">
                                        <option value="Denpasar Timur">
                                    </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-city"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Desa/kelurahan</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari desa/kelurahan tempat tinggal">
                                    <datalist id="datalistOptions">
                                        <option value="Denpasar Selatan">
                                        <option value="Mengwi">
                                        <option value="Kuta Utara">
                                        <option value="Kuta Selatan">
                                        <option value="Denpasar Timur">
                                    </datalist>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-city"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Banjar</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Banjar tempat tinggal">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-city"></span>
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
                        <button class="btn btn-primary" onclick="stepper.next()">Berikutnya</button>
                    </div>
                    <div id="data-kedua" class="content" role="tabpanel" aria-labelledby="data-kedua-trigger">
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
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                        <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{url('admin-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-admin-account').addClass('menu-open');
            $('#list-account').addClass('menu-open');
            $('#new-admin').addClass('active');
        });

        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>
@endpush
