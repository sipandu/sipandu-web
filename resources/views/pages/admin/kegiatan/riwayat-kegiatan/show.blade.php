@extends('layouts/admin/admin-layout')
@section('title', 'Detail Riwayat Kegiatan')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Detail Riwayat Kegiatan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('riwayat_kegiatan.home') }}">Riwayat Kegiatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $kegiatan->nama_kegiatan }}</li>
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
                    <div class="card-header p-2">
                        <h5 class="card-title">Dokumentasi Kegiatan</h5>
                        <a href="{{ route('dokumentasi.create', $kegiatan->id) }}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        <table id="data" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th style="text-align: center">No</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th style="text-align: center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumentasi_kegiatan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <img src="{{ route('dokumentasi.get_img', $item->id) }}" width="100" alt="">
                                        </td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('dokumentasi.show', $item->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                            <button class="btn btn-sm btn-danger" type="button" onclick="deleteDokumentasi('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                <th style="text-align: center">No</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th style="text-align: center">Action</th>
                              </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
<form id="form-delete" action="{{ route('dokumentasi.delete') }}" method="POST">
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

        function deleteDokumentasi(id){
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

        $(document).ready(function(){
            $('#riwayat-kegiatan').addClass('active');
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
