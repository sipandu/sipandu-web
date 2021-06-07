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
use App\Nakes;
use App\NakesPosyandu;
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
        $id_posyandu = [];
        $login_user = [];
        $ibu = [];
        $anak = [];
        $lansia = [];

        $data_ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_ibu_hamil.created_at', 'desc')
        ->get();

        $data_anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_anak.created_at', 'desc')
        ->get();

        $data_lansia = Lansia::join('tb_user', 'tb_user.id', 'tb_lansia.id_user')
            ->select('tb_lansia.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_lansia.created_at', 'desc')
        ->get();

        if (auth()->guard('admin')->user()->role == 'tenaga kesehatan') {
            $nakes = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $login_user = $nakes;
        }
        if (auth()->guard('admin')->user()->role == 'pegawai') {
            $admin = auth()->guard('admin')->user()->pegawai;
            $login_user = $admin;
        }

        foreach ($login_user as $data) {
            $id_posyandu[] = $data->id_posyandu;
        }
        
        foreach ($id_posyandu as $item) {
            foreach ($data_ibu->where('id_posyandu', $item) as $data) {
                $ibu[] = $data;
            }
        }
        foreach ($id_posyandu as $item) {
            foreach ($data_anak->where('id_posyandu', $item) as $data) {
                $anak[] = $data;
            }
        }
        foreach ($id_posyandu as $item) {
            foreach ($data_lansia->where('id_posyandu', $item) as $data) {
                $lansia[] = $data;
            }
        }

        return view('pages/admin/kesehatan-keluarga/data-kesehatan/data-kesehatan', compact('ibu', 'anak', 'lansia'));
    }

    public function kesehatanIbu(Ibu $ibu)
    {
        $dataIbu = $ibu;

        $umur = Carbon::parse($ibu->tanggal_lahir)->age;

        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->where('jenis_pemeriksaan', "Pemeriksaan")->orderBy('id', 'desc')->get()->first();
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
        
        $dataAwal = pemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', "Pemeriksaan")->orderBy('created_at', 'asc')->first();
        // dd($dataAwal->id);
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

    public function kesehatanAnakMob1(Anak $anak)
    {
        $dataAwal = pemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', "Pemeriksaan")->orderBy('created_at', 'asc')->first();
        // dd($dataAwal->id);
        if($dataAwal != null){
            if($dataAwal->berat_badan != null || $dataAwal->tinggi_badan != null){
                $dataPemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('created_at', 'asc')->get();
            $beratBadan[] = $dataAwal->berat_badan;
            $tinggiBadan[] = $dataAwal->tinggi_badan;
            $i = 1;
            foreach($dataPemeriksaan as $d){
                if($i == 1){
                    $i += 1 ;
                    continue;
                }else{
                    array_push($beratBadan, $d->berat_badan);
                    array_push($tinggiBadan, $d->tinggi_badan);
                }
            }
            $js_tinggi = json_encode($tinggiBadan);
            $js_berat = json_encode($beratBadan);
            }else{
                $js_tinggi = null;
                $js_berat = null;  
            }
        }else{
            $js_tinggi = null;
            $js_berat = null;
        }

        return view('mobile/graph-mobile-1', compact('js_berat', 'js_tinggi', 'dataAnak', 'umur', 'imunisasi', 'vitamin', 'pemeriksaan', 'usia', 'alergi', 'dataKesehatan'));
    }

    public function kesehatanAnakMob2(Anak $anak)
    {
        $dataAwal = pemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', "Pemeriksaan")->orderBy('created_at', 'asc')->first();
        // dd($dataAwal->id);
        if($dataAwal != null){
            if($dataAwal->berat_badan != null || $dataAwal->tinggi_badan != null){
                $dataPemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('created_at', 'asc')->get();
            $beratBadan[] = $dataAwal->berat_badan;
            $usia[] = $dataAwal->usia_anak;
            $i = 1;
            foreach($dataPemeriksaan as $d){
                if($i == 1){
                    $i += 1 ;
                    continue;
                }else{
                    array_push($beratBadan, $d->berat_badan);
                    array_push($usia, $d->usia_anak);
                }
            }
            $js_berat = json_encode($beratBadan);
            $js_usia = json_encode($usia);
            }else{
                $js_berat = null;
                $js_usia = null;    
            }
        }else{
            $js_berat = null;
            $js_usia = null;
        }

        return view('mobile/graph-mobile-2', compact('js_berat', 'js_usia',));
    }

    public function kesehatanAnakMob3(Anak $anak)
    {    
        $dataAwal = pemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', "Pemeriksaan")->orderBy('created_at', 'asc')->first();
        // dd($dataAwal->id);
        if($dataAwal != null){
            if($dataAwal->berat_badan != null || $dataAwal->tinggi_badan != null){
                $dataPemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('created_at', 'asc')->get();
            $tinggiBadan[] = $dataAwal->tinggi_badan;
            $usia[] = $dataAwal->usia_anak;
            $i = 1;
            foreach($dataPemeriksaan as $d){
                if($i == 1){
                    $i += 1 ;
                    continue;
                }else{
                    array_push($tinggiBadan, $d->tinggi_badan);
                    array_push($usia, $d->usia_anak);
                }
            }
            $js_tinggi = json_encode($tinggiBadan);
            $js_usia = json_encode($usia);
            }else{
                $js_tinggi = null;
                $js_usia = null;
            }
        }else{
            $js_tinggi = null;
            $js_usia = null;
        }


        return view('mobile/graph-mobile-3', compact( 'js_tinggi', 'js_usia',));
    }

    public function kesehatanAnakMob4(Anak $anak)
    {
        
        $dataAwal = pemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', "Pemeriksaan")->orderBy('created_at', 'asc')->first();
        // dd($dataAwal->id);
        if($dataAwal != null){
            if($dataAwal->berat_badan != null || $dataAwal->tinggi_badan != null){
                $dataPemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('created_at', 'asc')->get();
            $usia[] = $dataAwal->usia_anak;
            $lingkarKepala[] = $dataAwal->lingkar_kepala;
            $i = 1;
            foreach($dataPemeriksaan as $d){
                if($i == 1){
                    $i += 1 ;
                    continue;
                }else{
                    array_push($usia, $d->usia_anak);
                    array_push($lingkarKepala, $d->lingkar_kepala);
                }
            }
            $js_usia = json_encode($usia);
            $js_lingkar = json_encode($lingkarKepala);
            }else{
                $js_usia = null;
                $js_lingkar = null;    
            }
        }else{
            $js_usia = null;
            $js_lingkar = null;
        }


        return view('mobile/graph-mobile-4', compact('js_lingkar', 'js_usia'));
    }

    public function kesehatanIbuMob(Ibu $ibu)
    {

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

        return view('mobile/graph-mobile-5', compact('js_minggu', 'js_berat',));
    }
}
