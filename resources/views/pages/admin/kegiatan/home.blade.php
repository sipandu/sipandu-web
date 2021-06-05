@extends('layouts/admin/admin-layout')
@section('title', 'Manajemen Kegiatan')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Kegiatan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
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
                          <h3 class="card-title my-auto">Data Kegiatan</h3>
                      </div>
                      <div class="col-6">
                          <a class="btn btn-success float-right" href="{{ route('kegiatan.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                      </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive-md">
                <table id="data" class="table table-bordered table-hover">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Nama Kegiatan</th>
                      <th>Tempat</th>
                      <th>Tgl Mulai</th>
                      <th>Tgl Berakhir</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($kegiatan as $item)
                          <tr class="text-center">
                              <td class="align-middle">{{ $loop->iteration }}</td>
                              <td class="align-middle">{{ $item->nama_kegiatan }}</td>
                              <td class="align-middle">{{ $item->tempat }}</td>
                              <td class="align-middle">{{ date('d M Y', strtotime($item->start_at)) }}</td>
                              <td class="align-middle">{{ date('d M Y', strtotime($item->end_at)) }}</td>
                              <td class="align-middle">
                                  <a href="{{ route('kegiatan.show', $item->id) }}" class="btn btn-warning btn-sm my-1">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <button class="btn btn-primary btn-sm my-1" onclick="broadcastMessage('{{ $item->id }}')"><i class="fab fa-telegram"></i></button>
                                  <button class="btn btn-danger btn-sm my-1" onclick="deleteKegiatan('{{ $item->nama_kegiatan }}', '{{ $item->id }}')"><i class="fas fa-trash"></i></button>
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
  <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-delete-label">Batalkan Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('kegiatan.delete') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="id-delete">
            <div class="form-group">
              <label for="">Nama Kegiatan</label>
              <input type="text" class="form-control" name="" id="nama-kegiatan" readonly>
            </div>
            <div class="form-group">
              <label for="">Pesan Pembatalan</label>
              <textarea name="alasan" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
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
          $('#list-admin-dashboard').removeClass('menu-open');
          $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
          $('#kegiatan').addClass('active');
          $('#tambah-kegiatan').addClass('active');
        });

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

        function broadcastMessage(id){
            swal({
                title: 'Anda yakin ingin membroadcast kegiatan?',
                text: 'Pesan akan dikirimkan ke semua grup posyandu mengenai kegiatan yang berlangsung',
                icon: 'warning',
                buttons: ["Tidak", "Ya"],
            }).then(function(value) {
                if (value) {
                  broadcast(id);
                }
            });
        }

        function deleteKegiatan(nama, id){
          $('#id-delete').val(id);
          $('#nama-kegiatan').val(nama);
          $('#delete-modal').modal('show');
        }

        function broadcast(id){
          var url = '/admin/kegiatan/broadcast/'+id;
          $.ajax({
            url: url,
            method: 'GET',
            success: function(response){
              if(response.success){
                var msg = 'Pesan telegram berhasil dibroadcast';
                alertSuccess(msg);
              }else{
                var msg = 'Pesan telegram tidak berhasil dibroadcast';
                alertSuccess(msg);
              }
            }
          })
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
