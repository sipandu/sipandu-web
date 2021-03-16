@extends('layouts/admin/admin-layout')

@section('title', 'Add Kader')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin-template/dist/css/adminlte.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/select2/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin-template/dist/css/adminlte.min.css')}}">
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

    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Tambah Kader Posyandu</h3>
                    </div>

                </div>
                <form action="{{ route('submit.add.admin.kader') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="bs-stepper-content p-3">

                        <!-- your steps content here -->
                        <div id="data-pertama" class="content" role="tabpanel" aria-labelledby="data-pertama-trigger">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <div class="input-group mb-3">
                                    <input name="name" type="text" class="form-control" placeholder="Nama lengkap kader">
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
                                    <input name="email" type="email" class="form-control" placeholder="Alamat email aktif">
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
                                    <input name="tempat_lahir" type="text" class="form-control" placeholder="Tempat lahir">
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
                                    <input name="tgl_lahir" type="text" class="form-control" placeholder="Tanggal lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>
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
                                    <select name="gender" class="form-select" id="inputGroupSelect02">
                                        <option selected>Pilih jenis kelamin....</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
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
                                    <input name="nik" type="text" class="form-control" placeholder="Masukan nomor NIK">
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
                                        <input name="file" type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Upload scan KTP</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <div class="input-group mb-3">
                                    <input name="alamat" type="text" class="form-control" placeholder="Alamat tempat tinggal">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-road"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-primary" onclick="stepper.next()"> Berikutnya</a>
                        </div>
                        <div id="data-kedua" class="content" role="tabpanel" aria-labelledby="data-kedua-trigger">
                            <div class="form-group">
                                @csrf
                                <label for="exampleInputEmail1">Jabatan</label>
                                <div class="input-group mb-3">
                                    <select name="jabatan" class="form-select" id="inputGroupSelect02">
                                        <option selected>Pilih jabatan....</option>
                                        <option value="kader">Kader</option>
                                        <option value="tenaga kesehatan">Tenaga Kesehatan</option>
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
                                    <input name="tlpn" type="text" class="form-control" placeholder="Masukan nomor telepon aktif">
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
                                    <input name="telegram" type="text" class="form-control" placeholder="Masukan Username Telegram aktif">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tempat Tugas</label>
                                <div class="input-group mb-3">
                                    <select name="posyandu" class="form-control select2" style="width: 100%,;" >
                                        @foreach ($posyandu as $p)
                                            <option value="{{$p->id}}">{{$p->nama_posyandu}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <div class="input-group mb-3">
                                    <input name="password" type="password" class="form-control" placeholder="Masukan Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputEmail1">Konfirmasi Password</label>
                                <div class="input-group mb-3">
                                    <input name="c_password" type="password" class="form-control" placeholder="Masukan kembali Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>

                    
                                        </div>
                                        <a class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</a>
                                        <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
            
            $('#list-admin-account').addClass('menu-is-opening menu-open');
            $('#list-admin-account-link').addClass('active');

            $('#list-account').addClass('menu-is-opening menu-open');
            $('#list-account-link').addClass('active');
            $('#new-kader').addClass('active');
        });

        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })

            $('[data-mask]').inputmask()
        })

        // Custom Step Page
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>
@endpush
