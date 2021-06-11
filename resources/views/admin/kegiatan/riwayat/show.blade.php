@extends('layouts/admin/admin-layout')

@section('title', 'Dokumentasi Kegiatan')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Dokumentasi Kegiatan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('riwayat_kegiatan.home') }}">Riwayat Kegiatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dokumentasi</li>
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
                            <div class="col-6 my-auto">
                                <h3 class="card-title my-auto">Dokumentasi Kegiatan</h3>
                            </div>
                            @if(auth()->guard('admin')->user()->role != 'tenaga kesehatan')
                                <div class="col-6">
                                    <a class="btn btn-success float-right" href="{{ route('dokumentasi.create', $kegiatan->id) }}"><i class="fa fa-plus"></i> Tambah</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body table-responsive-md">
                        <table id="data" class="table table-bordered table-responsive-md table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumentasi_kegiatan as $item)
                                    <tr class="text-center">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">
                                            <img src="{{ route('dokumentasi.get_img', $item->id) }}" width="100" alt="">
                                        </td>
                                        <td class="align-middle">{{ $item->deskripsi }}</td>                                        
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="dokumentasiKegiatan('{{ $item->id }}', '{{ $item->deskripsi }}')">
                                                <i class="fas fa-image"></i>
                                            </button>
                                            <a href="{{ route('dokumentasi.show', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" type="button" onclick="deleteDokumentasi('{{ $item->id }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @include('admin.kegiatan.riwayat.dokumentasi.modal.dokumentasi')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        $(document).ready(function(){
          $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
          $('#kegiatan').addClass('active');
          $('#riwayat-kegiatan').addClass('active');
        });

        $(function () {
            $('#data').DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Dokumentasi Kegiatan",
                    "sSearchPlaceholder": "Cari dokumentasi kegiatan ...",
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

        function dokumentasiKegiatan(id, deskripsi){
            $('#dokumentasiKegiatan').modal('show');
            $('#fotoDokumentasi').attr("src", "{{ route('dokumentasi.get_img', '') }}"+"/"+id);
            $('#deskripsiFoto').html(deskripsi);
        }
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertError('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif
@endpush