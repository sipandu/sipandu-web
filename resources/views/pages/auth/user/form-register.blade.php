<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('sipandu.png') }}">
    @if ($role == 'ibu')
        <title>Smart Posyandu | Registrasi Ibu Hamil</title>
    @endif
    @if ($role == 'anak')
        <title>Smart Posyandu | Registrasi Lansia</title>
    @endif
    @if ($role == 'lansia')
        <title>Smart Posyandu | Registrasi Anak</title>
    @endif

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{url('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/dropzone/min/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
    </style>

</head>
<body >
    <div class="container justify-content-center pt-4">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">Smart Posyandu</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold h6">Daftarkan
                    @if ($role == 'ibu')
                        Ibu Hamil
                    @endif
                    @if ($role == 'anak')
                        Anak
                    @endif
                    @if ($role == 'lansia')
                        Lansia
                    @endif
                 Sebagai Anggota Posyandu Baru</p>
            </div>
            <div class="card-body">
                <p class="text-center fs-5 py-2">Silahkan lengkapi data di bawah ini</p>
                <form action="user/{{$role}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idKK" value="{{$idKK}}">
                    <input type="hidden" name="noKK" value="{{$scr}}">
                    <input type="hidden" name="role" value="{{$role}}">
                    @if ($idKK == null)
                    <div class="form-group">
                        <label>Kartu Keluarga</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('nama') is-invalid @enderror" name="file" id="exampleInputFile2" >
                                <label class="custom-file-label " for="exampleInputFile2">Upload Kartu Keluarga</label>
                            </div>
                            @error('file')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Nama</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan E-Mail">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
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
                                <label>Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password">
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
                                <label>Konfirmasi Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan Kembali Password">
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
                        <div class="col">
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select id="kabupaten" name="kabupaten" class="form-control select2 kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;">
                                    <option value="#" disabled selected>Select Kabupaten</option>
                                    @foreach ($kabupaten as $k)
                                        <option value="{{$k->id}}">{{ucfirst($k->nama_kabupaten)}}</option>
                                    @endforeach
                                </select>
                                @error('kabupaten')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control select2 kecamatan @error('kecamatan') is-invalid @enderror" style="width: 100%;">
                                </select>
                                @error('kecamatan')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Desa/Kelurahan</label>
                                <select id="desa" name="desa" class="form-control select2 @error('desa') is-invalid @enderror" style="width: 100%;">
                                </select>
                                @error('desa')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Banjar</label>
                                <select id="banjar" name="banjar" class="form-control select2 @error('banjar') is-invalid @enderror" style="width: 100%;">
                                </select>
                                @error('banjar')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end mt-4">
                        <div class="col-8">
                            <p> Sudah memiliki akun? Klik
                                <a href="{{ route("form.user.login") }}" class="text-decoration-none link-primary">di sini</a>
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftarkan Akun</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-center mt-4 mb-0">
                <a href="" class="nav-link link-dark">Smart Posyandu &copy 2021</a>
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

    {{-- Untuk Search Kabupaten dan dll --}}
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

    <script>
        $(function () {
          bsCustomFileInput.init();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
