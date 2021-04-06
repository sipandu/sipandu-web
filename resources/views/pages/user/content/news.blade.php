@extends('layouts/index/index-layout')

@section('content')
<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center my-auto">
      <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Berita Utama</h1>
      <h1 class="h6 fw-bold my-auto"><a class="text-decoration-none fw-bold btn btn-sm btn-outline-info text-dark p-2" href="">Kembali</a></h1>
    </div>
    <hr class="border border-dark dropdown-divider p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
          <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="#">Beranda</a></li>
          <li class="breadcrumb-item"><a class="text-decoration-none link-primary" href="#">Berita</a></li>
          <li class="breadcrumb-item active" aria-current="page">Semua Berita</li>
        </ol>
    </nav>
</div>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-md-center">
        <div class="col-md-12 col-lg-8">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-5 my-auto">
                        <img src="https://images.unsplash.com/photo-1568725992957-ead7b0259b5f?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDV8cVBZc0R6dkpPWWN8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-100 h-100" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><a href="{{ route('Detail Berita') }}" class="text-decoration-none page-scroll">Judul Berita</a></h5>
                            <p class="card-text small"><span class="text-muted">Oleh Admin A</span> | <span>Pada 15-Mar-20</span></p>
                            <p class="card-text">Deskripsi singkat dari berita yang ditampilkan nantinya pada list berita</p>
                            <p class="card-text small">
                            <span class="text-muted"><i class="fas fa-comments"></i> 27</span>
                            <span class="fw-bold mx-2"> | </span>
                            <span><i class="fas fa-eye"></i> 150</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-5 my-auto">
                        <img src="https://images.unsplash.com/photo-1583586492362-4f0cd838878f?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDIyfHhIeFlUTUhMZ09jfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-100 h-100" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><a href="" class="text-decoration-none page-scroll">Judul Berita</a></h5>
                            <p class="card-text small"><span class="text-muted">Oleh Admin A</span> | <span>Pada 15-Mar-20</span></p>
                            <p class="card-text">Deskripsi singkat dari berita yang ditampilkan nantinya pada list berita</p>
                            <p class="card-text small">
                            <span class="text-muted"><i class="fas fa-comments"></i> 27</span>
                            <span class="fw-bold mx-2"> | </span>
                            <span><i class="fas fa-eye"></i> 150</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-5 my-auto">
                        <img src="https://images.unsplash.com/photo-1616659661078-4e7d387c4920?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDMxfHhIeFlUTUhMZ09jfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-100 h-100" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><a href="" class="text-decoration-none page-scroll">Judul Berita</a></h5>
                            <p class="card-text small"><span class="text-muted">Oleh Admin A</span> | <span>Pada 15-Mar-20</span></p>
                            <p class="card-text">Deskripsi singkat dari berita yang ditampilkan nantinya pada list berita</p>
                            <p class="card-text small">
                            <span class="text-muted"><i class="fas fa-comments"></i> 27</span>
                            <span class="fw-bold mx-2"> | </span>
                            <span><i class="fas fa-eye"></i> 150</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-5 mb-4">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Berikutnya</a>
                  </li>
                </ul>
            </nav>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card px-3">
                <h1 class="h4 fw-bold text-dark border-2 border-bottom border-danger p-2">Berita Lainnya</h1>
                <div class="mb-3 border-0 border-bottom">
                    <div class="row g-0 py-2">
                        <div class="col-5 my-auto">
                            <img src="https://images.unsplash.com/photo-1568725992957-ead7b0259b5f?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDV8cVBZc0R6dkpPWWN8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-100 h-100" alt="...">
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h6 class="card-title fw-bold"><a href="" class="text-decoration-none page-scroll">Judul Berita Lainya</a></h6>
                                <p class="card-text small">
                                <span class="text-muted"><i class="fas fa-comments"></i> 27</span>
                                <span class="fw-bold mx-2"> | </span>
                                <span><i class="fas fa-eye"></i> 150</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 border-0 border-bottom">
                    <div class="row g-0 py-2">
                        <div class="col-5 my-auto">
                            <img src="https://images.unsplash.com/photo-1545221855-a9f94b4e3ee0?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDE3fEpwZzZLaWRsLUhrfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-100 h-100" alt="...">
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h6 class="card-title fw-bold"><a href="" class="text-decoration-none page-scroll">Judul Berita Lainya</a></h6>
                                <p class="card-text small">
                                <span class="text-muted"><i class="fas fa-comments"></i> 27</span>
                                <span class="fw-bold mx-2"> | </span>
                                <span><i class="fas fa-eye"></i> 150</span>
                                </p>
                            </div>
                        </div>
                    </div>
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
            $('#menu-penyuluhan').attr("href", "{{ route('Penyuluhan') }}");
        });
    </script>
@endpush