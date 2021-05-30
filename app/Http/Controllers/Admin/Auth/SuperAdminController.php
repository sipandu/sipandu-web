<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function semuaSuperAdmin()
    {
        $superAdmin = SuperAdmin::get();
        return view('admin/auth/super-admin/semua-super-admin', compact('superAdmin'));
    }

}
