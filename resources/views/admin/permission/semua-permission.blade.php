@extends('layouts/admin/admin-layout')

@section('title', 'Hak Akses')

@push('css')
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush


@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 col-lg-auto text-center text-md-start">Hak Akses Pengguna</h1>
    <div class="col-auto ml-auto my-auto text-right mt-n1">
        <nav aria-label="breadcrumb text-center">
            <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hak Akses</li>
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
                        <div class="col-12 my-auto">
                            <h3 class="card-title my-auto">Daftar Hak Akses</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive-md">
                    <table id="tbPermission" class="table table-bordered table-responsive-sm table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Hak Akses</th>
                                <th>Pengguna Akses</th>
                                <th class="d-md-none">Tindakan</th>
                                <th class="d-none d-md-table-cell">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permission as $data)
                                <tr class="text-center align-middle my-auto">
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $data->nama_permission }}</td>
                                    <td class="align-middle">
                                        {{$admin_permission->where('id_permission', $data->id)->count()}}
                                        Pengguna
                                    </td>
                                    <td class="text-center align-middle d-md-none">
                                        <a href="{{ route('Initial Permission', $data->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-user-lock"></i>
                                        </a>
                                    </td>
                                    <td class="text-center align-middle d-none d-md-table-cell">
                                        <a href="{{ route('Initial Permission', $data->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-user-lock"></i>
                                            Detail Akses
                                        </a>
                                    </td>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#permission').addClass('active');
    });

    $(function () {
        $("#tbPermission").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": false,
        "oLanguage": {
            "sSearch": "Cari:",
            "sZeroRecords": "Data Tidak Ditemukan",
            "emptyTable": "Tidak Terdapat Hak Akses Pengguna",
            "sSearchPlaceholder": "Cari hak akses ...",
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
</script>
@endpush

