@extends('layouts/admin/admin-layout')

@section('title', 'Data Anggota Posyandu')

@push('css')
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Anggota Posyandu</h1>
            <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-2">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 my-1">
                                <ul class="nav nav-pills d-flex justify-content-center justify-content-md-start">
                                    <li class="nav-item"><a class="nav-link active" href="#tbIbu" data-toggle="tab">Ibu Hamil</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tbAnak" data-toggle="tab">Anak</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tbLansia" data-toggle="tab">Lansia</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-end my-1">
                                <a href="{{ route("Tambah Anggota") }}" class="btn btn-success">
                                    <i class="fa fa-plus"></i> 
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive-md">
                        <div class="tab-content">
                            <div class="active tab-pane" id="tbIbu">
                                <table id="dataIbu" class="table table-responsive-md table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Ibu</th>
                                            <th>Nomor Telp</th>
                                            <th>Username Telegram</th>
                                            <th>Lokasi Posyandu</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ( $ibu != NULL)
                                            @foreach ($ibu as $data)
                                                <tr class="text-center align-middle my-auto">
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle text-start">{{ $data->nama_ibu_hamil }}</td>
                                                    <td class="align-middle">{{ $data->nomor_telepon ?? '-' }}</td>
                                                    <td class="align-middle">{{ $data->username_telegram ?? '-' }}</td>
                                                    <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                                                    @if ($data->user->status == '1')
                                                        <td class="align-middle">Aktif</td>
                                                    @else
                                                        <td class="align-middle">Non Aktif</td>
                                                    @endif
                                                    <td class="text-center align-middle">
                                                        <a href="{{route('Detail Anggota Bumil', $data->id)}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-danger btn-sm my-1" onclick="disableAccount('{{ $data->user->id }}')">
                                                            <i class="fas fa-user-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tbAnak">
                                <table id="dataAnak" class="table table-responsive-md table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Anak</th>
                                            <th>Nomor Telp</th>
                                            <th>Username</th>
                                            <th>Lokasi Posyandu</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ( $anak != NULL)
                                            @foreach ($anak as $data)
                                                <tr class="text-center align-middle my-auto">
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle text-start">{{ $data->nama_anak }}</td>
                                                    <td class="align-middle">{{ $data->nomor_telepon ?? '-' }}</td>
                                                    <td class="align-middle">{{ $data->username_telegram ?? '-' }}</td>
                                                    <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                                                    @if ($data->user->status == '1')
                                                        <td class="align-middle">Aktif</td>
                                                    @else
                                                        <td class="align-middle">Non Aktif</td>
                                                    @endif
                                                    <td class="text-center align-middle">
                                                        <a href="{{route('Detail Anggota Anak', $data->id)}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-danger btn-sm my-1" onclick="disableAccount('{{ $data->user->id }}')">
                                                            <i class="fas fa-user-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tbLansia">
                                <table id="dataLansia" class="table table-responsive-sm table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lansia</th>
                                            <th>Golongan</th>
                                            <th>Lokasi Posyandu</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ( $lansia != NULL )
                                            @foreach ($lansia as $data)
                                                <tr class="text-center align-middle my-auto">
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $data->nama_lansia }}</td>
                                                    <td class="align-middle">{{ $data->status }}</td>
                                                    <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                                                    @if ($data->user->status == '1')
                                                        <td class="align-middle">Aktif</td>
                                                    @else
                                                        <td class="align-middle">Non Aktif</td>
                                                    @endif
                                                    <td class="text-center align-middle">
                                                        <a href="{{route('Detail Anggota Lansia', $data->id)}}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-danger btn-sm my-1" onclick="disableAccount('{{ $data->user->id }}')">
                                                            <i class="fas fa-user-times"></i>
                                                        </button>
                                                    </td>
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
        </div>
    </div>
    <form id="disable-account" action="" method="POST">
        @csrf
    </form>
@endsection

@push('js')
    <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account').addClass('active');
            $('#data-anggota').addClass('active');

            $("#dataLansia").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari lansia ...",
                    "emptyTable": "Tidak Terdapat Akun Lansia",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });

            $("#dataAnak").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari anak ...",
                    "emptyTable": "Tidak Terdapat Akun Anak",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                    "previous": 'Sebelumnya',
                    "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });

            $("#dataIbu").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari ibu hamil ...",
                    "emptyTable": "Tidak Terdapat Akun Ibu Hamil",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
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
                    $('#disable-account').attr('action', "{{ route('Disable Anggota Account', '') }}"+"/"+id);
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
