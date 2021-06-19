<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga\Pemeriksaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Alergi;
use App\RiwayatPenyakit;

class AlergiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function simpanAlergi(User $user, Request $request)
    {
        $this->validate($request,[
            'nama_alergi' => "required|min:2|max:50",
            'kategori' => "required",
        ],
        [
            'nama_alergi.required' => "Nama alergi wajib diisi",
            'nama_alergi.min' => "Nama alergi minimal berjumlah 2 huruf",
            'nama_alergi.max' => "Nama alergi maksimal berjumlah 50 huruf",
            'kategori.required' => "Kategori alergi wajib dipilih",
        ]);

        // return($request);

        $alergi = Alergi::create([
            'id_user' => $user->id,
            'nama_alergi' => $request->nama_alergi,
            'kategori' => $request->kategori,
        ]);

        if ($alergi) {
            return redirect()->back()->with(['success' => 'Data Alergi Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Alergi Gagal di Simpan']);
        }
    }

}
