@extends('layouts/admin/admin-layout')
@section('title', 'Manajemen Pertanyaan Konsultasi')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Pertanyaan Konsultasi</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item" aria-current="page">Setting Bot</li>
                    <li class="breadcrumb-item active" aria-current="page">Pertanyaan Konsultasi</li>
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
                          <h3 class="card-title my-auto">Data Command Pertanyaan Konsultasi</h3>
                      </div>
                      <div class="col-6">
                          <a class="btn btn-success float-right" href="{{ route('pertanyaan-konsultasi.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                      </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive-md">
                <table id="data" class="table table-bordered table-hover">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Parent</th>
                      <th>Command Pertanyaan</th>
                      <th>Command Jawaban</th>
                      <th>Chat</th>
                      <th>Jenis</th>
                      <th>Key</th>
                      <th style="width: 100px;">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($command as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->getParent() }}</td>
                            <td>{{ $item->command }}</td>
                            <td>{{ $item->getAnswerCommand() }}</td>
                            <td>{{ $item->chat }}</td>
                            <td>{{ $item->cekJenis() }}</td>
                            <td>{{ $item->key }}</td>
                            <td>
                                <a href="{{ route('pertanyaan-konsultasi.show', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                @if($item->parent_id != NULL)
                                    <a href="{{ route('pertanyaan-konsultasi.kosongkan', $item->id) }}" class="btn btn-sm btn-success" title="kosongkan parent"><i class="fas fa-unlink"></i></a>
                                @else
                                    <button class="btn btn-sm btn-primary" onclick="addParent('{{ $item->id }}')" title="tambah parent"><i class="fas fa-link"></i></button>
                                @endif
                                <button class="btn btn-sm btn-danger" onclick="deleteCommand('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
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
  <!-- Modal -->
<div class="modal fade" id="add-parent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Parent</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pertanyaan-konsultasi.add-parent') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id-add-parent">
                <div class="form-group">
                    <label for="">Parent</label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" id="">
                        @foreach ($command as $item)
                            @if($item->hasNotChild())
                                <option value="{{ $item->getChildId() }}">{{ $item->command }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <form id="form-delete" action="{{ route('pertanyaan-konsultasi.delete') }}" method="POST">
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
