@extends('layouts/admin/admin-layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Dashboard</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            // $('#list-admin-dashboard').removeClass('menu-open');
            $('#admin-dashboard').addClass('active');
        });
    </script>
@endpush

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/sipandu-logo.ico') }}">
    <title>Smart POSYANDU - Register Admin</title>

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
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">Smart POSYANDU</a>
            </div>
            <div class="card-body">
                <p class="text-center py-2">Silahkan login untuk mengelola sistem</p>
                <form action="../../index3.html" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-5 mb-1">
                            <div class="refreshCaptcha m-0 p-0">
                                {!! captcha_img('flat') !!}
                            </div>
                            <a href="javascript:void(0)" class="text-decoration-none link-primary" onclick="refreshCaptcha()">Refresh Captcha</a>
                        </div>
                        <div class="col-7">
                            <div class="input-group-append g-0">
                                <input type="text" class="form-control" placeholder="Captcha">
                                <div class="input-group-text">
                                    <span class="fas fa-spell-check"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mb-4">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                </div>

                <p class="mb-1">
                    Lupa password? Klik 
                    <a href="forgot-password.html" class="text-decoration-none link-primary">di sini</a>
                </p>
                <p class="mb-0">
                    Belum teregistrasi? 
                    <a href="register.html" class="text-decoration-none link-primary">Ajukan akun sekarang</a>
                </p>
            </div>

            <div class="text-center mt-4 mb-0">
                <a href="" class="nav-link link-dark">SIPANDU &copy 2021</a>
            </div>

            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{url('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('admin-template/dist/js/adminlte.js')}}"></script>

    <script>
        function refreshCaptcha(){
            $.ajax({
                url: "/refresh-captcha",
                type: 'get',
                dataType: 'html',
                success: function(json){
                    $('.refreshCaptcha').html(json);
                },
                error: function(data){
                    alert("Coba lagi");
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>
