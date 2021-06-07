@extends('layouts/user/lansia/user-layout')

@section('title', 'Beranda Lansia')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Beranda Lansia</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Posyandu 5.0</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#lansia-dashboard').addClass('active');
        });
    </script>
@endpush
