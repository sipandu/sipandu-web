<?php

namespace App\Http\Controllers\User\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Anak;
use App\Ibu;
use App\Lansia;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logoutUser');
    }


    public function showForm(Request $request)
    {
        return view('pages/auth/user/login-user');
    }

    public function submitLogin(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'captcha' => 'required|captcha'
        ],
        [
            'email.required' => "Email tidak boleh kosong",
            'email.email' => "Masukan email yang sesuai",
            'password.required' => "Password tidak boleh kosong",
            'captcha.required' => "Captha harus diisi",
            'captcha.captcha' => "Captha yang dimasukan salah",
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credential, $request->member)){
            $anak = Anak::where('id_user', Auth::user()->id)->first();
            $ibu = Ibu::where('id_user', Auth::user()->id)->first();
            $lansia = Lansia::where('id_user', Auth::user()->id)->first();

            if(Auth::check() && isset($anak)){
                if(request()->segment(1) != null){
                    return redirect(route('anak.home'));
                }
            }elseif(Auth::check() && isset($ibu)){
                if(request()->segment(1) != null){
                    return redirect(route('ibu.home'));
                }
            }elseif(Auth::check() && isset($lansia)){
                if(request()->segment(1) != null){
                    return redirect(route('lansia.home'));
                  }
            }else{
                abort(403);
            }
        }

        return redirect()->back()->with('message','Email atau password Anda Salah');
    }

    public function logoutUser(Request $request)
    {
       Auth::guard('web')->logout();
       return redirect('/');
    }
}
