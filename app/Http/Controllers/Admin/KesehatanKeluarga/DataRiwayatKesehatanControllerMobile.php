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

class DataRiwayatKesehatanControllerMobile extends Controller {

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

        return view('mobile/graph-mobile-1', compact('js_berat', 'js_tinggi'));
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
