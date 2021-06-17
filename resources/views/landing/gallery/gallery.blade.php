@extends('layouts/index/index-layout')

@push('css')
    <style>
        .image {
            height: 30vh;
            object-fit: cover;
            object-position: center;
            background-position: center center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        @media screen and (max-width: 768px){
            .image {
                max-height: 35vh;
                object-fit: cover;
                object-position: center;
                background-position: center center;
                background-repeat: no-repeat;
                overflow: hidden;
            }
        }
        @media screen and (max-width: 576px){
            .image {
                min-height: 40vh;
                object-fit: cover;
                object-position: center;
                background-position: center center;
                background-repeat: no-repeat;
                overflow: hidden;
            }
        }

        .img-link{
            opacity: 0;
            transition: opacity 0.2s;
        }
        .img-link:hover{
            opacity: 1;
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.2s;
        }
    </style>
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap my-auto">
      <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger">Galeri</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Landing Page') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Galery</li>
        </ol>
    </nav>
</div>
<div class="container mt-5 mb-5 pb-100">
    <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 g-4 mt-5 d-flex justify-content-evenly">
        @foreach ($kegiatan as $data)
            @foreach ($dokumentasi_kegiatan->where('id_kegiatan', $data->id)->sortByDesc('created_at')->take(1) as $item)
                <div class="col">
                    <div class="card">
                        <img src="{{ route('Dokumentasi Kegiatan', $item->id) }}" class="card-img-top image" alt="">
                        <div class="card-img-overlay d-flex justify-content-center align-items-stretch my-auto img-link">
                            <a href="{{ route('Detail Galeri', $data->slug) }}" class="btn btm-sm btn-outline-primary my-auto">Selengkapnya</a>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">{{ $data->nama_kegiatan }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    @if($kegiatan->lastPage() > 1)
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-5 mb-4">
                <li class="page-item <?php if($kegiatan->currentPage() == 1): ?> disabled <?php endif; ?>">
                    <a class="page-link" href="{{ $kegiatan->url($kegiatan->currentPage()-1) }}" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                </li>
                @for($i=1; $i <= $kegiatan->lastPage(); $i++)
                    <li class="page-item <?php if($kegiatan->currentPage()): ?> bg-primary <?php endif; ?>"><a class="page-link" href="{{$kegiatan->url($i)}}">{{ $i }}</a></li>
                @endfor
                <li class="page-item <?php if($kegiatan->currentPage() == $kegiatan->lastPage()): ?> disabled <?php endif; ?>">
                    <a class="page-link" href="{{ $kegiatan->url($kegiatan->currentPage()+1) }}">Berikutnya</a>
                </li>
            </ul>
        </nav>
    @endif
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#menu-galeri').addClass('active');
            $('#menu-berita').attr("href", "{{ route('Berita') }}");
        });
    </script>
@endpush