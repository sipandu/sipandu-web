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

class ApiUserDataController extends Controller
{
    public function getUserAnak(Request $request)
    {
        //Auth User
        $idUser = User::where('email', $request->email)->first();
        $user = User::find($idUser->id);
        $anak = Anak::whereId_user($idUser->id)->first();
        return response()->json([
            'status_code' => 200,
            'user' => $user,
            'anak' => $anak
        ]);
    }

    public function getUserIbu(Request $request)
    {
        //Auth User
        $idUser = User::where('email', $request->email)->first();
        $user = Ibu::find($idUser->id);
        $ibu = Ibu::whereId_user($idUser->id)->first();
        return response()->json([
            'status_code' => 200,
            'user' => $user,
            'ibu' => $ibu
        ]);
    }

    public function getUserLansia(Request $request)
    {
        //Auth User
        $idUser = User::where('email', $request->email)->first();
        $user = Lansia::find($idUser->id);
        $lansia = Lansia::whereId_user($idUser->id)->first();
        return response()->json([
            'status_code' => 200,
            'user' => $user,
            'lansia' => $lansia
        ]);
    }

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
            $kegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->get();
            return response()->json([
                'status_code' => 200,
                'kegiatan' => $kegiatan,
                'message' => 'success',
            ]);
        }elseif($request->role == '1'){
            $userdata = Ibu::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            $kegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->get();
            return response()->json([
                'status_code' => 200,
                'kegiatan' => $kegiatan,
                'message' => 'success',
            ]);
        }elseif($request->role == '2'){
            $userdata = Lansia::where('id_user', $idUser->id)->get()->first();
            $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
            $kegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->get();
            return response()->json([
                'status_code' => 200,
                'kegiatan' => $kegiatan,
                'message' => 'success',
            ]);
        }
    }
}
