<?php

namespace App\Http\Controllers\Admin\PengaturanAkun\KonfirmasiAnggota;

use App\Http\Controllers\Controller;
use App\Mail\NotificationAccUser;
use App\Mail\NotificationRjctUser;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use Mail;
use App\User;

class KonfirmasiAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function terimaAnggota(User $user)
    {
        $user->is_verified = '1';
        $user->save();

        Mail::to($user->email)->send(new NotificationAccUser($user));

        if ($user) {
            return redirect()->route('Verifikasi Anggota')->with(['success' => 'Konfirmasi Akun Berhasil Dilakukan']);
        } else {
            return redirect()->back()->with(['failed' => 'Penolakan Akun Gagal Dilakukan']);
        }
    }

    public function tolakAnggota(Request $request, User $user)
    {
        $this->validate($request, [
            'keterangan' => "required|regex:/^[a-z .,0-9]+$/i|min:5",
        ],
        [
            'keterangan.required' => "Keterangan penolokan akun wajib diisi",
            'keterangan.regex' => "Format keterangan penolakan akun tidak sesuai",
            'keterangan.min' => "Keterangan yang diberikan minimal berjumlah 5 karakter",
        ]);

        $user->is_verified = '0';
        $user->keterangan = $request->keterangan;
        $user->save();

        Mail::to($user->email)->send(new NotificationRjctUser($user));

        if ($user) {
            return redirect()->route('Verifikasi Anggota')->with(['success' => 'Penolakan Akun Berhasil Dilakukan']);
        } else {
            return redirect()->back()->with(['failed' => 'Penolakan Akun Gagal Dilakukan']);
        }
    }
}
