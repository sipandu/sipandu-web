@extends('layouts/index/index-layout')

@section('content')
<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap my-auto">
      <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger">Berita Utama</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Landing Page') }}">Landing Page</a></li>
            <li class="breadcrumb-item active" aria-current="page">Semua Berita</li>
        </ol>
    </nav>
</div>
<div class="container mt-5 mb-5 pb-100">
    <div class="row">
        <div class="col-md-12 col-lg-8 mb-3">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($informasi as $item)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ route('informasi_penting.get_img', $item->id) }}" class="card-img-top" alt="berita-{{ $loop->iteration}}">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">
                                    <a href="{{ route('Detail Berita', $item->slug) }}" class="text-decoration-none page-scroll">{{ $item->judul_informasi }}</a>
                                </h5>
                                <p class="text-muted small">Diposting Oleh: {{ $item->author->pegawai->nama_pegawai ?? "no name" }}</p>
                                <p class="card-text fs-6">{{ strip_tags(substr($item->informasi, 0, 150)) }} ...</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted"><i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($item->created_at)) }}</small>
                                    </div>
                                    <div class="col-6 text-center">
                                        <span class="text-muted mx-auto"><i class="fas fa-eye"></i> {{ $item->dilihat }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($informasi->lastPage() > 1)
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-5 mb-4">
                        <li class="page-item <?php if($informasi->currentPage() == 1): ?> disabled <?php endif; ?>">
                            <a class="page-link" href="{{ $informasi->url($informasi->currentPage()-1) }}" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                        </li>
                        @for($i=1; $i <= $informasi->lastPage(); $i++)
                            <li class="page-item <?php if($kegiatan->currentPage()): ?> bg-primary <?php endif; ?>"><a class="page-link" href="{{$informasi->url($i)}}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item <?php if($informasi->currentPage() == $informasi->lastPage()): ?> disabled <?php endif; ?>">
                            <a class="page-link" href="{{ $informasi->url($informasi->currentPage()+1) }}">Berikutnya</a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="px-3 card">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap my-auto mb-4">
                    <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Berita Populer</h1>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 g-4">
                    @foreach($populer_informasi as $item)
                        <div class="col">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-5 my-auto">
                                        <img src="{{ route('informasi_penting.get_img', $item->id) }}" class="w-100 h-100" alt="berita-populer-{{ $loop->iteration }}">
                                    </div>
                                    <div class="col-7">
                                        <div class="card-body px-2 py-1">
                                            <a href="{{ route('Detail Berita', $item->slug) }}" class="text-decoration-none fw-bold lh-1 link-dark small">{{ $item->judul_informasi }}</a>
                                            <p class="text-muted small">
                                                <span class="text-muted mx-auto"><i class="fas fa-eye"></i> {{ $item->dilihat }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#menu-berita').addClass('active');
            $('#menu-berita').attr("href", "{{ route('Berita') }}");
        });
    </script>
@endpush