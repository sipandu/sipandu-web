@extends('layouts/admin/admin-layout')
@section('title', 'Tambah Penyuluhan')
@push('css')

@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Penyuluhan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item">Informasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Penyuluhan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('penyuluhan.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Konten Penyuluhan
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama Penyuluhan</label>
                                    <input type="text" class="form-control @error('nama_penyuluhan') is-invalid @enderror" value="{{ old('nama_penyuluhan') }}"
                                    placeholder="Masukkan Nama Penyuluhan" name="nama_penyuluhan" id="">
                                    @error('nama_penyuluhan')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Topik</label>
                                    <input type="text" class="form-control @error('topik_penyuluhan') is-invalid @enderror" value="{{ old('topik_penyuluhan') }}"
                                    placeholder="Masukkan Topik Penyuluhan" name="topik_penyuluhan" id="">
                                    @error('topik_penyuluhan')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Kontent</label>
                                    <textarea name="deskripsi" class="ckeditor @error('deskripsi') is-invalid @enderror" id=""
                                    placeholder="Masukkan Pesan Penyuluhan" cols="30" rows="10">{!! old('deskripsi') !!}</textarea>
                                    @error('deskripsi')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('penyuluhan.home') }}" class="btn btn-danger">Kembali</a>
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
                                    Setting Penyuluhan
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Lokasi Penyuluhan</label>
                                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}"
                                    placeholder="Masukkan Lokasi Penyuluhan" id="">
                                    @error('lokasi')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Penyuluhan</label>
                                    <input type="date" name="tanggal" class="form-control  @error('lokasi') is-invalid @enderror" value="{{ old('tanggal') }}" id="">
                                    @error('tanggal')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Gambar Penyuluhan</label>
                                    <img id="img-preview" src="/admin-template/dist/img/img-preview-800x400.png" width="100%" style="margin-bottom: 10px;" alt="">
                                    <input type="file" id="input-file" name="image" class="form-control-file  @error('lokasi') is-invalid @enderror" id="">
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
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#penyuluhan').addClass('active');
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
@endpush