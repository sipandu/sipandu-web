@extends('layouts/admin/admin-layout')

@section('title', 'Konsultasi Anak')

@push('css')
    <style>
        .image {
            width: 150px;
            height: 150px;
            overflow: hidden;
        }
        .image img {
            object-fit: cover;
            width: 150px;
            height: 150px;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Konsultasi Anak</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Konsultasi') }}">Konsultasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konsultasi Anak</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 col-md-8 order-2 order-md-1 mb-3">
                        <div class="card card-primary card-outline">
                            <p class="fw-bold text-center fs-5 mt-3">Tambah Konsultasi Anak</p>
                            <div class="row p-3">
                                <div class="col-12 my-2">
                                    <div class="form-floating">
                                        <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan diagnosa penyakit"></textarea>
                                        <label for="keterangan">Diagnosa Penyakit</label>
                                        @error('diagnosa')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 my-2">
                                    <div class="form-floating">
                                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan peneriksaan"></textarea>
                                        <label for="keterangan">Keterangan Pemeriksaan</label>
                                        @error('keterangan')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card card-primary card-outline p-3">
                            <p class="text-center fs-5 fw-bold">Riwayat Konsultasi Anak</p> --}}
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Konsultasi Anak</p>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Konsultasi 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar12-2020" role="button" aria-expanded="false" aria-controls="mar12-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar12-2020">
                                        <div class="card card-body">
                                            Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Pemeriksaan 10 Mar 2020 | Oleh Dr. Made Ayu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar10-2020" role="button" aria-expanded="false" aria-controls="mar10-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar10-2020">
                                        <div class="card card-body">
                                            Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        {{-- </div> --}}
                        {{-- <div class="card">
                            <ul class="list-group ">
                                <li class="list-group-item border border-0">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-5 fw-bold text-start">Tambah Konsultasi Anak</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar12-2020" role="button" aria-expanded="false" aria-controls="mar12-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar12-2020">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="usia">Umur Anak</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{ old('usia') }}" placeholder="Usia Anak" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="lingkar_kepala">Lingkar Kepala<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="lingkar_kepala" autocomplete="off" class="form-control @error('lingkar_kepala') is-invalid @enderror" id="lingkar_kepala" value="{{ old('lingkar_kepala') }}" placeholder="LP Anak" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-circle-notch"></span>
                                                        </div>
                                                    </div>
                                                    @error('lingkar_kepala')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="berat_badan">Berat Badan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="berat_badan" autocomplete="off" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" value="{{ old('berat_badan') }}" placeholder="Berat Anak" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-weight"></span>
                                                        </div>
                                                    </div>
                                                    @error('berat_badan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="tinggi_badan">Tinggi Badan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="tinggi_badan" autocomplete="off" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" value="{{ old('tinggi_badan') }}" placeholder="Tinggi Anak" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-ruler-vertical"></span>
                                                        </div>
                                                    </div>
                                                    @error('tinggi_badan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="form-floating">
                                                    <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan diagnosa penyakit"></textarea>
                                                    <label for="keterangan">Diagnosa Penyakit</label>
                                                    @error('diagnosa')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="form-floating">
                                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan peneriksaan"></textarea>
                                                    <label for="keterangan">Keterangan Pemeriksaan</label>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="col-sm-12 col-md-4 order-1 order-md-2">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="https://images.unsplash.com/photo-1537111166787-cac8c5491c6c?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDU4fHRvd0paRnNrcEdnfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Profile Admin" width="150" height="150">
                                    </div>
                                </div>
                                <h3 class="profile-username text-center my-3">I Gede Hadi Darmawan</h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-4 my-auto"><span class="fw-bold">Ayah</span></div>
                                            <div class="col-8 text-end"><span>Nama Bapaknya Hadi</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-4 my-auto"><span class="fw-bold">Ibu</span></div>
                                            <div class="col-8 text-end"><span>Nama Ibunya Hadi</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="btn btn-sm btn-info btn-block mt-3">Detail Anak</a>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center fw-bold mb-4">Data Kesehatan Anak</h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Umur</span></div>
                                            <div class="col-5 text-end my-auto"><span>2 Tahun</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Lingkar Kepala</span></div>
                                            <div class="col-5 text-end my-auto"><span>40 Cm</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Berat Badan</span></div>
                                            <div class="col-5 text-end my-auto"><span>20.5 Kg</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Tinggi Badan</span></div>
                                            <div class="col-5 text-end my-auto"><span>60 Cm</span></div>
                                        </div>
                                    </li>
                                </ul>
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
            $('#admin-konsultasi').addClass('active');
        });
    </script>
@endpush