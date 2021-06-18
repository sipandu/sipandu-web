@extends('layouts/admin/admin-layout')

@section('title', 'Data Admin')

@push('css')
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Admin</h1>
        <div class="col-auto ml-auto my-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Admin</li>
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
                            @permission('Tambah Admin')
                                <div class="col-6 my-auto">
                                    <h3 class="card-title my-auto">Daftar Admin</h3>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route("Tambah Admin") }}" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Tambah
                                    </a>
                                </div>
                            @else
                                <div class="col-12 my-auto">
                                    <h3 class="card-title my-auto">Daftar Admin</h3>
                                </div>
                            @endpermission
                        </div>
                    </div>
                    <div class="card-body table-responsive-xl">
                        <table id="tbAdmin" class="table table-responsive-lg table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Admin</th>
                                    <th>Nomor Telp</th>
                                    <th>Telegram</th>
                                    <th>Tempat Tugas</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( $admin != NULL)
                                    @foreach ($admin as $data)
                                        <tr class="text-center align-middle my-auto">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-start">{{ $data->nama_pegawai }}</td>
                                            <td class="align-middle">{{ $data->nomor_telepon ?? '-' }}</td>
                                            <td class="align-middle">{{ $data->username_telegram ?? '-' }}</td>
                                            <td class="align-middle">{{ $data->posyandu->nama_posyandu}}</td>
                                            @if ($data->admin->is_verified == '1')
                                                <td class="align-middle">Aktif</td>
                                            @else
                                                <td class="align-middle">Non Aktif</td>
                                            @endif
                                            @permission('Ubah Admin')
                                                <td class="text-center align-middle">
                                                    <a href="{{route('Detail Admin', $data->id)}}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if ($data->admin->is_verified == '1' && $data->admin->id != auth()->guard('admin')->user()->id)
                                                        @permission('Nonaktifkan Admin')
                                                            <button class="btn btn-danger btn-sm my-1" onclick="disableAccount('{{ $data->admin->id }}')">
                                                                <i class="fas fa-user-times"></i>
                                                            </button>
                                                        @endpermission
                                                    @endif
                                                </td>
                                            @else
                                                @if ($data->admin->is_verified == '1' && $data->admin->id != auth()->guard('admin')->user()->id)
                                                    @permission('Nonaktifkan Admin')
                                                        <td class="text-center align-middle">
                                                            <button class="btn btn-danger btn-sm my-1" onclick="disableAccount('{{ $data->admin->id }}')">
                                                                <i class="fas fa-user-times"></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td class="text-center align-middle">
                                                            -
                                                        </td>
                                                    @endpermission
                                                @endif
                                            @endpermission
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="disable-account" action="" method="POST">
        @csrf
    </form>
@endsection

@push('js')
    <script src="{{ url('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account').addClass('active');
            $('#data-admin').addClass('active');

            $("#tbAdmin").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari admin ...",
                    "emptyTable": "Tidak Terdapat Akun Admin",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)"
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });
        });

        function disableAccount(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menonaktifkan akun ? Akun yang telah dinonaktifkan tidak dapat dikembalikan kembali',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, nonaktifkan",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#disable-account').attr('action', "{{ route('Disable Admin Account', '') }}"+"/"+id);
                    $('#disable-account').submit();
                }
            })
        }
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                Swal.fire(
                    'Gagal',
                    '{{$message}}',
                    'error'
                )
            });
        </script>
    @endif

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                Swal.fire(
                    'Berhasil',
                    '{{$message}}',
                    'success'
                )
            });
        </script>
    @endif
@endpush
