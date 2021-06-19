<?php

namespace App\Http\Controllers\Admin\PengaturanAkun\GantiJabatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Admin;

class GantiJabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function gantiJabatan()
    {
        $pegawai = Pegawai::orderBy('nama_pegawai', 'DESC')->get();
        return view('admin.pengaturan-akun.ganti-jabatan.ganti-jabatan', compact('pegawai'));
    }

    public function updateJabatan(Request $request)
    {
        $request->validate([
            'pegawai' => "required|exists:tb_pegawai,id",
            'jabatan' => "required|exists:tb_pegawai,jabatan",
        ],
        [
            'pegawai.required' => "Pegawai wajib dipilih",
            'pegawai.exists' => "Nama pegawai tidak tersedia",
            'jabatan.required' => "Jabatan pegawai wajib dipilih",
            'jabatan.exists' => "Jabatan pegawai tidak tersedia",
        ]);

        $pegawai = Pegawai::where('id', $request->pegawai)->update([
            'jabatan' => $request->jabatan
        ]);

        if ($pegawai) {
            return redirect()->back()->with(['success' => 'Jabatan Pegawai Berhasil Diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Jabatan Pegawai Gagal Diubah']);
        }
    }
}
