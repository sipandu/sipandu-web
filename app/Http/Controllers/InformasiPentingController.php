<?php

namespace App\Http\Controllers;

use App\InformasiPenting;
use Illuminate\Http\Request;
use App\Mover;
use Illuminate\Support\Str;
use File;
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
        $request->validate([
            'judul_informasi' => 'required|min:2',
            'informasi' => 'required|min:2',
            'image' => 'max:2000|mimes:png,jpg,svg,jpeg',
        ]);

        $filename = Mover::slugFile($request->file('image'), 'app/informasi/informasi-penting/');
        $informasi = new InformasiPenting();
        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->informasi = $request->informasi;
        $informasi->tanggal = NOW();
        $informasi->image = $filename;
        $informasi->slug = Str::slug($request->judul_informasi);
        $informasi->save();
        return redirect()->route('informasi_penting.home')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        $informasi = InformasiPenting::find($id);
        return view('pages.admin.informasi.informasi-penting.show', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_informasi' => 'required|min:2',
            'informasi' => 'required|min:2',
            'image' => 'max:2000|mimes:png,jpg,svg,jpeg',
        ]);

        $informasi = InformasiPenting::find($id);

        if($request->file('image') != null) {
            File::delete(storage_path($informasi->image));
            $filename = Mover::slugFile($request->file('image'), 'app/informasi/informasi-penting/');
            $informasi->image = $filename;
        }

        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->informasi = $request->informasi;
        $informasi->slug = Str::slug($request->judul_informasi);
        $informasi->save();
        return redirect()->back()->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function delete(Request $request)
    {
        $informasi = InformasiPenting::find($request->id);
        File::delete(storage_path($informasi->image));
        $informasi->delete();
        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }

    public function getImage($id)
    {
        $informasi = InformasiPenting::find($id);
        return response()->file(
            storage_path($informasi->image)
        );
    }
}
