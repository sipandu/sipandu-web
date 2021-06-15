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
            'deskripsi' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:2",
        ],[
            'image.required' => 'Gambar dokumentasi kegiatan wajib diunggah',
            'image.mimes' => 'Format gambar dokumentasi kegiatan wajib diunggah',
            'image.max' => 'Gambar dokumentasi kegiatan maksimal berukuran 2 Mb',
            'deskripsi.required' => 'Deskripsi gambar dokumentasi kegiatan wajib diisi',
            'deskripsi.regex' => 'Format Deskripsi gambar dokumentasi kegiatan tidak sesuai',
            'deskripsi.min' => 'Deskripsi gambar dokumentasi kegiatan minimal berjumlah 2 karakter',
        ]);

        $filename = Mover::slugFile($request->file('image'), 'app/dokumentasi-kegiatan/');

        $dokumentasi_kegiatan = new DokumentasiKegiatan();
        $dokumentasi_kegiatan->id_kegiatan = $kegiatan->id;
        $dokumentasi_kegiatan->deskripsi = $request->deskripsi;
        $dokumentasi_kegiatan->image = $filename;
        $dokumentasi_kegiatan->save();

        if ($dokumentasi_kegiatan) {
            return redirect()->route('riwayat_kegiatan.show', $kegiatan->id)->with(['success' => 'Dokumentasi Kegiatan Berhasil Dibuat']);
        } else {
            return redirect()->route('riwayat_kegiatan.show', $kegiatan->id)->with(['failed' => 'Status Publikasi Kegiatan Posyandu Gagal Dibuat']);
        }
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

        if($request->file('image') != null) {
            File::delete(storage_path($dokumentasi_kegiatan->image));
            $filename = Mover::slugFile($request->file('image'), 'app/dokumentasi-kegiatan/');
        } else {
            $filename = $dokumentasi_kegiatan->image;
        }

        $dokumentasi_kegiatan->image = $filename;
        $dokumentasi_kegiatan->deskripsi = $request->deskripsi;
        $dokumentasi_kegiatan->save();

        if ($dokumentasi_kegiatan) {
            return redirect()->route('riwayat_kegiatan.show', $dokumentasi_kegiatan->id_kegiatan)->with(['success' => 'Dokumentasi Kegiatan Berhasil Diperbaharui']);
        } else {
            return redirect()->route('riwayat_kegiatan.show', $dokumentasi_kegiatan->id_kegiatan)->with(['failed' => 'Status Publikasi Kegiatan Posyandu Gagal Diperbaharui']);
        }
    }

    public function deleteDokumentasi($id)
    {
        $dokumentasi_kegiatan = DokumentasiKegiatan::find($id);

        File::delete(storage_path($dokumentasi_kegiatan->image));
        $dokumentasi_kegiatan->delete();
        return redirect()->back()->with(['success' => 'Foto Dokumentasi Kegiatan Berhasil Dihapus']);
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
