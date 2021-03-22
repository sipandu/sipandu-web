<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
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

            $user = User::where('email', $request->email)->first();

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
        try{
            $user = $request->user();
            // $user = User::where('id', $id)->get();
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            return response()->json([
                'status_code' => 200,
                'message' => 'Logout Successfull',
        ]);
        } catch (Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Logout',
                'error' => $error,
                ]);
        }
        
    }
}
