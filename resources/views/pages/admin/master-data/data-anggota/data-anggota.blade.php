@extends('layouts/admin/admin-layout')

@section('title', 'Data Anggota Posyandu')

@push('css')
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3 col-lg-auto text-center text-md-start">Data Anggota Posyandu</h1>
    <div class="col-auto ml-auto text-right my-auto mt-n1">
      <nav aria-label="breadcrumb text-center">
        <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
          <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Smart Posyandu 5.0</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="container-fluid px-0">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header p-2">
            <div class="row">
              <div class="col-md-6 col-sm-12 my-1">
                <ul class="nav nav-pills d-flex justify-content-center justify-content-md-start">
                  <li class="nav-item"><a class="nav-link active" href="#tbIbu" data-toggle="tab">Ibu Hamil</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tbAnak" data-toggle="tab">Anak</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tbLansia" data-toggle="tab">Lansia</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-end my-1">
                <a href="{{ route("Add User") }}" class="btn btn-success">
                  <i class="fa fa-plus"></i> Tambah
                </a>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive-md">
            <div class="tab-content">
              <div class="active tab-pane" id="tbIbu">
                  @if (count($ibu) > 0)
                    <table id="dataIbu" class="table table-responsive-md table-bordered table-hover">
                      <thead class="text-center">
                        <tr>
                          <th>No</th>
                          <th>Nama Ibu</th>
                          <th>Nomor Telp</th>
                          <th>Username Telegram</th>
                          <th>Lokasi Posyandu</th>
                          <th class="d-md-none">Tindakan</th>
                          <th class="d-none d-md-table-cell">Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ibu as $data)
                          <tr class="text-center align-middle my-auto">
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle text-start">{{ $data->nama_ibu_hamil }}</td>
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
                            <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                            <td class="text-center align-middle d-md-none">
                              <a href="{{route('Detail Anggota Ibu', $data->id)}}" class="btn btn-warning btn-sm">
                                <i class="fas fa-eye"></i>
                              </a>
                            </td>
                            <td class="text-center align-middle d-none d-md-table-cell">
                              <a href="{{route('Detail Anggota Ibu', $data->id)}}" class="btn btn-warning btn-sm">
                                <i class="fas fa-eye"></i>
                                Detail
                              </a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  @else
                    <p class="text-center my-auto">Tidak Terdapat Anggota Ibu Hamil</p>
                  @endif
              </div>
              <div class="tab-pane" id="tbAnak">
                @if (count($anak) > 0)
                  <table id="dataAnak" class="table table-responsive-md table-bordered table-hover">
                    <thead class="text-center">
                      <tr>
                        <th>No</th>
                        <th>Nama Anak</th>
                        <th>Nomor Telp</th>
                        <th>Username</th>
                        <th>Lokasi Posyandu</th>
                        <th class="d-md-none">Tindakan</th>
                        <th class="d-none d-md-table-cell">Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($anak as $data)
                        <tr class="text-center align-middle my-auto">
                          <td class="align-middle">{{ $loop->iteration }}</td>
                          <td class="align-middle text-start">{{ $data->nama_anak }}</td>
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
                          <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                          <td class="text-center align-middle d-md-none">
                            <a href="{{route('Detail Anggota Anak', $data->id)}}" class="btn btn-warning btn-sm">
                              <i class="fas fa-eye"></i>
                            </a>
                          </td>
                          <td class="text-center align-middle d-none d-md-table-cell">
                            <a href="{{route('Detail Anggota Anak', $data->id)}}" class="btn btn-warning btn-sm">
                              <i class="fas fa-eye"></i>
                              Detail
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <p class="text-center my-auto">Tidak Terdapat Anggota Anak</p>
                @endif
              </div>
              <div class="tab-pane" id="tbLansia">
                @if (count($lansia) > 0)
                  <table id="dataLansia" class="table table-responsive-sm table-bordered table-hover">
                    <thead class="text-center">
                      <tr>
                        <th>No</th>
                        <th>Nama Lansia</th>
                        <th>Golongan</th>
                        <th>Lokasi Posyandu</th>
                        <th class="d-md-none">Tindakan</th>
                        <th class="d-none d-md-table-cell">Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($lansia as $data)
                        <tr class="text-center align-middle my-auto">
                          <td class="align-middle">{{ $loop->iteration }}</td>
                          <td class="align-middle">{{ $data->nama_lansia }}</td>
                          <td class="align-middle">{{ $data->status }}</td>
                          <td class="align-middle">{{ $data->posyandu->nama_posyandu }}</td>
                          <td class="text-center align-middle d-md-none">
                            <a href="{{route('Detail Anggota Lansia', [$data->id])}}" class="btn btn-warning btn-sm">
                              <i class="fas fa-eye"></i>
                            </a>
                          </td>
                          <td class="text-center align-middle d-none d-md-table-cell">
                            <a href="{{route('Detail Anggota Lansia', [$data->id])}}" class="btn btn-warning btn-sm">
                              <i class="fas fa-eye"></i>
                              Detail
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <p class="text-center my-auto">Tidak Terdapat Anggota Lansia</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

  <script>
      $(document).ready(function(){
          $('#account-management').addClass('menu-is-opening menu-open');
          $('#account').addClass('active');
          $('#data-anggota').addClass('active');
      });
      
      $(function () {
        $("#dataLansia").DataTable({
          "responsive": false, "lengthChange": false, "autoWidth": false,
          "oLanguage": {
            "sSearch": "Cari:",
            "sZeroRecords": "Data Tidak Ditemukan",
            "sSearchPlaceholder": "Cari lansia ...",
            "infoEmpty": "Menampilkan 0 Data",
            "infoFiltered": "(dari _MAX_ data)",
          },
          "language": {
            "paginate": {
              "previous": 'Sebelumnya',
              "next": 'Berikutnya'
            },
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
          },
        });
      });

      $(function () {
        $("#dataAnak").DataTable({
          "responsive": false, "lengthChange": false, "autoWidth": false,
          "oLanguage": {
            "sSearch": "Cari:",
            "sZeroRecords": "Data Tidak Ditemukan",
            "sSearchPlaceholder": "Cari anak ...",
            "infoEmpty": "Menampilkan 0 Data",
            "infoFiltered": "(dari _MAX_ data)",
          },
          "language": {
            "paginate": {
              "previous": 'Sebelumnya',
              "next": 'Berikutnya'
            },
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
          },
        });
      });

      $(function () {
        $("#dataIbu").DataTable({
          "responsive": false, "lengthChange": false, "autoWidth": false,
          "oLanguage": {
            "sSearch": "Cari:",
            "sZeroRecords": "Data Tidak Ditemukan",
            "sSearchPlaceholder": "Cari ibu hamil ...",
            "infoEmpty": "Menampilkan 0 Data",
            "infoFiltered": "(dari _MAX_ data)",
          },
          "language": {
            "paginate": {
              "previous": 'Sebelumnya',
              "next": 'Berikutnya'
            },
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
          },
        });
      });
  </script>
@endpush
