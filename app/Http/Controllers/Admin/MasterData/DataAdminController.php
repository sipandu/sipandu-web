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

class DataAdminController extends Controller
{
    public function listAdmin()
    {
        return view('pages/admin/master-data/data-admin/data-admin');
    }

    public function detailAdmin()
    {
        return view('pages/admin/master-data/data-admin/detail-admin');
    }
}
