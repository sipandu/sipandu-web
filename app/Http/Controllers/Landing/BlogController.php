<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InformasiPenting;
use App\TagBerita;

class BlogController extends Controller
{
    public function index()
    {
        $informasi = InformasiPenting::where('status', 'Aktif')->orderby('created_at', 'desc')->paginate(6);
        $populer_informasi = InformasiPenting::orderby('dilihat', 'desc')->limit(5)->get();
        return view('landing.news.news', compact('informasi', 'populer_informasi'));
    }

    public function show($slug)
    {
        $tag_berita = TagBerita::get();
        $informasi = InformasiPenting::where('slug', $slug)->first();
        $informasi->dilihat = $informasi->dilihat + 1;
        $informasi->save();
        $informasi_terbaru = InformasiPenting::orderby('created_at', 'desc')->limit(5)->get();
        return view('landing.news.news-detail', compact('informasi', 'informasi_terbaru', 'tag_berita'));
    }
}
