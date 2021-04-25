@extends('layouts/admin/admin-layout')

@section('title', 'Ubah Data Posyandu')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Ubah Data Posyandu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Posyandu') }}">Data Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Data Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header my-auto">
                        <h3 class="card-title my-auto">Ubah Data Posyandu</h3>
                    </div>
                    @foreach ($dataPosyandu as $posyandu)
                        <form action="{{route('Update Posyandu', [$posyandu->id])}}" method="POST">
                            @csrf
                            <div class="modal-body p-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputNama">Nama Posyandu<span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="inputNama" value="{{ old('nik', $posyandu->nama_posyandu) }}" placeholder="Masukan nama posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-clinic-medical"></span>
                                                    </div>
                                                </div>
                                                @error('nama')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputBanjar">Banjar<span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Banjar</span>
                                                <input type="text" class="form-control @error('banjar') is-invalid @enderror" name="banjar" id="inputBanjar" value="{{ old('nik', $posyandu->banjar) }}" placeholder="Masukan lokasi banjar">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-city"></span>
                                                    </div>
                                                </div>
                                                @error('banjar')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputTelp">Nomor Telepon<span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="inputTelp" value="{{ old('nik', $posyandu->nomor_telepon) }}" placeholder="Masukan nomor telepon posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-phone-alt"></span>
                                                    </div>
                                                </div>
                                                @error('telp')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputAlamat">Alamat<span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="inputAlamat" value="{{ old('nik', $posyandu->alamat) }}" placeholder="Masukan alamat posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-road"></span>
                                                    </div>
                                                </div>
                                                @error('alamat')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputLay">Koordinat Latitude<span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('lat') is-invalid @enderror" name="lat" id="inputLat" value="{{ old('nik', $posyandu->latitude) }}" placeholder="Masukan koordinat Latitude posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-map-marker-alt"></span>
                                                    </div>
                                                </div>
                                                @error('lat')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputLng">Koordinat Longitude<span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('lng') is-invalid @enderror" name="lng" id="inputLng" value="{{ old('nik', $posyandu->longitude) }}" placeholder="Masukan koordinat Longitude posyandu">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-map-marker-alt"></span>
                                                    </div>
                                                </div>
                                                @error('lng')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <p class="text-danger small text-end mb-0 pb-0"><span>*</span>Data Wajib Diisi</p>
                                    </div> 
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <a href="{{ route('Detail Posyandu', [$posyandu->id]) }}" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Batal</a>
                                <button type="submit" class="btn btn-sm btn-outline-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    @endforeach
                </div>
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
            $('#data-posyandu').addClass('active');
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