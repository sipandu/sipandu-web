@extends('layouts/admin/admin-layout')

@section('title', 'Manajemen Informasi Penting')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Informasi Penting</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi Penting</li>
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
                              <h3 class="card-title my-auto">Data Informasi Penting</h3>
                          </div>
                          <div class="col-6">
                              <a class="btn btn-success float-right" href="{{ route('informasi_penting.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                          </div>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive-md">
                    <table id="data" class="table table-bordered table-hover">
                      <thead>
                        <tr class="text-center">
                          <th>No</th>
                          <th>Judul</th>
                          <th>Tanggal</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($informasi as $item)
                              <tr class="text-center">
                                  <th class="fw-normal align-middle">{{ $loop->iteration }}</th>
                                  <th class="fw-normal align-middle">{{ $item->judul_informasi }}</th>
                                  <th class="fw-normal align-middle">{{ date('d F Y', strtotime($item->tanggal)) }}</th>
                                  <th class="fw-normal align-middle">
                                      <a href="{{ route('informasi_penting.show', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                      <button class="btn btn-danger btn-sm" onclick="deletePenyuluhan('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                                  </th class="align-middle">
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <form id="form-delete" action="{{ route('informasi_penting.delete') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="id-delete">
    </form>
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
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#informasi-penting').addClass('active');
        });

        $(function () {
            $('#data').DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Informasi",
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

        function deletePenyuluhan(id){
            $('#id-delete').val(id);
            swal({
                title: 'Anda yakin ingin menghapus data?',
                text: 'Data yang dihapus tidak akan bisa dikembalikan lagi!',
                icon: 'warning',
                buttons: ["Tidak", "Ya"],
            }).then(function(value) {
                if (value) {
                    $('#form-delete').submit();
                }
            });
        }
    </script>
    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush