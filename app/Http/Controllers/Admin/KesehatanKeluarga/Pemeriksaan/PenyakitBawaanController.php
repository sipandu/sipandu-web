<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga\Pemeriksaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PenyakitBawaan;
use App\User;

class PenyakitBawaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function simpanPenyakitBawaan(User $user, Request $request)
    {
        $this->validate($request,[
            'nama_penyakit' => "required|min:3|max:50",
        ],
        [
            'nama_penyakit.required' => "Nama penyakit bawaan wajib diisi",
            'nama_penyakit.min' => "Nama penyakit bawaan minimal berjumlah 3 huruf",
            'nama_penyakit.max' => "Nama penyakit bawaan maksimal berjumlah 50 huruf",
        ]);

        $penyakitBawaan = PenyakitBawaan::create([
            'id_user' => $user->id,
            'nama_penyakit' => $request->nama_penyakit,
        ]);

        if ($penyakitBawaan) {
            return redirect()->back()->with(['success' => 'Data Penyakit Bawaan Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Penyakit Bawaan Gagal di Simpan']);
        }
    }
}
