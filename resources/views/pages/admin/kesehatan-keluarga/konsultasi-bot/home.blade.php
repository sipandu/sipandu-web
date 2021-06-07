@extends('layouts/admin/admin-layout')

@section('title', 'Konsultasi Bot')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Konsultasi Bot</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konsultasi Bot</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-6 my-auto">
                              <h3 class="card-title my-auto">Data Konsultasi Bot</h3>
                          </div>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive-md">
                    <table id="data" class="table table-bordered table-hover">
                      <thead>
                        <tr class="text-center">
                          <th>Tanggal</th>
                          <th>Nama Pasien</th>
                          <th>Status</th>
                          <th>Status Terkirim</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($data_konsultasi as $kon_item)
                            @foreach ($kon_item as $item)
                                <tr class="text-center">
                                    <th class="fw-normal align-middle">{{ $item->nama_pasien }}</th>
                                    <th class="fw-normal align-middle">{{ date('d F Y', strtotime($item->tanggal)) }}</th>
                                    <th class="fw-normal align-middle">{{ $item->cekStatus() }}</th>
                                    <th class="fw-normal align-middle">{{ $item->cekStatusTerkirim() }}</th>
                                    <th class="fw-normal align-middle">
                                        @if($item->is_confirm != '0')
                                        @if($item->is_sent != '1')
                                            <a href="{{ route('konsultasi-bot.sent-to-user', $item->id) }}" class="btn btn-sm btn-primary"><i class="fab fa-telegram-plane"></i></a>
                                        @endif
                                        @endif
                                        <a href="{{ route('konsultasi-bot.show', $item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                    </th class="align-middle">
                                </tr>
                            @endforeach
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
    <!-- DataTables  & Plugins -->
    <script src="{{url('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#konsultasi-bot').addClass('active');
        });

        $(function () {
            $('#data').DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Konsultasi Bot",
                    "sSearchPlaceholder": "Cari informasi....",
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
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush