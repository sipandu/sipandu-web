<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\User;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;
use App\Ibu;
use App\Anak;
use App\Lansia;

class DataAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function listAnggota()
    {
        $anak = Anak::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
        $ibu = Ibu::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
        $lansia = Lansia::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();

        return view('pages/admin/master-data/data-anggota/data-anggota', compact('anak', 'ibu', 'lansia'));
    }

    public function detailAnggotaAnak(Anak $anak)
    {
        $dataAnak = Anak::where('id', $anak->id)->first();
        $dataUser = User::where('id', $dataAnak->id_user)->first();

        return view('pages/admin/master-data/data-anggota/detail-anggota-anak', compact('dataUser'));
    }
}
