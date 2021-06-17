<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Mover;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\User;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;
use App\Nakes;
use App\NakesPosyandu;
use App\Ibu;
use App\Anak;
use App\Lansia;
use App\KK;
use App\PjLansia;

class DataAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
