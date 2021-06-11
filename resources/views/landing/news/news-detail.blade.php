@extends('layouts/index/index-layout')

@push('css')
    <style>
        .chipers{
            border-radius: 150px;
            opacity: 0.5;
        }
    </style>
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap my-auto">
      <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger">Detail Berita</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Landing Page') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Berita') }}">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rincian</li>
        </ol>
    </nav>
</div>
<div class="container mt-5 mb-5 pb-100">
    <img src="{{ route('informasi_penting.get_img', $informasi->id) }}" class="img-fluid w-100 ratio ratio-16x9 mb-5" alt="...">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="card border-0">
                <h2 class="fw-bold text-start">{{ $informasi->judul_informasi }}</h4>
                <div class="row mb-5">
                    <div class="col-sm-12 col-md-9">
                        <p class="card-text text-start small">
                            <span class="text-muted">Diposting Oleh : {{ $informasi->author->pegawai->nama_pegawai ?? "no name" }}</span>
                            <span class="fw-bold mx-2"> | </span>
                            <span class="text-muted">Pada {{ date('d M Y', strtotime($informasi->tanggal)) }}</span>
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <p class="card-text small text-start text-md-end">
                            <span class="text-muted"><i class="fas fa-eye"></i> {{ $informasi->dilihat }} kali</span>
                        </p>
                    </div>
                    <div class="d-inline mt-2">
                        @foreach ($tag_berita->where('id_informasi', $informasi->id) as $data)
                            <a class="btn btn-sm btn-secondary chipers">{{ $data->tag->nama_tag }}</a>
                        @endforeach
                    </div>
                </div>
                {!! $informasi->informasi !!}
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap my-auto mb-4">
                    <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Berita Terbaru</h1>
                </div>
                @foreach($informasi_terbaru as $item)
                    <div class="col my-2">
                        <div class="card h-100">
                            <img src="{{ route('informasi_penting.get_img', $item->id) }}" class="card-img-top" alt="berita-terbaru-{{ $loop->iteration }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <a href="{{ route('Detail Berita', $item->slug) }}" class="text-decoration-none page-scroll">{{ $item->judul_informasi }}</a>
                                </h5>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted"><i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($item->created_at)) }}</small>
                                    </div>
                                    <div class="col-6 text-center">
                                        <small class="text-muted"><i class="fas fa-user"></i> {{ $item->author->pegawai->nama_pegawai ?? "no name" }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger mt-5">Komentar</h1>
    <div class="mb-3 border-0 border-bottom pb-3 mt-4">
        <div class="row g-0">
            <div id="disqus_thread"></div>
            <script>
                // DON'T EDIT BELOW THIS LINE
                (function() {
                    var d = document, s = d.createElement('script');
                    s.src = 'https://posyandu-4-0.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#menu-berita').addClass('active');
            $('#menu-berita').attr("href", "{{ route('Berita') }}");
            $('#menu-penyuluhan').attr("href", "{{ route('Penyuluhan') }}");
        });
        (function($){
            setInterval(() => {
                $.each($('iframe'), (arr,x) => {
                    let src = $(x).attr('src');
                    if (src && src.match(/(ads-iframe)|(disqusads)/gi)) {
                        $(x).remove();
                    }
                });
            }, 300);
        })(jQuery);
    </script>
@endpush