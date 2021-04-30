@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Anak')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Profile Anak</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Anggota') }}">Data Anggota Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Profile Anak</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Data Anggota', $dataUser->id ) }}" alt="Profile Admin" width="150" height="150">
                            </div>
                        </div>
                        <h3 class="profile-username text-center">{{ $dataUser->anak->nama_anak }}</h3>
                        <p class="text-muted text-center">{{ $dataUser->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            @if ( $dataUser->anak->anak_ke == NULL)
                                <li class="list-group-item">
                                    <b class="fw-bold">Status Keluarga</b>
                                    <a class="float-right text-decoration-none link-dark">Anak</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Status Keluarga</b>
                                    <a class="float-right text-decoration-none link-dark">Anak ke-{{ $dataUser->anak->anak_ke }}</a>
                                </li>
                            @endif
                            @if ( $dataUser->anak->jenis_kelamin == 'laki laki')
                                <li class="list-group-item">
                                    <b class="fw-bold">Jenis Kelamin</b>
                                    <a class="float-right text-decoration-none link-dark">Laki-laki</a>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b class="fw-bold">Jenis Kelamin</b>
                                    <a class="float-right text-decoration-none link-dark">Perempuan</a>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <b class="fw-bold">Usia</b>
                                <a class="float-right text-decoration-none link-dark">{{ $umur }} Tahun</a>
                            </li>
                            <li class="list-group-item">
                                <b class="fw-bold">Terdaftar Sejak</b>
                                <a class="float-right text-decoration-none link-dark">{{ date('d-M-Y', strtotime($dataUser->created_at)) }}</a>
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
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->anak->nama_anak }}" disabled readonly>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->anak->NIK }}" disabled readonly>
                                    <label for="floatingInput">Nomor Induk Kependudukan</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->anak->tempat_lahir }}" disabled readonly>
                                            <label for="floatingInput">Tampat Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="{{ date('d-M-Y', strtotime($dataUser->anak->tanggal_lahir)) }}" disabled readonly>
                                            <label for="floatingInput">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->anak->nomor_telepon == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->anak->nomor_telepon }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Nomor Telp</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->username_tele == NULL)
                                                <input type="text" class="form-control" id="floatingInput" value="Username Telegram belum dimasukan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->username_tele }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Username Telegram</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <div class="card-body bg-light my-auto">
                                        <p class="fs-5 fw-bold my-auto">Scan Kartu Keluarga</p>
                                    </div>
                                    <img src="{{ route('Get Image Data Anggota KK', $dataUser->id_kk ) }}" class="card-img-buttom" alt="...">
                                </div>
                            </div>
                            <div class="tab-pane" id="info">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->anak->pendidikan_ibu == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->anak->pendidikan_ibu }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Pendidikan Ibu</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->anak->pendidikan_ayah == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->anak->pendidikan_ayah }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Pendidikan Ayah</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->anak->pekerjaan_ibu == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->anak->pekerjaan_ibu }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Pekerjaan Ibu</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->anak->pekerjaan_ayah == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->anak->pekerjaan_ayah }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Pekerjaan Ayah</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    @if ($dataUser->anak->alamat == NULL)
                                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                    @else
                                        <input type="text" class="form-control" value="{{ $dataUser->anak->alamat }}" disabled readonly>
                                    @endif
                                    <label for="floatingInput">Alamat</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->agama == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{    $dataUser->agama }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->tanggungan == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ $dataUser->tanggungan }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Tanggungan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->no_jkn == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{   $dataUser->no_jkn }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Nomor JKN</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            @if ($dataUser->masa_berlaku == NULL)
                                                <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                            @else
                                                <input type="text" class="form-control" value="{{ date('d-M-Y', strtotime($dataUser->masa_berlaku)) }}" disabled readonly>
                                            @endif
                                            <label for="floatingInput">Masa Berlaku</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    @if ($dataUser->fasker_rujukan == NULL)
                                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                    @else
                                        <input type="text" class="form-control" value="{{ $dataUser->fasker_rujukan }}" disabled readonly>
                                    @endif
                                    <label for="floatingInput">Faskes Rujukan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    @if ($dataUser->anak->alamat == NULL)
                                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                                    @else
                                        <input type="text" class="form-control" value="{{ $dataUser->anak->alamat }}" disabled readonly>
                                    @endif
                                    <label for="floatingInput">Alamat</label>
                                </div>
                            </div>
                            <div class="tab-pane" id="ubahData">
                                <form action="{{ route('Update Anggota Anak', [$dataUser->anak->id]) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="floatingInput" value="{{ old('nama', $dataUser->anak->nama_anak) }}" placeholder="Nama Lengkap Anak">
                                        <label for="floatingInput">Nama Lengkap<span class="text-danger">*</span></label>
                                        @error('nama')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="floatingInput" value="{{ old('nik', $dataUser->anak->NIK) }}" placeholder="NIK Anak">
                                        <label for="floatingInput">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
                                        @error('nik')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="floatingInput" value="{{ old('tempat_lahir', $dataUser->anak->tempat_lahir) }}" placeholder="Tempat Lahir Anak">
                                                <label for="floatingInput">Tempat Lahir<span class="text-danger">*</span></label>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', date('d-m-Y', strtotime($dataUser->anak->tanggal_lahir))) }}" id="floatingInput" placeholder="Tanggal Lahir Anak" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                    <label for="floatingInput">Tanggal Lahir<span class="text-danger">*</span></label>
                                                    @error('tgl_lahir')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat tempat tinggal">{{ old('alamat', $dataUser->anak->alamat) }}</textarea>
                                        <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                        @error('alamat')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    @if ( $dataUser->tanggungan == NULL )
                                                        <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan">
                                                            <option selected disabled>Pilih tanggungan* ...</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        </select>
                                                    @endif
                                                    @if ( $dataUser->tanggungan == 'Dengan Tanggungan' )
                                                        <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan">
                                                            <option selected value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                            <option value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                        </select>
                                                    @endif
                                                    @if ( $dataUser->tanggungan == 'Tanpa Tanggungan' )
                                                        <select name="tanggungan" class="form-select @error('tanggungan') is-invalid @enderror" id="tanggungan">
                                                            <option selected value="Tanpa Tanggungan">Tanpa Tanggungan</option>
                                                            <option value="Dengan Tanggungan">Dengan Tanggungan</option>
                                                        </select>
                                                    @endif
                                                    @error('tanggungan')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="input-group">
                                                <input type="text" name="goldar" autocomplete="off" class="form-control @error('goldar') is-invalid @enderror" id="goldar" value="{{ old('goldar', $dataUser->golongan_darah ) }}" placeholder="Golongan Darah">
                                                @error('goldar')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                @if ($dataUser->no_jkn == NULL && $dataUser->tanggungan == NULL)
                                                    <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" placeholder="Nomor JKN">
                                                    <label for="no_jkn">Nomor JKN<span class="text-danger">*</span></label>
                                                @else
                                                    @if ( $dataUser->no_jkn == NULL)
                                                        <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" value="{{ old('no_jkn', $dataUser->no_jkn) }}" placeholder="Nomor JKN">
                                                        <label for="no_jkn">Nomor JKN</label>
                                                    @else
                                                        <input type="text" name="no_jkn" class="form-control @error('no_jkn') is-invalid @enderror" id="no_jkn" value="{{ old('no_jkn', $dataUser->no_jkn) }}" placeholder="Nomor JKN">
                                                        <label for="no_jkn">Nomor JKN<span class="text-danger">*</span></label>
                                                    @endif
                                                @endif
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
                                                    @if ($dataUser->no_jkn == NULL && $dataUser->tanggungan == NULL)
                                                        <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                        <label for="masa_berlaku">Masa Berlaku<span class="text-danger">*</span></label>
                                                    @else
                                                        @if ($dataUser->no_jkn == NULL)
                                                            <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <label for="masa_berlaku">Masa Berlaku</label>
                                                        @else
                                                            <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" value="{{ old('masa_berlaku', date('d-m-Y', strtotime($dataUser->masa_berlaku)) ) }}" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                                            <label for="masa_berlaku">Masa Berlaku<span class="text-danger">*</span></label>
                                                        @endif
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
                                        <input type="text" name="faskes_rujukan" class="form-control @error('faskes_rujukan') is-invalid @enderror" id="faskes_rujukan" value="{{ old('faskes_rujukan', $dataUser->faskes_rujukan) }}" placeholder="Fasker rujukan">
                                        <label for="faskes_rujukan">Faskes Rujukan<span class="text-danger">*</span></label>
                                        @error('faskes_rujukan')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
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
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-management-posyandu').addClass('menu-is-opening menu-open');
            $('#management-posyandu').addClass('active');
            $('#data-anggota').addClass('active');
        });

        // Custom Input Date
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })

            $('[data-mask]').inputmask()
        })
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
