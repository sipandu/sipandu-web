@extends('layouts/admin/AdminLayout')
@section('title', 'Informasi Persebaran Posyandu')
@push('css')
    <style>
        #mapid { height: 600px; }
        .container {
            margin-top: 40px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@section('sidebar')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
                1805551041
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-id-badge"></i>
                    <p>My Profile</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Add Account
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview ms-3">
                    <li class="nav-item">
                        <a href="pages/examples/lockscreen.html" class="nav-link">
                            <i class="fas fa-user-shield nav-icon"></i>
                            <p>Add Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                            <i class="fas fa-user-tag nav-icon"></i>
                            <p>Add Kader</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                            <i class="fas fa-user nav-icon"></i>
                            <p>Add User</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-item menu-open">
        <a href="{{ route("Admin Home") }}" class="nav-link active">
            <i class="nav-icon fas fa-house-user"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clinic-medical"></i>
            <p>Tambah Posyandu</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>Data Posyandu</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Kader Posyandu</p>
        </a>
    </li>
    <li class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    Kesehatan Keluarga
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ms-3">
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fas fa-female nav-icon"></i>
                        <p>Pemeriksaan Ibu Hamil</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-baby nav-icon"></i>
                        <p>Pemeriksaan Bayi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-child nav-icon"></i>
                        <p>Pemeriksaan Balita</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-wheelchair nav-icon"></i>
                        <p>Pemeriksaan Lansia</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-file-medical-alt nav-icon"></i>
                        <p>Data Kesehatan</p>
                    </a>
                </li>
            </ul>
        </li>
    </li>
    <li class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-syringe"></i>
                <p>
                    Imunisasi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ms-3">
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fas fa-crutch nav-icon"></i>
                        <p>Pemberian Imunisasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        {{-- <i class="fal fa-crutches"></i> --}}
                        <i class="fas fa-vials nav-icon"></i>
                        <p>Jenis Imunisasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-file-medical nav-icon"></i>
                        <p>Data Imunisasi</p>
                    </a>
                </li>
            </ul>
        </li>
    </li>
    <li class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                {{-- <i class="fas fa-prescription-bottle-alt"></i> --}}
                <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                <p>
                    Vitamin
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ms-3">
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fas fa-capsules nav-icon"></i>
                        <p>Pemberian Vitamin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-pills nav-icon"></i>
                        <p>Jenis Vitamin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-file-medical nav-icon"></i>
                        <p>Data Vitamin</p>
                    </a>
                </li>
            </ul>
        </li>
    </li>
    <li class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-info"></i>
                <p>
                    Informasi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ms-3">
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fas fa-exclamation nav-icon"></i>
                        <p>Informasi Penting</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Penyuluhan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/informasi/persebaran-posyandu/home') }}" class="nav-link">
                        <i class="fas fa-map-marked-alt nav-icon"></i>
                        <p>Persebaran Posyandu</p>
                    </a>
                </li>
            </ul>
        </li>
    </li>
    <li class="nav-item">
        <a href="" class="nav-link">
            <i class="nav-icon fas fa-hospital-alt"></i>
            <p>Tambah Kegiatan</p>
        </a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-item">
        <a href="" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            <p>Riwayat Kegiatan</p>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a href="" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Report</p>
        </a>
    </li> --}}
    <li class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                    Laporan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ms-3">
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fas fa-file-alt nav-icon"></i>
                        <p>Laporan Kegiatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fas fa-clipboard-check nav-icon"></i>
                        <p>Laporan Bulanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="fas fa-clipboard-check nav-icon"></i>
                        <p>Laporan Tahunan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                        <i class="far fa-chart-bar nav-icon"></i>
                        <p>Grafik Kesehatan</p>
                    </a>
                </li>
            </ul>
        </li>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>Tentang</p>
        </a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Pesebaran Posyandu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="">sipandu</a></li>
                    <li class="breadcrumb-item">Informasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Persebaran Posyandu</li>
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
                        <h3 class="card-title">Peta Pesebaran Posyandu di Bali</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="mapid"></div>
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
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>\

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
        var mymap = L.map('mapid').setView([-8.30926555343337, 115.09210838237348], 10);
        //function marker
        function marker(id, latitude, longtitude, msg){
            var id = L.marker([latitude, longtitude]).addTo(mymap);
            id.bindPopup(msg);
            //when marker on click
            id.on('click', function(event){
                id.openPopup();
            });
        }

        $(document).ready(function(){
            //SD 1 Jinengdalem
            marker(
                'marker1',
                '-8.11074182432444',
                '115.1251112243882',
                'Nama : SD N 1 Jinengdalem<br>Jenis Sekolah : SD<br>Alamat : Jl. Setia Budi No.60, Penarukan, Kec. Buleleng, Kabupaten Buleleng, Bali 81119'
            );
            //SD 3 Jinengdalem
            marker(
                'marker2',
                '-8.116803838052453',
                '115.12772031778378',
                'Nama : SD 3 Jinengdalem<br>Jenis Sekolah : SD<br>Alamat : Jinengdalem, Kec. Buleleng, Kabupaten Buleleng, Bali 81119'
            );
            //Undiksha
            marker(
                'marker3',
                '-8.131928366546758',
                '115.13344951651526',
                'Nama : Universitas Pendidikan Ganesha Kampus Jinengdalem<br>Jenis Sekolah : Universitas<br>Alamat : Jinengdalem, Kec. Buleleng, Kabupaten Buleleng, Bali 81151'
            );
            //SMP 5 Singaraja
            marker(
                'marker4',
                '-8.123559612957928',
                '115.123342879719',
                'Nama : SMP 5 Singaraja<br>Jenis Sekolah : SMP<br>Alamat : Jl. Pulau Irian, Penglatan, Kec. Buleleng, Kabupaten Buleleng, Bali 81119'
            );
            //SD 3 Penglatan
            marker(
                'marker5',
                '-8.123039476290211',
                '115.12598574703956',
                'Nama : SD 3 Penglatan<br>Jenis Sekolah : SD<br>Alamat : Penglatan, Kec. Buleleng, Kabupaten Buleleng, Bali 81115'
            );
            //SD 1 Penglatan
            marker(
                'marker5',
                '-8.12168999086156',
                '115.12107947587519',
                'Nama : SD 1 Penglatan<br>Jenis Sekolah : SD<br>Alamat : Penglatan, Kec. Buleleng, Kabupaten Buleleng, Bali 81119'
            );
        });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);
    </script>
@endpush