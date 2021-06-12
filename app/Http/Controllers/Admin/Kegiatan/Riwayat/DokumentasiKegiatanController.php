<?php

namespace App\Http\Controllers\Admin\Kegiatan\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DokumentasiKegiatan;
use App\Kegiatan;
use App\Mover;
use File;

class DokumentasiKegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function createDokumentasi($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('admin.kegiatan.riwayat.dokumentasi.create', compact('kegiatan'));
    }

    public function storeDokumentasi(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            'deskripsi' => 'required|min:2',
        ],[
            'image.required' => 'Gambar dokumentasi kegiatan wajib diunggah',
            'image.mimes' => 'Format gambar dokumentasi kegiatan wajib diunggah',
            'image.max' => 'Gambar dokumentasi kegiatan maksimal berukuran 2 Mb',
            'deskripsi.required' => 'Deskripsi gambar dokumentasi kegiatan wajib diisi',
            'deskripsi.min' => 'Deskripsi gambar dokumentasi kegiatan minimal berjumlah 2 karakter',
        ]);

        $filename = Mover::slugFile($request->file('image'), 'app/dokumentasi-kegiatan/');

        $dokumentasi_kegiatan = new DokumentasiKegiatan();
        $dokumentasi_kegiatan->id_kegiatan = $kegiatan->id;
        $dokumentasi_kegiatan->deskripsi = $request->deskripsi;
        $dokumentasi_kegiatan->image = $filename;
        $dokumentasi_kegiatan->save();

        return redirect()->route('riwayat_kegiatan.show', $kegiatan->id)->with(['success' => 'Dokumentasi berhasil dibuat']);
    }

    public function showDokumentasi($id)
    {
        $dokumentasi_kegiatan = DokumentasiKegiatan::find($id);
        return view('admin.kegiatan.riwayat.dokumentasi.show', compact('dokumentasi_kegiatan'));
    }

    public function updateDokumentasi(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            'deskripsi' => 'required|min:2',
        ],[
            'image.required' => 'Gambar dokumentasi kegiatan wajib diunggah',
            'image.mimes' => 'Format gambar dokumentasi kegiatan wajib diunggah',
            'image.max' => 'Gambar dokumentasi kegiatan maksimal berukuran 2 Mb',
            'deskripsi.required' => 'Deskripsi gambar dokumentasi kegiatan wajib diisi',
            'deskripsi.min' => 'Deskripsi gambar dokumentasi kegiatan minimal berjumlah 2 karakter',
        ]);

        $dokumentasi_kegiatan = DokumentasiKegiatan::find($id);

        if($request->file('gambar') != null) {
            File::delete(storage_path($informasi->image));
            $filename = Mover::slugFile($request->file('gambar'), 'app/informasi/informasi-penting/');
            $informasi->image = $filename;
        } else {
            $informasi->image = $informasi->image;
        }

        if($request->file('image') != null) {
            File::delete(storage_path($dokumentasi_kegiatan->image));
            $filename = Mover::slugFile($request->file('image'), 'app/dokumentasi-kegiatan/');
        } else {
            $dokumentasi_kegiatan->image = $dokumentasi_kegiatan->image;
        }

        $dokumentasi_kegiatan->deskripsi = $request->deskripsi;
        $dokumentasi_kegiatan->save();

        return redirect()->route('riwayat_kegiatan.show', $dokumentasi_kegiatan->id_kegiatan)->with(['success' => 'Dokumentasi kegiatan berhasil diperbaharui']);
    }

    public function deleteDokumentasi(Request $request)
    {
        $dokumentasi_kegiatan = DokumentasiKegiatan::find($request->id);
        File::delete(storage_path($dokumentasi_kegiatan->image));
        $dokumentasi_kegiatan->delete();
        return redirect()->back()->with(['success' => 'Dokumentasi berhasil dihapus']);
    }

    public function showImgDokumentasi($id)
    {
        $dokumentasi_kegiatan = DokumentasiKegiatan::find($id);

        if(File::exists(storage_path($dokumentasi_kegiatan->image))) {
            return response()->file(
                storage_path($dokumentasi_kegiatan->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }
    }
}
