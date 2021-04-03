<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posyandu;

class RiwayatKeluargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function keluargaAnak()
    {
        return view('pages/user/riwayat-keluarga/keluarga-anak');
    }

    public function keluargaIbu()
    {
        return view('pages/user/riwayat-keluarga/keluarga-ibu');
    }

    public function keluargaLansia()
    {
        return view('pages/user/riwayat-keluarga/keluarga-lansia');
    }

    public function riwayatKeluargaAnak()
    {
        return view('pages/user/riwayat-keluarga/riwayat-keluarga-anak');
    }

    public function riwayatKeluargaIbu()
    {
        return view('pages/user/riwayat-keluarga/riwayat-keluarga-ibu');
    }

    public function riwayatKeluargaLansia()
    {
        return view('pages/user/riwayat-keluarga/riwayat-keluarga-lansia');
    }
}
