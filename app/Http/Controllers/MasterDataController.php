<?php

namespace App\Http\Controllers;
use App\Posyandu;
use App\Admin;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function listPosyandu()
    {
        $posyandu = Posyandu::orderBy('nama_posyandu', 'asc')->with('Pegawai')->get();
        $pegawai = Pegawai::where('jabatan', 'admin')->get();

        return view('pages/admin/master-data/data-posyandu', compact('posyandu', 'pegawai'));
    }

    public function addPosyandu()
    {
        $kabupaten = Kabupaten::get();
        $kecamatan = Kecamatan::get();
        $desa = Desa::get();

        return view('pages/admin/master-data/new-posyandu', compact('kabupaten', 'kecamatan', 'desa'));
    }

    public function storePosyandu(Request $request)
    {
        // $this->validate($request,[
        //     'nama_posyandu' => 'required|email',
        //     'password' => 'required|alpha_dash|min:8'
        // ]);

        $admin = Admin::create([
            'email' => $request->email,
            'password' => $request->password,
            'profile_image' => "profile123",
            'is_verified' => "1"
        ]);

        $desa = Desa::where('nama_desa', $request->desa)->get()->first();

        $posyandu = Posyandu::create([
            'id_desa' => $desa->id,
            'id_admin' => $admin->id,
            'id_chat_group_tele' => 1234,
            'nama_posyandu' => $request->nama_posyandu,
            'alamat' => $request->alamat_posyandu,
            'nomor_telepon' => "0812343",
            'banjar' => $request->banjar,
            'latitude' => $request->lat,
            'longitude' => $request->lng
        ]);

        Pegawai::create([
            'id' => 44,
            'id_posyandu' => $posyandu->id,
            'id_admin' => $admin->id,
            'nama_pegawai' => $request->nama_pegawai,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->gender,
            'alamat' => $request->alamat_admin,
            'nomor_telepon' => $request->no_telp,
            'jabatan' => "admin",
            'username_telegram' => $request->telegram,
            'nik' => $request->nik,
            'file_ktp' => "qqsda134"
        ]);
    }
}
