@extends('layouts/admin/admin-layout')
@section('title', 'Tambah Pertanyaan Konsultasi')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Edit Child Command</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item" aria-current="page">Setting Bot</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Command Menu</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('pertanyaan-satu-arah.update', $command->id) }}" enctype="multipart/form-data" method="POST">
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
                                        <div class="form-group col-md-12 col-12">
                                            <label for="">Command</label>
                                            <input type="text" name="command" readonly class="form-control @error('command') is-invalid @enderror"
                                            value="{{ old('command') ?? $command->command }}" placeholder="Command Bot Telegram" id="">
                                            @error('command')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label for="">Chat Balasan</label>
                                            <textarea name="chat" class="form-control @error('chat') is-invalid @enderror" id="" cols="30" rows="5">{{ old('chat') ?? $command->chat }}</textarea>
                                            @error('chat')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label for="">Deskripsi Fitur</label>
                                            <textarea name="desc_fitur" class="form-control @error('desc_fitur') is-invalid @enderror" id="" cols="30" rows="5">{{ old('desc_fitur') ?? $command->desc_fitur }}</textarea>
                                            @error('desc_fitur')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary float-right" type="submit">Update</button>
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