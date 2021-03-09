@extends('layouts/admin/admin-layout')

@section('title', 'Add Posyandu')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">New Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route("List Posyandu") }}">Daftar Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Posyandu</h3>
        </div>
        <p class="h4 text-center pt-4 fw-bold">Tambahkan Posyandu Baru</p>
        <div class="card-body p-0">
            <form action="">
                <div class="bs-stepper-content p-3">
                    <div class="form-group">
                        <label for="inputNamaPosyandu">Nama Posyandu</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="inputNamaPosyandu" placeholder="Nama Posyandu">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-clinic-medical"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdministrator">Administrator</label>
                        <div class="input-group mb-3">
                            <input class="form-control" list="dataAdmin" id="inputAdministrator" placeholder="Cari administrator....">
                            <datalist id="dataAdmin">
                                <option value="Petugas A">
                                <option value="Petugas B">
                                <option value="Petugas C">
                                <option value="Petugas D">
                                <option value="Petugas E">
                            </datalist>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-shield"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputKabupaten">Kabupaten/Kota</label>
                        <div class="input-group mb-3">
                            <input class="form-control" list="dataKabupatan" id="inputKabupaten" placeholder="Lokasi kabupaten/kota....">
                            <datalist id="dataKabupatan">
                                <option value="Denpasar">
                                <option value="Badung">
                                <option value="Tabanan">
                                <option value="Gianyar">
                                <option value="Singaraja">
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
                            <input class="form-control" list="dataKecamatan" id="inputKecamatan" placeholder="Lokasi kecamatan....">
                            <datalist id="dataKecamatan">
                                <option value="Denpasar Barat">
                                <option value="Denpasar Selatan">
                                <option value="Mengwi">
                                <option value="Kuta Utara">
                                <option value="Seririt">
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
                            <input class="form-control" list="dataDesa" id="inputDesa" placeholder="Lokasi desa....">
                            <datalist id="dataDesa">
                                <option value="Sesetan">
                                <option value="Sidakarya">
                                <option value="Sempidi">
                                <option value="Baha">
                                <option value="Dalung">
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
                            <input type="text" class="form-control" id="inputBanjar" placeholder="Masukan lokasi banjar">
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
                            <input type="text" class="form-control" id="inputAlamat" placeholder="Masukan alamat lengkap posyandu">
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
                            <input type="text" class="form-control" id="inputLng" placeholder="Koordinat Longitude posyandu">
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
                            <input type="text" class="form-control" id="inputLat" placeholder="Koordinat Latitude posyandu">
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
                            <input type="password" class="form-control" id="konfirmasiPass" placeholder="Masukan konfirmasi password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route("List Posyandu") }}" class="btn btn-danger">Kembali</a>
                        </div>
                        <div class="col-sm-6 text-end">
                            <button type="submit" class="btn btn-primary">Tambah Posyandu</button>
                        </div>
                    </div>
                </div>
            </form>
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
            $('#list-daftar-posyandu').addClass('menu-open');
            $('#daftar-posyandu').addClass('active');
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
