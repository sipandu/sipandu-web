<?php

namespace App\Http\Controllers;

use App\InformasiPenting;
use Illuminate\Http\Request;
use App\Mover;
class InformasiPentingController extends Controller
{
    public function index()
    {
        $informasi = InformasiPenting::orderby('tanggal', 'desc')->get();
        return view('pages.admin.informasi.informasi-penting.home', compact('informasi'));
    }

    public function create()
    {
        return view('pages.admin.informasi.informasi-penting.create');
    }

    public function store(Request $request)
    {
        $filename = Mover::slugFile($request->file('image'), 'app/informasi/informasi-penting/');
        $informasi = new InformasiPenting();
        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->informasi = $request->informasi;
        $informasi->tanggal = NOW();
        $informasi->image = $filename;
        $informasi->save();
        return redirect()->route('informasi_penting.home')->with(['success' => 'Data Berhasil Disimpan']);
    }
}
