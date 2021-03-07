@extends('layouts/admin/admin-layout')

@section('title', 'Add Kader')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">New Kader</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Account</li>
                    <li class="breadcrumb-item active" aria-current="page">Add Kader</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Kader Baru</h3>
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
                                <input type="text" class="form-control" placeholder="Nama lengkap kader">
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
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tempat lahir">
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
                                <input type="text" class="form-control" placeholder="Tanggal lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
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
                            <label for="exampleInputEmail1">Scan KTP</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Upload scan KTP</label>
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
                            <label for="exampleInputEmail1">Jabatan</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>Pilih jabatan....</option>
                                    <option value="1">Kader</option>
                                    <option value="2">Tenaga Kesehatan</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-venus-mars"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Telp</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan nomor telepon aktif">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username Telegram</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan Username Telegram aktif">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Tugas</label>
                            <div class="input-group mb-3">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari posyandu atau puskesmas lokasi tugas">
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
                        <button class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                        <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
                    </div>
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
            $('#list-admin-account').addClass('menu-open');
            $('#list-account').addClass('menu-open');
            $('#new-kader').addClass('active');
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
