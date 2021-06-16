@extends('layouts/admin/admin-layout')

@section('title', 'Detail Hak Akses')

@push('css')
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/select2/css/select2.min.css')}}">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 col-lg-auto text-center my-auto text-md-start">Detail Hak Akses</h1>
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
                        @permission('Tambah Hak Akses')
                            <div class="col-sm-12 col-md-6 my-auto d-flex justify-content-center justify-content-md-start">
                                <h3 class="card-title my-auto">Hak Akses {{ $permission->nama_permission }}</h3>
                            </div>
                            <div class="col-sm-12 col-md-6 my-1 d-flex justify-content-center justify-content-md-end">
                                <button class="btn btn-success my-1" type="button" data-bs-toggle="collapse" data-bs-target="#tambahPermission" aria-expanded="false" aria-controls="tambahPermission">
                                    <i class="fa fa-user-lock"></i> Tambah Pengguna Akses
                                </button>
                            </div>
                        @else
                            <div class="col-12 my-auto d-flex justify-content-center justify-content-md-start">
                                <h3 class="card-title my-auto">Hak Akses {{ $permission->nama_permission }}</h3>
                            </div>
                        @endpermission
                    </div>
                    @permission('Tambah Hak Akses')
                        <div class="collapse my-4" id="tambahPermission">
                            <div class="card card-body d-flex justify-content-end">
                                <form action="{{ route('Simpan Permission', $permission->id) }}" method="POST" class="needs-validation my-auto" novalidate>
                                    @csrf
                                    <div class="row my-auto">
                                        <div class="col-sm-12 col-md-9 py-1">
                                            <select class="select2 form-control @error('admin[]') is-invalid @enderror" multiple="multiple" name="admin[]" data-placeholder="Pilih akun admin" required style="width: 100%">
                                                @foreach ($admin as $data)
                                                    {{-- @if (!in_array($data->id, $id_admin)) --}}
                                                        <option value="{{ $data->id }}">{{ $data->email }}</option>
                                                    {{-- @endif --}}
                                                @endforeach
                                            </select>                                    
                                        </div>
                                        <div class="col-sm-12 col-md-3 d-grid py-1">
                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Tambahkan</button>
                                        </div>
                                        @error('admin[]')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Akun Admin Wajib Dipilih
                                            </div>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endpermission
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
                                    @permission('Hapus Hak Akses')
                                        @if ($data->id_admin != auth()->guard('admin')->user()->id)
                                            <td class="text-center align-middle d-md-none">
                                                <button onclick="hapusAkses('{{$data->id}}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                <button onclick="hapusAkses('{{$data->id}}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus Hak Akses
                                                </button>
                                            </td>
                                            <form action="" id="hapus-akses" method="POST" class="d-inline" hidden>
                                                @csrf
                                            </form>
                                        @else
                                            <td class="text-center align-middle d-md-none">
                                                -
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                -
                                            </td>
                                        @endif
                                    @else
                                        <td class="text-center align-middle d-md-none">
                                            -
                                        </td>
                                        <td class="text-center align-middle d-none d-md-table-cell">
                                            -
                                        </td>
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
@endsection

@push('js')
    <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#permission').addClass('active');

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
            
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        function hapusAkses(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus akses pengguna ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-akses').attr('action', "{{ route('Hapus Akses', '') }}"+"/"+id);
                    $('#hapus-akses').submit();
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

