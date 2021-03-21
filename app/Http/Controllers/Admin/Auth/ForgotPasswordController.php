<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\Auth\ForgotActivationEmailUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Kabupaten;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{

    public function showForm(Request $request)
    {

        return view('pages.auth.admin.password.forgot-password');
    }


    public function postEmail(Request $request)
    {
        $this->validate($request,[
            'email' => "required|email|exists:tb_admin",
        ],
        [
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.exists' => "Email yang anda masukan tidak terdaftar",
        ]);

        $admin = Admin::whereEmail($request->email)->first();

        $admin->timestamps = false;
        $admin->otp_token = rand(100000,999999);
        $admin->updated_at = Carbon::now()->setTimezone('GMT+8');

        $admin->save();

        event(new ForgotActivationEmailAdmin($admin));

        return redirect()->route('form.verify.token')->with('message','Mohon Cek Emailmu Code OTP sudah di kirim');

    }
}
