@extends('layouts/admin/admin-layout')

@section('title', 'Add Posyandu')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
<section class="content">
    

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Profile Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-title h4 my-auto">Detail Posyandu</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Estimated budget</span>
                                                <span class="info-box-number text-center text-muted mb-0">2300</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Total amount spent</span>
                                                <span class="info-box-number text-center text-muted mb-0">2000</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Estimated project duration</span>
                                                <span class="info-box-number text-center text-muted mb-0">20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Recent Activity</h4>
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                <span class="username">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                </span>
                                                <span class="description">Shared publicly - 7:45 PM today</span>
                                            </div>
                                            <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore.
                                            </p>
                                            <p>
                                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                            </p>
                                        </div>
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                                <span class="username">
                                                    <a href="#">Sarah Ross</a>
                                                </span>
                                            <span class="description">Sent you a message - 3 days ago</span>
                                            </div>
                                            <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore.
                                            </p>
                                            <p>
                                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                                            </p>
                                        </div>
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                <span class="username">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                </span>
                                                <span class="description">Shared publicly - 5 days ago</span>
                                            </div>
                                            <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> AdminLTE v3</h3>
                                <p class="text-muted">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                                <br>
                                <div class="text-muted">
                                    <p class="text-sm">Client Company
                                        <b class="d-block">Deveint Inc</b>
                                    </p>
                                    <p class="text-sm">Project Leader
                                        <b class="d-block">Tony Chicken</b>
                                    </p>
                                </div>
                                <h5 class="mt-5 text-muted">Project files</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                                    </li>
                                </ul>
                                <div class="text-center mt-5 mb-3">
                                    <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                    <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    {{-- <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Projects Detail</h3>
    
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated budget</span>
                                        <span class="info-box-number text-center text-muted mb-0">2300</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total amount spent</span>
                                        <span class="info-box-number text-center text-muted mb-0">2000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated project duration</span>
                                        <span class="info-box-number text-center text-muted mb-0">20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Recent Activity</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                    </div>
                                    <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                    </p>
                                </div>
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                        </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                                    </p>
                                </div>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 5 days ago</span>
                                    </div>
                                    <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i> AdminLTE v3</h3>
                        <p class="text-muted">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Client Company
                                <b class="d-block">Deveint Inc</b>
                            </p>
                            <p class="text-sm">Project Leader
                                <b class="d-block">Tony Chicken</b>
                            </p>
                        </div>
                        <h5 class="mt-5 text-muted">Project files</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                            </li>
                        </ul>
                        <div class="text-center mt-5 mb-3">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

</section>
@endsection

@push('js')
    {{-- Custom Step Page --}}
    {{-- <script src="{{url('admin-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <!-- Custom Input Date -->
    <script src="{{url('admin-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script> --}}

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-profile-posyandu').addClass('menu-open');
            $('#profile-posyandu').addClass('active');
        });

        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            
            $('[data-mask]').inputmask()
        })

        // Custom Step Page
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        });
    </script>
@endpush
