@extends('layouts/admin/admin-layout')

@section('title', 'Buat Berita')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Buat Berita Baru</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('informasi_penting.store') }}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Isi Berita
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Judul<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('judul_informasi') is-invalid @enderror" value="{{ old('judul_informasi') }}" placeholder="Masukkan Judul Informasi" name="judul_informasi" id="" required>
                                        @error('judul_informasi')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Judul Berita Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Kontent<span class="text-danger">*</span></label>
                                        <textarea name="informasi" class="ckeditor @error('informasi') is-invalid @enderror" id="content" placeholder="Masukkan Konten" cols="30" rows="10" required>{!! old('informasi') !!}</textarea>
                                        @error('informasi')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Konten Berita Wajib Diisi
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <p class="text-danger text-end"><span>*</span> Data wajib diisi</p>
                                        <div class="col-6">
                                            <a href="{{ route('informasi_penting.home') }}" class="btn btn-danger">Kembali</a>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary float-right" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Rincian Berita
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="gambar">Gambar Berita<span class="text-danger">*</span></label>
                                        <input type="file" id="input-file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" id="gambar" required>
                                        @error('gambar')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Gambar Berita Wajib Diisi
                                            </div>
                                        @enderror
                                        <div class="text-center my-1">
                                            <img id="img-preview" src="" class="w-100 rounded" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tag Berita<span class="text-danger">*</span></label>
                                        <select class="select2 form-control @error('tag_berita[]') is-invalid @enderror" multiple="multiple" name="tag_berita[]" style="width: 100%;" data-placeholder="Pilih tag berita" required>
                                            @foreach ($tag as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_tag }}</option>
                                            @endforeach
                                        </select>
                                        @error('tag_berita[]')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Tag Berita Wajib Dipilih
                                            </div>
                                        @enderror
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
    <script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#informasi-penting').addClass('active');
        });

        $(function () {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

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
                var msg = "Format Gambar Salah";
                // alertWarning(msg);
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
            alertSuccess('{{ $message }}');
        </script>
    @endif
@endpush