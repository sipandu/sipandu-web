<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KK;
use App\User;
use App\Anak;
use App\Ibu;
use App\Vitamin;
use App\PemberianVitamin;
use App\PemberianImunisasi;
use App\PemeriksaanAnak;
use App\PemeriksaanIbu;
use App\PemeriksaanLansia;
use Auth;
use App\Lansia;
use App\Kabupaten;
use App\Posyandu;
use App\Kegiatan;
use App\Pegawai;
use App\Pengumuman;
use App\Alergi;
use App\PenyakitBawaan;
use App\RiwayatPenyakit;

class ApiKesehatanDataController extends Controller
{
    public function getVitaminHistory(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $vitamin = PemberianVitamin::where('id_user', $idUser->id)->with('vitamin')->orderby('created_at','desc')->get();
        return response()->json([
            'status_code' => 200,
            'riwayat_vitamin' => $vitamin,
            'message' => 'success',
        ]);
    }

    public function getImunisasiHistory(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $imunisasi = PemberianImunisasi::where('id_user', $idUser->id)->with('imunisasi')->orderby('created_at','desc')->get();
        return response()->json([
            'status_code' => 200,
            'riwayat_imunisasi' => $imunisasi,
            'message' => 'success',
        ]);
    }

    public function getPemeriksaanAnakHistory(Request $request)
    {
        /*
        0 -> pemeriksaan
        1 -> konsultasi
        */
        $idUser = User::where('email', $request->email)->first();
        $anak = Anak::where('id_user', $idUser->id)->first();

        if ($request->flag == 0) {
            $pemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->get();
        }
        else if ($request->flag == 1) {
            $pemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', 'Konsultasi')->orderby('created_at','desc')->get();
        }
        return response()->json([
            'status_code' => 200,
            'riwayat_pemeriksaan_anak' => $pemeriksaan,
            'message' => 'success',
        ]);
    }

    public function getKesehatanSummaryAnak(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $anak = Anak::where('id_user', $idUser->id)->first();
        $imunisasi = PemberianImunisasi::where('id_user', $idUser->id)->orderby('created_at','desc')->get()->count();
        $vitamin = PemberianVitamin::where('id_user', $idUser->id)->orderby('created_at','desc')->get()->count();
        $konsultasi = PemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', 'Konsultasi')->orderby('created_at','desc')->get()->count();
        $pemeriksaanAnak = PemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->get();

        /*
        send 1 -> if theres pemeriksaan data exist
        send 0 -> if theres none pemeriksaan data exist
        */
        if ($pemeriksaanAnak != null) {
            return response()->json([
                'status_code' => 200,
                'nama_anak' => $anak->nama_anak,
                'flag' => 1,
                'riwayat_pemeriksaan_anak' => $pemeriksaanAnak,
                'jumlah_vitamin' => $vitamin,
                'jumlah_konsultasi' => $konsultasi,
                'jumlah_imunisasi' => $imunisasi,
                'jumlah_pemeriksaan' => $pemeriksaanAnak->count(),
                'id_anak' => $anak->id,
                'message' => 'success'
            ]);
        }
        else {
            return response()->json([
                'status_code' => 200,
                'nama_anak' => $anak->nama_anak,
                'flag' => 0,
                'riwayat_pemeriksaan_anak' => null,
                'jumlah_vitamin' => $vitamin,
                'jumlah_konsultasi' => $konsultasi,
                'jumlah_imunisasi' => $imunisasi,
                'jumlah_pemeriksaan' => $pemeriksaanAnak->count(),
                'id_anak' => $anak->id,
                'message' => 'success',
            ]);
        }
    }

