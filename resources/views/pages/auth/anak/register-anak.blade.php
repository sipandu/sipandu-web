<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('sipandu.png') }}">
    <title>SIPANDU - Registrasi Anak</title>

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
    <div class="container d-flex justify-content-center pt-4">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">SIPANDU</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold h6">Sistem Informasi Pos Pelayanan Terpadu</p>
            </div>
            <div class="card-body">
                <p class="text-center py-3">Silahkan daftarkan anak anda</p>      
                <form action="../../index.html" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama anak">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email aktif">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Akta Kelahiran atau SKL</label>
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile2">
                                <label class="custom-file-label" for="exampleInputFile2">Kartu Keluarga</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Konfirmasi password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-end mt-4">
                        <div class="col-8">
                            <p>
                                Sudah mempunyai akun? Masuk
                                <a href="register.html" class="text-decoration-none link-primary">di sini</a>
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
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
