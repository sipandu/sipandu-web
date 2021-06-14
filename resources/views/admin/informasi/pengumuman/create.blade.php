@extends('layouts/admin/admin-layout')

@section('title', 'Tambah Pengumuman')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Pengumuman</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pengumuman.home') }}">Pengumuman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('pengumuman.store') }}" enctype="multipart/form-data" method="POST" class="needs-validation my-auto" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Konten Pengumuman
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="judul_pengumuman">Judul</label>
                                        <input type="text" class="form-control @error('judul_pengumuman') is-invalid @enderror" value="{{ old('judul_pengumuman') }}" placeholder="Masukkan judul pengumuman" name="judul_pengumuman" id="judul_pengumuman" required>
                                        @error('judul_pengumuman')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Judul pengumuman wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="posyandu">Posyandu Tujuan</label>
                                        <select class="select2 form-control @error('posyandu[]') is-invalid @enderror" id="posyandu" multiple="multiple" name="posyandu[]" data-placeholder="Pilih posyandu tujuan" required style="width: 100%">
                                            @foreach ($posyandu as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_posyandu }}</option>
                                            @endforeach
                                        </select>
                                        @error('posyandu[]')
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
                                        <textarea name="pengumuman" class="ckeditor @error('pengumuman') is-invalid @enderror" id="content"
                                        placeholder="Masukkan isi pengumuman" cols="30" rows="10" required>{!! old('pengumuman') !!}</textarea>
                                        @error('pengumuman')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Isi pengumuman wajib diisi
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
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Gambar Pengumuman
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group my-auto">
                                        <label for="image">Gambar Pengumuman</label>
                                        <input type="file" id="input-file" name="image" class="mb-3 form-control @error('image') is-invalid @enderror" id="image" required>
                                        @error('image')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Gambar wajib diisi
                                            </div>
                                        @enderror
                                        <div class="text-center my-auto">
                                            <img id="img-preview" class="w-100 rounded" src="" alt="">
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

        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#pengumuman').addClass('active');

            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
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