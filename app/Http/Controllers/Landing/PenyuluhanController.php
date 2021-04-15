<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Penyuluhan;
use Illuminate\Http\Request;

class PenyuluhanController extends Controller
{
    public function index()
    {
        $penyuluhan = Penyuluhan::orderby('created_at', 'desc')->paginate(8);
        $penyuluhan_terbaru = Penyuluhan::orderby('created_at', 'desc')->limit(5)->get();
        return view('pages/user/content/penyuluhan', compact('penyuluhan', 'penyuluhan_terbaru'));
    }

    public function show($slug)
    {
        $penyuluhan = Penyuluhan::where('slug', $slug)->first();
        $penyuluhan_terbaru = Penyuluhan::orderby('created_at', 'desc')->limit(3)->get();
        return view('pages/user/content/detail-penyuluhan', compact('penyuluhan', 'penyuluhan_terbaru'));
    }
}
