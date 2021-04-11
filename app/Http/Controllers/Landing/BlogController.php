<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\InformasiPenting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $informasi = InformasiPenting::orderby('created_at', 'desc')->paginate(8);
        $populer_informasi = InformasiPenting::orderby('dilihat', 'desc')->limit(5)->get();
        return view('pages.user.content.news', compact('informasi', 'populer_informasi'));
    }

    public function show($slug)
    {
        $informasi = InformasiPenting::where('slug', $slug)->first();
        $informasi->dilihat = $informasi->dilihat + 1;
        $informasi->save();
        $informasi_terbaru = InformasiPenting::orderby('created_at', 'desc')->limit(5)->get();
        return view('pages.user.content.detail-news', compact('informasi', 'informasi_terbaru'));
    }
}
