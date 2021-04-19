<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Imunisasi;
use App\Vitamin;
use App\PemberianImunisasi;
use App\Posyandu;

class PemeriksaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function tambahPemeriksaan()
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

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/tambah-pemeriksaan', compact('ibu', 'anak', 'lansia') );
    }

    public function pemeriksaanIbu(Ibu $ibu)
    {
        $dataIbu = Ibu::where('id', $ibu->id)->get()->first();
        $imunisasi = Imunisasi::where('penerima', 'Ibu Hamil')->get();
        $vitamin = Vitamin::where('penerima', 'Ibu Hamil')->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-ibu', compact('dataIbu', 'imunisasi', 'vitamin'));
    }

    public function pemeriksaanAnak(Anak $anak)
    {
        $dataAnak = Anak::where('id', $anak->id)->get()->first();
        $imunisasi = Imunisasi::where('penerima', 'Anak')->get();
        $vitamin = Vitamin::where('penerima', 'Anak')->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-anak', compact('dataAnak', 'imunisasi', 'vitamin'));
    }

    public function pemeriksaanLansia(Lansia $lansia)
    {
        $dataLansia = Lansia::where('id', $lansia->id)->get()->first();
        $imunisasi = Imunisasi::where('penerima', 'Lansia')->get();
        $vitamin = Vitamin::where('penerima', 'Lansia')->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-lansia', compact('dataLansia', 'imunisasi', 'vitamin'));
    }
}
