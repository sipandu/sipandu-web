<?php

namespace App\Http\Controllers;

use App\Posyandu;
use Illuminate\Http\Request;

class SIGPosyanduController extends Controller
{
    public function index()
    {
        return view('pages.admin.informasi.sig-posyandu');
    }

    public function getData()
    {
        $posyandu = Posyandu::select('id', 'nama_posyandu', 'alamat', 'latitude', 'longitude', 'nomor_telepon')
            ->where('latitude', '!=', NULL)
            ->where('longitude', '!=', NULL)
            ->get();
        return response()->json(['posyandu' => $posyandu]);
    }

    public function sigPolosan()
    {
        return view('pages.admin.informasi.sig-polos');
    }
}
