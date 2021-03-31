<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Posyandu;
use Hash;

class GetData extends Controller
{
    //
    public function dataPosyandu(Request $request){
        try{
            $user = $request->user();
            if($user->role == '0'){
                $userdata = Anak::where('id_user', $user->id)->get()->first();
                $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
                return response()->json([
                    'status_code' => 200,
                    'posyandu' => $posyandu,
                    'message' => 'success',
                ]);
            }elseif($user->role == '1'){
                $userdata = Ibu::where('id_user', $user->id)->get()->first();
                $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
                return response()->json([
                    'status_code' => 200,
                    'posyandu' => $posyandu,
                    'message' => 'success',
                ]);
            }elseif($user->role == '2'){
                $userdata = Lansia::where('id_user', $user->id)->get()->first();
                $posyandu = Posyandu::where('id', $userdata->id_posyandu)->get()->first();
                return response()->json([
                    'status_code' => 200,
                    'posyandu' => $posyandu,
                    'message' => 'success',
                ]);
            }
        } catch(Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Get data Posyandu',
                'error' => $error,
                ]);
        }
        
    }
}
