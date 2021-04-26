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
        // dd($dataAwal->berat_badan);
        $perubahanBerat[] = 0;
        $minggu[] = $dataAwal->usia_kandungan;
        $i = 1;
        foreach($dataPemeriksaan as $d){
            if($i == 1){
                $i += 1 ;
                continue;
            }else{
                $minusBerat = $d->berat_badan - $dataAwal->berat_badan;
                // dd($minusBerat);
                array_push($perubahanBerat, $minusBerat);
                array_push($minggu, $d->usia_kandungan);
            }
        }
        $js_minggu = json_encode($minggu);
        $js_berat = json_encode($perubahanBerat);
        // dd($js_minggu, $js_berat);
        // dd($perubahanBerat);
        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan-ibu', compact('js_minggu', 'js_berat'));
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
