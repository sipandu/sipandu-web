@extends('layouts/admin/admin-layout')
@section('title', 'Tambah Informasi Penting')
@push('css')
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Informasi Penting</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item">Informasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Informasi Penting</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('informasi_penting.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Konten Informasi Penting
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Judul</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Judul Informasi" name="judul_informasi" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Kontent</label>
                                    <textarea name="informasi" class="form-control" id="content" placeholder="Masukkan Konten" cols="30" rows="10"></textarea>
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
                                    <label for="">Gambar Penyuluhan</label>
                                    <img id="img-preview" src="/admin-template/dist/img/img-preview-800x400.png" width="100%" style="margin-bottom: 10px;" alt="">
                                    <input type="file" id="input-file" name="image" class="form-control-file" id="">
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
    <script>
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#penyuluhan').addClass('active');
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