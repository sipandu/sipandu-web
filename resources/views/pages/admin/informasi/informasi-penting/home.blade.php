@extends('layouts/admin/admin-layout')
@section('title', 'Manajemen Informasi Penting')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Informasi Penting</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item">Informasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi Penting</li>
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
                            <h3 class="card-title">Data Informasi Penting</h3>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success float-right" href="{{ route('informasi_penting.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="data" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="text-align: center">No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th style="text-align: center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($informasi as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $item->judul_informasi }}</th>
                                <th>{{ date('d F Y', strtotime($item->tanggal)) }}</th>
                                <th>
                                    <a href="{{ route('penyuluhan.show', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    <button class="btn btn-danger btn-sm" onclick="deletePenyuluhan('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="text-align: center">No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th style="text-align: center">Action</th>
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
    <form id="form-delete" action="{{ route('penyuluhan.delete') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="id-delete">
    </form>
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
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#informasi-penting').addClass('active');
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