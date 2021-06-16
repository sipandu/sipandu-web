    @extends('layouts/admin/admin-layout')

    @section('title', 'Tag Berita')

    @push('css')
        <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endpush


    @section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Tag Berita</h1>
        <div class="col-auto ml-auto my-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Admin Home') }}">Posyandu 5.0</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tag</li>
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
                            @permission('Tambah Tag Berita')
                                <div class="col-6 my-auto">
                                    <h3 class="card-title my-auto">Daftar Tag Berita</h3>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#tambahTag" aria-expanded="false" aria-controls="tambahTag">
                                        <i class="fa fa-plus"></i> Tambah
                                    </button>
                                </div>
                            @else
                                <div class="col-6 my-auto">
                                    <h3 class="card-title my-auto">Daftar Tag Berita</h3>
                                </div>
                            @endpermission
                        </div>
                        @permission('Tambah Tag Berita')
                            <div class="collapse my-4" id="tambahTag">
                                <div class="card card-body">
                                    <form action="{{ route('Simpan Tag') }}" method="POST" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('nama_tag') is-invalid @enderror" placeholder="Masukan nama tag" name="nama_tag" autocomplete="off" required>
                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Simpan Tag</button>
                                            @error('nama_tag')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Nama Tag Wajib Diisi
                                                </div>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endpermission
                    </div>
                    <div class="card-body table-responsive-sm">
                        <table id="tbTagBerita" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tag</th>
                                    <th class="d-md-none">Tindakan</th>
                                    <th class="d-none d-md-table-cell">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tag as $data)
                                    <tr class="text-center align-middle my-auto">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $data->nama_tag }}</td>
                                        @permission('Hapus Tag Berita')
                                            <td class="text-center align-middle d-md-none">
                                                <button onclick="hapusTag('{{ $data->id }}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                <button onclick="hapusTag('{{ $data->id }}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </td>
                                            <form action="" id="hapus-tag" method="POST" class="d-inline">
                                                @csrf
                                            </form>
                                        @else
                                            <td class="text-center align-middle d-md-none">
                                                -
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                -
                                            </td>
                                        @endpermission
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
    <script src="{{ asset('base-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#informasi').addClass('menu-is-opening menu-open');
            $('#informasi-link').addClass('active');
            $('#tag').addClass('active');
        });

        $(function () {
            $("#tbTagBerita").DataTable({
            "responsive": false, "lengthChange": false, "autoWidth": false,
            "oLanguage": {
                "sSearch": "Cari:",
                "sZeroRecords": "Data Tidak Ditemukan",
                "emptyTable": "Tidak Terdapat Tag Berita",
                "sSearchPlaceholder": "Cari tag berita ...",
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

        function hapusTag(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus Tag Berita ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-tag').attr('action', "{{ route('Hapus Tag', '') }}"+"/"+id);
                    $('#hapus-tag').submit();
                }
            })
        }
    </script>

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                Swal.fire(
                    'Gagal',
                    '{{$message}}',
                    'error'
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

    @if (count($errors) > 0)
        <script>
            $(document).ready(function() {
                $('#tambahTag').addClass('show');
            });
        </script>
    @endif
@endpush

