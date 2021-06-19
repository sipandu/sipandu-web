<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga\Pemeriksaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Mover;
use Carbon\Carbon;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Imunisasi;
use App\KK;
use App\Vitamin;
use App\Posyandu;
use App\Nakes;
use App\NakesPosyandu;
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

class PemeriksaanLansiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function pemeriksaanLansia(Lansia $lansia)
    {
        $dataLansia = $lansia;
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $pj = PjLansia::where('id_lansia', $lansia->id)->first();
        $jenisImunisasi = Imunisasi::where('penerima', 'Lansia')->get();
        $jenisVitamin = Vitamin::where('penerima', 'Lansia')->get();
        $imunisasi = PemberianImunisasi::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $lansia->id_user)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $lansia->id_user)->get();
        $riwayatPenyakit = RiwayatPenyakit::where('id_lansia', $lansia->id)->get();
        $pemeriksaan = PemeriksaanLansia::where('id_lansia', $lansia->id)->orderBy('id', 'desc')->limit(5)->get();

        return view('admin.kesehatan-keluarga.pemeriksaan.pemeriksaan-lansia', compact('dataLansia', 'imunisasi', 'vitamin', 'umur', 'alergi', 'penyakitBawaan', 'riwayatPenyakit', 'pj', 'pemeriksaan', 'jenisImunisasi', 'jenisVitamin'));
    }
}
