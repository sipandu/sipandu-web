<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/sipandu-logo.ico') }}">
    <title>Smart Posyandu | Lupa Sandi</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{url('base-template/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
    </style>

</head>
<body class="hold-transition login-page">
    <div class="hold-transition login-page">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h3 fw-bold">Smart Posyandu</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold">Pengubahan Kata Sandi</p>
            </div>
            <div class="card-body" >
                <p class="text-center fs-6 pt-2 pb-1">Silakan masukan Username Telegram atau Email untuk merubah kata sandi</p>
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    <form action="#" method="POST" class="col-md-6">
                        @csrf
                        <div class="col-md">
                            <div class="form-group mb-2">
                                <label>Telegram</label>
                                <div class="input-group">
                                    <input name="telegram" type="text" class="form-control" placeholder="Username Telegram">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fab fa-telegram-plane"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-sm btn-block mb-3">Kirim Kode OTP</button>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('post.email')}}" method="POST" class="col-md-6">
                        @csrf
                        <div class="col-md">
                            <div class="form-group mb-2">
                                <label>E-Mail</label>
                                <div class="input-group">
                                    <input name="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Masukan E-mail">
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
                            <div class="col-12 d-flex justify-content-end p-0">
                                <button type="submit" class="btn btn-outline-primary btn-sm btn-block">Kirim Kode OTP</button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="mb-1">
                    Ingin masuk? Klik
                    <a href="{{route('form.admin.login')}}" class="text-decoration-none link-primary">di sini</a>
                </p>
            </div>
            <div class="text-center mt-4 mb-0">
                <a href="" class="nav-link link-dark">Smart Posyandu &copy 2021</a>
            </div>

        </div>
    </div>


    <script src="{{url('base-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('base-template/dist/js/adminlte.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>
