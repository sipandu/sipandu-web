@extends('layouts/user/lansia/user-layout')

@section('title', 'Riwayat Keluarga Lansia')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Riwayat Lansia</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Smart Posyandu 5.0</a></li>
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
                                    <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#data1" role="button" aria-expanded="false" aria-controls="collapseExample">Selengkapnya</a>
                                </div>
                                <div class="collapse" id="data1">
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
                                    <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#data2" role="button" aria-expanded="false" aria-controls="collapseExample">Selengkapnya</a>
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