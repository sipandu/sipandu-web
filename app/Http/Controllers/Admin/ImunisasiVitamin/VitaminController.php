<?php

namespace App\Http\Controllers\Admin\ImunisasiVitamin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;

class VitaminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function tambahVitamin(Request $request)
    {
        return view('pages/admin/vitamin/tambah-vitamin');
    }

    public function jenisVitamin()
    {
        return view('pages/admin/vitamin/jenis-vitamin');
    }
}
