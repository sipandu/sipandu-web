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
            'email' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credential, $request->member)){
            $idUser = Auth::user()->id;
            $anak = Anak::where('id_user',$idUser)->first();
            $ibu = Ibu::where('id_user',$idUser)->first();
            $lansia = Lansia::where('id_user',$idUser)->first();

            if($anak != null){
                return redirect()->intended(route('anak.home'));
            }elseif($ibu != null){
                 return redirect()->intended(route('ibu.home'));
            }elseif($lansia != null){
                return redirect()->intended(route('lansia.home'));
            }
            // return redirect()->intended(route('user.home'));


        }

        return redirect()->back()->with('message','Email atau password Anda Salah');
    }

    public function logoutUser(Request $request)
    {
       Auth::guard('web')->logout();
       // $request->session()->invalidate();
       return redirect(route('form.user.login'));
    }


}
