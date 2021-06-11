@extends('layouts/admin/admin-layout')

@section('title', 'Manajemen Kegiatan')

@push('css')
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manajemen Kegiatan Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kegiatan Posyandu</li>
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
                                <h3 class="card-title my-auto">Data Kegiatan</h3>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-success float-right" href="{{ route('kegiatan.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive-md">
                        <table id="tbKegiatanPosyandu" class="table table-bordered table-responsive-md table-hover">
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
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn btn-primary btn-sm my-1" onclick="broadcastMessage('{{ $item->id }}')"><i class="fab fa-telegram"></i></button>
                                            <button class="btn btn-danger btn-sm my-1" onclick="batalkanKegiatan('{{ $item->id }}', '{{ $item->nama_kegiatan }}')"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                    @include('admin.kegiatan.kegiatan.modal.batalkan-kegiatan')
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
    <script src="{{url('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#kegiatan-posyandu').addClass('menu-is-opening menu-open');
            $('#kegiatan').addClass('active');
            $('#tambah-kegiatan').addClass('active');
        });

        $(function () {
            $('#tbKegiatanPosyandu').DataTable({
            "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari: ",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Kegiatan Posyandu",
                    "sSearchPlaceholder": "Cari kegiatan posyandu ...",
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

        function batalkanKegiatan(id, nama_kegiatan) {
            $('#delete-modal').modal('show');
            $('#formBatalkanKegiatan').attr("action", "{{ route('kegiatan.delete', '') }}"+"/"+id);
            $('#nama-kegiatan').val(nama_kegiatan);
            // $('#formBatalkanKegiatan').attr("action", "{{ route('kegiatan.delete', '') }}"+"/"+id);
            // if (status == 'Tampil') {
            //     $('#statusPublikasi option').remove();
            //     $('#statusPublikasi').append(`<option selected value="${status}">${status}</option>`);
            //     $('#statusPublikasi').append(`<option value="Tidak Tampil">Tidak Tampil</option>`);
            // } else if ( status == 'Tidak Tampil' ) {
            //     $('#statusPublikasi option').remove();
            //     $('#statusPublikasi').append(`<option selected value="${status}">${status}</option>`);
            //     $('#statusPublikasi').append(`<option value="Tampil">Tampil</option>`);
            // } else if ( status == '') {
            //     $('#statusPublikasi option').remove();
            //     $('#statusPublikasi').append(`<option selected disable>Pilih status publikasi</option>`);
            //     $('#statusPublikasi').append(`<option value="Tampil">Tampil</option>`);
            //     $('#statusPublikasi').append(`<option value="Tidak Tampil">Tidak Tampil</option>`);
            // }
        }

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
                    alertError(msg);
                }
                }
            })
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

    @if (count($errors) > 0)
        <script>
            $(document).ready(function() {
                $('#delete-modal').modal('show');
            });
        </script>
    @endif
@endpush
