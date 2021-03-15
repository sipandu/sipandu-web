<?php

namespace App\Http\Controllers\User\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

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
            // return redirect()->intended(route('user.home'));
            return view('pages/user/dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logoutUser(Request $request)
    {
       Auth::guard('web')->logout();
       // $request->session()->invalidate();
       return redirect(route('form.user.login'));
    }


}
