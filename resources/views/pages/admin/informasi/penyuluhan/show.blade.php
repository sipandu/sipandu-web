@extends('layouts/admin/admin-layout')
@section('title', 'Manajemen Kegiatan')
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
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('penyuluhan.home') }}">Penyuluhan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $penyuluhan->nama_penyuluhan }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('penyuluhan.update', $penyuluhan->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Konten Penyuluhan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Nama Penyuluhan</label>
                                        <input type="text" class="form-control  @error('nama_penyuluhan') is-invalid @enderror" value="{{ $penyuluhan->nama_penyuluhan }}"
                                        placeholder="Masukkan Nama Penyuluhan" name="nama_penyuluhan" id="">
                                        @error('nama_penyuluhan')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Topik</label>
                                        <input type="text" class="form-control  @error('topik_penyuluhan') is-invalid @enderror" value="{{ $penyuluhan->topik_penyuluhan }}"
                                        placeholder="Masukkan Topik Penyuluhan" name="topik_penyuluhan" id="">
                                        @error('topik_penyuluhan')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kontent</label>
                                        <textarea name="deskripsi" class="ckeditor  @error('deskripsi') is-invalid @enderror" id=""
                                        placeholder="Masukkan Pesan Penyuluhan" cols="30" rows="10">{{ $penyuluhan->deskripsi }}</textarea>
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
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <div class="card-header my-auto">
                                    <h4 class="card-title my-auto">
                                        Setting Penyuluhan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Lokasi Penyuluhan</label>
                                        <input type="text" name="lokasi" class="form-control  @error('lokasi') is-invalid @enderror" value="{{ $penyuluhan->lokasi }}"
                                        placeholder="Masukkan Lokasi Penyuluhan" id="">
                                        @error('lokasi')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Penyuluhan</label>
                                        <input type="date" name="tanggal" value="{{ $penyuluhan->tanggal }}" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal-penyuluhan">
                                        @error('tanggal')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Gambar Penyuluhan</label>
                                        <img id="img-preview" src="{{ route('penyuluhan.get_img', $penyuluhan->id) }}" width="100%" style="margin-bottom: 10px;" alt="">
                                        <input id="input-file" type="file" name="gambar" value="" class="form-control-file  @error('gambar') is-invalid @enderror" id="">
                                        @error('gambar')
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
            </div>
        </div>
    </div>=
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
        var myDate = document.querySelector('#tanggal-penyuluhan');
        myDate.onkeypress = function (evt) {
            var _evt = evt || windows.event;
            var keyCode = _evt.keyCode || _evt.charCode;
            var sKey = String.fromCharCode(keyCode);

            var text = this.value;
            var res = text.substring(0, 3);
            var res2 = text.substring(0,2);
            var res3  = text.substring(0,1);
            if(res === "000" || res2 === "00" || res3 ==="0"){
                return true;
            }else{
                if (text.length >= 9) {
                    return false;
                }
                else {
                    return true;
                }
            }

        };
    </script>
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush