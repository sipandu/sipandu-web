@extends('layouts/admin/admin-layout')

@section('title', 'Jenis Vitamin')

@push('css')
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 col-lg-auto text-center text-md-start">Jenis Vitamin</h1>
    <div class="col-auto ml-auto text-right mt-n1">
      <nav aria-label="breadcrumb text-center">
        <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
          <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu 5.0</a></li>
          <li class="breadcrumb-item active" aria-current="page">Jenis Vitamin</li>
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
              <div class="col-12 my-auto">
                <h3 class="card-title my-auto">Daftar Jenis Vitamin</h3>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive-md">
            @if ($vitamin->count() > 0)
              <table id="tbVitamin" class="table table-bordered table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Nama Vitamin</th>
                    <th class="d-none d-md-table-cell">Kategori</th>
                    <th>Penerima</th>
                    <th class="d-md-none">Tindakan</th>
                    <th class="d-none d-md-table-cell">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($vitamin as $data)
                    <tr class="text-center align-middle my-auto">
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $data->nama_vitamin }}</td>
                      <td class="align-middle d-none d-md-table-cell">{{ $data->status }}</td>
                      <td class="align-middle">{{ $data->penerima }}</td>
                      <td class="text-center align-middle d-md-none">
                        <a href="{{route('Detail Vitamin', [$data->id])}}" class="btn btn-warning btn-sm">
                          <i class="fas fa-eye"></i>
                        </a>
                        @if (auth()->guard('admin')->user()->jabatan == 'super admin')
                          <a href="{{route('Detail Imunisasi', $data->id)}}" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        @endif
                      </td>
                      <td class="text-center align-middle d-none d-md-table-cell">
                        <a href="{{route('Detail Vitamin', [$data->id])}}" class="btn btn-warning btn-sm">
                          <i class="fas fa-eye"></i>
                          Detail
                        </a>
                        @if (auth()->guard('admin')->user()->jabatan == 'super admin')
                          <button onclick="hapusVitamin()" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                            Hapus
                          </button>
                        @endif
                      </td>
                      <form action="{{ route('Hapus Vitamin', $data->id) }}" id="hapus-imunisasi" method="POST" class="d-inline">
                        @csrf
                      </form>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <p class="my-auto text-center fs-5 text-warning">Tidak Terdapat Data Vitamin</p>
            @endif
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script type="text/javascript">
      $(document).ready(function(){
          $('#list-vitamin').addClass('menu-is-opening menu-open');
          $('#vitamin').addClass('active');
          $('#jenis-vitamin').addClass('active');
      });

      $(function () {
        $("#tbVitamin").DataTable({
          "responsive": false, "lengthChange": false, "autoWidth": false,
          "oLanguage": {
            "sSearch": "Cari:",
            "sZeroRecords": "Data Tidak Ditemukan",
            "emptyTable": "Tidak Terdapat Data Vitamin",
            "sSearchPlaceholder": "Cari Vitamin....",
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

      function hapusVitamin() {
        Swal.fire({
          title: 'Peringatan',
          text: 'Apakah anda yakin akan menghapus Vitamin ?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: "Ya, hapus",
          cancelButtonText: 'Tidak, batalkan',
        }).then((result) => {
          if (result.isConfirmed) {
            $('#hapus-imunisasi').submit();
          }
        })
      }
  </script>

  @if($message = Session::get('failed'))
    <script>
      $(document).ready(function(){
        Swal.fire(
          'Berhasil',
          '{{$message}}',
          'failed'
        )
      });
    </script>
  @endif

  @if($message = Session::get('success'))
    <script>
      $(document).ready(function(){
        Swal.fire(
          'Berhasil',
          '{{$message}}',
          'success'
        )
      });
    </script>
  @endif
@endpush

