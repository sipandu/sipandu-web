<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;

class DataRiwayatKesehatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function dataKesehatan()
    {
        $idPosyandu = Auth::guard('admin')->user()->pegawai->id_posyandu;

        $ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_ibu_hamil.id_posyandu', $idPosyandu)
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_ibu_hamil.nama_ibu_hamil', 'asc')
        ->get();

        $anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_anak.id_posyandu', $idPosyandu)
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
        ->get();

        $lansia = Lansia::join('tb_user', 'tb_user.id', 'tb_lansia.id_user')
            ->select('tb_lansia.*')
            ->where('tb_lansia.id_posyandu', $idPosyandu)
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
        ->get();

        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan', compact('ibu', 'anak', 'lansia'));
    }

    public function kesehatanIbu(Ibu $ibu)
    {
        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan-ibu');
    }

    public function kesehatanAnak(Anak $anak)
    {
        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan-anak');
    }

    public function kesehatanLansia(Lansia $lansia)
    {
        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan-lansia');
    }
}
