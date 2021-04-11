@extends('layouts/admin/admin-layout')

@section('title', 'Konsultasi Ibu')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Konsultasi Ibu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Konsultasi') }}">Konsultasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konsultasi Ibu</li>
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
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Konsultasi Ibu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#konsulAnak" role="button" aria-expanded="false" aria-controls="konsulAnak"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="konsulAnak">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label>Usia Ibu<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{ old('usia') }}" placeholder="Usia Ibu" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label>Usia Kehamilan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" value="{{ old('usia_kehamilan') }}" placeholder="LP Anak" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-circle-notch"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label>Kehamilan ke<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" value="{{ old('berat_badan') }}" placeholder="Berat Anak" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-weight"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label>Jarak Anak Sebelumnya<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control" value="{{ old('tinggi_badan') }}" placeholder="Tinggi Anak" disabled>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-ruler-vertical"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="form-floating">
                                                    <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan diagnosa konsultasi"></textarea>
                                                    <label for="diagnosa">Bahasan Konsultasi<span class="text-danger">*</span></label>
                                                    @error('diagnosa')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="form-floating">
                                                    <textarea name="pengobatan" class="form-control @error('pengobatan') is-invalid @enderror" id="pengobatan" placeholder="Masukan obat atau resep"></textarea>
                                                    <label for="pengobatan">Pengobatan</label>
                                                    @error('pengobatan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="form-floating">
                                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan konsultasi"></textarea>
                                                    <label for="keterangan">Keterangan Tambahan</label>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                <button class="btn btn-block btn-success">Simpan Catatan Konsultasi</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Konsultasi Ibu</p>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Konsultasi 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar12-2020" role="button" aria-expanded="false" aria-controls="mar12-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar12-2020">
                                        <div class="card card-body">
                                            <span class="fw-bold">Bahasan Konsultasi :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Pengobatan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Usia Ibu :</span>
                                                    <p>15 Tahun</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Usia Kehamilan :</span>
                                                    <p>15 Kilogram</p>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Kehamilan ke :</span>
                                                    <p>40 Sentimeter</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Jarak Anak Sebelumnya :</span>
                                                    <p>15 Sentimeter</p>
                                                </div>
                                            </div>
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
                    </div>
                    <div class="col-sm-12 col-md-4 order-1 order-md-2">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div class="image mx-auto d-block rounded">
                                        <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="https://images.unsplash.com/photo-1537111166787-cac8c5491c6c?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDU4fHRvd0paRnNrcEdnfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Profile Admin" width="150" height="150">
                                    </div>
                                </div>
                                <h3 class="profile-username text-center mt-3">I Gede Hadi Darmawan</h3>
                                <p class="text-muted text-center">27 Tahun</p>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-4 my-auto"><span class="fw-bold">Suami</span></div>
                                            <div class="col-8 text-end"><span>Nama Bapaknya Hadi</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Bumil</a>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center fw-bold mb-4">Data Kesehatan Bumil</h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Usia Ibu</span></div>
                                            <div class="col-5 text-end my-auto"><span>2 Tahun</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Usia Kandungan</span></div>
                                            <div class="col-5 text-end my-auto"><span>40 Cm</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Kehamilan ke</span></div>
                                            <div class="col-5 text-end my-auto"><span>20.5 Kg</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Jarak Anak Sebelumnya</span></div>
                                            <div class="col-5 text-end my-auto"><span>60 Cm</span></div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="btn btn-sm btn-outline-info btn-block mt-3">Detail Kesehatan Bumil</a>
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