<header id="home" class="header">
    <div class="header-wrapper">
        <div class="header-top theme-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="header-top-left text-center text-md-left">
                            <ul>
                                <li><a href="#"><i class="lni lni-envelope"></i> smart.posyandu@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="header-top-right d-none d-md-block">
                            <ul>
                                <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram-filled"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                                <img src="{{ asset('/images/sipandu-logo.png') }}" alt="" width="75" height="75" class="d-inline-block align-top" alt="Logo Smart Posyandu">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
        
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="page-scroll" id="menu-home" href="{{ route('Landing Page') }}">Beranda</a>
                                    </li>
                                    <li class="nav-item" id="berita">
                                        <a class="" id="menu-berita" href="#blog">Berita</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" id="menu-penyuluhan" href="#penyuluhan">Penyuluhan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" id="menu-tentang" href="#about">Tentang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('landing.regis') }}">Registrasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('form.user.login')}}">Masuk</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>