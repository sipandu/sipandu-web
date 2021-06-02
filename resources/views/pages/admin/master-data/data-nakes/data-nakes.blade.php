@extends('layouts/admin/admin-layout')

@section('title', 'Data Nakes')

@push('css')
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 col-lg-auto text-center text-md-start">Data Nakes</h1>
    <div class="col-auto ml-auto text-right my-auto mt-n1">
      <nav aria-label="breadcrumb text-center">
        <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
          <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu 5.0</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data Nakes</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="container-fluid px-0">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              @if (auth()->guard('admin')->user()->role == 'super admin')
                <div class="col-6 my-auto">
                  <h3 class="card-title my-auto">Daftar Data Nakes</h3>
                </div>
                <div class="col-6 text-end">
                  <a href="{{ route("Add Nakes") }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Tambah
                  </a>
                </div>
              @else
                <div class="col-12 my-auto">
                  <h3 class="card-title my-auto">Daftar Data Nakes</h3>
                </div>
              @endif
            </div>
          </div>
          <div class="card-body table-responsive-md">
            <table id="tbNakes" class="table table-responsive-sm table-bordered table-hover">
              <thead class="text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Nakes</th>
                  <th>Nomor Telp</th>
                  <th>Telegram</th>
                  <th>Tempat Tugas</th>
                  @if (auth()->guard('admin')->user()->role == 'super admin')
                    <th class="d-md-none">Tindakan</th>
                    <th class="d-none d-md-table-cell">Tindakan</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($nakes as $data)
                  <tr class="text-center align-middle my-auto">
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $data->nama_nakes }}</td>
                    @empty($data->nomor_telepon)
                      <td class="align-middle"> - </td>
                    @else
                      <td class="align-middle">{{ $data->nomor_telepon }}</td>
                    @endempty
                    @empty($data->username_telegram)
                      <td class="align-middle"> - </td>
                    @else
                      <td class="align-middle">{{ $data->username_telegram }}</td>
                    @endempty
                    <td class="align-middle text-start">
                      @foreach ($nakesPosyandu->where('id_nakes', $data->id) as $data)
                        {{ $data->posyandu->nama_posyandu }}. 
                      @endforeach
                    </td>
                    @if (auth()->guard('admin')->user()->role == 'super admin')
                      <td class="text-center align-middle d-md-none">
                          <a href="{{route('Detail Nakes', $data->id)}}" class="btn btn-warning btn-sm">
                            <i class="fas fa-eye"></i>
                          </a>
                      </td>
                      <td class="text-center align-middle d-none d-md-table-cell">
                          <a href="{{route('Detail Nakes', $data->id)}}" class="btn btn-warning btn-sm">
                            <i class="fas fa-eye"></i>
                              Detail
                          </a>
                      </td>
                    @endif
                  </tr>
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
  <script src="{{ url('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ url('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ url('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script>
      $(document).ready(function(){
          $('#account-management').addClass('menu-is-opening menu-open');
          $('#account').addClass('active');
          $('#data-nakes').addClass('active');
      });
      
      $(function () {
          $("#tbNakes").DataTable({
              "responsive": false, "lengthChange": false, "autoWidth": false,
              "oLanguage": {
                  "sSearch": "Cari:",
                  "sZeroRecords": "Data Tidak Ditemukan",
                  "sSearchPlaceholder": "Cari nakes ...",
                  "infoEmpty": "Menampilkan 0 Data",
                  "infoFiltered": "(dari _MAX_ data)",
              },
              "language": {
                  // "buttons": {
                  //     "colvis": 'Tampilkan kolom',
                  //     "excel": 'Unduh',
                  // },
                  "paginate": {
                      "previous": 'Sebelumnya',
                      "next": 'Berikutnya'
                  },
                  "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
              },
              "buttons": ["colvis"]
          });
      });
  </script>
@endpush