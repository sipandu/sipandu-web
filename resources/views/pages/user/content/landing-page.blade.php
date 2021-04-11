@extends('layouts/index/index-layout')

@section('content')
    {{-- Hero Start --}}
        @include('layouts/index/hero-layout')
    {{-- Hero End --}}

    <section id="blog" class="blog-section pt-150">
        <div class="shape shape-7">
            <img src="index-template/img/shapes/shape-6.svg" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="section-title text-center mb-55">
                        <span class="wow fadeInDown" data-wow-delay=".2s"><a class="text-decoration-none" href="{{ route("Berita") }}">Lihat Semua Berita</a></span>
                        <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s">Berita Terbaru</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Simak berita terkini terkait kesehatan dan jangan lewatkan informasi mengenai kegiatan-kegiatan yang dilaksanakan oleh Smart Posyandu</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($informasi_terbaru as $item)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-blog mb-30 wow fadeInUp" data-wow-delay=".2s">
                        <div class="blog-img">
                            <a href="{{ route('Detail Berita', $item->slug) }}"><img src="{{ route('informasi_penting.get_img', $item->id) }}" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h4><a class="text-decoration-none" href="{{ route('Detail Berita', $item->slug) }}">{{ $item->judul_informasi }}</a></h4>
                            <p>{{ strip_tags(substr($item->informasi, 0, 100)) }} ...</p>
                            <a class="read-more text-decoration-none" href="{{ route('Detail Berita', $item->slug) }}">Baca selengkapnya <i class="lni lni-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="we-do-section pt-150" id="penyuluhan">
        <div class="shape shape-1">
            <img src="index-template/img/shapes/shape-1.svg" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="section-title text-center mb-55">
                        <span class="wow fadeInDown" data-wow-delay=".2s"><a class="text-decoration-none" href="{{ route('Penyuluhan') }}">Lihat Semua Penyuluhan</a></span>
                        <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s">Lihat Setiap Penyuluhan Kesehatan</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            dinonumy <br class="d-none d-lg-block"> eirmod tempor invidunt ut labore et dolore magn.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($penyuluhan_terbaru as $item)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-blog mb-30 wow fadeInUp" data-wow-delay=".2s">
                        <div class="blog-img">
                            <a href="{{ route('Detail Penyuluhan', $item->slug) }}"><img src="{{ route('penyuluhan.get_img', $item->id) }}" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h4><a class="text-decoration-none" href="{{ route('Detail Penyuluhan', $item->slug) }}">{{ $item->nama_penyuluhan }}</a></h4>
                            <p>{{ strip_tags(substr($item->deskripsi, 0, 100)) }} ...</p>
                            <a class="read-more text-decoration-none" href="{{ route('Detail Penyuluhan', $item->slug) }}">Baca selengkapnya <i class="lni lni-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Fitur Start --}}
        @include('layouts/index/fitur-layout')
    {{-- Fitur End --}}

    {{-- About Start --}}
        @include('layouts/index/about-layout')
    {{-- About End --}}
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#home').addClass('active');
            $('#menu-home').addClass('active');
        });
    </script>
@endpush