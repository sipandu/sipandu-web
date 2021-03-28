<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kabupaten;

class TambahKeluargaController extends Controller
{
    public function tambahAnak()
    {
        $kabupaten = Kabupaten::get()->all();
        return view('pages/auth/user/tambah-keluarga/tambah-keluarga-anak', compact(['kabupaten']));
    }

    public function tambahIbu()
    {
        $kabupaten = Kabupaten::get()->all();
        return view('pages/auth/user/tambah-keluarga/tambah-keluarga-ibu', compact(['kabupaten']));
    }

    public function tambahLansia()
    {
        $kabupaten = Kabupaten::get()->all();
        return view('pages/auth/user/tambah-keluarga/tambah-keluarga-lansia', compact(['kabupaten']));
    }
}
