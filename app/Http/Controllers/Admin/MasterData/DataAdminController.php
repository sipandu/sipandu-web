<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $admin = Pegawai::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->orWhere('jabatan', 'head admin')->get();
        $adminAll = Pegawai::orWhere('jabatan', 'admin')->orWhere('jabatan', 'head admin')->get();

        return view('pages/admin/master-data/data-admin/data-admin', compact(['admin', 'adminAll']));
    }

    public function detailAdmin(Pegawai $pegawai)
    {
        $dataPegawai = Pegawai::where('id', $pegawai->id)->first();
        $dataAdmin = Admin::where('id', $dataPegawai->id_admin)->first();
        return view('pages/admin/master-data/data-admin/detail-admin', compact(['dataPegawai', 'dataAdmin']));
    }
}
