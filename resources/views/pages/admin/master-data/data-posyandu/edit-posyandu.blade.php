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
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-posyandu-tab" data-bs-toggle="tab" data-bs-target="#nav-posyandu" type="button" role="tab" aria-controls="nav-posyandu" aria-selected="true">Data Posyandu</button>
                        <button class="nav-link" id="nav-administrator-tab" data-bs-toggle="tab" data-bs-target="#nav-administrator" type="button" role="tab" aria-controls="nav-administrator" aria-selected="false">Administrator</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-posyandu" role="tabpanel" aria-labelledby="nav-posyandu-tab">
                        <div class="card card-primary">
                            <div class="card-header my-auto">
                                <h3 class="card-title my-auto">Ubah Data Posyandu</h3>
                            </div>
                            @foreach ($dataPosyandu as $posyandu)
                                <form action="{{route('Update Posyandu', [$posyandu->id])}}" method="POST">
                                    @csrf
                                    <div class="modal-body p-3">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputNama">Nama Posyandu</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="inputNama" value="{{ $posyandu->nama_posyandu }}" placeholder="Masukan nama posyandu">
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
                                                <div class="form-group">
                                                    <label for="inputBanjar">Banjar</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text @error('banjar') is-invalid @enderror" id="basic-addon1">Banjar</span>
                                                        <input type="text" class="form-control" name="banjar" id="inputBanjar" value="{{ $posyandu->banjar }}" placeholder="Masukan lokasi banjar">
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
                                                <div class="form-group">
                                                    <label for="inputTelp">Nomor Telepon</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="inputTelp" value="{{ $posyandu->nomor_telepon }}" placeholder="Masukan nomor telepon posyandu">
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
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputAlamat">Alamat</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="inputAlamat" value="{{ $posyandu->alamat }}" placeholder="Masukan alamat posyandu">
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
                                                <div class="form-group">
                                                    <label for="inputLay">Koordinat Latitude</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('lat') is-invalid @enderror" name="lat" id="inputLat" value="{{ $posyandu->latitude }}" placeholder="Masukan koordinat Latitude posyandu">
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
                                                <div class="form-group">
                                                    <label for="inputLng">Koordinat Longitude</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control @error('lng') is-invalid @enderror" name="lng" id="inputLng" value="{{ $posyandu->longitude }}" placeholder="Masukan koordinat Longitude posyandu">
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
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('Detail Posyandu', [$posyandu->id]) }}" class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-administrator" role="tabpanel" aria-labelledby="nav-administrator-tab">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Ubah Administrator Posyandu</h3>
                            </div>
                            @foreach ($dataPosyandu as $posyandu)
                                @foreach ($pegawai->where('id_posyandu', $posyandu->id) as $pgw)
                                    <form action="{{route('Update Admin Posyandu', [$pgw->id])}}" method="POST">
                                @endforeach
                                    @csrf
                                    <div class="modal-body p-3">
                                        <div class="form-group">
                                            <label for="inputDesa">Non-aktifkan Administrator</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control @error('pegawai') is-invalid @enderror" name="pegawai" list="dataPegawai" id="inputPegawai" value="{{ old('pegawai') }}" placeholder="Cari admin {{ $posyandu->nama_posyandu }}..." autocomplete="off">
                                                <datalist id="dataPegawai">
                                                    @foreach ($pegawai->where('id_posyandu', $posyandu->id) as $pgw)
                                                        <option value="{{ $pgw->nama_pegawai }}">
                                                    @endforeach
                                                </datalist>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-city"></span>
                                                    </div>
                                                </div>
                                                @error('pegawai')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBanjar">NIK Admin</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="inputBanjar" value="{{ old('nik') }}" placeholder="Masukan NIK Admin">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-city"></span>
                                                    </div>
                                                </div>
                                                @error('nik')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('Detail Posyandu', [$posyandu->id]) }}" class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan Perubahan</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
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
@endpush