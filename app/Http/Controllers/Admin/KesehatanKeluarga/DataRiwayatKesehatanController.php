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
use App\PemeriksaanIbu;
use App\PemeriksaanAnak;
use App\PemeriksaanLansia;
use App\PemberianImunisasi;
use App\PemberianVitamin;
use App\Alergi;
use App\Persalinan;
use App\PenyakitBawaan;
use App\RiwayatPenyakit;
use App\PjLansia;

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
        $dataIbu = $ibu;

        $umur = Carbon::parse($ibu->tanggal_lahir)->age;

        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->get()->first();
        if ($pemeriksaanIbu != NULL) {
            $usia_kandungan = $pemeriksaanIbu->usia_kandungan;
        } else {
            $usia_kandungan = '0';
        }

        $dataAwal = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('created_at', 'asc')->first();
        if($dataAwal != null){
            if($dataAwal->berat_badan != null || $dataAwal->usia_kandungan != null){
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
                    array_push($perubahanBerat, $minusBerat);
                    array_push($minggu, $d->usia_kandungan);
                }
            }
            $js_minggu = json_encode($minggu);
            $js_berat = json_encode($perubahanBerat);
            }else{
                $js_minggu = null;
                $js_berat = null;
            }
        }else{
            $js_minggu = null;
            $js_berat = null;
        }

        $alergi = Alergi::where('id_user', $ibu->id_user)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $ibu->id_user)->get();

        $imunisasi = PemberianImunisasi::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->get();
        $vitamin = PemberianVitamin::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->get();
        $pemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->get();

        $dataKesehatan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->where('jenis_pemeriksaan','Pemeriksaan')->orderBy('id', 'desc')->first();

        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan-ibu', compact('js_minggu', 'js_berat', 'dataIbu', 'umur', 'imunisasi', 'vitamin', 'pemeriksaan', 'usia_kandungan', 'alergi', 'penyakitBawaan', 'dataKesehatan'));
    }

    public function kesehatanAnak(Anak $anak)
    {
        $today = Carbon::now()->setTimezone('GMT+8'); 
        $dataAnak = $anak;
        $umur = Carbon::parse($anak->tanggal_lahir)->age;
        $umurBayi = Carbon::parse($anak->tanggal_lahir)->diff($today)->format('%m');
        $umurLahirBayi = Carbon::parse($anak->tanggal_lahir)->diff($today)->format('%d');
        
        $dataAwal = pemeriksaanAnak::where('id_anak', $anak->id)->orderBy('created_at', 'asc')->first();
        if($dataAwal != null){
            if($dataAwal->berat_badan != null || $dataAwal->tinggi_badan != null){
                $dataPemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('created_at', 'asc')->get();
            $beratBadan[] = $dataAwal->berat_badan;
            $tinggiBadan[] = $dataAwal->tinggi_badan;
            $usia[] = $dataAwal->usia_anak;
            $lingkarKepala[] = $dataAwal->lingkar_kepala;
            $i = 1;
            foreach($dataPemeriksaan as $d){
                if($i == 1){
                    $i += 1 ;
                    continue;
                }else{
                    array_push($beratBadan, $d->berat_badan);
                    array_push($tinggiBadan, $d->tinggi_badan);
                    array_push($usia, $d->usia_anak);
                    array_push($lingkarKepala, $d->lingkar_kepala);
                }
            }
            $js_tinggi = json_encode($tinggiBadan);
            $js_berat = json_encode($beratBadan);
            $js_usia = json_encode($usia);
            $js_lingkar = json_encode($lingkarKepala);
            }else{
                $js_tinggi = null;
                $js_berat = null;
                $js_usia = null;
                $js_lingkar = null;    
            }
        }else{
            $js_tinggi = null;
            $js_berat = null;
            $js_usia = null;
            $js_lingkar = null;
        }

        $alergi = Alergi::where('id_user', $anak->id_user)->get();

        $imunisasi = PemberianImunisasi::where('id_user', $anak->id_user)->orderBy('id', 'desc')->get();
        $vitamin = PemberianVitamin::where('id_user', $anak->id_user)->orderBy('id', 'desc')->get();
        $pemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('id', 'desc')->get();

        $dataKesehatan = PemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan','Pemeriksaan')->orderBy('id', 'desc')->first();

        if ($umur > 0) {
            $usia = $umur.' Tahun';
        } else {
            if ($umur < 1) {
                $usia= $umurLahirBayi.' Hari';
            } else {
                $usia = $umurBayi.' Bulan';
            }
        }

        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan-anak', compact('js_berat', 'js_tinggi', 'js_lingkar', 'js_usia', 'dataAnak', 'umur', 'imunisasi', 'vitamin', 'pemeriksaan', 'usia', 'alergi', 'dataKesehatan'));
    }

    public function kesehatanLansia(Lansia $lansia)
    {
        $dataLansia = $lansia;
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;

        $alergi = Alergi::where('id_user', $lansia->id_user)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $lansia->id_user)->get();
        $riwayatPenyakit = RiwayatPenyakit::where('id_lansia', $lansia->id)->get();

        $imunisasi = PemberianImunisasi::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->get();
        $vitamin = PemberianVitamin::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->get();
        $pemeriksaan = PemeriksaanLansia::where('id_lansia', $lansia->id)->orderBy('id', 'desc')->get();

        $dataKesehatan = PemeriksaanLansia::where('id_lansia', $lansia->id)->where('jenis_pemeriksaan','Pemeriksaan')->orderBy('id', 'desc')->first();

        $pj = PjLansia::where('id_lansia', $lansia->id)->first();

        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan-lansia', compact('dataLansia', 'umur', 'imunisasi', 'vitamin', 'pemeriksaan', 'pj', 'alergi', 'penyakitBawaan', 'riwayatPenyakit', 'dataKesehatan'));
    }
}
