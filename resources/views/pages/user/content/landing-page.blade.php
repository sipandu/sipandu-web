@extends('layouts/index/index-layout')

@section('content')
    {{-- Hero Start --}}
        @include('layouts/index/hero-layout')
    {{-- Hero End --}}

    {{-- Blog Start --}}
        @include('layouts/index/blog-layout')
    {{-- Blog End --}}

    {{-- Penyuluhan Start --}}
        @include('layouts/index/penyuluhan-layout')
    {{-- Penyuluhan End --}}

    {{-- Fitur Start --}}
        @include('layouts/index/fitur-layout')
    {{-- Fitur End --}}

    {{-- About Start --}}
        @include('layouts/index/about-layout')
    {{-- About End --}}
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#home').addClass('active');
            $('#menu-home').addClass('active');
        });
    </script>
@endpush