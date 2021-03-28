<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('sipandu.png') }}">
    <title>SIPANDU - Registrasi Ibu</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{url('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{url('base-template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{url('base-template/plugins/dropzone/min/dropzone.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
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
                <p class="text-center fs-5 pt-2 pb-1">Silahkan isi data diri anda<br>"Ibu Hamil"</p>
                <form action="{{ route('ibu.data-diri.submit') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label >NIK</label>
                        <div class="input-group mb-3">
                            <input type="text" name="nik" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" id="inputNoKK" value="{{ old('nik') }}" placeholder="Masukan Nomor Indentitas Anak">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('nik')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">

                            <div class="form-group">
                                <label>Nama Suami</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama_suami" autocomplete="off" class="form-control @error('nama_suami') is-invalid @enderror" id="inputNoKK" value="{{ old('nama_suami') }}" placeholder="Nama lengkap ayah kandung">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama_suami')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="tempat_lahir" autocomplete="off" class="form-control @error('tempat_lahir') is-invalid @enderror" id="inputNoKK" value="{{ old('tempat_lahir') }}" placeholder="Tempat lahir anak">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-building"></span>
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
                                    <input type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" id="inputNoKK" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir anak" data-inputmask-alias="datetime" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
                        </div>
                        <div class="col">

                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="no_tlpn" autocomplete="off" class="form-control @error('no_tlpn') is-invalid @enderror" id="inputNoKK" value="{{ old('no_tlpn') }}"  placeholder="Nomor telepon hanya dalam angka">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-alt"></span>
                                        </div>
                                    </div>
                                    @error('no_tlpn')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Username Telegram</label>
                                <div  class="input-group mb-3">
                                    <input type="text" name="telegram" autocomplete="off" class="form-control @error('telegram') is-invalid @enderror" id="inputNoKK" value="{{ old('telegram') }}" placeholder="Username Telegram">
                                </div>
                                @error('telegram')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <div  class="input-group mb-3">
                                    <input type="text" name="alamat" autocomplete="off" class="form-control @error('alamat') is-invalid @enderror" id="inputNoKK" value="{{ old('alamat') }}" placeholder="Jalan lokasi tempat tinggal">
                                </div>
                                @error('alamat')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
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
    <script src="{{url('base-template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{url('base-template/dist/js/adminlte.js')}}"></script>

    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
