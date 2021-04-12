@extends('layouts/admin/admin-layout')

@section('title', 'Pemeriksaan Ibu')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Pemeriksaan Kesehatan Ibu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Tambah Pemeriksaan') }}">Pemeriksaan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pemeriksaan Ibu</li>
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
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemeriksaan Ibu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahPemeriksaan" role="button" aria-expanded="false" aria-controls="tambahPemeriksaan"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahPemeriksaan">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="usia_kandungan">Usia Kandungan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" autocomplete="off" class="form-control @error('usia_kandungan') is-invalid @enderror" id="usia_kandungan" value="{{ old('usia_kandungan') }}" placeholder="Usia kehamilan">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calendar-week"></span>
                                                        </div>
                                                    </div>
                                                    @error('usia_kandungan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="berat_badan">Berat Badan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" value="{{ old('berat_badan') }}" placeholder="Berat badan">
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
                                                <label for="tekanan_darah">Tekanan Darah<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('tekanan_darah') is-invalid @enderror" id="tekanan_darah" value="{{ old('tensi') }}" placeholder="Tekanan darah">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calendar"></span>
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
                                                <label for="detak_jantung_bayi">Detak Jantung Bayi<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('tekanan_darah') is-invalid @enderror" id="detak_jantung_bayi" value="{{ old('tensi') }}" placeholder="Detak jantung bayi">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calendar"></span>
                                                        </div>
                                                    </div>
                                                    @error('detak_jantung_bayi')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="form-floating">
                                                    <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan hasil konsultasi"></textarea>
                                                    <label for="diagnosa">Hasil Pemeriksaan<span class="text-danger">*</span></label>
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
                                                    <textarea name="keteranganPemeriksaan" class="form-control @error('keteranganPemeriksaan') is-invalid @enderror" id="keteranganPemeriksaan" placeholder="Masukan keterangan tambahan"></textarea>
                                                    <label for="keteranganPemeriksaan">Keterangan Tambahan</label>
                                                    @error('keteranganPemeriksaan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                <button class="btn btn-block btn-success">Simpan Pemeriksaan Kesehatan</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Pemberian Vitamin</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahVitamin" role="button" aria-expanded="false" aria-controls="tambahVitamin"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="tambahVitamin">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="vitamin">Jenis Vitamin<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="vitamin" class="form-control @error('vitamin') is-invalid @enderror" value="{{ old('vitamin') }}" id="vitamin">
                                                        <option selected disabled>Pilih pemberian vitamin....</option>
                                                        <option value="Laki-laki">Vitamin A</option>
                                                        <option value="Perempuan">Vitamin B</option>
                                                        <option value="Perempuan">Vitamin C</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-tablets"></span>
                                                        </div>
                                                    </div>
                                                    @error('vitamin')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 my-2">
                                                <label for="detak_jantung_bayi">Frekuensi<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('tekanan_darah') is-invalid @enderror" id="detak_jantung_bayi" value="{{ old('tensi') }}" placeholder="Frekuensi pemberian vitamin">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-redo-alt"></span>
                                                        </div>
                                                    </div>
                                                    @error('detak_jantung_bayi')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <div class="form-floating">
                                                    <textarea name="keteranganVitamin" class="form-control @error('keteranganVitamin') is-invalid @enderror" id="keteranganVitamin" placeholder="Masukan keterangan tambahan"></textarea>
                                                    <label for="keteranganVitamin">Keterangan Tambahan</label>
                                                    @error('keteranganVitamin')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 my-2">
                                                <p class="text-danger text-end">* Data Wajib Diisi</p>
                                                <button class="btn btn-block btn-success">Simpan Pemberian Vitamin</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card card-primary card-outline">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="text-center fs-5 fw-bold mt-3">Riwayat Pemeriksaan Ibu</p>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Pemeriksaan 12 Mar 2020 | Oleh Dr. Andre</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar12-2020" role="button" aria-expanded="false" aria-controls="mar12-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar12-2020">
                                        <div class="card card-body">
                                            <span class="fw-bold">Hasil Pemeriksaan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Pengobatan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Berat Badan :</span>
                                                    <p>50 Kilogram</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Tekanan Darah :</span>
                                                    <p>120/80</p>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Usia Ibu :</span>
                                                    <p>15 Tahun</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Usia Kehamilan :</span>
                                                    <p>50 Minggu</p>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <span class="fw-bold">Jumlah  Kehamilan :</span>
                                                    <p>Kemahilan ke-2</p>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-bold">Jarak Anak Sebelumnya :</span>
                                                    <p>4 Tahun</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-10 my-auto"><p class="my-auto fs-6 text-start">Konsultasi 10 Mar 2020 | Oleh Dr. Made Ayu</p></div>
                                        <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#mar10-2020" role="button" aria-expanded="false" aria-controls="mar10-2020"><i class="fas fa-plus-circle"></i></a></div>
                                    </div>
                                    <div class="collapse my-3" id="mar10-2020">
                                        <div class="card card-body">
                                            <span class="fw-bold">Hasil Pemeriksaan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Pengobatan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
                                            <span class="fw-bold">Keterangan Tambahan :</span>
                                            <p>Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.</p>
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
                                            <div class="col-5 text-end my-auto"><span>29 Tahun</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Jumlah Kehamilan</span></div>
                                            <div class="col-5 text-end my-auto"><span>Kehamilan ke-2</span></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7 my-auto"><span class="fw-bold">Jarak Anak Sebelumnya</span></div>
                                            <div class="col-5 text-end my-auto"><span>4 Tahun</span></div>
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
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-pemeriksaan').addClass('menu-is-opening menu-open');
            $('#pemeriksaan').addClass('active');
            $('#pemeriksaan-keluarga').addClass('active');
        });
    </script>
@endpush