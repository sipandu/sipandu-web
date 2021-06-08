<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KK;
use App\User;
use App\Anak;
use App\Ibu;
use Auth;
use App\Lansia;
use App\Kabupaten;
use App\Posyandu;
use App\Kegiatan;
use App\Pegawai;
use App\Pengumuman;

class ApiPosyanduDataController extends Controller
{
    public function getPosyandu(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        if($request->role == '0'){
            $userdata = Anak::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            return response()->json([
                'status_code' => 200,
                'posyandu' => $posyandu,
                'message' => 'success',
            ]);
        }elseif($request->role == '1'){
            $userdata = Ibu::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            return response()->json([
                'status_code' => 200,
                'posyandu' => $posyandu,
                'message' => 'success',
            ]);
        }elseif($request->role == '2'){
            $userdata = Lansia::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            return response()->json([
                'status_code' => 200,
                'posyandu' => $posyandu,
                'message' => 'success',
            ]);
        }
    }

    public function getPosyanduKegiatan(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        if($request->role == '0'){
            $userdata = Anak::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            $kegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->get()->map(function($item){
                $item->status = $item->determineKegiatanStatus();
                return $item;
            });;
            return response()->json([
                'status_code' => 200,
                'kegiatan' => $kegiatan,
                'message' => 'success',
            ]);
        }elseif($request->role == '1'){
            $userdata = Ibu::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            $kegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->get()->map(function($item){
                $item->status = $item->determineKegiatanStatus();
                return $item;
            });;
            return response()->json([
                'status_code' => 200,
                'kegiatan' => $kegiatan,
                'message' => 'success',
            ]);
        }elseif($request->role == '2'){
            $userdata = Lansia::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            $kegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->get()->map(function($item){
                $item->status = $item->determineKegiatanStatus();
                return $item;
            });;
            return response()->json([
                'status_code' => 200,
                'kegiatan' => $kegiatan,
                'message' => 'success',
            ]);
        }
    }

    public function getTenagaKesehatanPosyandu(Request $request)
    {
        $pegawai = Pegawai::where('id_posyandu', $request->posyandu)->where('jabatan', 'tenaga kesehatan')->get();
        return response()->json([
            'status_code' => 200,
            'pegawai' => $pegawai,
            'message' => 'success',
        ]);
    }

    public function getPengumuman(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        if ($request->role == 0) {
            $userdata = Anak::where('id_user', $idUser->id)->get()->first();
        }
        else if ($request->role == 1) {
            $userdata = Ibu::where('id_user', $idUser->id)->get()->first();
        }
        else if ($request->role == 2) {
            $userdata = Lansia::where('id_user', $idUser->id)->get()->first();
        }
        $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
        $pengumuman = Pengumuman::where('id_posyandu', $posyandu->id)->orderby('created_at', 'desc')->limit(10)->get()->map(function($item){
            $item->foto = $item->getUrlImage();
            return $item;
        });
        return response()->json([
            'status_code' => 200,
            'pengumuman' => $pengumuman,
            'message' => 'success',
        ]);

    }
}
