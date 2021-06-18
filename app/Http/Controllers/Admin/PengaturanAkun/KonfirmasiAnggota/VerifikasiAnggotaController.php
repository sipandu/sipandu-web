<?php

namespace App\Http\Controllers\Admin\PengaturanAkun\KonfirmasiAnggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class VerifikasiAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function detailVerifikasiBumil(Request $request, User $user)
    {
        return view('admin.pengaturan-akun.konfirmasi-anggota.verifikasi-bumil', compact('user'));
    }

    public function detailVerifikasiAnak(Request $request, User $user)
    {
        return view('admin.pengaturan-akun.konfirmasi-anggota.verifikasi-anak', compact('user'));
    }

    public function detailVerifikasiLansia(Request $request, User $user)
    {
        return view('admin.pengaturan-akun.konfirmasi-anggota.verifikasi-lansia', compact('user'));
    }
}
