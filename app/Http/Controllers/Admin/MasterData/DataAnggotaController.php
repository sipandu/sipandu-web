<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;

class DataAnggotaController extends Controller
{
    public function listAnggota()
    {
        return view('pages/admin/master-data/data-anggota/data-anggota');
    }

    public function detailAnggota()
    {
        return view('pages/admin/master-data/data-anggota/detail-anggota');
    }
}
