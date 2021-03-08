@extends('layouts/admin/admin-layout')
@section('title', 'Manajemen Kegiatan')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Kegiatan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Data Kegiatan</h3>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success float-right" href="{{ route('kegiatan.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="data" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="text-align: center">No</th>
                        <th>Nama Kegiatan</th>
                        <th>Tempat</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Deskripsi</th>
                        <th style="text-align: center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $item)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->tempat }}</td>
                                <td>{{ $item->start_at }}</td>
                                <td>{{ $item->end_at }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('kegiatan.show', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-primary btn-sm" onclick="broadcastMessage('{{ $item->id }}')"><i class="fab fa-telegram"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteKegiatan('{{ $item->nama_kegiatan }}', '{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Tempat</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Batalkan Kegiatan</h5>
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
    <script src="{{url('admin-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script>
        $(function () {
            $('#data').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
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
        $(document).ready(function(){
            $('#kegiatan').addClass('active');
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