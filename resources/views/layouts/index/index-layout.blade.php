<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Posyandu 5.0 - Welcome</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('/images/sipandu-logo.ico') }}">

	<link rel="stylesheet" href="{{ url('index-template/css/bootstrap-5.0.5-alpha.min.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/LineIcons.2.0.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/animate.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/tiny-slider.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/main.css')}}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	@stack('css')
</head>
<body>
	{{-- Preload Start --}}
	<div class="preloader">
		<div class="loader">
			<img src="{{ asset('/images/sipandu-logo.ico') }}" alt="" width="50" height="50" class="d-inline-block align-top" alt="Logo Posyandu 5.0">
			<div class="ytp-spinner">
				<div class="ytp-spinner-container">
					<div class="ytp-spinner-rotator">
						<div class="ytp-spinner-left">
							<div class="ytp-spinner-circle"></div>
						</div>
						<div class="ytp-spinner-right">
							<div class="ytp-spinner-circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- preloader end -->

	{{-- Header Start --}}
		@include('layouts/index/navbar-layout')
	{{-- Header End --}}

		@yield('content')

	{{-- Footer Start --}}
		@include('layouts/index/footer-layout')
	{{-- Footer End --}}

	{{-- Scroll Up Buttom Start --}}
	<a href="#" class="scroll-top">
		<i class="lni lni-arrow-up"></i>
	</a>
	{{-- Scroll Up Buttom End --}}

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	@stack('js')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

	<script src="{{ url("index-template/js/bootstrap.bundle-5.0.0.alpha-min.js")}}"></script>
	<script src="{{ url("index-template/js/wow.min.js")}}"></script>
	<script src="{{ url("index-template/js/tiny-slider.js")}}"></script>
	<script src="{{ url("index-template/js/main.js")}}"></script>

</body>
</html>