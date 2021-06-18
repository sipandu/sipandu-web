@extends('layouts/admin/admin-layout')

@section('title', 'Konfirmasi Anggota')

@push('css')
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Konfirmasi Anggota Posyandu</h1>
        <div class="col-auto ml-auto text-right my-auto mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konfirmasi Anggota</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Anggota</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="nav flex-column nav-pills card-body p-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item d-grid">
                                        <button class="nav-link btn btn-info active text-left" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        <i class="fas fa-female nav-icon"></i> Ibu Hamil
                                            @if ($ibu != NULL && $ibu->count() > 0)
                                                <span class="badge bg-warning float-right">{{ $ibu->count() }}</span>
                                            @endif
                                        </button>
                                    </li>
                                    <li class="nav-item d-grid">
                                        <button class="nav-link text-left btn btn-info" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                        <i class="fas fa-child nav-icon"></i> Anak
                                            @if ($anak != NULL && $anak->count() > 0)
                                                <span class="badge bg-warning float-right">{{ $anak->count() }}</span>
                                            @endif
                                        </button>
                                    </li>
                                    <li class="nav-item d-grid">
                                        <button class="nav-link text-left btn btn-info" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                        <i class="fas fa-wheelchair nav-icon"></i> Lanjut Usia
                                            @if ($lansia != NULL && $lansia->count() > 0)
                                                <span class="badge bg-warning float-right">{{ $lansia->count() }}</span>
                                            @endif
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                            <div class="card-header my-auto">
                                <h3 class="card-title my-auto">Permintaan Verifikasi</h3>
                            </div>
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="card-body p-0">
                                    <div class="mailbox-messages p-2">
                                        <table id="tbBumil" class="table table-bordered table-responsive-md table-hover">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Bumil</th>
                                                    <th>Nama Suami</th>
                                                    <th>Mendaftar Pada</th>
                                                    <th class="d-md-none">Tindakan</th>
                                                    <th class="d-none d-md-table-cell">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($ibu != NULL)
                                                    @foreach ($ibu as $data)
                                                        <tr class="text-center align-middle my-auto">
                                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                                            <td class="align-middle">{{ $data->nama_ibu_hamil }}</td>
                                                            <td class="align-middle">{{ $data->nama_suami ?? '-' }}</td>
                                                            <td class="align-middle">{{ date('d-M-Y', strtotime($data->created_at)) }}</td>
                                                            <td class="text-center align-middle d-md-none">
                                                                <a href="{{ route('Detail Verifikasi Bumil', $data->user->id) }}" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check-square"></i>
                                                                </a>
                                                            </td>
                                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                                <a href="{{ route('Detail Verifikasi Bumil', $data->user->id) }}" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check-square"></i>
                                                                    Verifikasi
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="card-body p-0">
                                    <div class="mailbox-messages p-2">
                                        <table id="tbAnak" class="table table-bordered table-responsive-md table-hover">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Anak</th>
                                                    <th>Nama Ibu</th>
                                                    <th>Mendaftar Pada</th>
                                                    <th class="d-md-none">Tindakan</th>
                                                    <th class="d-none d-md-table-cell">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($anak != NULL)
                                                    @foreach ($anak as $data)
                                                        <tr class="text-center align-middle my-auto">
                                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                                            <td class="align-middle">{{ $data->nama_anak }}</td>
                                                            <td class="align-middle">{{ $data->nama_ibu ?? '-' }}</td>
                                                            <td class="align-middle">{{ date('d M Y', strtotime($data->created_at)) }}</td>
                                                            <td class="text-center align-middle d-md-none">
                                                                <a href="{{ route('Detail Verifikasi Anak', $data->user->id) }}" class="btn btn-success btn-sm">
                                                                <i class="fas fa-check-square"></i>
                                                                </a>
                                                            </td>
                                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                                <a href="{{ route('Detail Verifikasi Anak', $data->user->id) }}" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check-square"></i>
                                                                Verifikasi
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div class="card-body p-0">
                                    <div class="mailbox-messages p-2">
                                        <table id="tbLansia" class="table table-bordered table-responsive-md table-hover">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lansia</th>
                                                    <th>Kategori</th>
                                                    <th>Mendaftar Pada</th>
                                                    <th class="d-md-none">Tindakan</th>
                                                    <th class="d-none d-md-table-cell">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($lansia != NULL)
                                                    @foreach ($lansia as $data)
                                                        <tr class="text-center align-middle my-auto">
                                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                                            <td class="align-middle">{{ $data->nama_lansia }}</td>
                                                            <td class="align-middle">{{ $data->status ?? '-' }}</td>
                                                            <td class="align-middle">{{ date('d-M-Y', strtotime($data->created_at)) }}</td>
                                                            <td class="text-center align-middle d-md-none">
                                                                <a href="{{ route('Detail Verifikasi Lansia', $data->user->id) }}" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check-square"></i>
                                                                </a>
                                                            </td>
                                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                                <a href="{{ route('Detail Verifikasi Lansia', $data->user->id) }}" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check-square"></i>
                                                                    Verifikasi
                                                                </a>
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
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ url('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#account-setting').addClass('menu-is-opening menu-open');
            $('#setting').addClass('active');
            $('#verify-anggota').addClass('active');

            $("#tbBumil").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data ...",
                    "emptyTable": "Tidak Terdapat Akun Ibu Hamil Untuk Diverifikasi",
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
    
            $("#tbAnak").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data ...",
                    "emptyTable": "Tidak Terdapat Akun Anak Untuk Diverifikasi",
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
    
            $("#tbLansia").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data ...",
                    "emptyTable": "Tidak Terdapat Akun Lansia Untuk Diverifikasi",
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

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('error'))
        <script>
            $(document).ready(function(){
                alertError('{{$message}}');
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
