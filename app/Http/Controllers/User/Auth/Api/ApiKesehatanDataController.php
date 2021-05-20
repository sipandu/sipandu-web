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
use Auth;
use App\Lansia;
use App\Kabupaten;
use App\Posyandu;
use App\Kegiatan;
use App\Pegawai;
use App\Pengumuman;

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
                'message' => 'success',
            ]);
        }
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

}
