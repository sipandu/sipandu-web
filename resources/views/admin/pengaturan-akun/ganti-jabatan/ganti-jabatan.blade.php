@extends('layouts/admin/admin-layout')

@section('title', 'Ganti Jabatan')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Ganti Jabatan Pegawai</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ganti Jabatan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header my-auto">
                        <h3 class="card-title my-auto">Ganti Jabatan Pegawai</h3>
                    </div>
                    <form action="{{ route('Update Jabatan') }}" method="POST">
                        @csrf
                        <div class="modal-body p-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                <div class="form-group">
                                    <label for="pegawai">Nama Pegawai<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <select name="pegawai" class="form-control select2 kabupaten @error('pegawai') is-invalid @enderror" id="pegawai">
                                            <option value="#" disabled selected>Pilih pegawai ...</option>
                                            @foreach ($pegawai as $pgw)
                                                @if ($pgw->admin->id != auth()->guard('admin')->user()->id)
                                                    <option value="{{ $pgw->id }}">{{ $pgw->nama_pegawai }}, {{ $pgw->admin->email }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-shield"></span>
                                            </div>
                                        </div>
                                        @error('pegawai')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan Baru<span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                        <select name="jabatan" class="form-control select2 kabupaten @error('jabatan') is-invalid @enderror" id="jabatan">
                                            <option value="#" disabled selected>Pilih jabatan ...</option>
                                            <option value="admin">Admin</option>
                                            <option value="kader">Kader</option>
                                            <option value="head admin">Tenaga Kesehatan</option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-user-tag"></span>
                                            </div>
                                        </div>
                                        @error('jabatan')
                                            <div class="invalid-feedback text-start">
                                            {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <p class="text-danger small text-end mb-0 pb-0"><span>*</span>Data Wajib Diisi</p>
                                </div> 
                            </div>
                        </div>
                        <div class="modal-footer text-end">
                            <button type="submit" class="btn btn-sm btn-outline-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('base-template/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#account-setting').addClass('menu-is-opening menu-open');
            $('#setting').addClass('active');
            $('#ganti-jabatan').addClass('active');

            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush