<?php

namespace App\Http\Controllers\User\RiwayatKeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posyandu;

class RiwayatKeluargaController extends Controller
{
    public function keluargaAnak()
    {
        return view('pages/user/riwayat-keluarga/keluarga-anak');
    }
}
