<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('sipandu.png') }}">
    <title>SIPANDU - Registrasi Lansia</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin-template/dist/css/adminlte.min.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/dropzone/min/dropzone.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin-template/dist/css/adminlte.min.css')}}">
    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
    </style>

</head>
<body class="login-page">
    <div class="container justify-content-center pt-4">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">SIPANDU</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold h6">Sistem Informasi Pos Pelayanan Terpadu</p>
            </div>
            <div class="card-body" style="padding: 30px">
                <p class="text-center fs-5 pt-2 pb-1">Silahkan isi data diri anda <br> Lansia</p>
                <form action="{{ route('anak.data-diri.submit') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>NIK</label>
                        <div class="input-group mb-3">
                            <input name="KIA" type="text" class="form-control" placeholder="Masukan Nomor Indentitas Anak">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <div class="input-group mb-3">
                                    <input name="tempatLahir" type="text" class="form-control" placeholder="Tempat lahir anak">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-building"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group">
                                    <input name="tanggalLahir" type="text" class="form-control" placeholder="Tanggal lahir anak" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="input-group mb-3">
                                    <input name="tempatLahir" type="text" class="form-control" placeholder="Tempat lahir anak">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-building"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <div class="input-group mb-3">
                                    <input name="notlpn" type="text" class="form-control" placeholder="Nomor telepon hanya dalam angka">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-alt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="gender" class="form-control select2" style="width: 100%;">
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select id="kabupaten" name="kabupaten" class="form-control select2" style="width: 100%;">
                                    @foreach ($kabupaten as $k)
                                        <option value="{{$k->nama_kabupaten}}">{{$k->nama_kabupaten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control select2" style="width: 100%;">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Desa/Kelurahan</label>
                                <select id="desa" name="desa" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Banjar</label>
                                <select  id="banjar" name="banjar" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <div  class="input-group mb-3">
                                    <input name="alamat" type="text" class="form-control" placeholder="Jalan lokasi tempat tinggal">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-end mt-4">
                        <div class="col-8">
                            <p>
                                Terdapat kendala? Klik
                                <a href="register.html" class="text-decoration-none link-primary">di sini</a>
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center mt-4 mb-0">
                <a href="" class="nav-link link-dark">SIPANDU &copy 2021</a>
            </div>

        </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{url('admin-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{url('admin-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{url('admin-template/dist/js/adminlte.js')}}"></script>

    <script src="{{url('admin-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

            $('[data-mask]').inputmask()
        })
    </script>
     <script>
        $(document).ready(function(){
            // Kabupaten AJAX //
            $('#kabupaten').on('change', function () {
                let id = $(this).val();
                $('#kecamatan').empty();
                $('#kecamatan').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#kecamatan').empty();
                        $('#kecamatan').append(`<option value="0" disabled selected>Select Kecamatan</option>`);
                        response.forEach(element => {
                            $('#kecamatan').append(`<option value="${element['id']}">${element['nama_kecamatan']}</option>`);
                        });
                    }
                });
            });

            // Kecamatan AJAX //
            $('#kecamatan').on('change', function () {
                let idDesa = $(this).val();
                $('#desa').empty();
                $('#desa').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/desa/' + idDesa,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#desa').empty();
                        $('#desa').append(`<option value="0" disabled selected>Select Desa/Kelurahan</option>`);
                        response.forEach(element => {
                            $('#desa').append(`<option value="${element['id']}">${element['nama_desa']}</option>`);
                        });
                    }
                });
            });

            // Banjar AJAX //
            $('#desa').on('change', function () {
                let id = $(this).val();
                $('#banjar').empty();
                $('#banjar').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/banjar/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#banjar').empty();
                        $('#banjar').append(`<option value="0" disabled selected>Select Banjar</option>`);
                        response.forEach(element => {
                            $('#banjar').append(`<option value="${element['id']}">${element['banjar']}</option>`);
                        });
                    }
                });
            });


        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