    public function getKesehatanSummaryIbu(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $ibu = Ibu::where('id_user', $idUser->id)->first();
        $imunisasi = PemberianImunisasi::where('id_user', $idUser->id)->orderby('created_at','desc')->get()->count();
        $vitamin = PemberianVitamin::where('id_user', $idUser->id)->orderby('created_at','desc')->get()->count();
        $konsultasi = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->where('jenis_pemeriksaan', 'Konsultasi')->orderby('created_at','desc')->get()->count();
        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->get();

        /*
        send 1 -> if theres pemeriksaan data exist
        send 0 -> if theres none pemeriksaan data exist
        */
        if ($pemeriksaanIbu != null) {
            return response()->json([
                'status_code' => 200,
                'nama_ibu' => $ibu->nama_ibu_hamil,
                'flag' => 1,
                'riwayat_pemeriksaan_ibu' => $pemeriksaanIbu,
                'jumlah_vitamin' => $vitamin,
                'jumlah_konsultasi' => $konsultasi,
                'jumlah_imunisasi' => $imunisasi,
                'jumlah_pemeriksaan' => $pemeriksaanIbu->count(),
                'id_ibu' => $ibu->id,
                'message' => 'success'
            ]);
        }
        else {
            return response()->json([
                'status_code' => 200,
                'nama_anak' => $ibu->nama_ibu,
                'flag' => 0,
                'riwayat_pemeriksaan_ibu' => null,
                'jumlah_vitamin' => $vitamin,
                'jumlah_konsultasi' => $konsultasi,
                'jumlah_imunisasi' => $imunisasi,
                'jumlah_pemeriksaan' => $pemeriksaanIbu->count(),
                'id_ibu' => $ibu->id,
                'message' => 'success',
            ]);
        }
    }

    public function getKesehatanSummaryLansia(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $lansia = Lansia::where('id_user', $idUser->id)->first();
        $imunisasi = PemberianImunisasi::where('id_user', $idUser->id)->orderby('created_at','desc')->get()->count();
        $vitamin = PemberianVitamin::where('id_user', $idUser->id)->orderby('created_at','desc')->get()->count();
        $konsultasi = PemeriksaanLansia::where('id_lansia', $lansia->id)->where('jenis_pemeriksaan', 'Konsultasi')->orderby('created_at','desc')->get()->count();
        $pemeriksaanLansia = PemeriksaanLansia::where('id_lansia', $lansia->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->get();

        /*
        send 1 -> if theres pemeriksaan data exist
        send 0 -> if theres none pemeriksaan data exist
        */
        if ($pemeriksaanLansia != null) {
            return response()->json([
                'status_code' => 200,
                'nama_ibu' => $lansia->nama_lansia,
                'flag' => 1,
                'riwayat_pemeriksaan_lansia' => $pemeriksaanLansia,
                'jumlah_vitamin' => $vitamin,
                'jumlah_konsultasi' => $konsultasi,
                'jumlah_imunisasi' => $imunisasi,
                'jumlah_pemeriksaan' => $pemeriksaanLansia->count(),
                'message' => 'success'
            ]);
        }
        else {
            return response()->json([
                'status_code' => 200,
                'nama_anak' => $lansia->nama_lansia,
                'flag' => 0,
                'riwayat_pemeriksaan_lansia' => null,
                'jumlah_vitamin' => $vitamin,
                'jumlah_konsultasi' => $konsultasi,
                'jumlah_imunisasi' => $imunisasi,
                'jumlah_pemeriksaan' => $pemeriksaanLansia->count(),
                'message' => 'success',
            ]);
        }
    }

    public function getAlergi(Request $request) {
        $idUser = User::where('email', $request->email)->first();
        $alergi = Alergi::where('id_user', $idUser->id)->orderby('created_at','desc')->get();
        return response()->json([
            'status_code' => 200,
            'alergi' => $alergi,
            'message' => 'success',
        ]);

    }

    public function getPenyakitBawaan(Request $request) {
        $idUser = User::where('email', $request->email)->first();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $idUser->id)->orderby('created_at','desc')->get();
        return response()->json([
            'status_code' => 200,
            'penyakit_bawaan' => $penyakitBawaan,
            'message' => 'success',
        ]);
    }

    public function getMasalahKesehatanLansia(Request $request) {
        $idUser = User::where('email', $request->email)->first();
        $lansia = Lansia::where('id_user', $idUser->id)->first();
        $masalahKesehatan = RiwayatPenyakit::where('id_lansia', $lansia->id)->orderby('created_at','desc')->get();
        return response()->json([
            'status_code' => 200,
            'masalah_kesehatan_lansia' => $masalahKesehatan,
            'message' => 'success',
        ]);
    }

