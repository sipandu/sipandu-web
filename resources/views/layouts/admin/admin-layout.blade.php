<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/images/sipandu-logo.ico') }}">
    <title>Smart Posyandu | @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{url('admin-template/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{url('admin-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/summernote/summernote-bs4.min.css')}}">
    @stack('css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
        .swal-footer {
            text-align: center;
        }
    </style>
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        {{-- Navbar Start --}}
            @include('layouts/admin/navbar-layout')
        {{-- Navbar End --}}

        {{-- Sidebar Container Start --}}
            @include('layouts/admin/sidebar-layout')
        {{-- Sidebar Container End --}}

        {{-- Content Start --}}
            @include('layouts/admin/content-layout')
        {{-- Content End --}}

        {{-- Footer Start --}}
            @include('layouts/admin/footer-layout')
        {{-- Footer End --}}
    </div>

    <!-- jQuery -->
    <script src="{{url('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{url('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/sparklines/sparkline.js')}}"></script>
    <script src="{{url('admin-template/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{url('admin-template/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('admin-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{url('admin-template/dist/js/adminlte.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function alertSuccess(msg){
          swal({
            title: "Sukses",
            text: msg,
            icon: "success",
            button: "Ok",
          });
        }

        function alertError(msg){
          swal({
            title: "Eror",
            text: msg,
            icon: "warning",
            button: "Ok",
          });
        }
    </script>

    @stack('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>