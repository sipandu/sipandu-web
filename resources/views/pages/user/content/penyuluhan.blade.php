@extends('layouts/index/index-layout')

@section('content')
    
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#menu-penyuluhan').addClass('active');
            $('#menu-berita').attr("href", "{{ route('Berita') }}");
            $('#menu-penyuluhan').attr("href", "{{ route('Penyuluhan') }}");;
        });
    </script>
@endpush