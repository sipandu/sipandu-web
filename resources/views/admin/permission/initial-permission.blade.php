@extends('layouts/admin/admin-layout')

@section('title', 'Detail Hak Akses')

@push('css')
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{url('base-template/plugins/select2/css/select2.min.css')}}">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 col-lg-auto text-center text-md-start">Detail Hak Akses</h1>
    <div class="col-auto ml-auto text-right mt-n1">
    <nav aria-label="breadcrumb text-center">
        <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Semua Permission') }}">Hak Akses</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
    </div>
</div>
<div class="container-fluid px-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 my-auto d-flex justify-content-center justify-content-md-start">
                            <h3 class="card-title my-auto">Hak Akses {{ $permission->nama_permission }}</h3>
                        </div>
                        <div class="col-sm-12 col-md-6 my-1 d-flex justify-content-center justify-content-md-end">
                            <button class="btn btn-success my-1" type="button" data-bs-toggle="collapse" data-bs-target="#tambahPermission" aria-expanded="false" aria-controls="tambahPermission">
                                <i class="fa fa-user-lock"></i> Tambah Pengguna Akses
                            </button>
                        </div>
                    </div>
                    <div class="collapse my-4" id="tambahPermission">
                        <div class="card card-body d-flex justify-content-end">
                            <form action="{{ route('Simpan Tag') }}" method="POST" class="needs-validation my-auto" novalidate>
                                @csrf
                                <div class="row my-auto">
                                    <div class="col-sm-12 col-md-9 py-1">
                                        <select class="select2 form-control @error('tag_berita[]') is-invalid @enderror" multiple="multiple" name="tag_berita[]" data-placeholder="Pilih tag berita" required style="width: 100%">
                                            @foreach ($admin as $data)
                                                @if (!in_array($data->id, $id_admin))
                                                    <option value="{{ $data->id }}">{{ $data->email }}</option>
                                                @endif
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <div class="col-sm-12 col-md-3 d-grid py-1">
                                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Tambahkan</button>
                                    </div>
                                    @error('nama_tag')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Nama Tag Wajib Diisi
                                        </div>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive-md">
                    <table id="tbInitialPermission" class="table table-bordered table-responsive-sm table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Email Pengguna</th>
                                <th class="d-md-none">Tindakan</th>
                                <th class="d-none d-md-table-cell">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin_permission as $data)
                            <tr class="text-center align-middle my-auto">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $data->admin->email }}</td>
                                <td class="text-center align-middle d-md-none">
                                    <button onclick="hapusTag()" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td class="text-center align-middle d-none d-md-table-cell">
                                    <button onclick="hapusTag()" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                        Hapus Hak Akses
                                    </button>
                                </td>
                                <form action="{{ route('Hapus Tag', $data->id) }}" id="hapus-tag" method="POST" class="d-inline">
                                    @csrf
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{url('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#permission').addClass('active');
    });

    $(function () {
        $("#tbInitialPermission").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": false,
        "oLanguage": {
            "sSearch": "Cari:",
            "sZeroRecords": "Data Tidak Ditemukan",
            "emptyTable": "Tidak Terdapat Pengguna Hak Akses",
            "sSearchPlaceholder": "Cari pengguna hak akses ...",
            "infoEmpty": "Menampilkan 0 Data",
            "infoFiltered": "(dari _MAX_ data)",
        },
        "language": {
            "paginate": {
            "previous": 'Sebelumnya',
            "next": 'Berikutnya'
            },
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
        }
        });
    });

    $(function () {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>
@endpush

