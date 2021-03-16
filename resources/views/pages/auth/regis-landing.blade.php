<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('sipandu.png') }}">
    <title>SIPANDU - Data Diri Anak</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin-template/dist/css/adminlte.min.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
    </style>

</head>
<body class="login-page">
    <div class="container d-flex justify-content-center pt-5">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">SIPANDU</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold h6">Sistem Informasi Pos Pelayanan Terpadu</p>
            </div>
            <div class="card-body">
                <p class="text-center py-3">Silahkan lengkapi data di bawah ini</p>
                <form action="{{ route('landing.regis.submit') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nomor KK</label>
                        <input type="number" class="form-control" name="noKK" placeholder="NO KK">
                    </div>
                    <div class="form-group">
                        <label>Daftar Sebagai</label>
                        <select class="form-control select2bs4" name="role" style="width: 100%;">
                          <option value="anak">Balita</option>
                          <option value="ibu">Ibu Hamil</option>
                          <option value="lansia">Lansia</option>
                        </select>
                      </div>
                    <div class="row d-flex justify-content-end mt-4">
                        <div class="col-8">
                            <p style="width: 350px;">
                                Sudah mempunyai akun? Masuk
                                <a href="register.html" class="text-decoration-none link-primary">di sini</a>
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Selanjutnya</button>
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
    <!-- AdminLTE App -->
    <script src="{{url('admin-template/dist/js/adminlte.js')}}"></script>

    <script src="{{url('admin-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(function () {
          bsCustomFileInput.init();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>