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


}
