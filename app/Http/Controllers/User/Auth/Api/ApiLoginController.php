<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        try {

            $request->validate([
            'email' => 'email|required',
            'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Unauthorized'
            ]);
            }

                /*
                Flag role user
                    0, anak
                    1, bumil
                    2, lansia
                */

            $user = User::where('email', $request->email)->first();
            if ($user->role == "0") {
                $role = Anak::where('id_user', $user->id)->get()->first();
                $nama = $role->nama_anak;
                $posyandu = $role->id_posyandu;
            }
            else if ($user->role == '1') {
                $role = Ibu::where('id_user', $user->id)->get()->first();
                $nama = $role->nama_ibu_hamil;
                $posyandu = $role->id_posyandu;
            }
            else if ($user->role == '2') {
                $role = Lansia::where('id_user', $user->id)->get()->first();
                $nama = $role->nama_lansia;
                $posyandu = $role->id_posyandu;
            }

            if ($role->NIK == NULL) {
                $flagComplete = 0;
            }
            else {
                $flagComplete = 1;
            }

            if ( ! Hash::check($request->password, $user->password, [])){
            throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('authToke')->plainTextToken;

            return response()->json([
            'status_code' => 200,
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'message' => 'sucess',
            'user' => $user,
            'flag_complete' => $flagComplete,
            'posyandu' => $posyandu,
            'nama' => $nama
            ]);

        } catch (Exception $error) {
            return response()->json([
            'status_code' => 500,
            'message' => 'Error in Login',
            'error' => $error,
            ]);
        }
    }

    public function logout(Request $request){
            if($request->user() != null){
                $user = $request->user();
                $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Logout Successfull',
                ]);
            }else{
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Login First !',
                    ]);
            }
            // $user = User::where('id', $id)->get();
    }

    public function videoBg(Request $request){
        $files = Storage::files('/video');
        $rand = Arr::random($files, 1);

        return response()->json([
            'video' => $rand
        ]);
    }
}
