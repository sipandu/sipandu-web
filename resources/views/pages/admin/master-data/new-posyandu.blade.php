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
                                    <div id="data-pertama" class="content" role="tabpanel" aria-labelledby="data-pertama-trigger">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputNamaPosyandu">Nama Posyandu</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="nama_posyandu" class="form-control @error('nama_posyandu') is-invalid @enderror" id="inputNamaPosyandu" value="{{ old('nama_posyandu') }}" placeholder="Nama Posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-clinic-medical"></span>
                                                            </div>
                                                        </div>
                                                        @error('nama_posyandu')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputKabupaten">Kabupaten/Kota</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control @error('kabupaten') is-invalid @enderror" name="kabupaten" list="dataKabupatan" id="inputKabupaten" value="{{ old('kabupaten') }}" placeholder="Lokasi kabupaten/kota...." autocomplete="off">
                                                        <datalist name="kabupaten" id="dataKabupatan">
                                                            @foreach ($kabupaten as $data)
                                                                <option value="{{ $data->nama_kabupaten }}">
                                                            @endforeach
                                                        </datalist>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-city"></span>
                                                            </div>
                                                        </div>
                                                        @error('kabupaten')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputKecamatan">Kecamatan</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" list="dataKecamatan" id="inputKecamatan" value="{{ old('kecamatan') }}" placeholder="Lokasi kecamatan...." autocomplete="off">
                                                        <datalist name="kecamatan" id="dataKecamatan">
                                                            @foreach ($kecamatan as $data)
                                                                <option value="{{ $data->nama_kecamatan }}">
                                                            @endforeach
                                                        </datalist>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-city"></span>
                                                            </div>
                                                        </div>
                                                        @error('kecamatan')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDesa">Desa/Kelurahan</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control @error('desa') is-invalid @enderror" name="desa" list="dataDesa" id="inputDesa" value="{{ old('desa') }}" placeholder="Lokasi desa...." autocomplete="off">
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
                                                        @error('desa')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputBanjar">Banjar</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('banjar') is-invalid @enderror" name="banjar" id="inputBanjar" value="{{ old('banjar') }}" placeholder="Masukan lokasi banjar" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-city"></span>
                                                            </div>
                                                        </div>
                                                        @error('banjar')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>                                                
                                                <div class="form-group">
                                                    <label for="inputAlamat">Alamat Posyandu</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('alamat_posyandu') is-invalid @enderror" name="alamat_posyandu" id="inputAlamat" value="{{ old('alamat_posyandu') }}" placeholder="Masukan alamat lengkap posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-road"></span>
                                                            </div>
                                                        </div>
                                                        @error('alamat_posyandu')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputLat">Koordinat Latitude</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('lat') is-invalid @enderror" name="lat" id="inputLat" value="{{ old('lat') }}" placeholder="Koordinat Latitude posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marker-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('lat')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputLng">Koordinat Longitude</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('lng') is-invalid @enderror" name="lng" id="inputLng" value="{{ old('lng') }}" placeholder="Koordinat Longitude posyandu" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marker-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('lng')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 d-flex justify-content-between">
                                                <a href="{{ route("Data Posyandu") }}" class="btn btn-danger">Batalkan</a>
                                                <a class="btn btn-outline-primary" onclick="stepper.next()">Berikutnya</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="data-kedua" class="content" role="tabpanel" aria-labelledby="data-kedua-trigger">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Lengkap</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai') }}" placeholder="Nama lengkap admin" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                        @error('nama_pegawai')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Tempat lahir" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-map-marked-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('tempat_lahir')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        @error('tgl_lahir')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="inputGroupSelect02">
                                                            <option value="" selected>Pilih jenis kelamin....</option>
                                                            <option value="laki-laki">Laki-laki</option>
                                                            <option value="perempuan">Perempuan</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-venus-mars"></span>
                                                            </div>
                                                        </div>
                                                        @error('gender')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NIK</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Masukan nomor NIK" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-address-card"></span>
                                                            </div>
                                                        </div>
                                                        @error('nik')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
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
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat E-Mail</label>
                                                    <div class="input-group mb-3">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Alamat email aktif" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-envelope"></span>
                                                            </div>
                                                        </div>
                                                        @error('email')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor Telp</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" placeholder="Masukan nomor telepon aktif" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-alt"></span>
                                                            </div>
                                                        </div>
                                                        @error('telp')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Username Telegram</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('telegram') is-invalid @enderror" name="telegram" value="{{ old('telegram') }}" placeholder="Masukan Username Telegram aktif" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fab fa-telegram"></span>
                                                            </div>
                                                        </div>
                                                        @error('telegram')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('alamat_pegawai') is-invalid @enderror" name="alamat_pegawai" value="{{ old('alamat_pegawai') }}" placeholder="Alamat tempat tinggal" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-road"></span>
                                                            </div>
                                                        </div>
                                                        @error('alamat_pegawai')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukan Password" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                        </div>
                                                        @error('password')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Masukan kembali Password" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                        </div>
                                                        @error('password_confirmation')
                                                            <div class="invalid-feedback text-start">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="konfirmasiPass">Password Konfirmasi</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" name="password" id="konfirmasiPass" placeholder="Konfirmasi password anda">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-6 justify-content-start d-flex align-items-start">
                                                        <a class="btn btn-outline-primary my-2" onclick="stepper.previous()">Sebelumnya</a>
                                                    </div>
                                                    <div class="col-6 justify-content-end text-end">
                                                        <a href="{{ route("Data Posyandu") }}" class="btn btn-danger my-1">Batalkan</a>
                                                        <button type="submit" class="btn btn-success my-1">Tambah Posyandu</button>
                                                    </div>
                                                </div>
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
