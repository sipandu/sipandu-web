<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Konsultasi</title>
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
                            <p><strong>RIWAYAT KESEHATAN</strong></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table style="margin-bottom: 40px; width: 100%;">
            <tr>
                <td style="width: 150px;">NIK</td>
                <td style="width: 30px;">:</td>
                <td>1234567890123456</td>
            </tr>
            <tr>
                <td>Nama Anak</td>
                <td>:</td>
                <td>LUH PUTU NYOMAN KETUT</td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td>LUH PUTU NYOMAN KETUT</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{ date('d F Y') }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>Jenis Kelamin Belum diisikan</td>
            </tr>
            <tr>
                <td>Posyandu</td>
                <td>:</td>
                <td>POSYANDU A</td>
            </tr>
        </table>
        <div class="body">
            <p>Data Riwayat Kesehatan Anggota : </p>
            <table class="table-body">
                <tr>
                    <th rowspan="1" width="250">Alergi</th>
                    <td rowspan="1">
                        <li>Alergi 1</li>
                        <li>Alergi 2</li>
                    </td>
                </tr>
                <tr>
                    <th rowspan="1">Alergi</th>
                    <td rowspan="1">
                        <li>Alergi 1</li>
                        <li>Alergi 2</li>
                    </td>
                </tr>
                <tr>
                    <th rowspan="1">Imunisasi</th>
                    <td rowspan="1">
                        <li>Imunisasi 1</li>
                        <li>Imunisasi 2</li>
                    </td>
                </tr>
                <tr>
                    <th rowspan="1">Pemberian Vitamin</th>
                    <td rowspan="1">
                        <li>Pemberian 1</li>
                        <li>Pemberian 2</li>
                    </td>
                </tr>
            </table>
            <p>Riwayat Pemeriksaan : </p>
            <table class="table-body">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Lingkar Kepala</th>
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Pengobatan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>