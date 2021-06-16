@extends('layouts/admin/admin-layout')

@section('title', 'Detail Pengumuman')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Edit Pengumuman</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pengumuman.home') }}">Pengumuman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('pengumuman.update', $pengumuman->id) }}" enctype="multipart/form-data" method="POST" class="needs-validation my-auto" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-8 col-sm-12">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Konten Pengumuman
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="judul_pengumuman">Judul Pengumuman</label>
                                        <input type="text" value="{{ $pengumuman->judul_pengumuman }}" class="form-control @error('judul_pengumuman') is-invalid @enderror" placeholder="Masukkan judul pengumuman" name="judul_pengumuman" id="judul_pengumuman" required>
                                        @error('judul_pengumuman')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Gambar pengumuman wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="posyandu">Posyandu Tujuan</label>
                                        <select class="select2 form-control @error('posyandu') is-invalid @enderror" id="posyandu" name="posyandu" data-placeholder="Pilih posyandu tujuan" required style="width: 100%">
                                            @foreach ($posyandu as $data)
                                                @if ($data->id == $pengumuman->id_posyandu)
                                                    <option selected value="{{ $data->id }}">{{ $data->nama_posyandu }}</option>
                                                @else
                                                    <option value="{{ $data->id }}">{{ $data->nama_posyandu }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('posyandu')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Posyandu tujuan wajib dipilih
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Isi Pengumuman</label>
                                        <textarea name="pengumuman" class="ckeditor @error('pengumuman') is-invalid @enderror" id="content" placeholder="Masukkan isi pengumuman" cols="30" rows="10" required>{!! $pengumuman->pengumuman !!}</textarea>
                                        @error('pengumuman')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Gambar pengumuman wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('pengumuman.home') }}" class="btn btn-danger">Kembali</a>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary float-right" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Gambar Pengumuman
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group my-auto">
                                        <label for="input-file">Gambar Penyuluhan</label>
                                        <input type="file" id="input-file" name="image" class="form-control @error('image') is-invalid @enderror mb-3">
                                        @error('image')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Gambar pengumuman wajib diisi
                                            </div>
                                        @enderror
                                        <div class="text-center my-auto">
                                            <img id="img-preview" src="{{ route('pengumuman.get_img', $pengumuman->id) }}" width="100%" alt="">
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

    <script>
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#pengumuman').addClass('active');

            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
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

        // ClassicEditor
        //     .create( document.querySelector( '#content' ) )
        //     .then( editor => {
        //             console.log( editor );
        //     } )
        //     .catch( error => {
        //             console.error( error );
        //     } );
    </script>

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush