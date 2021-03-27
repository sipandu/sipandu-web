@extends('layouts/user/anak/user-layout')

@section('title', 'Keluarga Anak')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Riwayat Keluarga Anak</h1>
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
                <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#ibu" data-toggle="tab">Ibu Hamil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#anak" data-toggle="tab">Anak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#lansia" data-toggle="tab">Lansia</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="ibu">
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
                                                <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Selengkapnya</a>
                                            </div>
                                            <div class="collapse" id="collapseExample">
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
                                                <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Selengkapnya</a>
                                            </div>
                                            <div class="collapse" id="collapseExample">
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
                            <div class="tab-pane" id="anak">
                            </div>
                            <div class="tab-pane" id="lansia">
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
                                                <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Selengkapnya</a>
                                            </div>
                                            <div class="collapse" id="collapseExample">
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
                                                <a class="btn btn-outline-info link-dark btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Selengkapnya</a>
                                            </div>
                                            <div class="collapse" id="collapseExample">
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
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-anak-account').addClass('menu-is-opening menu-open');
            $('#list-anak-account-link').addClass('active');
            $('#profile-anak').addClass('active');
        });
    </script>
@endpush