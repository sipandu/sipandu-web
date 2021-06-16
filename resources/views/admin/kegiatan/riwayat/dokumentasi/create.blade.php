@extends('layouts/admin/admin-layout')

@section('title', 'Tambah Dokumentasi Kegiatan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Dokumentasi Kegiatan</h1>
        <div class="col-auto ml-auto my-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('riwayat_kegiatan.show', $kegiatan->id) }}">Dokumentasi Kegiatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('dokumentasi.store', $kegiatan->id) }}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">Form Dokumentasi Kegiatan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="image">Gambar Dokumentasi Kegiatan<span class="text-danger">*</span></label>
                                        <input type="file" id="input-file" name="image" class="form-control @error('image') is-invalid @enderror mb-3" id="image" accept="image/*" required>
                                        @error('image')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Gambar Dokumentasi Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                        <div class="text-center my-3">
                                            <img id="img-preview" class="w-75 rounded" src="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deskripsi<span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" id="" class="form-control @error('deskripsi') is-invalid @enderror" cols="30" rows="10" required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Deskripsi Gambar Dokumentasi Kegiatan Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <p class="text-danger text-end"><span>*</span> Data wajib diisi</p>
                                        <div class="col-6">
                                            <a href="{{ route('riwayat_kegiatan.show', $kegiatan->id) }}" class="btn btn-danger">Kembali</a>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary float-right" type="submit">Simpan</button>
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
    <script src="{{ asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function(){
          $('#list-admin-dashboard').removeClass('menu-open');
          $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
          $('#kegiatan').addClass('active');
          $('#riwayat-kegiatan').addClass('active');
          bsCustomFileInput.init();
        });

        $('#input-file').on('change', function(){
            var filedata = this.files[0];
            var imgtype = filedata.type;
            var match = ['image/jpg', 'image/jpeg', 'image/png'];
            if (!(filedata.type==match[0]||filedata.type==match[1]||filedata.type==match[2])) {
                var msg = "Format Gambar Tidak Sesuai";
                alertError(msg);
                $(this).val('');
            }else{
                var reader=new FileReader();
                reader.onload=function(ev){
                $('#img-preview').attr('src', ev.target.result);
            }
                reader.readAsDataURL(this.files[0]);
                var postData=new FormData();
                postData.append('file', this.files[0]);
            }
        });
    </script>
@endpush