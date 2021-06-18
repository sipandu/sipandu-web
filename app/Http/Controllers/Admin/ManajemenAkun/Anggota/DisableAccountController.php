<?php

namespace App\Http\Controllers\Admin\ManajemenAkun\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DisableAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function disableAccount(User $user)
    {
        $disable_account = $user->update([
            'status' => 0
        ]);

        if ($disable_account) {
            return redirect()->back()->with(['success' => 'Akun Berhasil Dinonaktifkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Akun Gagal Dinonaktifkan']);
        }
    }
}
