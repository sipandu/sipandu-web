@extends('layouts/admin/admin-layout')
@section('title', 'Detail Kegiatan')
@push('css')

@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Kegiatan Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item">Kegiatan</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $kegiatan->nama_kegiatan }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Setting Kegiatan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Lokasi Kegiatan</label>
                                        <input type="text" name="tempat" value="{{ $kegiatan->tempat }}" class="form-control @error('tempat') is-invalid @enderror" placeholder="Masukkan Tempat Kegiatan" id="">
                                        @error('tempat')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Mulai</label>
                                        <input type="date" name="start_at" value="{{ $kegiatan->start_at }}" class="form-control @error('start_at') is-invalid @enderror" id="">
                                        @error('start_at')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Berakhir</label>
                                        <input type="date" name="end_at" value="{{ $kegiatan->end_at }}" class="form-control @error('end_at') is-invalid @enderror" id="">
                                        @error('end_at')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Gambar Penyuluhan</label>
                                        <img id="img-preview" src="/admin-template/dist/img/img-preview-800x400.png" width="100%" style="margin-bottom: 10px;" alt="">
                                        <input type="file" id="input-file" name="image" class="form-control-file" id="">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Konten Kegiatan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Nama Kegiatan</label>
                                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ $kegiatan->nama_kegiatan }}" placeholder="Masukkan Nama Kegiatan" name="nama_kegiatan" id="">
                                        @error('nama_kegiatan')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Topik</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Topik Penyuluhan" name="topik_penyuluhan" id="">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="">Kontent</label>
                                        <textarea name="deskripsi" class="ckeditor @error('deskripsi') is-invalid @enderror" id="" placeholder="Masukkan Pesan Penyuluhan" cols="30" rows="10">{!! $kegiatan->deskripsi !!}</textarea>
                                        @error('deskripsi')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
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
          $('#list-admin-dashboard').removeClass('menu-open');
          $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
          $('#kegiatan').addClass('active');
          $('#tambah-kegiatan').addClass('active');
        });

        $(function () {
          $('.ckeditor').each(function(e){
              CKEDITOR.replace(this.id ,{
                  height : 800,
                  filebrowserBrowseUrl : '{{url("ckeditor")}}/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr=',
                  filebrowserUploadUrl : '{{url("ckeditor")}}/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr=',
                  filebrowserImageBrowseUrl : '{{url("ckeditor")}}/filemanager/dialog.php?type=1&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr='
              });
          });
        });
        $('#input-file').on('change', function(){
            var filedata = this.files[0];
            var imgtype = filedata.type;
            var match = ['image/jpg', 'image/jpeg', 'image/png'];
            if (!(filedata.type==match[0]||filedata.type==match[1]||filedata.type==match[2])) {
                var msg = "Format Gambar Salah";
                alertWarning(msg);
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
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush