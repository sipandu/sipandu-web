<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Smart Posyandu - Welcome</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('/images/sipandu-logo.ico') }}">

	<link rel="stylesheet" href="{{ url('index-template/css/bootstrap-5.0.5-alpha.min.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/LineIcons.2.0.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/animate.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/tiny-slider.css')}}">
	<link rel="stylesheet" href="{{ url('index-template/css/main.css')}}">
</head>
<body>
	{{-- Preload Start --}}
	<div class="preloader">
		<div class="loader">
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


	<!--========================= service-section start ========================= -->
	{{-- <section id="services" class="service-section pt-150">
		<div class="shape shape-3">
			<img src="index-template/img/shapes/shape-3.svg" alt="">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="section-title text-center mb-55">
						<span class="wow fadeInDown" data-wow-delay=".2s">Services</span>
						<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s">Our Healthcare Services</h2>
						<p class="wow fadeInUp" data-wow-delay=".6s">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
							dinonumy
							<br class="d-none d-lg-block"> eirmod tempor invidunt ut labore et dolore magn.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="service-item mb-30">
						<div class="service-icon mb-25">
							<svg xmlns="http://www.w3.org/2000/svg" width="79.557" height="57.882" viewBox="0 0 79.557 57.882">
								<g id="noun_Cardiology_1744691" transform="translate(0 0.005)">
									<g id="Layer_2" data-name="Layer 2" transform="translate(0 -0.005)">
										<g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
											<path id="Path_64" data-name="Path 64"
												d="M38.188,57.877l-1.726-1.448c-.9-.74-21.974-18.449-27.368-29.778a16.444,16.444,0,0,1-1.5-6.365A20.406,20.406,0,0,1,17.145,2.521C23.224-1.163,30.782-.8,38.451,3.547,46.1-.8,53.678-1.163,59.788,2.481a20.43,20.43,0,0,1,9.547,17.757,16.087,16.087,0,0,1-1.5,6.412C62.406,38,40.853,55.689,39.939,56.485ZM26.255,5.449A12.172,12.172,0,0,0,19.89,7.167a15,15,0,0,0-6.866,12.9,10.471,10.471,0,0,0,.088,1.13,10.159,10.159,0,0,0,.883,3.111c4.049,8.513,19.094,21.99,24.2,26.453,5.227-4.439,20.6-17.948,24.663-26.453a10.676,10.676,0,0,0,.979-4.24,15.02,15.02,0,0,0-6.85-12.9C52.58,4.534,47.123,4.924,41.164,8.281l-2.713,2.777L35.762,8.289a19.547,19.547,0,0,0-9.507-2.84Z"
												transform="translate(-1.552 0.005)" fill="#3a424e" />
											<path id="Path_65" data-name="Path 65"
												d="M29.19,39.18,25.769,27.955l-2.021,4.463H1.949a1.949,1.949,0,1,1,0-3.9H21.234l5.251-11.6,3.866,12.729,7.041-11.782L41.37,29.172l6.786-8.751,5.4,6.07h24.05a1.949,1.949,0,0,1,0,3.9H51.776l-3.445-3.859-8.29,10.7-3.6-10.215Z"
												transform="translate(0 -3.455)" fill="#00adb5" />
										</g>
									</g>
								</g>
							</svg>
						</div>
						<div class="service-content">
							<h4>Cardiology</h4>
							<p>Lorem ipsum dolor sit amet, consetet
								sadipscing elitr, sed dinonumy eirmod tempor invidunt.</p>
							<a href="#" class="read-more">Read More <i class="lni lni-arrow-right"></i></a>
						</div>
						<div class="service-overlay img-bg"></div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-item mb-30">
						<div class="service-icon mb-25">
							<svg xmlns="http://www.w3.org/2000/svg" width="57.792" height="58.716" viewBox="0 0 57.792 58.716">
								<g id="noun_Brain_2581553" transform="translate(-5.696 -4.966)">
									<path id="Path_66" data-name="Path 66"
										d="M71.522,37.625a86.253,86.253,0,0,1-4.365-8.273,23.669,23.669,0,0,0-1.368-12.768C63.184,10.2,55.106,5.444,46.051,4.988a22.5,22.5,0,0,0-16.09,5.733.91.91,0,0,0-.2.977.928.928,0,0,0,.847.586h.912a4.536,4.536,0,0,1,1.629.326.819.819,0,0,0,.847-.13A18.391,18.391,0,0,1,45.855,8.9c7.426.326,14.266,4.169,16.286,9.055a19.834,19.834,0,0,1,1.173,10.683V28.7c0,.13-.065.2-.065.261-.065.586-.2,1.629,4.1,9.25h-.586a4.465,4.465,0,0,0-4.625,4.43v9.315a.764.764,0,0,1-.326.717c-1.368,1.107-5.863,1.042-9.25.326a2.037,2.037,0,0,0-1.954.717,2,2,0,0,0-.391,1.238v7.426a1.142,1.142,0,0,0,1.107,1.107h1.759a1.142,1.142,0,0,0,1.107-1.107V57.168c2.866.326,7.687.521,10.162-1.563a4.577,4.577,0,0,0,1.759-3.778V42.771c0-.2.13-.782.521-.782h0c.912.065,3.257.065,4.495-1.3h0a2.883,2.883,0,0,0,.651-2.606C71.717,37.95,71.587,37.755,71.522,37.625Z"
										transform="translate(-8.367 0)" fill="#393e46" />
									<path id="Path_677" data-name="Path 67"
										d="M46.934,41.032a7.145,7.145,0,0,0,2.345-5.8,5.839,5.839,0,0,0-1.954-4.3,4.524,4.524,0,0,0-2.28-.977,5.655,5.655,0,0,0-3.257-5.472,7.122,7.122,0,0,0-4.3-.456,8.9,8.9,0,0,0-3.257-3.387,6.293,6.293,0,0,0-5.211-.326,9.683,9.683,0,0,0-1.889.847,9.288,9.288,0,0,0-9.511-1.694,8.706,8.706,0,0,0-5.993,8.794,6.841,6.841,0,0,0-5.342,5.407c-.326.912-1.3,4.1.326,6.514a5.759,5.759,0,0,0,4.821,2.41h5.342a1.336,1.336,0,0,1,1.368,1.368V67.415a1.142,1.142,0,0,0,1.107,1.107h1.629a1.142,1.142,0,0,0,1.107-1.107V43.963a5.3,5.3,0,0,0-5.277-5.277H11.5A2,2,0,0,1,9.8,38.035c-.521-.782-.13-2.475.13-3.127A.392.392,0,0,0,10,34.648a3.311,3.311,0,0,1,3.387-2.736,1.727,1.727,0,0,0,1.433-.521,2.021,2.021,0,0,0,.586-1.433,1.272,1.272,0,0,1,.065-.456v-.065a7.094,7.094,0,0,0,.065-1.238,5.023,5.023,0,0,1,3.453-5.146,5.62,5.62,0,0,1,5.211.586,8.009,8.009,0,0,0-.912,1.629c-1.107,2.866-.521,6.189,1.759,10.032a1.035,1.035,0,0,0,.651.521,1.3,1.3,0,0,0,.847-.13l1.433-.847a1.035,1.035,0,0,0,.521-.651,1.3,1.3,0,0,0-.13-.847c-1.629-2.671-2.085-4.886-1.433-6.579a5.393,5.393,0,0,1,3.192-2.736h.065a3.016,3.016,0,0,1,2.28.065,5.6,5.6,0,0,1,2.215,3,1.857,1.857,0,0,0,1.173,1.238,1.917,1.917,0,0,0,1.694-.2,2.846,2.846,0,0,1,2.606-.2c1.563.717.782,3.062.717,3.322a1.957,1.957,0,0,0,.977,2.41,1.928,1.928,0,0,0,1.368.13,2.34,2.34,0,0,1,1.694.065,2.05,2.05,0,0,1,.521,1.238,3.72,3.72,0,0,1-.977,2.866,4.2,4.2,0,0,1-3.062.651H29.085a4.949,4.949,0,0,0-4.951,4.951V49.5a1.474,1.474,0,0,0,1.5,1.5h.912a1.474,1.474,0,0,0,1.5-1.5V43.572a1.029,1.029,0,0,1,1.042-1.042H40.941A7.951,7.951,0,0,0,46.934,41.032Z"
										transform="translate(0 -4.84)" fill="#00adb5" />
									<path id="Path_68" data-name="Path 68"
										d="M20.446,40.035a.765.765,0,0,0-.651.912l.13.912a.9.9,0,0,0,.326.521.664.664,0,0,0,.586.13A7.536,7.536,0,0,0,23.7,41.4a3.24,3.24,0,0,1,3,1.5.8.8,0,0,0,.651.326.942.942,0,0,0,.456-.13l.782-.521a.664.664,0,0,0,.326-.521.625.625,0,0,0-.13-.586,5.623,5.623,0,0,0-3.127-2.28,7.248,7.248,0,0,0,.261-4.625,1.013,1.013,0,0,0-.391-.521.771.771,0,0,0-.651-.065l-.847.261a.781.781,0,0,0-.521.977,4.513,4.513,0,0,1-.391,3.322A4.28,4.28,0,0,1,20.446,40.035Z"
										transform="translate(-4.911 -10.098)" fill="#00adb5" />
									<path id="Path_699" data-name="Path 69"
										d="M42,40.77a1.171,1.171,0,0,0,.261.586l.717.586a.74.74,0,0,0,.521.2.707.707,0,0,0,.586-.261c1.433-1.5,2.671-1.433,3-1.368a8.933,8.933,0,0,0,3.583.717h.717a.777.777,0,0,0,.586-.326,1.051,1.051,0,0,0,.2-.586l-.13-.912a.9.9,0,0,0-.847-.717,5.83,5.83,0,0,1-3.843-.977,4.125,4.125,0,0,1-1.433-3A.752.752,0,0,0,45.062,34l-.912.065a1.171,1.171,0,0,0-.586.261,1.051,1.051,0,0,0-.2.586,6.909,6.909,0,0,0,1.238,3.518,7.394,7.394,0,0,0-2.345,1.759A.635.635,0,0,0,42,40.77Z"
										transform="translate(-12.654 -10.116)" fill="#00adb5" />
								</g>
							</svg>
						</div>
						<div class="service-content">
							<h4>Neurology</h4>
							<p>Lorem ipsum dolor sit amet, consetet
								sadipscing elitr, sed dinonumy eirmod tempor invidunt.</p>
							<a href="#" class="read-more">Read More <i class="lni lni-arrow-right"></i></a>
						</div>
						<div class="service-overlay img-bg"></div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-item mb-30">
						<div class="service-icon mb-25">
							<svg xmlns="http://www.w3.org/2000/svg" width="51.275" height="58.44" viewBox="0 0 51.275 58.44">
								<g id="noun_Stomach_576009" transform="translate(-4.423 -0.572)">
									<g id="Group_152" data-name="Group 152" transform="translate(4.423 0.572)">
										<path id="Path_470" data-name="Path 70"
											d="M53.065,18.13A8.5,8.5,0,0,0,46.853,13.3l-.016,0a4.4,4.4,0,0,1-3.089-2.131c-.217-.38-.417-.76-.592-1.143a11.73,11.73,0,0,1-.965-6.237,2.867,2.867,0,0,0-5.69-.7,17.283,17.283,0,0,0,1.446,9.331l.014.031c1.392,3.02-1,6.211-1.718,9.108a22.519,22.519,0,0,1-3.734,7.887,25.8,25.8,0,0,1-14.583,9.684l-.107.025a7.8,7.8,0,0,0-4.689,3.13,7.238,7.238,0,0,1-2.2,2.062A13.119,13.119,0,0,0,7.691,47.1a13.667,13.667,0,0,0-3.263,9.124,2.866,2.866,0,0,0,2.862,2.785l.082,0a2.867,2.867,0,0,0,2.785-2.946,7.737,7.737,0,0,1,1.451-4.7.982.982,0,0,1,1.589,0,7.79,7.79,0,0,0,2.5,2.149,27.063,27.063,0,0,0,12.968,3.309c.136,0,.273,0,.409,0A27.048,27.048,0,0,0,53.065,18.13ZM29.016,52.608c-.114,0-.231,0-.346,0a22.843,22.843,0,0,1-10.95-2.793,3.36,3.36,0,0,1-1.767-3.525A3.57,3.57,0,0,1,18.5,43.315c.078-.025.161-.046.245-.065s.143-.033.214-.049a30.669,30.669,0,0,0,14.072-7.92,27.067,27.067,0,0,0,7.521-13.739c.009-.049.021-.105.031-.168A4.67,4.67,0,0,1,41.844,18.8a4.824,4.824,0,0,1,3.418-1.427A4.324,4.324,0,0,1,48.79,19.13a5.251,5.251,0,0,1,.483.813A22.622,22.622,0,0,1,51.5,29.981,22.959,22.959,0,0,1,29.016,52.608Z"
											transform="translate(-4.423 -0.572)" fill="#393e46" />
										<path id="Path_71" data-name="Path 71"
											d="M43.851,43.011a1.578,1.578,0,0,1,1.279,2.6,19.953,19.953,0,0,1-14.8,6.97c-.1,0-.2,0-.294,0a20.012,20.012,0,0,1-8.224-1.768l-.014-.007a1.2,1.2,0,0,1-.039-2.147,1.39,1.39,0,0,1,.233-.106A33.62,33.62,0,0,0,35.155,41.34a1.562,1.562,0,0,1,1.638-.285c.111.046.22.1.329.15.777.384,1.454.953,2.242,1.315a9.56,9.56,0,0,0,4.453.495Z"
											transform="translate(-5.596 -3.409)" fill="#00adb5" />
									</g>
								</g>
							</svg>
						</div>
						<div class="service-content">
							<h4>Gastroenterology</h4>
							<p>Lorem ipsum dolor sit amet, consetet
								sadipscing elitr, sed dinonumy eirmod tempor invidunt.</p>
							<a href="#" class="read-more">Read More <i class="lni lni-arrow-right"></i></a>
						</div>
						<div class="service-overlay img-bg"></div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-item mb-30">
						<div class="service-icon mb-25">
							<svg xmlns="http://www.w3.org/2000/svg" width="48.362" height="58.163" viewBox="0 0 48.362 75.163">
								<g id="noun_knee_joint_2596276" data-name="noun_knee joint_2596276"
									transform="translate(-24.199 -12.537)">
									<path id="Path_72" data-name="Path 72"
										d="M51.5,87.7H37.1a2.553,2.553,0,0,1-2.4-1.9c-.2-.9-.4-2.1-.6-3.5-.8-4.7-2-11.9-4.9-16-.4-.5-.8-1.1-1.2-1.6a19.145,19.145,0,0,1-2.5-3.6c-.6-1.2-2.6-5.5,0-8.2,3-3.2,6.7-.1,7.8.9l.4.3a19.761,19.761,0,0,0,3.5,2.6c3.4,1.8,7,1.8,11.1,0,.2-.1.5-.2.7-.3a11.717,11.717,0,0,1,3.6-1.2,3.888,3.888,0,0,1,1.9.3A3.509,3.509,0,0,1,56,57.3a5.7,5.7,0,0,1-.3,3.9,28.8,28.8,0,0,1-1.3,3.1l-.3.7a9.492,9.492,0,0,0-.9,2.5c-.9,4.3-.1,14.7.7,17.1a2.817,2.817,0,0,1-.3,2.2A2.723,2.723,0,0,1,51.5,87.7ZM39.2,82.9h9.4c-.7-4.7-1-12.4-.2-16.4A15.943,15.943,0,0,1,49.7,63l.3-.6c.2-.4.3-.8.5-1.2-.1,0-.1.1-.2.1-5.4,2.4-10.6,2.3-15.3-.2a24.907,24.907,0,0,1-4.4-3.2l-.4-.4a5.223,5.223,0,0,0-1.1-.8,10.572,10.572,0,0,0,.7,2.2,13.109,13.109,0,0,0,2,2.8c.5.6.9,1.2,1.4,1.8,3.6,5.1,4.9,12.9,5.7,18C39,82,39.1,82.5,39.2,82.9Zm12.1-24Z"
										fill="#00adb5" />
									<path id="Path_73" data-name="Path 73"
										d="M43.4,54.1a12.078,12.078,0,0,1-7.9-21.2,13.221,13.221,0,0,1,5-2.6,9.459,9.459,0,0,0,3.1-2.1l.1-.1a27.592,27.592,0,0,0,5-5.9,33.949,33.949,0,0,0,3.2-5.6c.3-.7.8-1.6,1.1-2.5a2.443,2.443,0,0,1,3.1-1.4L71,18.3a2.293,2.293,0,0,1,1.5,1.8,2.328,2.328,0,0,1-.8,2.3c-.5.5-1.1,1-1.6,1.5-1.6,1.6-3.2,3.3-4.7,5.1a65.45,65.45,0,0,0-5.8,7.8,51.292,51.292,0,0,0-4.9,9.6,12.347,12.347,0,0,1-6.3,6.8A14.259,14.259,0,0,1,43.4,54.1Zm13.3-36-.3.6a52.992,52.992,0,0,1-3.6,6.2,33.563,33.563,0,0,1-5.9,6.8l-.1.1c-1.3,1.1-2.9,2.6-5,3.1a8.239,8.239,0,0,0-3.1,1.6,7.239,7.239,0,0,0,2.2,12.2,7,7,0,0,0,5.5-.2,7.106,7.106,0,0,0,3.8-4A55.18,55.18,0,0,1,55.6,34a89.346,89.346,0,0,1,6.2-8.3c1.3-1.5,2.6-2.9,3.9-4.3Z"
										fill="#393e46" />
								</g>
							</svg>
						</div>
						<div class="service-content">
							<h4>Orthopedics</h4>
							<p>Lorem ipsum dolor sit amet, consetet
								sadipscing elitr, sed dinonumy eirmod tempor invidunt.</p>
							<a href="#" class="read-more">Read More <i class="lni lni-arrow-right"></i></a>
						</div>
						<div class="service-overlay img-bg"></div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-item mb-30">
						<div class="service-icon mb-25">
							<svg xmlns="http://www.w3.org/2000/svg" width="43.302" height="58.633" viewBox="0 0 43.302 58.633">
								<g id="noun_womb_1744327" transform="translate(-22.94 -12.449)">
									<path id="Path_81" data-name="Path 81"
										d="M59,49.642V50c0,.434-.868.583-1.167.655a2.227,2.227,0,0,1-1.843-.135,8.716,8.716,0,0,1-1.48-1.252l-1.793-1.7L51.68,46.526a.755.755,0,1,0-1.067,1.067A4.98,4.98,0,0,1,52.2,50.439c.192,1.722-1.423,3.223-2.782,3.963a12.192,12.192,0,0,1-5.841,1.124,7.947,7.947,0,0,1-5.635-2.277A17.36,17.36,0,0,1,33.673,46.4a7.57,7.57,0,0,1-.384-2.355v-.064a2.583,2.583,0,0,0-.975-1.971A6.88,6.88,0,1,1,43.427,35.22a7.115,7.115,0,0,1,.043,2.618A1.515,1.515,0,0,1,41.7,39.048l-.178-.043a5.329,5.329,0,0,0-1.473-.213H39.2a.754.754,0,0,0-.761.6.711.711,0,0,0,.711.854h.9a3.643,3.643,0,0,1,1.85.512l.512.313.406.228.27.157a.711.711,0,0,0,.9-.121l1-1.025a.953.953,0,0,1,1.323-.1.968.968,0,0,1,.27,1.124l-.939,2.8a1.615,1.615,0,0,1-1.53,1.1H42.695a.861.861,0,0,0,0,1.715h2.013a3.1,3.1,0,0,0,2.938-2.134l.975-3.095a2.277,2.277,0,0,1,2.213-1.594h.036a2.191,2.191,0,0,1,1.885,1.06l3.778,6.311a3.458,3.458,0,0,0,1.878,1.416A.776.776,0,0,1,59,49.642Z"
										transform="translate(-0.985 -4.655)" fill="#00adb5" />
									<path id="Path_82" data-name="Path 82"
										d="M66.242,34.145A21.651,21.651,0,1,0,26.177,45.49h0l.183.256a23.146,23.146,0,0,0,1.582,2.2L44.569,71.082,61.247,47.973a20.214,20.214,0,0,0,1.582-2.2l.183-.249h0A21.461,21.461,0,0,0,66.242,34.145Zm-39.991-.051A18.311,18.311,0,0,1,58.786,22.528a1.714,1.714,0,0,1-.842.168,3.171,3.171,0,0,0-3.281,3.281A1.3,1.3,0,0,1,53.2,27.443a3.164,3.164,0,0,0-3.274,3.274,1.3,1.3,0,0,1-1.465,1.465,3.171,3.171,0,0,0-2.351.923.953.953,0,0,0,1.348,1.348,1.34,1.34,0,0,1,1.091-.359A3.157,3.157,0,0,0,51.82,30.82a1.3,1.3,0,0,1,1.465-1.465,3.164,3.164,0,0,0,3.281-3.318,1.3,1.3,0,0,1,1.465-1.465,3.369,3.369,0,0,0,1.875-.535A18.311,18.311,0,1,1,26.251,34.094Z"
										fill="#393e46" />
									<path id="Path_83" data-name="Path 83"
										d="M59.013,49.974v-.356a.776.776,0,0,0-.62-.712,3.462,3.462,0,0,1-1.838-1.475L52.78,41.084a2.194,2.194,0,0,0-1.888-1.061h-.036a2.28,2.28,0,0,0-2.215,1.6l-.983,3.1a3.106,3.106,0,0,1-2.942,2.137H42.7a.862.862,0,0,1,0-1.717h1.425a1.617,1.617,0,0,0,1.532-1.1l.926-2.743a.969.969,0,0,0-.271-1.126.955.955,0,0,0-1.339.114l-.99,1.012a.712.712,0,0,1-.9.121l-.264-.121-.406-.228-.513-.313a3.647,3.647,0,0,0-1.852-.513h-.862a.712.712,0,0,1-.712-.855.755.755,0,0,1,.712-.648h.826a5.336,5.336,0,0,1,1.475.214l.178.043a1.517,1.517,0,0,0,1.8-1.2,7.124,7.124,0,0,0-.036-2.622,6.91,6.91,0,1,0-11.1,6.775,2.586,2.586,0,0,1,.976,1.973v.064a7.58,7.58,0,0,0,.385,2.358,17.382,17.382,0,0,0,4.274,6.853,7.957,7.957,0,0,0,5.642,2.28,12.14,12.14,0,0,0,5.849-1.126c1.368-.712,2.978-2.244,2.785-3.968a4.987,4.987,0,0,0-1.589-2.849.756.756,0,1,1,1.069-1.069l1,1.069,1.76,1.7a8.727,8.727,0,0,0,1.482,1.254,2.23,2.23,0,0,0,1.845.135C58.144,50.558,59.013,50.4,59.013,49.974Z"
										transform="translate(-0.997 -4.602)" fill="#00adb5" />
								</g>
							</svg>
						</div>
						<div class="service-content">
							<h4>Gynecology</h4>
							<p>Lorem ipsum dolor sit amet, consetet
								sadipscing elitr, sed dinonumy eirmod tempor invidunt.</p>
							<a href="#" class="read-more">Read More <i class="lni lni-arrow-right"></i></a>
						</div>
						<div class="service-overlay img-bg"></div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-item mb-30">
						<div class="service-icon mb-25">
							<svg id="noun_dental_care_2692540" data-name="noun_dental care_2692540" xmlns="http://www.w3.org/2000/svg"
								width="70.285" height="58.102" viewBox="0 0 70.285 58.102">
								<g id="Group_156" data-name="Group 156">
									<path id="Path_84" data-name="Path 84"
										d="M17.336,17C14.2,22.319,7.223,26.405,0,27.04c0,13.45,3.61,28.3,17.337,32.13C31.061,55.34,34.674,40.489,34.674,27.04,27.373,25.929,20.467,22.319,17.336,17Zm0,37.576c-8.564-2.144-13-15.642-13-24.21,3.65-.224,10.44-2.565,13-7.149,2.561,4.584,9.352,6.925,13,7.149C30.338,38.934,25.9,52.432,17.337,54.576Zm2.144-17.593V32.655h-4.33v4.329h-4.33v4.33h4.33v4.33h4.33v-4.33h4.33v-4.33Z"
										transform="translate(0 -1.069)" fill="#393e46" />
									<path id="Path_85" data-name="Path 85"
										d="M72.777,7.735a7.668,7.668,0,0,0-2.063-5.6A7.393,7.393,0,0,0,66.72.127,8.515,8.515,0,0,0,65.246,0c-3.365.066-5.6,1.62-9.029,1.58C52.784,1.62,50.545.066,47.185,0a8.411,8.411,0,0,0-1.476.126,7.4,7.4,0,0,0-3.994,2.011,7.667,7.667,0,0,0-2.065,5.6A19.9,19.9,0,0,0,44,20.6a21.726,21.726,0,0,0-.974,6.388,17.447,17.447,0,0,0,1.408,7.128,8.114,8.114,0,0,0,1.477,2.28,3.178,3.178,0,0,0,2.136,1.085v0h.06l.078,0A2.689,2.689,0,0,0,50.2,36.391a11.413,11.413,0,0,0,1.632-3.6c.652-2.094,1.256-4.552,2.039-6.379a7.347,7.347,0,0,1,1.236-2.087,1.47,1.47,0,0,1,1.107-.573c.538-.008,1.086.351,1.761,1.486a35.937,35.937,0,0,1,2.431,6.94A19.3,19.3,0,0,0,61.652,35.5a4.76,4.76,0,0,0,.947,1.289,2.508,2.508,0,0,0,1.652.7H64.3A3.164,3.164,0,0,0,66.519,36.4c1.664-1.776,2.854-5.148,2.886-9.41a21.74,21.74,0,0,0-.974-6.387A19.876,19.876,0,0,0,72.777,7.735ZM65.619,33.029a5.612,5.612,0,0,1-.982,1.551,1.632,1.632,0,0,1-.305.255,6.733,6.733,0,0,1-.978-2.028c-.664-1.912-1.28-4.633-2.2-6.964A10.906,10.906,0,0,0,59.382,22.7a4.163,4.163,0,0,0-3.167-1.568h0a4.787,4.787,0,0,0-4.026,2.79c-1.262,2.2-1.954,5.131-2.675,7.507a17.169,17.169,0,0,1-1.048,2.844,2.546,2.546,0,0,1-.376.561,2.072,2.072,0,0,1-.474-.45c-.927-1.091-2-3.925-1.977-7.4A19.133,19.133,0,0,1,46.7,20.754a1.3,1.3,0,0,0-.236-1.273A17.2,17.2,0,0,1,42.268,7.737a5.021,5.021,0,0,1,1.3-3.753,4.794,4.794,0,0,1,2.587-1.277,5.972,5.972,0,0,1,1.028-.09c2.294-.066,4.822,1.541,9.031,1.58,4.206-.039,6.731-1.646,9.029-1.58a6.188,6.188,0,0,1,1.026.088,4.789,4.789,0,0,1,2.586,1.279,5.021,5.021,0,0,1,1.3,3.753,17.2,17.2,0,0,1-4.194,11.744,1.312,1.312,0,0,0-.239,1.273,19.049,19.049,0,0,1,1.06,6.236A14.968,14.968,0,0,1,65.619,33.029Z"
										transform="translate(-2.493 0)" fill="#00adb5" />
								</g>
							</svg>
						</div>
						<div class="service-content">
							<h4>Dental Surgery</h4>
							<p>Lorem ipsum dolor sit amet, consetet
								sadipscing elitr, sed dinonumy eirmod tempor invidunt.</p>
							<a href="#" class="read-more">Read More <i class="lni lni-arrow-right"></i></a>
						</div>
						<div class="service-overlay img-bg"></div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!--========================= service-section end ========================= -->

	<!-- ========================= testimonial-section start ========================= -->
	{{-- <section id="testimonial" class="team-section pt-150 pb-150">
		<div class="shape shape-5">
			<img src="index-template/img/shapes/shape-2.svg" alt="">
		</div>
		<div class="shape shape-6">
			<img src="index-template/img/shapes/shape-5.svg" alt="">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="section-title text-center mb-55">
						<span class="wow fadeInDown" data-wow-delay=".2s">Your Using Free Lite Version of The Template</span>
						<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s">Please, purchase full version</h2>
						<p class="wow fadeInUp" data-wow-delay=".6s">To get all sections and permission to use with commercial projects & footer credit remove <br/></p></br>
						<a href="https://rebrand.ly/medic-ud" rel="nofollow" class="btn theme-btn">Purchase Now</a>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- ========================= testimonial-section end ========================= -->

	<!--========================= faq-section start ========================= -->
	{{-- <section class="faq-section theme-bg">
		<div class="faq-video-wrapper">
			<div class="faq-video">
				<img src="index-template/img/faq/faq-img.jpg" alt="">
				<div class="video-btn">
					<a class="popup-video glightbox" href="#"><i class="lni lni-play"></i></a>
				</div>
			</div>
		</div>
		<div class="shape">
			<img src="index-template/img/shapes/shape-8.svg" alt="" class="shape-faq">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-6 col-lg-8 col-md-10">
					<div class="faq-content-wrapper pt-90 pb-90">
						<div class="section-title">
							<span class="text-white wow fadeInDown" data-wow-delay=".2s">Frequently Asked
								Questions</span>
							<h2 class="text-white mb-35 wow fadeInUp" data-wow-delay=".4s">Get Every Single Answers
								There if you want</h2>
						</div>
						<div class="faq-wrapper accordion" id="accordionExample">
							<div class="faq-item mb-20">
								<div id="headingOne">
									<h5 class="mb-0">
										<button class="faq-btn btn" type="button" data-toggle="collapse" data-target="#collapseOne"
											aria-expanded="true" aria-controls="collapseOne">
											What is an academic medical center? <i class="lni"></i>
										</button>
									</h5>
								</div>

								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
									data-parent="#accordionExample">
									<div class="faq-content">
										Lorem ipsum dolor sit amet, consetet Lorem ipsum dolor sit amet, consetet
										sadipscing elitr, sed dinonumy eirmod tempor invidunt.
										sadipscing elitr, sed dinonumy eirmod tempor invidunt. Lorem ipsum dolor sit
										amet, consetet Lorem ipsum dolor.
									</div>
								</div>
							</div>
							<div class="faq-item mb-20">
								<div id="headingTwo">
									<h5 class="mb-0">
										<button class="faq-btn btn collapsed" type="button" data-toggle="collapse"
											data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
											What is an academic medical center? <i class="lni"></i>
										</button>
									</h5>
								</div>

								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
									<div class="faq-content">
										Lorem ipsum dolor sit amet, consetet Lorem ipsum dolor sit amet, consetet
										sadipscing elitr, sed dinonumy eirmod tempor invidunt.
										sadipscing elitr, sed dinonumy eirmod tempor invidunt. Lorem ipsum dolor sit
										amet, consetet Lorem ipsum dolor.
									</div>
								</div>
							</div>
							<div class="faq-item mb-20">
								<div id="headingThree">
									<h5 class="mb-0">
										<button class="faq-btn btn collapsed" type="button" data-toggle="collapse"
											data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
											What is a medical student? <i class="lni"></i>
										</button>
									</h5>
								</div>

								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
									<div class="faq-content">
										Lorem ipsum dolor sit amet, consetet Lorem ipsum dolor sit amet, consetet
										sadipscing elitr, sed dinonumy eirmod tempor invidunt.
										sadipscing elitr, sed dinonumy eirmod tempor invidunt. Lorem ipsum dolor sit
										amet, consetet Lorem ipsum dolor.
									</div>
								</div>
							</div>
							<div class="faq-item">
								<div id="headingFour">
									<h5 class="mb-0">
										<button class="faq-btn btn collapsed" type="button" data-toggle="collapse"
											data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
											How are residents supervised? <i class="lni"></i>
										</button>
									</h5>
								</div>

								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
									<div class="faq-content">
										Lorem ipsum dolor sit amet, consetet Lorem ipsum dolor sit amet, consetet
										sadipscing elitr, sed dinonumy eirmod tempor invidunt.
										sadipscing elitr, sed dinonumy eirmod tempor invidunt. Lorem ipsum dolor sit
										amet, consetet Lorem ipsum dolor.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!--========================= faq-section end ========================= -->

	<!-- ========================= team-section start ========================= -->
	{{-- <section id="team" class="team-section pt-150 pb-150">
		<div class="shape shape-5">
			<img src="index-template/img/shapes/shape-2.svg" alt="">
		</div>
		<div class="shape shape-6">
			<img src="index-template/img/shapes/shape-5.svg" alt="">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="section-title text-center mb-55">
						<span class="wow fadeInDown" data-wow-delay=".2s">Your Using Free Lite Version of The Template</span>
						<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s">Please, purchase full version</h2>
						<p class="wow fadeInUp" data-wow-delay=".6s">To get all sections and permission to use with commercial projects & footer credit remove <br/></p></br>
						<a href="https://rebrand.ly/medic-ud" rel="nofollow" class="btn theme-btn">Purchase Now</a>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- ========================= team-section end ========================= -->

	<!-- ========================= subscribe-section start ========================= -->
	{{-- <section class="subscribe-section pt-100 pb-100 img-bg" style="background-image: url(index-template/img/bg/subscribe-bg.jpg)">
		<div class="container">
			<div class="row">
				<div class="col-xl-7">
					<div class="section-title">
						<h2 class="mb-15">Subscribe Our Newsletter</h2>
						<p class="mb-35">Lorem ipsum dolor sit amet, consetetur sadiping elitr, sed dinonumy <br
								class="d-none d-lg-block"> eirmod tempor invidunt ut labore.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-8">
					<div class="subscribe-wrapper">
						<form action="#" class="subscribe-from">
							<input type="text" name="subscribe" id="subscribe" placeholder="Enter Your Email">
							<button class="btn theme-btn">Subscribe</button>
						</form>
						<div class="support d-flex">
							<div class="support-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="57.473" height="56.533" viewBox="0 0 57.473 56.533">
									<g id="noun_customer_service_2786300" data-name="noun_customer service_2786300"
										transform="translate(-11.49 -12.11)">
										<path id="Path_94" data-name="Path 94"
											d="M65.1,36.746a3.769,3.769,0,0,0-.485.052v-.209a3.858,3.858,0,0,0-2.746-3.664,21.6,21.6,0,0,0-43.166-.037,3.858,3.858,0,0,0-2.873,3.732v.209a3.769,3.769,0,0,0-.485-.052,3.866,3.866,0,0,0-3.858,3.858v7.515a3.866,3.866,0,0,0,3.858,3.858,3.732,3.732,0,0,0,.485-.052v.209a3.858,3.858,0,1,0,7.709,0V36.589a3.732,3.732,0,0,0-.037-.4V33.671a16.792,16.792,0,0,1,33.584,0v1.851a3.784,3.784,0,0,0-.164,1.037V52.172a3.829,3.829,0,0,0,.082.784c-1.1,2.463-4.254,8.426-9.56,10.075a4.023,4.023,0,1,0,.246,2.4c5.15-1.4,8.821-6.1,10.836-10.127a3.821,3.821,0,0,0,2.239.746,3.866,3.866,0,0,0,3.858-3.858v-.231a3.73,3.73,0,0,0,.485.052,3.866,3.866,0,0,0,3.851-3.858V40.6A3.866,3.866,0,0,0,65.1,36.746Z"
											fill="#00adb5" />
										<path id="Path_95" data-name="Path 95"
											d="M35.595,41.324a5.97,5.97,0,0,1,1.59-4.478,4.858,4.858,0,0,1,3.6-1.358,4.627,4.627,0,0,1,3.485,1.53A5.052,5.052,0,0,1,45.715,40.6a9.866,9.866,0,0,1-.94,4.321,29.853,29.853,0,0,1-2.4,3.732q-.507.746-1.493,2.239l-.6.873q-.545.828-.813,1.306a1.1,1.1,0,0,0-.134.284h6.127v3.06H35.55V53.564a6.716,6.716,0,0,1,.694-1.134q.306-.485.7-1.067l.806-1.179q.746-.978,2.239-3.12a20.9,20.9,0,0,0,2.142-3.642,6.859,6.859,0,0,0,.582-2.746,2.463,2.463,0,0,0-.53-1.6,1.843,1.843,0,0,0-1.493-.694,1.918,1.918,0,0,0-1.843,1.493,3.4,3.4,0,0,0-.179,1.216v.746H35.595Z"
											transform="translate(-6.104 -5.93)" fill="#00adb5" />
										<path id="Path_96" data-name="Path 96"
											d="M49.37,48.893l5.5-13.083h3.12V48.893h2v3.142h-2v4.478H54.87V52.035h-5.5Zm5.5,0V42.46L52.3,48.893Z"
											transform="translate(-9.61 -6.012)" fill="#00adb5" />
									</g>
								</svg>
							</div>
							<h2> <span>Emergency Medical</span> Service 24/7</h2>
						</div>
						<div class="subscribe-links">
							<ul>
								<li><a href="#"><i class="lni lni-phone-set"></i> <span>+034895903478</span> </a> </li>
								<li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
								<li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
								<li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- ========================= subscribe-section end ========================= -->



	<!-- ========================= contact-section start ========================= -->
	{{-- <section id="contact" class="team-section pt-150 pb-150">
		<div class="shape shape-5">
			<img src="index-template/img/shapes/shape-2.svg" alt="">
		</div>
		<div class="shape shape-6">
			<img src="index-template/img/shapes/shape-5.svg" alt="">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-8 mx-auto">
					<div class="section-title text-center mb-55">
						<span class="wow fadeInDown" data-wow-delay=".2s">Your Using Free Lite Version of The Template</span>
						<h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s">Please, purchase full version</h2>
						<p class="wow fadeInUp" data-wow-delay=".6s">To get all sections and permission to use with commercial projects & footer credit remove <br/></p></br>
						<a href="https://rebrand.ly/medic-ud" rel="nofollow" class="btn theme-btn">Purchase Now</a>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- ========================= contact-section end ========================= -->

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	@stack('js')

	<script src="{{ url('index-template/js/bootstrap.bundle-5.0.0.alpha-min.js')}}"></script>
	<script src="{{ url("index-template/js/wow.min.js")}}"></script>
	<script src="{{ url('index-template/js/tiny-slider.js')}}"></script>
	<script src="{{ url('index-template/js/main.js')}}"></script>

</body>
</html>