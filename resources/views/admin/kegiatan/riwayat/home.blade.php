@extends('layouts/admin/admin-layout')

@section('title', 'Riwayat Kegiatan')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Riwayat Kegiatan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Kegiatan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#kegiatan-terlaksana" data-toggle="tab">Kegiatan Terlaksana</a></li>
                            <li class="nav-item"><a class="nav-link" href="#kegiatan-dibatalkan" data-toggle="tab">Kegiatan Dibatalkan</a></li>
                        </ul>
                    </div>
                    <div class="card-body table-responsive-md">
                        <div class="tab-content">
                            <div class="active tab-pane" id="kegiatan-terlaksana">
                                <table id="tbKegiatanTerlaksana" class="table table-bordered table-responsive-md table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Tempat</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Berakhir</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kegiatan_lewat as $item)
                                            <tr class="text-center">
                                                <td class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $item->nama_kegiatan }}</td>
                                                <td class="align-middle">{{ $item->tempat }}</td>
                                                <td class="align-middle">{{ date('d M Y', strtotime($item->start_at)) }}</td>
                                                <td class="align-middle">{{ date('d M Y', strtotime($item->end_at)) }}</td>
                                                <td class="text-center align-middle">
                                                    <a href="{{ route('riwayat_kegiatan.show', $item->id) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-images"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="statusPublikasi('{{ $item->id }}', '{{ $item->status }}')">
                                                        <i class="fas fa-external-link-square-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="kegiatan-dibatalkan">
                                <table id="tbKegiatanDibatalkan" class="table table-bordered table-responsive-md table-hover">
                                    <thead>
                                      <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Alasan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kegiatan_cancel as $item)
                                            <tr class="text-center">
                                                <td class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $item->nama_kegiatan }}</td>
                                                <td class="align-middle">{{ $item->tempat }}</td>
                                                <td class="align-middle">{{ date('d M Y', strtotime($item->start_at)) }}</td>
                                                <td class="align-middle">{{ date('d M Y', strtotime($item->end_at)) }}</td>
                                                <td class="align-middle">{{ $item->alasan_cancel }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.kegiatan.riwayat.dokumentasi.modal.publikasi');
@endsection

@push('js')
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
          $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
          $('#kegiatan').addClass('active');
          $('#riwayat-kegiatan').addClass('active');
        });

        $(function () {
            $('#tbKegiatanDibatalkan').DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Kegiatan Dibatalkan",
                    "sSearchPlaceholder": "Cari kegiatan dibatalkan ...",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya',
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });
        });

        $(function () {
            $('#tbKegiatanTerlaksana').DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Kegiatan Terlaksana",
                    "sSearchPlaceholder": "Cari kegiatan terlaksana ...",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya',
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });
        });

        function statusPublikasi(id, status) {
            $('#publikasi').modal('show');
            $('#formPublikasi').attr("action", "{{ route('Publikasi Dokumentasi', '') }}"+"/"+id);
            if (status == 'Tampil') {
                $('#statusPublikasi option').remove();
                $('#statusPublikasi').append(`<option selected value="${status}">${status}</option>`);
                $('#statusPublikasi').append(`<option value="Tidak Tampil">Tidak Tampil</option>`);
            } else if ( status == 'Tidak Tampil' ) {
                $('#statusPublikasi option').remove();
                $('#statusPublikasi').append(`<option selected value="${status}">${status}</option>`);
                $('#statusPublikasi').append(`<option value="Tampil">Tampil</option>`);
            } else if ( status == '') {
                $('#statusPublikasi option').remove();
                $('#statusPublikasi').append(`<option selected disable>Pilih status publikasi</option>`);
                $('#statusPublikasi').append(`<option value="Tampil">Tampil</option>`);
                $('#statusPublikasi').append(`<option value="Tidak Tampil">Tidak Tampil</option>`);
            }
        }
    </script>

    @if($message = Session::get('failed'))
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
