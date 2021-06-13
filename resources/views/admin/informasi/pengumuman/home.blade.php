@extends('layouts/admin/admin-layout')
@section('title', 'Manajemen Pengumuman')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Pengumuman</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
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
                            @permission('Tambah Pengumuman')
                                <div class="col-6 my-auto">
                                    <h3 class="card-title my-auto">Data Pengumuman</h3>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-success float-right" href="{{ route('pengumuman.create') }}">
                                        <i class="fa fa-plus"></i>
                                        Tambah
                                    </a>
                                </div>
                            @else
                                <div class="col-6 my-auto">
                                    <h3 class="card-title my-auto">Data Pengumuman</h3>
                                </div>
                            @endpermission
                        </div>
                    </div>
                    <div class="card-body table-responsive-sm">
                        <table id="tbPengumuman" class="table table-bordered table-responsive-sm table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th class="d-md-none">Tindakan</th>
                                    <th class="d-none d-md-table-cell">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengumuman as $item)
                                    <tr class="text-center">
                                        <td class="fw-normal align-middle">{{ $loop->iteration }}</td>
                                        <td class="fw-normal align-middle">{{ $item->judul_pengumuman }}</td>
                                        <td class="fw-normal align-middle">{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                                        @permission('Ubah Pengumuman')
                                            <td class="fw-normal align-middle d-md-none">
                                                <a href="{{ route('pengumuman.show', $item->id) }}" class="btn btn-primary btn-sm my-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @permission('Hapus Pengumuman')
                                                    <button class="btn btn-danger btn-sm my-1" onclick="hapusPengumuman('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endpermission
                                            </td>
                                            <td class="fw-normal align-middle d-none d-md-table-cell">
                                                <a href="{{ route('pengumuman.show', $item->id) }}" class="btn btn-primary btn-sm my-1">
                                                    <i class="fas fa-eye"></i>
                                                    Detail
                                                </a>
                                                @permission('Hapus Pengumuman')
                                                    <button class="btn btn-danger btn-sm my-1" onclick="hapusPengumuman('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                @endpermission
                                            </td>
                                        @else
                                            @permission('Hapus Pengumuman')
                                                <td class="fw-normal align-middle d-md-none">
                                                    <button class="btn btn-danger btn-sm my-1" onclick="hapusPengumuman('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td class="fw-normal align-middle d-none d-md-table-cell">
                                                    <button class="btn btn-danger btn-sm my-1" onclick="hapusPengumuman('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </td>
                                            @else
                                                <td class="fw-normal align-middle d-md-none">
                                                    -
                                                </td>
                                                <td class="fw-normal align-middle d-none d-md-table-cell">
                                                    -
                                                </td>
                                            @endpermission
                                        @endpermission
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="hapus-pengumuman" action="" method="POST">
        @csrf
    </form>
@endsection

@push('js')
    <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#pengumuman').addClass('active');
        });

        $(function () {
            $('#tbPengumuman').DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Pengumuman",
                    "sSearchPlaceholder": "Cari pengumuman ...",
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

        function hapusPengumuman(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus Pengumuman ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-pengumuman').attr('action', "{{ route('pengumuman.delete', '') }}"+"/"+id);
                    $('#hapus-pengumuman').submit();
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