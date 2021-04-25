@extends('layouts/index/index-layout')

@push('css')
    <style>
        .image {
            width: 80px;
            height: 80px;
            overflow: hidden;
        }

        .image img {
            object-fit: cover;
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center my-auto">
      <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Rincian Penyuluhan</h1>
      <h1 class="h6 fw-bold my-auto"><a class="text-decoration-none fw-bold btn btn-sm btn-outline-info text-dark p-2" href="{{ route('Penyuluhan') }}">Kembali</a></h1>
    </div>
    <hr class="border border-dark dropdown-divider p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
          <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Landing Page') }}">Beranda</a></li>
          <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Penyuluhan') }}">Penyuluhan</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $penyuluhan->nama_penyuluhan }}</li>
        </ol>
    </nav>
</div>
<div class="container mt-5 mb-5">
    <img src="{{ route('penyuluhan.get_img', $penyuluhan->id) }}" class="img-fluid w-100 ratio ratio-16x9 mb-5" alt="...">
    <div class="container px-md-5">
        <div class="card border-info border-2 mx-md-5 mx-2 p-2 p-md-5">
            <h2 class="fw-bold text-center">{{ $penyuluhan->nama_penyuluhan }}</h4>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-6 text-md-center">
                    <p class="card-text text-center text-md-start small">
                        <span class="text-muted">{{ $penyuluhan->posyandu->nama_posyandu }}</span>
                        <span class="fw-bold mx-2"> | </span>
                        <span class="text-muted">Pada {{ $penyuluhan->tanggal }}</span>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6">
                    <p class="card-text small text-center text-md-end text-end">
                        <span class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $penyuluhan->lokasi }}</span>
                    </p>
                </div>
            </div>
            {!! $penyuluhan->deskripsi !!}
        </div>
        <hr class="border border-dark dropdown-divider mt-5 mb-4 mx-5">
        <div class="mx-md-5 mx-2">
            <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Penyuluhan Terbaru</h1>
            @foreach($penyuluhan_terbaru as $item)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-5 my-auto">
                        <img src="{{ route('penyuluhan.get_img', $item->id) }}" class="w-100 h-100" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><a href="" class="text-decoration-none page-scroll">{{ $item->nama_penyuluhan }}</a></h5>
                            <p class="card-text small"><span class="text-muted">{{ $item->posyandu->nama_posyandu }}</span> | <span>Pada {{ date('d F Y', strtotime($item->tanggal)) }}</span></p>
                            <p class="card-text">{{ strip_tags(substr($item->deskripsi, 0, 100)) }}</p>
                            <p class="card-text small">
                                <span class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <hr class="border border-dark dropdown-divider mt-5 mx-5">
        <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger mx-md-5 mx-2 mt-5">Komentar</h1>
        <div class="mb-3 border-0 border-bottom pb-3 mx-md-5 mx-2 mt-4">
            <div id="disqus_thread"></div>
            <script>
                /**
                *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                /*
                var disqus_config = function () {
                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
                (function() { // DON'T EDIT BELOW THIS LINE
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
            $('#menu-penyuluhan').addClass('active');
            $('#menu-berita').attr("href", "{{ route('Berita') }}");
            $('#menu-penyuluhan').attr("href", "{{ route('Penyuluhan') }}");
            $('#desc-content p').addClass('card-text');
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