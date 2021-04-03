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
}
