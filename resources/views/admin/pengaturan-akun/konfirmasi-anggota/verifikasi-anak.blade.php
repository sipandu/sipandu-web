@extends('layouts/admin/admin-layout')

@section('title', 'Detail Verifikasi Anak')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Rincian Verifikasi</h1>
        <div class="col-auto ml-auto my-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Verifikasi Anggota') }}">Verifikasi Anggota Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Anak</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header">
                        Verifikasi Anak
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ route('Get KK', $user->id_kk) }}" class="card-img-bottom" alt="File KK Anak">
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="namaLansia" value="{{$user->anak->nama_anak}}" disabled>
                                            <label for="namaLansia">Nama Anak</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="noKK" value="{{$user->kk->no_kk}}" disabled>
                                            <label for="noKK">Nomor KK</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="lokasiPosyandu" value="{{$user->anak->posyandu->nama_posyandu}}" disabled>
                                            <label for="lokasiPosyandu">Lokasi Posyandu</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="banjar" value="{{$user->anak->posyandu->banjar}}" disabled>
                                            <label for="banjar">Banjar</label>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('Tolak Anggota', $user->id) }}" class="mb-2">
                                        @csrf
                                        <div class="col-12 p-0 m-0">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan penolakan akun">
                                                <label for="keterangan">Keterangan Tambahan</label>
                                            </div>
                                            @error('keterangan')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 text-start p-0 m-0">
                                            <button class="btn btn-block btn-outline-danger btn-sm">Tolak Dengan Alasan</button>
                                        </div>
                                    </form>
                                    <div class="row p-0 m-0">
                                        <div class="col-sm-12 col-md-6 text-start float-lg-left">
                                            <a href="{{route('Verifikasi Anggota')}}" class="btn btn-outline-primary btn-sm">Kembali</a>
                                        </div>
                                        <div class="col-sm-12 col-md-6 my-auto">
                                            <form method="POST" action="{{ route('Terima Anggota', $user->id) }}" class="p-0 m-0">
                                                @csrf
                                                <div class="text-end float-lg-right my-auto">
                                                    <button class="btn btn-outline-success btn-sm">Konfirmasi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{ date('d M Y', strtotime($user->created_at)) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#account-setting').addClass('menu-is-opening menu-open');
            $('#setting').addClass('active');
            $('#verify-anggota').addClass('active');
        });
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('error'))
        <script>
            $(document).ready(function(){
                alertError('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush
