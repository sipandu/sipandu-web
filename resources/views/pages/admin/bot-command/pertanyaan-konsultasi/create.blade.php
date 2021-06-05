@extends('layouts/admin/admin-layout')
@section('title', 'Tambah Pertanyaan Konsultasi')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Kegiatan Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item" aria-current="page">Setting Bot</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Pertanyaan Konsultasi</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('pertanyaan-konsultasi.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Setting Pertanyaan Konsultasi
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Command Pertanyaan</label>
                                            <input type="text" name="command_pertanyaan" class="form-control @error('command_pertanyaan') is-invalid @enderror"
                                            value="{{ old('command_pertanyaan') }}" placeholder="Command untuk pertanyaan" id="">
                                            @error('command_pertanyaan')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Command Jawaban</label>
                                            <input type="text" name="command_jawaban" class="form-control @error('command_jawaban') is-invalid @enderror"
                                            value="{{ old('command_jawaban') }}" placeholder="Command untuk jawaban" id="">
                                            @error('command_jawaban')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Chat Pertanyaan</label>
                                            <input type="text" name="chat_pertanyaan" class="form-control @error('chat_pertanyaan') is-invalid @enderror"
                                            value="{{ old('chat_pertanyaan') }}" placeholder="Chat untuk pertanyaan" id="">
                                            @error('chat_pertanyaan')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Chat Jawaban</label>
                                            <input type="text" name="chat_jawaban" class="form-control @error('chat_jawaban') is-invalid @enderror"
                                            value="{{ old('chat_jawaban') }}" placeholder="Chat untuk jawaban" id="">
                                            @error('chat_jawaban')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Key</label>
                                            <input type="text" name="key" class="form-control @error('key') is-invalid @enderror"
                                            value="{{ old('key') }}" placeholder="Key Command" id="">
                                            @error('key')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Parent</label>
                                            <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" id="">
                                                @foreach ($command as $item)
                                                    @if($item->hasNotChild())
                                                        <option value="{{ $item->getChildId() }}">{{ $item->command }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('parent_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Jenis Form</label>
                                            <select name="is_numeric" class="form-control @error('is_numeric') is-invalid @enderror" id="">
                                                <option value="0">Text</option>
                                                <option value="1">Numeric</option>
                                            </select>
                                            @error('is_numeric')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Satuan (Optional)</label>
                                            <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror"
                                            value="{{ old('satuan') }}" placeholder="Key Command" id="">
                                            @error('key')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary float-right" type="submit">Tambah</button>
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
        //   $('#list-admin-dashboard').removeClass('menu-open');
        //   $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
        //   $('#kegiatan').addClass('active');
        //   $('#tambah-kegiatan').addClass('active');
        });
    </script>
@endpush