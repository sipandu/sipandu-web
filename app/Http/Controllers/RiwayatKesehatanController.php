<?php

namespace App\Http\Controllers;

use App\PemeriksaanAnak;
use App\User;
use Illuminate\Http\Request;

class RiwayatKesehatanController extends Controller
{
    public function downloadFile()
    {
        // $user = User::find($id);
        // if ($user->role == '0') {
        //     $riwayat = PemeriksaanAnak::where('id_anak', $user->anak->id)->get();
        //     return view('pages.admin.kesehatan-keluarga.riwayat-pemeriksaan.anak');
        // } else if($user->role == '1') {

        // } else if($user->role == '2') {

        // }

        return view('pages.admin.kesehatan-keluarga.riwayat-pemeriksaan.anak');
    }
}
