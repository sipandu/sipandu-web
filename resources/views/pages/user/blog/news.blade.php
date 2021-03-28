@extends('layouts/index/index-layout')

@section('content')
    
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#berita').addClass('active');
            $('#menu-berita').addClass('active');
        });
    </script>
@endpush