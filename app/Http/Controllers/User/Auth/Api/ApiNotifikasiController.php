<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NotifikasiUser;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;


class ApiNotifikasiController extends Controller
{
    public function getNotifikasi(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $notifikasi = NotifikasiUser::where('id_user', $idUser->id)->where('read_flag', 0)->orderby('created_at', 'desc')->get();
        $flag = 1;

        if ($notifikasi->count() == 0) {
            $notifikasi = NotifikasiUser::where('id_user', $idUser->id)->limit(7)->orderby('created_at', 'desc')->get();
            $flag = 0;
        }
        return response()->json([
            'status_code' => 200,
            'notifikasi' => $notifikasi,
            'flag' => $flag,
            'message' => 'success',
        ]);
    }


    public function markReadNotifikasi(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();

        $notif = NotifikasiUser::where('id_user', $idUser->id)->update([
            'read_flag' => 1,
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'success',
        ]);
    }

    public function getUnreadNotification(Request $request)
    {
        $idUser = User::where('email', $request->email)->first();
        $notifikasi = NotifikasiUser::where('id_user', $idUser->id)->where('read_flag', 0)->orderby('created_at', 'desc')->get();
        $flag = 1;

        if ($notifikasi->count() == 0) {
            $flag = 0;
        }

        return response()->json([
            'status_code' => 200,
            'flag' => $flag,
            'message' => 'success',
        ]);
    }
}
