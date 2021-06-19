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

class PemeriksaanBumilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function pemeriksaanBumil(Ibu $ibu)
    {
        $umur = Carbon::parse($ibu->tanggal_lahir)->age;
        
        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->first();
        if ($pemeriksaanIbu != NULL) {
            $usia_kandungan = $pemeriksaanIbu->usia_kandungan;
        } else {
            $usia_kandungan = '0';
        }
        
        $dataIbu = $ibu;
        $jenisImunisasi = Imunisasi::where('penerima', 'Ibu Hamil')->where('deleted_at', NULL)->get();
        $jenisVitamin = Vitamin::where('penerima', 'Ibu Hamil')->where('deleted_at', NULL)->get();
        $imunisasi = PemberianImunisasi::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $ibu->id_user)->get();
        $persalinan = Persalinan::where('id_ibu_hamil', $ibu->id)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $ibu->id_user)->get();
        $pemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->limit(5)->get();

        $anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_anak.nama_anak', 'asc')
        ->get();

        return view('admin.kesehatan-keluarga.pemeriksaan.pemeriksaan-bumil', compact('dataIbu', 'umur', 'usia_kandungan', 'pemeriksaan', 'imunisasi', 'vitamin', 'alergi', 'penyakitBawaan', 'jenisImunisasi', 'jenisVitamin', 'anak', 'persalinan'));
    }
}
