@extends('layouts/admin/admin-layout')

@section('title', 'Tambah Admin')

@push('css')
  <link rel="stylesheet" href="{{url('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h3 col-lg-auto text-center text-md-start">Tambah Administrator</h1>
      <div class="col-auto ml-auto text-right my-auto mt-n1">
          <nav aria-label="breadcrumb text-center">
              <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Data Admin') }}">Semua Admin</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
              </ol>
          </nav>
      </div>
  </div>
  <div class="container-fluid px-0">
    <div class="row">
      <div class="col-12">
        @if ($errors->any())
          <div class="alert alert-danger text-center" role="alert">
            <span>Terdapat kesalahan dalam penginputan data. Periksa kembali input data sebelumnya!</span>
          </div>
        @endif
        <div class="card card-primary">
          <div class="card-header my-auto">
            <h3 class="card-title my-auto">Form Tambah Administrator Baru</h3>
          </div>
          <div class="card-body p-0">
            <div class="bs-stepper py-3">
              <div class="bs-stepper-header px-3 d-flex justify-content-center" role="tablist">
                <div class="step" data-target="#data-pertama">
                  <button type="button" class="step-trigger" role="tab" aria-controls="data-pertama" id="data-pertama-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Data Pertama</span>
                  </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#data-kedua">
                  <button type="button" class="step-trigger" role="tab" aria-controls="data-kedua" id="data-kedua-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Data Kedua</span>
                  </button>
                </div>
              </div>
              <form action="{{ route('create.add.admin') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="bs-stepper-content p-3">
                  <div id="data-pertama" class="content" role="tabpanel" aria-labelledby="data-pertama-trigger">
                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="name">Nama Lengkap<span class="text-danger">*</span></label>
                          <div class="input-group mb-3">
                            <input type="text" name="name" id="name" autocomplete="off" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  placeholder="Nama lengkap admin">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user-shield"></span>
                              </div>
                            </div>
                            @error('name')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="gender">Jenis Kelamin<span class="text-danger">*</span></label>
                          <div class="input-group mb-3">
                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}">
                              @if (old('gender'))
                                <option selected value="{{ old('gender') }}">{{ old('gender') }}</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                              @else
                                <option selected disabled>Pilih jenis kelamin....</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                              @endif
                            </select>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-venus-mars"></span>
                              </div>
                            </div>
                            @error('gender')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="nik">NIK<span class="text-danger">*</span></label>
                          <div class="input-group mb-3">
                            <input type="text" name="nik" id="nik" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="Masukan NIK">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-address-card"></span>
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
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="fileKTP">Scan KTP<span class="text-danger">*</span></label>
                          <div class="col-sm-12 px-0">
                            <div class="custom-file">
                              <input type="file" name="file" autocomplete="off" class="custom-file-input @error('file') is-invalid @enderror" id="fileKTP" autocomplete="off">
                              <label class="custom-file-label" for="exampleInputFile">Unggah scan KTP</label>
                              @error('file')
                                <div class="invalid-feedback text-start">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                          <div class="input-group mb-3">
                            <input  type="text" name="tempat_lahir" id="tempat_lahir" autocomplete="off" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}"  placeholder="Tempat lahir">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                              </div>
                            </div>
                            @error('tempat_lahir')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="tgl_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                          <div class="input-group">
                            <input  type="text" name="tgl_lahir" id="tgl_lahir" autocomplete="off" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            @error('tgl_lahir')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="email">Alamat E-Mail<span class="text-danger">*</span></label>
                          <div class="input-group mb-3">
                            <input type="email" name="email" id="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Alamat email aktif">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                            @error('email')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="alamat">Alamat<span class="text-danger">*</span></label>
                          <div class="input-group mb-3">
                            <input type="text" name="alamat" id="alamat" autocomplete="off" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Alamat tempat tinggal admin">
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
                      <div class="col-12">
                        <p class="text-danger text-end"><span>*</span> Data wajib diisi</p>
                      </div>
                      <div class="col-12 d-flex justify-content-end">
                        <a class="btn btn-primary text-end" onclick="stepper.next()">Berikutnya</a>
                      </div>
                    </div>
                  </div>
                  <div id="data-kedua" class="content" role="tabpanel" aria-labelledby="data-kedua-trigger">
                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="tlpn">Nomor Telp</label>
                          <div class="input-group mb-3">
                            <input type="text" name="tlpn" id="tlpn" autocomplete="off" class="form-control @error('tlpn') is-invalid @enderror" value="{{ old('tlpn') }}" placeholder="Masukan nomor telepon aktif">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                              </div>
                            </div>
                            @error('tlpn')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="telegram">Username Telegram</label>
                          <div class="input-group mb-3">
                            <input type="text" name="telegram" id="telegram" autocomplete="off" class="form-control @error('telegram') is-invalid @enderror" value="{{ old('telegram') }}"  placeholder="Masukan Username Telegram aktif">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fab fa-telegram-plane"></span>
                              </div>
                            </div>
                            @error('telegram')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="row">
                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="jabatan">Jabatan<span class="text-danger">*</span></label>
                              <div class="input-group mb-3">
                                  @if (Auth::guard('admin')->user()->role == 'super admin')
                                    <select name="jabatan" class="form-select @error('jabatan') is-invalid @enderror" id="jabatan">
                                      @if ( old('jabatan') )
                                        <option selected disabled>Pilih jabatan....</option>
                                        <option value="head admin">Head Admin</option>
                                        <option value="admin">Admin</option>
                                      @else
                                        <option selected disabled>Pilih jabatan....</option>
                                        <option value="head admin">Head Admin</option>
                                        <option value="admin">Admin</option>        
                                      @endif
                                    </select>
                                  @endif
                                  @if (Auth::guard('admin')->user()->role == 'pegawai')
                                    @if (Auth::guard('admin')->user()->pegawai->jabatan == 'head admin')
                                      <select name="jabatan" class="form-select @error('jabatan') is-invalid @enderror" id="jabatan">
                                        <option selected value="admin">Admin</option>
                                      </select>
                                    @endif
                                  @endif
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-user-cog"></span>
                                    </div>
                                  </div>
                                  @error('jabatan')
                                    <div class="invalid-feedback text-start">
                                      {{ $message }}
                                    </div>
                                  @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <label for="lokasi_posyandu">Tempat Tugas<span class="text-danger">*</span></label>
                              <div class="input-group mb-3">
                                <select name="lokasi_posyandu" id="lokasi_posyandu" class="form-control select2 @error('lokasi_posyandu') is-invalid @enderror" value="{{ old('lokasi_posyandu') }}" style="width: 100%">
                                    @if (Auth::guard('admin')->user()->role == 'super admin')
                                      @if ( old('lokasi_posyandu') )
                                        <option selected value="{{ old('lokasi_posyandu') }}">{{ old('lokasi_posyandu') }}</option>
                                        @foreach ($posyandu as $p)
                                          <option value="{{$p->id}}">{{$p->nama_posyandu}}</option>
                                        @endforeach
                                      @else
                                        <option selected disabled>Pilih Lokasi Posyandu ....</option>
                                        @foreach ($posyandu as $p)
                                          <option value="{{$p->id}}">{{$p->nama_posyandu}}</option>
                                        @endforeach
                                      @endif
                                    @else
                                      <option selected value="{{auth()->guard('admin')->user()->pegawai->id_posyandu}}">{{auth()->guard('admin')->user()->pegawai->posyandu->nama_posyandu}}</option>
                                    @endif
                                </select>
                                @error('lokasi_posyandu')
                                  <div class="invalid-feedback text-start">
                                    {{ $message }}
                                  </div>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="password">Password<span class="text-danger">*</span></label>
                          <div class="input-group mb-3">
                            <input type="password" name="password" id="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                            @error('password')
                              <div class="invalid-feedback text-start">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <p class="text-danger text-end"><span>*</span> Data wajib diisi</p>
                        <div class="row">
                          <div class="col-6 justify-content-start">
                            <a class="btn btn-warning" onclick="stepper.previous()">Sebelumnya</a>
                          </div>
                          <div class="col-6 text-end">
                            <button type="submit" class="btn btn-primary my-1">Daftarkan Akun</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script src="{{ asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
  <script src="{{ asset('base-template/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('base-template/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('base-template/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

  <script>
    $(document).ready(function(){
      $('#account-management').addClass('menu-is-opening menu-open');
      $('#account').addClass('active');
      $('#data-admin').addClass('active');
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

    // Custom Step Page
    document.addEventListener('DOMContentLoaded', function () {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
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
