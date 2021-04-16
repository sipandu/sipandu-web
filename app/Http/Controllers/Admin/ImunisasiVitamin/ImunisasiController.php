<?php

namespace App\Http\Controllers\Admin\ImunisasiVitamin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;

class ImunisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function tambahImunisasi(Request $request)
    {
        return view('pages/admin/imunisasi/tambah-imunisasi');
    }
}
