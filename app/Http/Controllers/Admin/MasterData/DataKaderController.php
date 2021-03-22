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


class DataKaderController extends Controller
{
    public function listKader()
    {
        return view('pages/admin/master-data/data-kader/data-kader');
    }

    public function detailKader()
    {
        return view('pages/admin/master-data/data-kader/detail-kader');
    }
}
