<?php

namespace App\Http\Controllers\Admin\ManajemenAkun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;

class DisableAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function disableAccount(Admin $admin)
    {
        $disable_account = $admin->update([
            'is_verified' => '0'
        ]);

        if ($disable_account) {
            return redirect()->back()->with(['success' => 'Akun Berhasil Dinonaktifkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Akun Gagal Dinonaktifkan']);
        }
    }
}
