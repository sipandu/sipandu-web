@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Ibu Hamil')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Profile Ibu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Anggota') }}">Data Anggota Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Profile Ibu Hamil</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline sticky-top">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Profile Image Anggota', $anggota->id ) }}?{{date('YmdHis')}}" alt="Profile Anggota Bumil" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{ $anggota->ibu->nama_ibu_hamil }}</h3>
                        <p class="text-muted text-center">{{ $anggota->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="fw-bold">Status Keluarga</b>
                                <a class="float-right text-decoration-none link-dark">Ibu</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Kehamilan</b>
                                <a class="float-right text-decoration-none link-dark">{{ $anggota->ibu->kehamilan_ke ?? 'Belum Ditambahkan' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Usia</b>
                                <a class="float-right text-decoration-none link-dark">{{ $umur }} Tahun</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d M Y', strtotime($anggota->created_at)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#info" data-toggle="tab">Informasi</a></li>
                            <li class="nav-item"><a class="nav-link" href="#ubahData" data-toggle="tab">Ubah Data</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->ibu->nama_ibu_hamil }}" disabled readonly>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->ibu->NIK ?? 'Belum Ditambahkan'}}" disabled readonly>
                                    <label for="floatingInput">Nomor Induk Kependudukan</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->ibu->tempat_lahir ?? "Belum ditambahkan" }}" disabled readonly>
                                            <label for="floatingInput">Tempat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ date('d M Y', strtotime($anggota->ibu->tanggal_lahir)) ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->ibu->nomor_telepon ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Nomor Telp</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $anggota->username_tele ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Username Telegram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <div class="card-body bg-light my-auto">
                                        <p class="fs-5 fw-bold my-auto">Scan Kartu Keluarga</p>
                                    </div>
                                    <img src="{{ route('Get KK Anggota', $anggota->id_kk ) }}?{{date('YmdHis')}}" class="card-img-buttom" alt="Scan KK Anggota Ibu">
                                </div>
                            </div>
                            <div class="tab-pane" id="info">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($anggota->ibu->pendidikan_ibu == NULL)
                                            <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                            <input type="text" class="form-control" value="{{ $anggota->ibu->pendidikan_ibu }}" disabled readonly>
                                            @endif
                                        <label for="floatingInput">Pendidikan Ibu</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->ibu->pendidikan_suami ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Pendidikan Suami</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->ibu->pekerjaan_ibu ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Pekerjaan Ibu</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->ibu->pekerjaan_suami ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Pekerjaan Suami</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $anggota->ibu->alamat ?? 'Belum Ditambahkan' }}" disabled readonly>
                                    <label for="floatingInput">Alamat</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->agama ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->tanggungan ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Tanggungan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ $anggota->no_jkn ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Nomor JKN</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{ date('d-M-Y', strtotime($anggota->masa_berlaku)) ?? 'Belum Ditambahkan' }}" disabled readonly>
                                            <label for="floatingInput">Masa Berlaku</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $anggota->faskes_rujukan ?? 'Belum Ditambahkan' }}" disabled readonly>
                                    <label for="floatingInput">Faskes Rujukan</label>
                                </div>
                            </div>
                            <div class="tab-pane" id="ubahData">
                                <form action="{{ route('Update Anggota Bumil', $anggota->ibu->id) }}" method="POST" class="form-horizontal needs-validation my-auto" novalidate>
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $anggota->ibu->nama_ibu_hamil) }}" placeholder="Nama lengkap ibu hamil" required>
                                        <label for="nama">Nama Lengkap<span class="text-danger">*</span></label>
                                        @error('nama')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Nama ibu hamil wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik', $anggota->ibu->NIK) }}" placeholder="NIK ibu hamil" required>
                                        <label for="nik">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
                                        @error('nik')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                NIK ibu hamil wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir', $anggota->ibu->tempat_lahir) }}" placeholder="Tempat lahir ibu hamil" required>
                                                <label for="tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Tempat lahir ibu hamil wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', date('d-m-Y', strtotime($anggota->ibu->tanggal_lahir))) }}" id="tgl_lahir" placeholder="Tanggal Lahir Ibu Hamil" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask required>
                                                    <label for="tgl_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                                                    @error('tgl_lahir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Tanggal lahir ibu hamil wajib diisi
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat tempat tinggal" style="height: 100px" required>{{ old('alamat', $anggota->ibu->alamat) }}</textarea>
                                        <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                        @error('alamat')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Alamat ibu hamil wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan" required>
                                                        @if ( $anggota->tanggungan == NULL )
                                                            <option selected disabled>Pilih tanggungan ...</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @endif
                                                        @if ( $anggota->tanggungan == 'Dengan Tanggungan' )
                                                            <option selected value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        @endif
                                                        @if ( $anggota->tanggungan == 'Tanpa Tanggungan' )
                                                            <option selected value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                        @endif
                                                    </select>
                                                    @error('tanggungan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Tanggungan ibu hamil wajib dipilih
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                                        @if ($anggota->golongan_darah == NULL)
                                                            <option selected disabled>Pilih golongan darah ...</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @endif
                                                        @if ($anggota->golongan_darah == 'A')
                                                            <option selected value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @endif
                                                        @if ($anggota->golongan_darah == 'B')
                                                            <option selected value="B">B</option>
                                                            <option value="A">A</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        @endif
                                                        @if ($anggota->golongan_darah == 'AB')
                                                            <option selected value="AB">AB</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="O">O</option>
                                                        @endif
                                                        @if ($anggota->golongan_darah == 'O')
                                                            <option selected value="O">O</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                        @endif
                                                    </select>
                                                    @error('goldar')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Golongan darah ibu hamil wajib diisi
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" value="{{ old('no_jkn', $anggota->no_jkn ?? '') }}" placeholder="Nomor JKN">
                                                <label for="no_jkn">Nomor JKN</label>
                                                @error('no_jkn')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    @if ($anggota->no_jkn == NULL)
                                                        <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <label for="masa_berlaku">Masa Berlaku</label>
                                                    @else
                                                        <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" value="{{ old('masa_berlaku', date('d-m-Y', strtotime($anggota->masa_berlaku)) ) }}" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <label for="masa_berlaku">Masa Berlaku<span class="text-danger">*</span></label>
                                                    @endif
                                                    @error('masa_berlaku')
                                                        <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="faskes_rujukan" class="form-control @error('faskes_rujukan') is-invalid @enderror" id="faskes_rujukan" value="{{ old('faskes_rujukan', $anggota->faskes_rujukan ?? '' ) }}" placeholder="Fasker rujukan">
                                        <label for="faskes_rujukan">Faskes Rujukan<span class="text-danger">*</span></label>
                                        @error('faskes_rujukan')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Faskes rujukan ibu hamil wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group row m-0 p-0">
                                        <div class="col-sm-12 text-end">
                                        <p class="text-danger">* Data Wajib Diisi</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-grid">
                                            <button type="submit" class="btn btn-outline-success my-1">Simpan Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account').addClass('active');
            $('#data-anggota').addClass('active');

            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
            $('[data-mask]').inputmask()
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
