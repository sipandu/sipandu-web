<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProfile()
    {
        // dd(Auth::user()->profile_image);
        return response()->file(
            storage_path(Auth::user()->profile_image)
        );
    }


    public function anakhome(Request $request)
    {
        return view('pages/user/dashboard-anak');
    }

    public function ibuhome(Request $request)
    {
        return view('pages/user/dashboard-ibu');
    }

    public function lansiahome(Request $request)
    {
        return view('pages/user/dashboard-lansia');
    }

    public function profile(Request $request)
    {
        return view('pages/auth/user/profile-user');
    }


}
