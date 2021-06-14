@extends('layouts/admin/admin-layout')

@section('title', 'Semua Imunisasi')

@push('css')
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush


@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Imunisasi</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Imunisasi</li>
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
                            <div class="col-12 d-flex jutify-content-center justify-content-md-start my-auto">
                                <h3 class="card-title my-auto">Daftar Jenis Imunisasi</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive-md">
                        <table id="tbImunisasi" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Imunisasi</th>
                                    <th>Kategori</th>
                                    <th>Perulangan</th>
                                    <th>Penerima</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imunisasi as $data)
                                    <tr class="text-center align-middle my-auto">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $data->nama_imunisasi }}</td>
                                        <td class="align-middle">{{ $data->status }}</td>
                                        <td class="align-middle">{{ $data->perulangan }}</td>
                                        <td class="align-middle">{{ $data->penerima }}</td>
                                        @permission('Ubah Imunisasi')
                                            <td class="text-center align-middle">
                                                <a href="{{route('Detail Imunisasi', $data->id)}}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @permission('Hapus Imunisasi')
                                                    <button class="btn btn-sm btn-danger" type="button" onclick="hapusImunisasi('{{ $data->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endpermission
                                            </td>
                                        @else
                                            @permission('Hapus Imunisasi')
                                                <td class="text-center align-middle">
                                                    <button class="btn btn-sm btn-danger" type="button" onclick="hapusImunisasi('{{ $data->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td class="text-center align-middle">
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
    <form id="hapus-imunisasi" action="" method="POST">
        @csrf
    </form>
@endsection

@push('js')
    <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-imunisasi').addClass('menu-is-opening menu-open');
            $('#imunisasi').addClass('active');
            $('#jenis-imunisasi').addClass('active');

            $("#tbImunisasi").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Imunisasi",
                    "sSearchPlaceholder": "Cari imunisasi....",
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

        function hapusImunisasi(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus jenis imunisasi ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-imunisasi').attr('action', "{{ route('Hapus Imunisasi', '') }}"+"/"+id);
                    $('#hapus-imunisasi').submit();
                }
            })
        }
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                Swal.fire(
                'Berhasil',
                '{{$message}}',
                'failed'
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

