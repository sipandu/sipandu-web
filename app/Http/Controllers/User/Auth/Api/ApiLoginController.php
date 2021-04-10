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
            }
            else if ($user->role == '1') {
                $role = Ibu::where('id_user', $user->id)->get()->first();
            }
            else if ($user->role == '2') {
                $role = Lansia::where('id_user', $user->id)->get()->first();
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
            'flag_complete' => $flagComplete
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
}
