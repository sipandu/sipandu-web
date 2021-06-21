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
use Carbon\Carbon;

class ApiUserDataController extends Controller
{
    public function getUserAnak(Request $request)
    {
        //Auth User
        $idUser = User::where('email', $request->email)->first();
        $user = User::find($idUser->id);
        $profileImg = $user->getUrlImage();
        $anak = Anak::whereId_user($idUser->id)->first();
        $anakJml = User::where('id_kk', $idUser->id_kk)->where('role', '0')->with('anak')->count();
        $bumilJml = User::where('id_kk', $idUser->id_kk)->where('role', '1')->with('ibu')->count();
        $lansiaJml = User::where('id_kk', $idUser->id_kk)->where('role', '2')->with('lansia')->count();
        $totalKeluarga = $anakJml + $bumilJml + $lansiaJml;
        $KK = KK::where('id', $idUser->id_kk)->first();
        $umur = Carbon::parse($anak->tanggal_lahir)->diff(Carbon::now()->setTimezone('GMT+8'))->format('%y Tahun, %m Bulan');;
        return response()->json([
            'status_code' => 200,
            'user' => $user,
            'anak' => $anak,
            'profile_img' => $profileImg,
            'total_keluarga' => $totalKeluarga,
            'kartu_keluarga' => $KK,
            'umur' => $umur
        ]);
    }

    public function getUserIbu(Request $request)
    {
        //Auth User
        $idUser = User::where('email', $request->email)->first();
        $user = User::find($idUser->id);
        $profileImg = $user->getUrlImage();
        $ibu = Ibu::whereId_user($idUser->id)->first();
        $anakJml = User::where('id_kk', $idUser->id_kk)->where('role', '0')->with('anak')->count();
        $bumilJml = User::where('id_kk', $idUser->id_kk)->where('role', '1')->with('ibu')->count();
        $lansiaJml = User::where('id_kk', $idUser->id_kk)->where('role', '2')->with('lansia')->count();
        $totalKeluarga = $anakJml + $bumilJml + $lansiaJml;
        $KK = KK::where('id', $idUser->id_kk)->first();
        return response()->json([
            'status_code' => 200,
            'user' => $user,
            'ibu' => $ibu,
            'profile_img' => $profileImg,
            'total_keluarga' => $totalKeluarga,
            'kartu_keluarga' => $KK
        ]);
    }

    public function getUserLansia(Request $request)
    {
        //Auth User
        $idUser = User::where('email', $request->email)->first();
        $user = User::find($idUser->id);
        $profileImg = $user->getUrlImage();
        $lansia = Lansia::whereId_user($idUser->id)->first();
        $anakJml = User::where('id_kk', $idUser->id_kk)->where('role', '0')->with('anak')->count();
        $bumilJml = User::where('id_kk', $idUser->id_kk)->where('role', '1')->with('ibu')->count();
        $lansiaJml = User::where('id_kk', $idUser->id_kk)->where('role', '2')->with('lansia')->count();
        $totalKeluarga = $anakJml + $bumilJml + $lansiaJml;
        $KK = KK::where('id', $idUser->id_kk)->first();
        return response()->json([
            'status_code' => 200,
            'user' => $user,
            'lansia' => $lansia,
            'profile_img' => $profileImg,
            'total_keluarga' => $totalKeluarga,
            'kartu_keluarga' => $KK
        ]);
    }

    public function getUserKeluarga(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $anak = User::where('id_kk', $idUser->id_kk)->where('role', '0')->with('anak')->get()->map(function($item){
            $item->profile_image = $item->getUrlImage();
            return $item;
        });
        $bumil = User::where('id_kk', $idUser->id_kk)->where('role', '1')->with('ibu')->get()->map(function($item){
            $item->profile_image = $item->getUrlImage();
            return $item;
        });
        $lansia = User::where('id_kk', $idUser->id_kk)->where('role', '2')->with('lansia')->get()->map(function($item){
            $item->profile_image = $item->getUrlImage();
            return $item;
        });
        return response()->json([
            'status_code' => 200,
            'user_with_anak' => $anak,
            'user_with_ibu' => $bumil,
            'user_with_lansia' => $lansia
        ]);
    }
}
