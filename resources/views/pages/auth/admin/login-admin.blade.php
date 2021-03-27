<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/sipandu-logo.ico') }}">
    <title>Smart Posyandu | Login Admin</title>

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

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">Smart Posyandu</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold h6">Selamat Datang Admin</p>
            </div>
            <div class="card-body">
                <p class="text-center pb-2 fs-6">Silakan Login untuk mengelola sistem</p>
                @if (session('message'))
                    <div class="alert alert-danger" role="alert">
                        {{session('message')}}
                    </div>
                @endif
                <form action="{{route('submit.login.admin')}}" method="post" id="form">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row g-4">
                        <div class="col-5 mb-1">
                            <div class="refreshCaptcha m-0 p-0">
                                {!! captcha_img('flat') !!}
                            </div>
                            <a href="javascript:void(0)" class="text-decoration-none link-primary" onclick="refreshCaptcha()">Refresh Captcha</a>
                        </div>                        
                        <div class="col-7">
                            <div class="input-group g-0">
                                <input name="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" placeholder="Captcha" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-spell-check"></span>
                                    </div>
                                </div>
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="show-hide" id="show-hide">
                                <label for="show-hide">Tampilkan Password</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-outline-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    Lupa password? Klik
                    <a href="{{route('form.reset-password')}}" class="text-decoration-none link-primary">di sini</a>
                </p>
            </div>
            <div class="text-center mt-4 mb-0">
                <a class="nav-link link-dark">Smart Posyandu &copy 2021</a>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('base-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('base-template/dist/js/adminlte.js')}}"></script>

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
    <script>
        (function() {
            var showHide = function( element, field ) {
                this.element = element;
                this.field = field;
                this.toggle();    
            };
            showHide.prototype = {
                toggle: function() {
                    var self = this;
                    self.element.addEventListener( "change", function() {
                        if(self.element.checked) {self.field.setAttribute( "type", "text" );}
                        else {self.field.setAttribute( "type", "password" );}
                    }, false);
                }
            };
            document.addEventListener( "DOMContentLoaded", function() {
                var checkbox = document.querySelector( "#show-hide" ),
                    password = document.querySelector( "#password" ),
                    form = document.querySelector( "#form" );
                    // form.addEventListener( "submit", function( e ) {
                    //     e.preventDefault();
                    // }, false);
                    var toggler = new showHide( checkbox, password );
            });
        })();
    </script>
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
