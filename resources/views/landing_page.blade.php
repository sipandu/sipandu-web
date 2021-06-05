<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sistem Posyandu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user-template') }}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{asset('user-template') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('user-template') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('user-template') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('user-template') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('user-template') }}/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="{{asset('user-template') }}/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="{{asset('user-template') }}/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="{{asset('user-template') }}/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="{{asset('user-template') }}/css/aos.css">

    <link rel="stylesheet" href="{{asset('user-template') }}/css/style.css">

  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap"  id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <div class="container d-none d-lg-block">
      <div class="row">
        <div class="col-12 text-center mb-4 mt-5">
            <h1 class="mb-0 site-logo"><a href="index.html" class="text-black h2 mb-0">Smart Posyandu 5.0<span class="text-primary">.</span> </a></h1>
          </div>
      </div>
    </div>
    <header class="site-navbar py-md-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-md-6 col-xl-2  d-block d-lg-none">
            <h1 class="mb-0 site-logo"><a href="index.html" class="text-black h2 mb-0">Sistem Posyandu<span class="text-primary">.</span> </a></h1>
          </div>

          <div class="col-12 col-md-10 main-menu">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#features-section" class="nav-link">Features</a></li>
                <li><a href="#about-section" class="nav-link">About Us</a></li>
                <li><a href="#" class="nav-link">Contact</a></li>
                <li><a href="#" class="nav-link"></a></li>
                <li><a href="#" class="nav-link"></a></li>
                <li><a href="{{route('form.user.login')}}" class="btn btn-primary mr-3 mb-2">Login</a></li>
                <li><a href="{{route('landing.regis')}}" class="btn btn-primary mr-3 mb-2">Registrasi</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-6 col-md-6 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>
        </div>
      </div>
    </header>

    <div class="site-blocks-cover">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12" style="position: relative;" data-aos="{{asset('user-template') }}/fade-up">

            <div class="row mb-2">
              <div class="col-lg-7 order-1 order-lg-2">
                <img src="{{asset('user-template') }}/images/landing_1.png" alt="Image" class="img-fluid">
              </div>
              <div class="col-lg-5 pr-lg-5 mr-auto mt-5 order-2 order-lg-1">
                <h1>Sistem Posyandu 5.0</h1>
                <p class="mb-4">Sistem Posyandu 5.0 merupakan sebuah layanan yang diberikan kepada masyarakat guna mempermudah pemantauan perkembangan ...Membantu para orang tua untuk memantau imunisasi anak mereka, melihat perkembangan anak mereka mulau dari berat badan, tinggi badan, hingga kesehatan anak mereka, serta yang terpenting semua dapat diakses melalui perangkat komputer masing-masing orang tua</p>
                <div>
                  <a href="#" class="btn btn-primary mr-2 mb-2">Get Started</a>
                </div>
              </div>
            </div>

            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-light" id="features-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Features</h2>
          </div>
        </div>
        <div class="row align-items-stretch">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="{{asset('user-template') }}/fade-up">

            <div class="unit-4 d-block">
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-telegram"></span></span>
              </div>
              <div>
                <h3>Telegram</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>

          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="{{asset('user-template') }}/fade-up">

            <div class="unit-4 d-block">
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-phonelink"></span></span>
              </div>
              <div>
                <h3>Website & Phone</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="{{asset('user-template') }}/fade-up" >
            <div class="unit-4 d-block">
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-bar-chart-o"></span></span>
              </div>
              <div>
                <h3>User Monitoring Grafik</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>


          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="{{asset('user-template') }}/fade-up">
            <div class="unit-4 d-block">
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-connectdevelop"></span></span>
              </div>
              <div>
                <h3>Terintegerasi</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="{{asset('user-template') }}/fade-up">
            <div class="unit-4 d-block">
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-share2"></span></span>
              </div>
              <div>
                <h3>Jaringan Antar Keluarga</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>

          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="{{asset('user-template') }}/fade-up">
            <div class="unit-4 d-block">
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-update"></span></span>
              </div>
              <div>
                <h3>Riwayat Keluarga</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="feature-big">
      <div class="container">
        <div class="row mb-5 site-section border-bottom">
          <div class="col-lg-7">
            <img src="{{asset('user-template') }}/images/do_ui_kit_download_cta_floating_devices-2x.png" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-5 pl-lg-5 ml-auto mt-md-5">
            <h2 class="text-black">Bersama Smart Posyandu 5.0</h2>
            <p class="mb-4">Posyandu merupakan salah satu bentuk Upaya Kesehatan Bersumberdaya Masyarakat (UKBM) yang dikelola dari, oleh, untuk, dan bersama masyarakat, guna memberdayakan masyarakat dan memberikan kemudahan kepada masyarakat dalam perawatan anak khususnya bayi serta balita</p>
            <ul class="ul-check mb-5 list-unstyled success">
              <li>Website</li>
              <li>Phone</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section" style="padding-top: 40px;" id="blog-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Kegiatan Terkini</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="{{asset('user-template') }}/images/Balita.jpg" alt="Image" class="img-fluid">
              <h2><a href="#">Program Kesehatan Balita</a></h2>
              <div class="meta mb-4">Br.Kaja, Dalung <span class="mx-2">&bullet;</span> Jan 18, 2021<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>Jenis pelayanan yang diselenggarakan posyandu untuk balita mencakup penimbangan berat badan, pengukuran tinggi badan dan lingkar kepala anak, evaluasi tumbuh kembang, serta penyuluhan dan konseling tumbuh kembang. Hasil pemeriksaan tersebut kemudian dicatat di dalam buku KIA atau KMS.</p>
              <p><a href="#">Continue Reading...</a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="{{asset('user-template') }}/images/Lansia.jpg" alt="Image" class="img-fluid">
              <h2><a href="#">Kegiatan Senam Bersama Lansia</a></h2>
              <div class="meta mb-4">James Phelps <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>Senam lansia merupakan olahraga yang cocok bagi lansia karena gerakan di dalamnya menghindari gerakan loncat-loncat, melompat, kaki menyilang, maju mundur, menyentak-sentak namun masih dapat memacu kerja jantung-paru dengan intensitas ringan-sedang, bersifat menyeluruh dengan gerakan yang melibatkan sebagian besar otot tubuh</p>
              <p><a href="#">Continue Reading...</a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="{{asset('user-template') }}/images/ibuHamil.jpg" alt="Image" class="img-fluid">
              <h2><a href="#">Program kesehatan ibu hamil</a></h2>
              <div class="meta mb-4">James Phelps <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p> Pelayanan yang diberikan posyandu kepada ibu hamil mencakup pemeriksaan kehamilan dan pemantauan gizi.Ibu hamil juga dapat melakukan konsultasi terkait persiapan persalinan dan pemberian ASI.Setelah melahirkan, ibu juga bisa mendapatkan suplemen vitamin yang baik dikonsumsi selama masa menyusui, serta pemasangan alat kontrasepsi (KB)</p>
              <p><a href="#">Continue Reading...</a></p>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="site-section" style="padding-top: 40px;" id="blog-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Cara Pendaftaran</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img style="width:280px;height:280px" src="{{asset('user-template') }}/images/pertama.png" alt="Image" class="img-fluid">
              <h2 style="text-align: center;"><a href="#">Pendaftaran</a></h2>
              <p style="text-align: center;">Anda dapat melakukan pendaftaran online pada website resmi Smart Posyandu 5.0 atau offline dengan mengunjungi posyandu terdekat di daerah anda</p>

            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img style="width:280px;height:280px" src="{{asset('user-template') }}/images/kedua.png" alt="Image" class="img-fluid">
              <h2 style="text-align: center;"><a href="#">Verifikasi Berkas</a></h2>

              <p style="text-align: center;">Setelah mendaftarkan akun, maka akun anda akan di tinjau untuk lebih lanjutnya sebagai verifikasi data untuk menggunakan layanan ini.</p>

            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img style="width:280px;height:280px" src="{{asset('user-template') }}/images/ketiga.png" alt="Image" class="img-fluid">
              <h2 style="text-align: center;"><a href="#">Layanan Posyandu</a></h2>

              <p style="text-align: center;">Jika data sudah selesai di verifkasi maka anda dapat meninjau lebih lanjut sistem yang di tawarkan mulaui dari layanan bot telegram hingga report kesehatan</p>

            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="about-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">About Us</h2>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-6">
            <img src="{{asset('user-template') }}/images/about_1.png" alt="Image" class="img-fluid mb-5 mb-lg-0 rounded shadow">
          </div>
          <div class="col-lg-5 ml-auto pl-lg-5">
            <h2 class="text-black mb-4">Tentang Posyandu 5.0</h2>
            <p class="mb-4">Posyandu merupakan salah satu bentuk Upaya Kesehatan Bersumberdaya Masyarakat (UKBM) yang dikelola dari, oleh, untuk, dan bersama masyarakat, guna memberdayakan masyarakat dan memberikan kemudahan kepada masyarakat dalam perawatan anak khususnya bayi serta balita.</p>
            <p><a href="#" class="btn btn-primary">Learn More</a></p>
          </div>
        </div>

      </div>
    </div>

    <div class="footer py-5 border-top text-center">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <p class="mb-0">
              <footer class="main-footer ">
                <strong class="float-left">Copyright &copy; 2021
                    <a class="text-decoration-none link-primary" href="#">Sistem Informasi Posyandu Terintegrasi</a>
                </strong>
                <div class="float-right d-none d-sm-inline-block">
                    <b>All rights reserved</b>
                </div>
            </footer>
            </p>
          </div>
        </div>
      </div>
    </div>




  </div> <!-- .site-wrap -->

  <script src="{{asset('user-template') }}/js/jquery-3.3.1.min.js"></script>
  <script src="{{asset('user-template') }}/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="{{asset('user-template') }}/js/jquery-ui.js"></script>
  <script src="{{asset('user-template') }}/js/popper.min.js"></script>
  <script src="{{asset('user-template') }}/js/bootstrap.min.js"></script>
  <script src="{{asset('user-template') }}/js/owl.carousel.min.js"></script>
  <script src="{{asset('user-template') }}/js/jquery.stellar.min.js"></script>
  <script src="{{asset('user-template') }}/js/jquery.countdown.min.js"></script>
  <script src="{{asset('user-template') }}/js/bootstrap-datepicker.min.js"></script>
  <script src="{{asset('user-template') }}/js/jquery.easing.1.3.js"></script>
  <script src="{{asset('user-template') }}/js/aos.js"></script>
  <script src="{{asset('user-template') }}/js/jquery.fancybox.min.js"></script>
  <script src="{{asset('user-template') }}/js/jquery.sticky.js"></script>
  <script src="{{asset('user-template') }}/js/main.js"></script>

  </body>
</html>
