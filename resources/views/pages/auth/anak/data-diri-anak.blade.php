<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('sipandu.png') }}">
    <title>SIPANDU - Registrasi Anak</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('admin-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin-template/dist/css/adminlte.min.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
    </style>

</head>
<body class="login-page">
    <div class="container justify-content-center pt-4">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/images/sipandu-logo.png') }}" alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">SIPANDU</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold h6">Sistem Informasi Pos Pelayanan Terpadu</p>
            </div>
            <div class="card-body">
                <p class="text-center fs-5 pt-2 pb-1">Silahkan isi data diri anak anda</p>      
                <form action="../../index.html" method="post">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Nama Anak</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nama lengkap anak">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Ayah</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nama lengkap ayah kandung">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Tempat lahir anak">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-building"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Anak ke</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Silakan isi dalam angka">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-sort-numeric-down"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nomor telepon hanya dalam angka">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-alt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari kecamatan tempat tinggal">
                                    <datalist id="datalistOptions">
                                        <option value="Denpasar Selatan">
                                        <option value="Mengwi">
                                        <option value="Kuta Utara">
                                        <option value="Kuta Selatan">
                                        <option value="Denpasar Timur">
                                    </datalist>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-city"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Banjar</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Banjar tempat tinggal">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-city"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Email Aktif</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Masukan Email Google aktif">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Ibu</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nama lengkap ibu kandung">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Tanggal lahir anak" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>KIA</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Masukan Nomor Indentitas Anak">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari kabupaten/kota tempat tinggal">
                                    <datalist id="datalistOptions">
                                        <option value="Denpasar">
                                        <option value="Badung">
                                        <option value="Gianyar">
                                        <option value="Tabanan">
                                        <option value="Singaraja">
                                    </datalist>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-city"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Desa/Kelurahan</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari desa/kelurahan tempat tinggal">
                                    <datalist id="datalistOptions">
                                        <option value="Denpasar Selatan">
                                        <option value="Mengwi">
                                        <option value="Kuta Utara">
                                        <option value="Kuta Selatan">
                                        <option value="Denpasar Timur">
                                    </datalist>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-city"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Jalan lokasi tempat tinggal">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-road"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-end mt-4">
                        <div class="col-8">
                            <p>
                                Terdapat kendala? Klik 
                                <a href="register.html" class="text-decoration-none link-primary">di sini</a>
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center mt-4 mb-0">
                <a href="" class="nav-link link-dark">SIPANDU &copy 2021</a>
            </div>

        </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{url('admin-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{url('admin-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{url('admin-template/dist/js/adminlte.js')}}"></script>

    <script src="{{url('admin-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();

            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            
            $('[data-mask]').inputmask()
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>