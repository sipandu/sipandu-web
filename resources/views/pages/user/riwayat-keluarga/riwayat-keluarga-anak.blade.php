@extends('layouts/user/anak/user-layout')

@section('title', 'Riwayat Keluarga Anak')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Riwayat Anak</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayar Keluarga</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 g-0">
                <div class="card p-3">
                    <div class="timeline timeline-inverse">
                        <div class="time-label">
                            <span class="bg-success small btn-sm">29-Mar-2021</span>
                        </div>
                        <div>
                            <i class="fas fa-male bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time d-none d-sm-block"><i class="fas fa-clinic-medical"></i> Posyandu Batan Asem</span>
                                <h3 class="timeline-header fw-bold">Kegiatan A</h3>
                                <div class="timeline-body">
                                    <p>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...</p>
                                    <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#data1_1" role="button" aria-expanded="false" aria-controls="collapseExample">Dokumentasi</a>
                                    <a class="btn btn-outline-primary link-dark btn-sm" href="">Detail Kegiatan</a>
                                </div>
                                <div class="collapse" id="data1_1">
                                    <div class="timeline-footer p-2 text-center">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619448121040-3923c07a4bc9?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDN8aG1lbnZRaFVteE18fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619539088891-a4816eed75fa?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDF8cm5TS0RId3dZVWt8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619448353263-d798109021c1?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDV8aG1lbnZRaFVteE18fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619431131290-a18ae5a55cb0?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDl8aG1lbnZRaFVteE18fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619448121101-eb112fad88e0?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDE0fGhtZW52UWhVbXhNfHxlbnwwfHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619447998478-8d09f6a4948b?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDE2fGhtZW52UWhVbXhNfHxlbnwwfHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-male bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time d-none d-sm-block"><i class="fas fa-clinic-medical"></i> Posyandu Batan Asem</span>
                                <h3 class="timeline-header fw-bold">Kegiatan B</h3>
                                <div class="timeline-body">
                                    <p>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...</p>
                                    <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#data1_2" role="button" aria-expanded="false" aria-controls="collapseExample">Dokumentasi</a>
                                    <a class="btn btn-outline-primary link-dark btn-sm" href="">Detail Kegiatan</a>
                                </div>
                                <div class="collapse" id="data1_2">
                                    <div class="timeline-footer p-2 text-center">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619448121040-3923c07a4bc9?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDN8aG1lbnZRaFVteE18fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619539088891-a4816eed75fa?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDF8cm5TS0RId3dZVWt8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619448353263-d798109021c1?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDV8aG1lbnZRaFVteE18fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619431131290-a18ae5a55cb0?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDl8aG1lbnZRaFVteE18fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619448121101-eb112fad88e0?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDE0fGhtZW52UWhVbXhNfHxlbnwwfHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#dokumentasi">
                                            <img src="https://images.unsplash.com/photo-1619447998478-8d09f6a4948b?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDE2fGhtZW52UWhVbXhNfHxlbnwwfHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="h-25 w-25 mt-1" alt="...">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="time-label">
                            <span class="bg-success small btn-sm">25-Mar-2020</span>
                        </div>
                        <div>
                            <i class="fas fa-male bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time d-none d-sm-block"><i class="fas fa-clinic-medical"></i> Posyandu Batan Asem</span>
                                <h3 class="timeline-header fw-bold">Dr. Andi Budiman</h3>
                                <div class="timeline-body">
                                    <p>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...</p>
                                    <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#data1_3" role="button" aria-expanded="false" aria-controls="collapseExample">Dokumentasi</a>
                                    <a class="btn btn-outline-primary link-dark btn-sm" href="">Detail Kegiatan</a>
                                </div>
                                <div class="collapse" id="data1_3">
                                    <div class="timeline-footer p-2">
                                        <p class="my-auto">Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="time-label">
                            <span class="bg-success small btn-sm">25-Mar-2020</span>
                        </div>
                        <div>
                            <i class="fas fa-female bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time d-none d-sm-block"><i class="fas fa-clinic-medical"></i> Puskesmas Dalung</span>
                                <h3 class="timeline-header fw-bold">Dr. Meimei Susanti</h3>
                                <div class="timeline-body">
                                    <p>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...</p>
                                    <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#data2" role="button" aria-expanded="false" aria-controls="collapseExample">Dokumentasi</a>
                                    <a class="btn btn-outline-primary link-dark btn-sm" href="">Detail Kegiatan</a>
                                </div>
                                <div class="collapse" id="data2">
                                    <div class="timeline-footer p-2">
                                        <p class="my-auto">Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="dokumentasi" tabindex="-1" aria-labelledby="dokumentasi" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dokumentasi">Dokumentasi Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="https://images.unsplash.com/photo-1617056442878-f07e2376b617?ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDIwfEJKSk10dGVESkE0fHxlbnwwfHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="img-fluid mx-auto d-block" alt="...">
                </div>
            </div>
        </div>
    </div>
  
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-riwayat-kesehatan').addClass('menu-is-opening menu-open');
            $('#list-riwayat-kesehatan-link').addClass('active');
            $('#kesehatan-keluarga').addClass('active');
        });
    </script>
@endpush