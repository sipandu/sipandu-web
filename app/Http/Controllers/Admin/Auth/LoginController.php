<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('pages/auth/admin/login-admin');
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

        if (Auth::guard('admin')->attempt($credential, $request->member)){
            return redirect()->intended(route('Admin Home'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logoutAdmin(Request $request)
    {
       Auth::guard('admin')->logout();
       // $request->session()->invalidate();
       return redirect(route('form.admin.login'));
    }

}
