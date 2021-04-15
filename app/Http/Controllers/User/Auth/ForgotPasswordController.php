<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\Auth\ForgotActivationEmailUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
class ForgotPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showForm(Request $request)
    {
        return view('pages.auth.user.password.forgot-password');
    }


    public function postEmail(Request $request)
    {
        $this->validate($request,[
            'email' => "required|email|exists:tb_user",
        ],
        [
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.exists' => "Email yang anda masukan tidak terdaftar",
        ]);


        $user = User::whereEmail($request->email)->first();

        $user->timestamps = false;
        $user->otp_token = rand(100000,999999);
        $user->updated_at = Carbon::now()->setTimezone('GMT+8');

        $user->save();

        event(new ForgotActivationEmailUser($user));

        return redirect()->route('user.form.verify.token')->with('message','Mohon Cek Emailmu Code OTP sudah di kirim');

    }

    public function postTelegram(Request $request)
    {
        $user = User::where('username_tele', $request->telegram)->first();
        $user->timestamps = false;
        $user->otp_token = rand(100000,999999);
        $user->updated_at = Carbon::now()->setTimezone('GMT+8');

        $user->save();

        $url = 'https://bagushikano-sipandu-test.herokuapp.com/api/request/token/forget-password';

        $response = Http::post($url, [
            'chat_id' => $user->id_chat_tele,
            'token' => $user->otp_token,
        ]);

        if($response->successful()) {
            return redirect()->route('user.form.verify.token')->with('message','Mohon Cek Telegrammu Code OTP sudah di kirim');
        }
    }
}
