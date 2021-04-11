<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InformasiPenting;
use App\Penyuluhan;

class LandingController extends Controller
{
    public function index()
    {
        $informasi_terbaru = InformasiPenting::orderby('created_at', 'desc')->limit(3)->get();
        $penyuluhan_terbaru = Penyuluhan::orderby('created_at', 'desc')->limit(3)->get();
        return view('pages/user/content/landing-page', compact('informasi_terbaru', 'penyuluhan_terbaru'));
    }
}
