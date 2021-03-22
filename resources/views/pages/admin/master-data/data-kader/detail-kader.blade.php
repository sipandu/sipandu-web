@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Kader')

@push('css')
    <link rel="stylesheet" href="{{url('admin-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Profile Kader</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Kader') }}">Data Kader</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Profile Kader</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-management-posyandu').addClass('menu-is-opening menu-open');
            $('#management-posyandu').addClass('active');
            $('#data-kader').addClass('active');
        });
    </script>
@endpush
