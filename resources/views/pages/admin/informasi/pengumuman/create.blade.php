@extends('layouts/admin/admin-layout')
@section('title', 'Tambah Pengumuman')
@push('css')

@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Pengumuman</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item">Informasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('pengumuman.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Konten Pengumuman
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Judul</label>
                                    <input type="text" class="form-control @error('judul_pengumuman') is-invalid @enderror" value="{{ old('judul_pengumuman') }}"
                                    placeholder="Masukkan Judul Pengumuman" name="judul_pengumuman" id="">
                                    @error('judul_pengumuman')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Kontent</label>
                                    <textarea name="pengumuman" class="ckeditor @error('pengumuman') is-invalid @enderror" id="content"
                                    placeholder="Masukkan Konten" cols="30" rows="10">{!! old('pengumuman') !!}</textarea>
                                    @error('pengumuman')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('pengumuman.home') }}" class="btn btn-danger">Kembali</a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary float-right" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Setting Pengumuman
                                </h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label for="">Tanggal Pengumuman</label>
                                    <input type="date" class="form-control @error('tanggal_pengumuman') is-invalid @enderror" value="{{ old('tanggal_pengumuman') }}"
                                     name="tanggal_pengumuman" id="">
                                    @error('tanggal_pengumuman')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Gambar Pengumuman</label>
                                    <img id="img-preview" src="/admin-template/dist/img/img-preview-800x400.png" width="100%" style="margin-bottom: 10px;" alt="">
                                    <input type="file" id="input-file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="">
                                    @error('image')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
@endsection

@push('js')
<script src="{{ url('base-template/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
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
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#pengumuman').addClass('active');
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

        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
    </script>
@endpush