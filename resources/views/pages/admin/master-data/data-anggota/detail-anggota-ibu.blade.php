@extends('layouts/admin/admin-layout')

@section('title', 'Data Profile Ibu Hamil')

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
    @if ($errors->any())
      <div class="alert alert-danger text-center" role="alert">
        <span>Terdapat kesalahan dalam penginputan data. Periksa kembali input data sebelumnya!</span>
      </div>
    @endif
    <div class="row">
      <div class="col-md-5">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
            <div class="text-center">
              <div class="image mx-auto d-block rounded">
                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="{{ route('Get Image Data Anggota', $dataUser->id ) }}?{{date('YmdHis')}}" alt="Profile Admin" width="150" height="150">
              </div>
            </div>
            <h3 class="profile-username text-center">{{ $dataUser->ibu->nama_ibu_hamil }}</h3>
            <p class="text-muted text-center">{{ $dataUser->email }}</p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b class="fw-bold">Status Keluarga</b>
                  <a class="float-right text-decoration-none link-dark">Ibu</a>
                </li>
                @if ( $dataUser->ibu->kehamilan_ke == NULL)
                  <li class="list-group-item">
                    <b class="fw-bold">Kehamilan</b>
                    <a class="float-right text-decoration-none link-dark">Belum ditambahkan</a>
                  </li>
                @else
                  <li class="list-group-item">
                    <b class="fw-bold">Kehamilan</b>
                    <a class="float-right text-decoration-none link-dark">{{ $dataUser->ibu->kehamilan_ke}}</a>
                  </li>
                @endif
                <li class="list-group-item">
                  <b class="fw-bold">Usia</b>
                  <a class="float-right text-decoration-none link-dark">{{ $umur }} Tahun</a>
                </li>
                <li class="list-group-item">
                  <b class="fw-bold">Terdaftar Sejak</b>
                  <a class="float-right text-decoration-none link-dark">{{ date('d M Y', strtotime($dataUser->created_at)) }}</a>
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
                  <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->ibu->nama_ibu_hamil }}" disabled readonly>
                  <label for="floatingInput">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-3">
                  @if ($dataUser->ibu->NIK == NULL)
                    <input type="text" class="form-control" id="floatingInput" value="Belum ditambahkan" disabled readonly>
                  @else
                    <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->ibu->NIK }}" disabled readonly>
                  @endif
                  <label for="floatingInput">Nomor Induk Kependudukan</label>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->ibu->tempat_lahir)
                        <input type="text" class="form-control" id="floatingInput" value="Belum ditambahkan" disabled readonly>
                      @else
                        <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->ibu->tempat_lahir }}" disabled readonly>
                      @endif
                      <label for="floatingInput">Tempat Lahir</label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->ibu->tanggal_lahir == NULL)
                        <input type="text" class="form-control" id="floatingInput" value="Belum ditambahkan" disabled readonly>
                      @else
                        <input type="text" class="form-control" id="floatingInput" value="{{ date('d M Y', strtotime($dataUser->ibu->tanggal_lahir)) }}" disabled readonly>
                      @endif
                      <label for="floatingInput">Tanggal Lahir</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->ibu->nomor_telepon == NULL)
                        <input type="text" class="form-control" id="floatingInput" value="Belum ditambahkan" disabled readonly>
                      @else
                        <input type="text" class="form-control" id="floatingInput" value="{{ $dataUser->ibu->nomor_telepon }}" disabled readonly>
                      @endif
                      <label for="floatingInput">Nomor Telp</label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->username_tele == NULL)
                        <input type="text" class="form-control" id="floatingInput" value="Belum ditambahkan" disabled readonly>
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
                  <img src="{{ route('Get Image Data Anggota KK', $dataUser->id_kk ) }}" class="card-img-buttom" alt="{{ $dataUser->kk->no_kk }}">
                </div>
              </div>
              <div class="tab-pane" id="info">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                        @if ($dataUser->ibu->pendidikan_ibu == NULL)
                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                        @else
                          <input type="text" class="form-control" value="{{ $dataUser->ibu->pendidikan_ibu }}" disabled readonly>
                        @endif
                      <label for="floatingInput">Pendidikan Ibu</label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->ibu->pendidikan_suami == NULL)
                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                      @else
                        <input type="text" class="form-control" value="{{ $dataUser->ibu->pendidikan_suami }}" disabled readonly>
                      @endif
                      <label for="floatingInput">Pendidikan Suami</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->ibu->pekerjaan_ibu == NULL)
                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                      @else
                        <input type="text" class="form-control" value="{{ $dataUser->ibu->pekerjaan_ibu }}" disabled readonly>
                      @endif
                      <label for="floatingInput">Pekerjaan Ibu</label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->ibu->pekerjaan_suami == NULL)
                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                      @else
                        <input type="text" class="form-control" value="{{ $dataUser->ibu->pekerjaan_suami }}" disabled readonly>
                      @endif
                      <label for="floatingInput">Pekerjaan Suami</label>
                    </div>
                  </div>
                </div>
                <div class="form-floating mb-3">
                  @if ($dataUser->ibu->alamat == NULL)
                    <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                  @else
                    <input type="text" class="form-control" value="{{ $dataUser->ibu->alamat }}" disabled readonly>
                  @endif
                  <label for="floatingInput">Alamat</label>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-floating mb-3">
                      @if ($dataUser->agama == NULL)
                        <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                      @else
                        <input type="text" class="form-control" value="{{ $dataUser->agama }}" disabled readonly>
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
                          <input type="text" class="form-control" value="{{ $dataUser->no_jkn }}" disabled readonly>
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
                  @if ($dataUser->faskes_rujukan == NULL)
                    <input type="text" class="form-control" value="Belum ditambahkan" disabled readonly>
                  @else
                    <input type="text" class="form-control" value="{{ $dataUser->faskes_rujukan }}" disabled readonly>
                  @endif
                  <label for="floatingInput">Faskes Rujukan</label>
                </div>
              </div>
              <div class="tab-pane" id="ubahData">
                <form action="{{ route('Update Anggota Ibu', [$dataUser->ibu->id]) }}" method="POST" class="form-horizontal">
                  @csrf
                  <div class="form-floating mb-3">
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $dataUser->ibu->nama_ibu_hamil) }}" placeholder="Nama Lengkap Ibu Hamil">
                    <label for="nama">Nama Lengkap<span class="text-danger">*</span></label>
                    @error('nama')
                      <div class="invalid-feedback text-start">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik', $dataUser->ibu->NIK) }}" placeholder="NIK Ibu Hamil">
                    <label for="nik">Nomor Induk Kependudukan<span class="text-danger">*</span></label>
                    @error('nik')
                      <div class="invalid-feedback text-start">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir', $dataUser->ibu->tempat_lahir) }}" placeholder="Tempat Lahir Ibu Hamil">
                        <label for="tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
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
                          <input  type="text" name="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', date('d-m-Y', strtotime($dataUser->ibu->tanggal_lahir))) }}" id="tgl_lahir" placeholder="Tanggal Lahir Ibu Hamil" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                          <label for="tgl_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
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
                    <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat tempat tinggal">{{ old('alamat', $dataUser->ibu->alamat) }}</textarea>
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
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @if ($dataUser->golongan_darah == NULL)
                                  <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                    <option selected disabled>Pilih golongan darah ...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                  </select>
                                @endif
                                @if ($dataUser->golongan_darah == 'A')
                                  <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                    <option selected value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                  </select>
                                @endif
                                @if ($dataUser->golongan_darah == 'B')
                                  <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                    <option selected value="B">B</option>
                                    <option value="A">A</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                  </select>
                                @endif
                                @if ($dataUser->golongan_darah == 'AB')
                                  <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                    <option selected value="AB">AB</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="O">O</option>
                                  </select>
                                @endif
                                @if ($dataUser->golongan_darah == 'O')
                                  <select name="goldar" class="form-select @error('goldar') is-invalid @enderror" id="goldar">
                                    <option selected value="O">O</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                  </select>
                                @endif
                                @error('goldar')
                                  <div class="invalid-feedback text-start">
                                    {{ $message }}
                                  </div>
                                @enderror
                            </div>
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
                          @if ($dataUser->no_jkn == NULL)
                            <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                            <label for="masa_berlaku">Masa Berlaku</label>
                          @else
                            <input type="text" name="masa_berlaku" autocomplete="off" class="form-control @error('masa_berlaku') is-invalid @enderror" value="{{ old('masa_berlaku', date('d-m-Y', strtotime($dataUser->masa_berlaku)) ) }}" id="masa_berlaku" placeholder="Masa berlaku JKN" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
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
      $('#account-management').addClass('menu-is-opening menu-open');
      $('#account').addClass('active');
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
