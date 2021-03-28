<?php

namespace App\Http\Controllers\admin\KesehatanKeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function tambahKonsultasi()
    {
        return view('pages/admin/kesehatan-keluarga/tambah-konsul');
    }
}
