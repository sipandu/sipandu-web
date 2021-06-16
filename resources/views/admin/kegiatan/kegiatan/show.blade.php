@extends('layouts/admin/admin-layout')

@section('title', 'Detail Kegiatan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Detail Kegiatan</h1>
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
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">Rincian Kegiatan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="tempat">Lokasi Kegiatan<span class="text-danger">*</span></label>
                                        <input type="text" name="tempat" value="{{ $kegiatan->tempat }}" class="form-control @error('tempat') is-invalid @enderror" placeholder="Masukkan Tempat Kegiatan" id="tempat" required>
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
                                    <div class="form-group">
                                        <label for="start_at">Tanggal Mulai<span class="text-danger">*</span></label>
                                        <input type="date" name="start_at" value="{{ $kegiatan->start_at }}" class="form-control @error('start_at') is-invalid @enderror" id="start_at" required>
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
                                        <input type="date" name="end_at" value="{{ $kegiatan->end_at }}" class="form-control @error('end_at') is-invalid @enderror" id="end_at">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">Deskripsi Kegiatan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_kegiatan">Nama Kegiatan<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ $kegiatan->nama_kegiatan }}" placeholder="Masukkan Nama Kegiatan" name="nama_kegiatan" id="nama_kegiatan" required>
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
                                        <label for="deskripsi">Kontent<span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" class="ckeditor @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Masukkan Pesan Penyuluhan" cols="30" rows="10" required>{!! $kegiatan->deskripsi !!}</textarea>
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
                                            <button class="btn btn-primary float-right" type="submit">Update</button>
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
    <script src="{{ url('base-template/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
            $('#kegiatan').addClass('active');
            $('#tambah-kegiatan').addClass('active');
        });

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

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush