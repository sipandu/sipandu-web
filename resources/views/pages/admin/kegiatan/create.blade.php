@extends('layouts/admin/admin-layout')
@section('title', 'Tambah Kegiatan')
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
                    <li class="breadcrumb-item active" aria-current="page">Tambah Kegiatan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('kegiatan.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Setting Penyuluhan
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Lokasi Kegiatan</label>
                                    <input type="text" name="tempat" class="form-control" placeholder="Masukkan Temapt Kegiatan" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Mulai</label>
                                    <input type="date" name="start_at" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Berakhir</label>
                                    <input type="date" name="end_at" class="form-control" id="">
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
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Penyuluhan" name="nama_kegiatan" id="">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="">Topik</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Topik Penyuluhan" name="topik_penyuluhan" id="">
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Kontent</label>
                                    <textarea name="deskripsi" class="form-control" id="" placeholder="Masukkan Pesan Penyuluhan" cols="30" rows="10"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('kegiatan.home') }}" class="btn btn-danger">Kembali</a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary float-right" type="submit">Submit</button>
                                    </div>
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
            $('#kegiatan').addClass('active');
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