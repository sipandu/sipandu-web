@extends('layouts/admin/admin-layout')

@section('title', 'Jenis Vitamin Baru')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Tambah Jenis Vitamin Baru</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jenis Vitamin Baru</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary p-3">
                    <p class="text-center fs-5">Tambah Jenis Vitamin Baru</p>
                    <form action="{{ route('Store Vitamin') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 my-2">
                                <label for="nama_vitamin">Nama Vitamin<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control @error('nama_vitamin') is-invalid @enderror" id="nama_vitamin" name="nama_vitamin" value="{{ old('nama_vitamin') }}" placeholder="Nama vitamin">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-syringe"></span>
                                        </div>
                                    </div>
                                    @error('nama_vitamin')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 my-2">
                                <label for="usia_pemberian">Usia Pemberian<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control @error('usia_pemberian') is-invalid @enderror" id="usia_pemberian" name="usia_pemberian" value="{{ old('usia_pemberian') }}" placeholder="Usia pemberian">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-calendar-check"></span>
                                        </div>
                                    </div>
                                    @error('usia_pemberian')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 my-2">
                                <label for="perulangan">Frekuensi Perulangan<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control @error('perulangan') is-invalid @enderror" id="perulangan" name="perulangan" value="{{ old('perulangan') }}" placeholder="Frekuensi perulangan">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-redo-alt"></span>
                                        </div>
                                    </div>
                                    @error('perulangan')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 my-2">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="status">Status<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status') }}" id="status">
                                                @if (old('status'))
                                                    @if (old('status') == 'Wajib')
                                                        <option selected value="Wajib">Wajib</option>
                                                        <option value="Tidak Wajib">Tidak Wajib</option>
                                                    @endif
                                                    @if (old('status') == 'Tidak Wajib')
                                                        <option value="Wajib">Wajib</option>
                                                        <option selected value="Tidak Wajib">Tidak Wajib</option>
                                                    @endif
                                                @else
                                                    <option selected disabled>Status Imunisasi ...</option>
                                                    <option value="Wajib">Wajib</option>
                                                    <option value="Tidak Wajib">Tidak Wajib</option>
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-tablets"></span>
                                                </div>
                                            </div>
                                            @error('status')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="penerima">Penerima<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="penerima" class="form-control @error('penerima') is-invalid @enderror" value="{{ old('penerima') }}" id="penerima">
                                                @if (old('penerima'))
                                                    @if (old('penerima') == 'Ibu Hamil')
                                                        <option selected value="Ibu Hamil">Ibu Hamil</option>
                                                        <option value="Anak">Anak</option>
                                                        <option value="Lansia">Lansia</option>
                                                    @endif
                                                    @if (old('penerima') == 'Anak')
                                                        <option value="Ibu Hamil">Ibu Hamil</option>
                                                        <option selected value="Anak">Anak</option>
                                                        <option value="Lansia">Lansia</option>
                                                    @endif
                                                    @if (old('penerima') == 'Lansia')
                                                        <option value="Ibu Hamil">Ibu Hamil</option>
                                                        <option value="Anak">Anak</option>
                                                        <option selected value="Lansia">Lansia</option>
                                                    @endif
                                                @else
                                                    <option selected disabled>Penerima Imunisasi....</option>
                                                    <option value="Ibu Hamil">Ibu Hamil</option>
                                                    <option value="Anak">Anak</option>
                                                    <option value="Lansia">Lansia</option>
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-tag"></span>
                                                </div>
                                            </div>
                                            @error('penerima')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <div class="form-floating">
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan tambahan">{{ old('keterangan') }}</textarea>
                                    <label for="keterangan">Keterangan Tambahan<span class="text-danger">*</span></label>
                                    @error('keterangan')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <p class="text-danger text-end">* Data Wajib Diisi</p>
                                <button type="submit" class="btn btn-block btn-outline-success">Simpan Data Vitamin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-vitamin').addClass('menu-is-opening menu-open');
            $('#vitamin').addClass('active');
            $('#tambah-vitamin').addClass('active');
        });
    </script>

    @if($message = Session::get('failed'))
    <script>
        $(document).ready(function(){
            alertDanger('{{$message}}');
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

