@extends('layouts/admin/admin-layout')
@section('title', 'Riwayat Kegiatan')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Daftar Riwayat Kegiatan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/admin') }}">sipandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Kegiatan</li>
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
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#past-kegiatan" data-toggle="tab">Riwayat Kegiatan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#cancel-kegiatan" data-toggle="tab">Kegiatan yang Batal</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="past-kegiatan">
                                <table id="riwayat-data-kegiatan" class="table table-bordered table-hover">
                                    <thead>
                                      <tr>
                                        <th style="text-align: center">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th style="text-align: center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kegiatan_lewat as $item)
                                            <tr>
                                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_kegiatan }}</td>
                                                <td>{{ $item->tempat }}</td>
                                                <td>{{ $item->start_at }}</td>
                                                <td>{{ $item->end_at }}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('riwayat_kegiatan.show', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th style="text-align: center">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Action</th>
                                      </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane" id="cancel-kegiatan">
                                <table id="cancel-data-kegiatan" class="table table-bordered table-hover">
                                    <thead>
                                      <tr>
                                        <th style="text-align: center">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Alasan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kegiatan_cancel as $item)
                                            <tr>
                                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_kegiatan }}</td>
                                                <td>{{ $item->tempat }}</td>
                                                <td>{{ $item->start_at }}</td>
                                                <td>{{ $item->end_at }}</td>
                                                <td>{{ $item->alasan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th style="text-align: center">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Alasan</th>
                                      </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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
            $('#riwayat-data-kegiatan').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#cancel-data-kegiatan').DataTable({
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
            $('#riwayat-kegiatan').addClass('active');
        });

    </script>
@endpush
