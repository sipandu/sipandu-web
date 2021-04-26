<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\PemeriksaanIbu;
use App\PemeriksaanAnak;

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
        $dataAwal = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('created_at', 'asc')->first();
        $beratAwal = $dataAwal->berat_badan;
        $dataPemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('created_at', 'asc')->get();
        $awal[] = null;
        $menengah[] = null;
        $menengah2[] = null;
        $akhir[] = null;
        foreach($dataPemeriksaan as $d){
            if($d->usia_kandungan < 18.5 ){
                array_push($awal, $d->berat_badan);
            }elseif($d->usia_kandungan > 10.5 and $d->usia_kandungan < 24.9 ){

            }
        }
        // dd($dataPemeriksaan[0]->berat_badan);
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
