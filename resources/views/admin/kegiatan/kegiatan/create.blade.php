@extends('layouts/admin/admin-layout')

@section('title', 'Tambah Kegiatan')

@push('css')
    <link rel="stylesheet" href="{{ asset('base-template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base-template/dist/css/adminlte.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Kegiatan Posyandu</h1>
        <div class="col-auto ml-auto my-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('kegiatan.home') }}">Kegiatan Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('kegiatan.store') }}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Rincian Kegiatan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group" id="field_lokasi">
                                        <label for="tempat">Lokasi Kegiatan<span class="text-danger">*</span></label>
                                        <select class="select2 select2-primary form-select border @error('tempat') is-invalid @enderror" data-dropdown-css-class="select2-primary" id="tempat" name="tempat" data-placeholder="Masukan lokasi kegiatan" required style="width: 100%">
                                            @foreach ($posyandu as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_posyandu }}</option>
                                            @endforeach
                                            <option value="manual" id="insertManual">Masukan manual</option>
                                        </select>
                                        @error('tempat')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Lokasi Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group" id="field_detail_lokasi">
                                        <div class="row">
                                            <div class="col-10">
                                                <label for="detail_tempat">Detail Tempat Kegiatan<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-2 d-flex justify-content-end">
                                                <i class="far fa-times-circle small text-danger" style="cursor: pointer" onclick="tampilkanLokasiPosyandu()"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="detail_tempat" class="form-control @error('detail_tempat') is-invalid @enderror"
                                        value="{{ old('detail_tempat') }}" placeholder="Masukkan detail tempat kegiatan" id="detail_tempat" required autocomplete="off">
                                        @error('detail_tempat')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Detail Tempat Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="start_at">Tanggal Mulai<span class="text-danger">*</span></label>
                                        <input type="date" name="start_at" class="form-control @error('start_at') is-invalid @enderror" value="{{ old('start_at') }}" id="start_at" required>
                                        @error('start_at')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Tanggal Mulai Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="end_at">Tanggal Berakhir<span class="text-danger">*</span></label>
                                        <input type="date" name="end_at" class="form-control @error('end_at') is-invalid @enderror" value="{{ old('end_at') }}" id="end_at" required>
                                        @error('end_at')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Tanggal Berakhir Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <p class="text-danger text-end my-3"><span>*</span> Data wajib diisi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Deskripsi Kegiatan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_kegiatan">Nama Kegiatan<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" placeholder="Masukkan Nama Kegiatan" value="{{ old('nama_kegiatan') }}" name="nama_kegiatan" id="nama_kegiatan" required autocomplete="off">
                                        @error('nama_kegiatan')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Nama Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Konten<span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" class="ckeditor @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Masukkan Pesan Penyuluhan" cols="30" rows="10" required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Konten Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <p class="text-danger text-end"><span>*</span> Data wajib diisi</p>
                                        <div class="col-6">
                                            <a href="{{ route('kegiatan.home') }}" class="btn btn-danger">Kembali</a>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-success float-right" type="submit">Tambah Kegiatan</button>
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
@endsection

@push('js')
    <script src="{{ asset('base-template/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('base-template/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function(){
            $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
            $('#kegiatan').addClass('active');
            $('#tambah-kegiatan').addClass('active');

            $('#field_detail_lokasi').hide();
            $('#tempat').prop('required', true);
            $('#detail_tempat').prop('required', false);

            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            
            $('.select2').on('select2:select', function (e) {
                if (e.params.data.id == 'manual') {
                    $('#field_detail_lokasi').show();
                    $('#detail_tempat').prop('required', true);

                    $('#field_lokasi').hide();
                    $('#tempat').prop('required', false);
                }
            });
        });

        function tampilkanLokasiPosyandu() {
            $('#field_lokasi').show();
            $('#tempat').prop('required', true);

            $('#field_detail_lokasi').hide();
            $('#detail_tempat').prop('required', false);
        }

        // $(function () {
        //   $('.ckeditor').each(function(e){
        //       CKEDITOR.replace(this.id ,{
        //           height : 800,
        //           filebrowserBrowseUrl : '{{url("ckeditor")}}/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr=',
        //           filebrowserUploadUrl : '{{url("ckeditor")}}/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr=',
        //           filebrowserImageBrowseUrl : '{{url("ckeditor")}}/filemanager/dialog.php?type=1&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr='
        //       });
        //   });
        // });
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                Swal.fire(
                    'Gagal',
                    '{{$message}}',
                    'error'
                )
            });
        </script>
    @endif

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                Swal.fire(
                    'Berhasil',
                    '{{$message}}',
                    'success'
                )
            });
        </script>
    @endif
@endpush