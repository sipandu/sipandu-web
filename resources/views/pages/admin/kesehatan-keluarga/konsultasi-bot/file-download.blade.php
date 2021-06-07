<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Konsultasi - {{ $konsultasi->kode_konsultasi }}</title>
    <style>
        .container {
            padding-left: 10%;
            padding-right: 10%;
        }
        .header {
            width: 100%;
            /* margin-bottom: 10px; */
        }
        .img-header {
            width: 100px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
        .img-header-right {
            width: 100px;
            margin-left: 150px;
            margin-right: auto;
            display: block;
        }
        .text-center {
            text-align: center;
        }
        .header p {
            margin-top: -10px;
        }
        .text-bold {
            font-weight: 900;
        }
        .header table {
            margin-top: 40px;
            width: 100%;
            height: 100px;
        }
        .header hr {
            border-top: 1px solid black;
            padding-top: 1px;
            border-bottom: 1px solid black;
            margin-top: -40px;
        }
        .body {
            width: 100%;
        }
        .table-body {
            border: 1px solid black;
            padding: 2px;
            border-collapse: collapse;
            width: 100%;
        }
        .table-body tr {
            border: 1px solid black;
            padding: 2px;
        }
        .table-body th {
            border: 1px solid black;
            padding: 2px;
        }
        .table-body td {
            border: 1px solid black;
            padding: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <div class="text-center">
                            <p><strong>HASIL KONSULTASI VIA BOT</strong></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table style="margin-bottom: 40px; width: 100%;">
            <tr>
                <td style="width: 150px;">Nomor Konsultasi</td>
                <td style="width: 30px;">:</td>
                <td>{{ $konsultasi->kode_konsultasi }}</td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td>:</td>
                <td>{{ $konsultasi->nama_pasien }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{ date('d F Y', strtotime($pasien->tanggal_lahir)) }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ \Str::title($pasien->jenis_kelamin ?? "Jenis Kelamin Belum diisikan") }}</td>
            </tr>
            <tr>
                <td>Nama Pemeriksa</td>
                <td>:</td>
                <td>{{ $konsultasi->nama_pemeriksa }}</td>
            </tr>
            <tr>
                <td>Posyandu</td>
                <td>:</td>
                <td>{{ $pasien->nama_posyandu }}</td>
            </tr>
            <tr>
                <td>Tanggal Konsultasi</td>
                <td>:</td>
                <td>{{ date('d F Y', strtotime($konsultasi->tanggal)) }}</td>
            </tr>
        </table>
        <div class="body">
            <p>Data Konsultasi : </p>
            <table class="table-body text-center">
                <tr>
                    <th rowspan="1">NO</th>
                    <th rowspan="1">Objek Pengukuran</th>
                    <th rowspan="1">Hasil</th>
                </tr>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $key }}</td>
                        <td>{{ $item }}</td>
                    </tr>
                @endforeach
            </table>
            <p>Hasil Diagnosa : </p>
            <table class="table-body text-center">
                <tr>
                    <th rowspan="1">Diagnosa</th>
                    <th rowspan="1">Keterangan</th>
                </tr>
                <tr>
                    <td rowspan="1" width="50%">{{ $konsultasi->diagnosa }}</td>
                    <td rowspan="1" width="50%">{{ $konsultasi->keterangan }}</td>
                </tr>
                <tr>
                    <th colspan="2">Resep</th>
                </tr>
                <tr>
                    <td colspan="2">
                        {{ $konsultasi->resep }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>