    public function getKeluargakuAnak(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $anak = Anak::where('id_user', $idUser->id)->first();
        $pemeriksaanAnak = PemeriksaanAnak::where('id_anak', $anak->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->first();

        /*
        send 1 -> if theres pemeriksaan data exist
        send 0 -> if theres none pemeriksaan data exist
        */
        if ($pemeriksaanAnak != null) {
            return response()->json([
                'status_code' => 200,
                'nama_anak' => $anak->nama_anak,
                'flag' => 1,
                'pemeriksaan_anak_terakhir' => $pemeriksaanAnak->tanggal_pemeriksaan,
                'status_gizi_anak' => $pemeriksaanAnak->status_gizi,
                'message' => 'success',
            ]);
        }
        else {
            return response()->json([
                'status_code' => 200,
                'nama_anak' => $anak->nama_anak,
                'flag' => 0,
                'pemeriksaan_anak_terakhir' => null,
                'status_gizi_anak' => null,
                'message' => 'success',
            ]);
        }
    }

    public function getPemeriksaanIbuHistory(Request $request)
    {
        /*
        0 -> pemeriksaan
        1 -> konsultasi
        */
        $idUser = User::where('email', $request->email)->first();
        $ibu = Ibu::where('id_user', $idUser->id)->first();

        if ($request->flag == 0) {
            $pemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->get();
        }
        else if ($request->flag == 1) {
            $pemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->where('jenis_pemeriksaan', 'Konsultasi')->orderby('created_at','desc')->get();
        }
        return response()->json([
            'status_code' => 200,
            'riwayat_pemeriksaan_ibu' => $pemeriksaan,
            'message' => 'success',
        ]);
    }

    public function getKeluargakuIbu(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $ibu = Ibu::where('id_user', $idUser->id)->first();
        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->first();

        /*
        send 1 -> if theres pemeriksaan data exist
        send 0 -> if theres none pemeriksaan data exist
        */
        if ($pemeriksaanIbu != null) {
            return response()->json([
                'status_code' => 200,
                'nama_ibu' => $ibu->nama_ibu_hamil,
                'flag' => 1,
                'pemeriksaan_ibu_terakhir' => $pemeriksaanIbu->tanggal_pemeriksaan,
                'usia_kandungan' => $pemeriksaanIbu->usia_kandungan,
                'message' => 'success',
            ]);
        }
        else {
            return response()->json([
                'status_code' => 200,
                'nama_ibu' => $ibu->nama_ibu_hamil,
                'flag' => 0,
                'pemeriksaan_ibu_terakhir' => null,
                'usia_kandungan' => null,
                'message' => 'success',
            ]);
        }
    }

    public function getPemeriksaanLansiaHistory(Request $request)
    {
        /*
        0 -> pemeriksaan
        1 -> konsultasi
        */
        $idUser = User::where('email', $request->email)->first();
        $lansia = Lansia::where('id_user', $idUser->id)->first();

        if ($request->flag == 0) {
            $pemeriksaan = PemeriksaanLansia::where('id_lansia', $lansia->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->get();
        }
        else if ($request->flag == 1) {
            $pemeriksaan = PemeriksaanLansia::where('id_lansia', $lansia->id)->where('jenis_pemeriksaan', 'Konsultasi')->orderby('created_at','desc')->get();
        }
        return response()->json([
            'status_code' => 200,
            'riwayat_pemeriksaan_lansia' => $pemeriksaan,
            'message' => 'success',
        ]);
    }

    public function getKeluargakuLansia(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $lansia = Lansia::where('id_user', $idUser->id)->first();
        $pemeriksaanLansia = PemeriksaanLansia::where('id_lansia', $lansia->id)->where('jenis_pemeriksaan', 'Pemeriksaan')->orderby('created_at','desc')->first();

        /*
        send 1 -> if theres pemeriksaan data exist
        send 0 -> if theres none pemeriksaan data exist
        */
        if ($pemeriksaanLansia != null) {
            return response()->json([
                'status_code' => 200,
                'nama_lansia' => $lansia->nama_lansia,
                'flag' => 1,
                'pemeriksaan_lansia_terakhir' => $pemeriksaanLansia->tanggal_pemeriksaan,
                'status_lansia' => $lansia->status,
                'imt' => $pemeriksaanLansia->IMT,
                'message' => 'success',
            ]);
        }
        else {
            return response()->json([
                'status_code' => 200,
                'nama_lansia' => $lansia->nama_lansia,
                'flag' => 0,
                'status_lansia' => $lansia->status,
                'pemeriksaan_lansia_terakhir' => null,
                'imt' => null,
                'message' => 'success',
            ]);
        }
    }

}
