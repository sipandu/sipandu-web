@extends('layouts/index/index-layout')

@section('content')
<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center my-auto">
      <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Penyuluhan</h1>
      <h1 class="h6 fw-bold my-auto"><a class="text-decoration-none fw-bold btn btn-sm btn-outline-info text-dark p-2" href="">Kembali</a></h1>
    </div>
    <hr class="border border-dark dropdown-divider p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
          <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Landing Page') }}">Beranda</a></li>
          <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Penyuluhan') }}">Penyuluhan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Semua Penyuluhan</li>
        </ol>
    </nav>
</div>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-md-center">
        <div class="col-md-12 col-lg-8">
            @foreach($penyuluhan as $item)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-5 my-auto">
                            <img src="{{ route('penyuluhan.get_img', $item->id) }}" class="w-100 h-100" alt="...">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><a href="{{ route('Detail Penyuluhan', $item->slug) }}" class="text-decoration-none page-scroll">{{ $item->nama_penyuluhan }}</a></h5>
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
            @if($penyuluhan->lastPage() > 1)
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-5 mb-4">
                    <li class="page-item <?php if($penyuluhan->currentPage() == 1): ?> disabled <?php endif; ?>">
                        <a class="page-link" href="{{ $penyuluhan->url($penyuluhan->currentPage()-1) }}" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                    </li>
                    @for($i=1; $i <= $penyuluhan->lastPage(); $i++)
                    <li class="page-item"><a class="page-link" href="{{$penyuluhan->url($i)}}">{{ $i }}</a></li>
                    @endfor
                    <li class="page-item <?php if($penyuluhan->currentPage() == $penyuluhan->lastPage()): ?> disabled <?php endif; ?>">
                        <a class="page-link" href="{{ $penyuluhan->url($penyuluhan->currentPage()+1) }}">Berikutnya</a>
                    </li>
                    </ul>
                </nav>
            @endif
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card px-3">
                <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Penyuluhan Terbaru</h1>
                @foreach($penyuluhan_terbaru as $item)
                    <div class="mb-3 border-0 border-bottom">
                        <div class="row g-0 py-2">
                            <div class="col-5 my-auto">
                                <img src="{{ route('penyuluhan.get_img', $item->id) }}" class="w-100 h-100" alt="...">
                            </div>
                            <div class="col-7">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold"><a href="" class="text-decoration-none page-scroll">{{ $item->nama_penyuluhan }}</a></h6>
                                    <p class="card-text small">
                                    <span class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
    </script>
@endpush