@extends('layouts/index/index-layout')

@push('css')
    <style>
        .image {
            max-height: 50vh;
            object-fit: none;
            object-position: center;
            background-position: center center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        @media screen and (max-width: 768px){
            .image {
                max-height: 55vh;
                object-fit: none;
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
            transition: opacity 0.2s;
        }
    </style>
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap my-auto">
      <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger">Detail Galeri</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="{{ route('Galeri') }}">Galeri</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>
<div class="container mb-5 pb-100">
    <div class="row row-cols-1 mt-5">
          @foreach ($dokumentasi_kegiatan as $data)
              <div class="col mx-auto my-3">
                  <div class="card mx-auto" style="width: 70vh">
					<img src="{{ route('Dokumentasi Kegiatan', $data->id) }}" class="card-img-top h-50" alt="">
					<div class="card-footer text-center">
						<small class="text-muted fs-5">{{ $data->deskripsi }}</small>
					</div>
                  </div>
              </div>
          @endforeach
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#menu-galeri').addClass('active');
        });
    </script>
@endpush