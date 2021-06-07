@extends('layouts/admin/admin-layout')

@section('title', 'Konsultasi Bot')

@push('css')

@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Konsultasi Bot</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item" aria-current="page">Konsultasi Bot</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $konsultasi->kode_konsultasi }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-7 col-12">
                <div class="card card-primary card-outline">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Data Konsultasi Via Bot</p></div>
                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#tambahKelahiran" role="button" aria-expanded="false" aria-controls="tambahKelahiran"><i class="fas fa-plus-circle"></i></a></div>
                            </div>
                            <div class="collapse my-3" id="tambahKelahiran">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="row">
                                        @foreach($data as $key => $item)
                                            <div class="col-12 my-2">
                                                <label for="nama_anak" class="form-label">{{ $key }}</label>
                                                <input class="form-control @error('berat_lahir') is-invalid @enderror" value="{{ $item }}" id="nama_anak" name="{{ $key }}" readonly>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-10 my-auto"><p class="my-auto fw-bold fs-5 text-start">Tambah Diagnosa</p></div>
                                <div class="col-2 d-flex align-items-center justify-content-end"><a class="btn btn-primary" data-bs-toggle="collapse" href="#konsulIbu" role="button" aria-expanded="false" aria-controls="konsulIbu"><i class="fas fa-plus-circle"></i></a></div>
                            </div>
                            <div class="collapse my-3" id="konsulIbu">
                                <form action="{{ route('konsultasi-bot.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kode" value="{{ $konsultasi->kode_konsultasi }}">
                                    <div class="row">
                                        <div class="col-12 my-2">
                                            <div class="form-floating">
                                                <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" placeholder="Masukan hasil konsultasi">{{ $konsultasi->diagnosa ?? "" }}</textarea>
                                                <label for="diagnosa">Diagnosa<span class="text-danger">*</span></label>
                                                @error('diagnosa')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <div class="form-group mb-3">
                                                <div class="form-floating">
                                                    <textarea name="resep" class="form-control @error('resep') is-invalid @enderror" id="resep" placeholder="Masukan Resep Jika ada">{{ $konsultasi->resep ?? "" }}</textarea>
                                                    <label for="resep">Resep</label>
                                                    @error('resep')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <div class="form-floating">
                                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan Keterangan Tambahan">{{ $konsultasi->keterangan ?? "" }}</textarea>
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
                                            @if($konsultasi->is_sent != '1')
                                                <button type="submit" class="btn btn-block btn-success">Simpan Catatan Konsultasi</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-4 order-1 order-md-2 mb-2">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Anggota Pemeriksaan', $user->id ) }}" alt="..." width="150" height="150">
                            </div>
                        </div>
                        <ul class="list-group mt-2 list-group-unbordered">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-5 my-auto"><span class="fw-bold">Nama</span></div>
                                    <div class="col-7 text-end"><span>{{ $pasien->nama}}</span></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-5 my-auto"><span class="fw-bold">Jenis Kelamin</span></div>
                                    <div class="col-7 text-end"><span>{{ \Str::title($pasien->jenis_kelamin ?? "") }}</span></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-5 my-auto"><span class="fw-bold">Tanggal Lahir</span></div>
                                    <div class="col-7 text-end"><span>{{ date('d F Y', strtotime($pasien->tanggal_lahir)) }}</span></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-5 my-auto"><span class="fw-bold">Nama Posyandu</span></div>
                                    <div class="col-7 text-end"><span>{{ $pasien->nama_posyandu }}</span></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" name="is_sent" id="sent-status" value="{{ $konsultasi->is_sent }}">
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#konsultasi-bot').addClass('active');
            let status_sent = $('#sent-status').val();
            if (status_sent == '1') {
                $('textarea').prop('readonly', true);
            }
        });
    </script>
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush