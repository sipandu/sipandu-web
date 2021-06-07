@extends('layouts/admin/admin-layout')
@section('title', 'Manajemen Pertanyaan Konsultasi')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Command Child</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item" aria-current="page">Setting Bot</li>
                    <li class="breadcrumb-item active" aria-current="page">Command Menu</li>
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
                      <div class="col-12 my-auto">
                          <h3 class="card-title my-auto">Data Child Command</h3>
                      </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive-md">
                <table id="data" class="table table-bordered table-hover">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Command</th>
                      <th>Chat</th>
                      <th style="width: 100px;">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($command as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->command }}</td>
                            <td>{{ $item->chat }}</td>
                            <td class="text-center">
                                <a href="{{ route('pertanyaan-satu-arah.child.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
        //   $('#list-admin-dashboard').removeClass('menu-open');
        //   $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
        //   $('#kegiatan').addClass('active');
        //   $('#tambah-kegiatan').addClass('active');
        });

        function addParent(id) {
            $('#id-add-parent').val(id);
            $('#add-parent').modal('show');
        }

        $(function () {
            $('#data').DataTable({
              "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Kegiatan Posyandu",
                    "sSearchPlaceholder": "Cari kegiatan posyandu....",
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
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        function deleteCommand(id){
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
