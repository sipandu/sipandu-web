@extends('layouts/admin/admin-layout')

@section('title', 'Add Posyandu')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route("Data Posyandu") }}">Daftar Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Tambahkan Posyandu Baru</h3>
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
                            <form action="{{ route('New Posyandu') }}" method="POST">
                                @csrf
                                <div class="bs-stepper-content p-3">
                                    <!-- your steps content here -->
                                    <div id="data-pertama" class="content" role="tabpanel" aria-labelledby="data-pertama-trigger">
                                        <div class="form-group">
                                            <label for="inputNamaPosyandu">Nama Posyandu</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="nama_posyandu" class="form-control" id="inputNamaPosyandu" placeholder="Nama Posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-clinic-medical"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputKabupaten">Kabupaten/Kota</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" name="kebupaten" list="dataKabupatan" id="inputKabupaten" placeholder="Lokasi kabupaten/kota....">
                                                <datalist id="dataKabupatan">
                                                    @foreach ($kabupaten as $data)
                                                        <option value="{{ $data->nama_kabupaten }}">
                                                    @endforeach
                                                </datalist>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-city"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputKecamatan">Kecamatan</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" name="kecamatan" list="dataKecamatan" id="inputKecamatan" placeholder="Lokasi kecamatan....">
                                                <datalist id="dataKecamatan">
                                                    @foreach ($kecamatan as $data)
                                                        <option value="{{ $data->nama_kecamatan }}">
                                                    @endforeach
                                                </datalist>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-city"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDesa">Desa/Kelurahan</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" name="desa" list="dataDesa" id="inputDesa" placeholder="Lokasi desa....">
                                                <datalist id="dataDesa">
                                                    @foreach ($desa as $data)
                                                        <option value="{{ $data->nama_desa }}">
                                                    @endforeach
                                                </datalist>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-city"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBanjar">Banjar</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="banjar" id="inputBanjar" placeholder="Masukan lokasi banjar">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-city"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAlamat">Alamat Posyandu</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="alamat_posyandu" id="inputAlamat" placeholder="Masukan alamat lengkap posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-road"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLng">Koordinat Longitude</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="lng" id="inputLng" placeholder="Koordinat Longitude posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-map-marker-alt"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLat">Koordinat Latitude</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="lat" id="inputLat" placeholder="Koordinat Latitude posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-map-marker-alt"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="konfirmasiPass">Konfirmasi Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" name="password" id="konfirmasiPass" placeholder="Masukan konfirmasi password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="{{ route("Data Posyandu") }}" class="btn btn-danger">Batalkan</a>
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <a class="btn btn-primary" onclick="stepper.next()">Berikutnya</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="data-kedua" class="content" role="tabpanel" aria-labelledby="data-kedua-trigger">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Lengkap</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="nama_pegawai" placeholder="Nama lengkap admin">
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
                                                <input type="email" class="form-control" name="email" placeholder="Alamat email aktif">
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
                                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir">
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
                                                <input type="text" class="form-control" name="tgl_lahir" placeholder="Tanggal lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                                                <select class="form-select" name="gender" id="inputGroupSelect02">
                                                    <option selected>Pilih jenis kelamin....</option>
                                                    <option value="laki-laki">Laki-laki</option>
                                                    <option value="perempuan">Perempuan</option>
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
                                                <input type="text" class="form-control" name="nik" placeholder="Masukan nomor NIK">
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
                                                <input type="text" class="form-control" name="alamat_admin" placeholder="Alamat tempat tinggal">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-road"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor Telp</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="no_telp" placeholder="Masukan nomor telepon aktif">
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
                                                <input type="text" class="form-control" name="telegram" placeholder="Masukan Username Telegram aktif">
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
                                                <input type="password" class="form-control" name="password" placeholder="Masukan Password">
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
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Masukan kembali Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</a>
                                                <a class="btn btn-primary" onclick="stepper.next()">Berikutnya</a>
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <a href="{{ route("Data Posyandu") }}" class="btn btn-danger">Batalkan</a>
                                                <button type="submit" class="btn btn-primary">Tambah Posyandu</button>
                                            </div>
                                        </div>
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
            $('#list-data-posyandu').addClass('menu-open');
            $('#data-posyandu').addClass('active');
        });

        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
            
            $('[data-mask]').inputmask()
        })

        // Custom Step Page
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>
@endpush
