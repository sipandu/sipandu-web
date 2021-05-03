<?php

namespace App\Http\Controllers;

use App\DokumentasiKegiatan;
use App\Kegiatan;
use App\Mover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class RiwayatKegiatanController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->user()->pegawai->jabatan == 'super admin') {
            $kegiatan_lewat = Kegiatan::where('end_at', '<', date('Y-m-d'))
                ->orderby('end_at', 'desc')->get();
            $kegiatan_cancel = Kegiatan::onlyTrashed()->orderby('end_at', 'desc')->get();
        } else {
            $kegiatan_lewat = Kegiatan::where('end_at', '<', date('Y-m-d'))
                ->where('id_posyandu', Auth::guard('admin')->user()->pegawai->id_posyandu)
                ->orderby('end_at', 'desc')->get();
            $kegiatan_cancel = Kegiatan::
                where('id_posyandu', Auth::guard('admin')->user()->pegawai->id_posyandu)
                ->onlyTrashed()->orderby('end_at', 'desc')->get();
        }
        return view('pages.admin.kegiatan.riwayat-kegiatan.home', compact('kegiatan_lewat', 'kegiatan_cancel'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        $dokumentasi_kegiatan = DokumentasiKegiatan::where('id_kegiatan', $id)->get();
        return view('pages.admin.kegiatan.riwayat-kegiatan.show', compact('kegiatan', 'dokumentasi_kegiatan'));
    }

    public function createDokumentasi($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('pages.admin.kegiatan.riwayat-kegiatan.dokumentasi-kegiatan.create', compact('kegiatan'));
    }

    public function storeDokumentasi(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,svg',
            'deskripsi' => 'required|min:2',
        ]);

        $filename = Mover::slugFile($request->file('image'), 'app/dokumentasi-kegiatan/');

        $dokumentasi_kegiatan = new DokumentasiKegiatan();
        $dokumentasi_kegiatan->id_kegiatan = $request->id_kegiatan;
        $dokumentasi_kegiatan->deskripsi = $request->deskripsi;
        $dokumentasi_kegiatan->image = $filename;
        $dokumentasi_kegiatan->save();

        return redirect()->route('riwayat_kegiatan.show', $request->id_kegiatan)->with(['success' => 'Dokumentasi berhasil dibuat']);
    }

    public function showDokumentasi($id)
    {
        $dokumentasi_kegiatan = DokumentasiKegiatan::find($id);
        return view('pages.admin.kegiatan.riwayat-kegiatan.dokumentasi-kegiatan.show', compact('dokumentasi_kegiatan'));
    }

    public function updateDokumentasi(Request $request, $id)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg,svg',
            'deskripsi' => 'required|min:2',
        ]);
        $dokumentasi_kegiatan = DokumentasiKegiatan::find($id);
        if($request->file('image') != null) {
            File::delete(storage_path($dokumentasi_kegiatan->image));
            $filename = Mover::slugFile($request->file('image'), 'app/dokumentasi-kegiatan/');
            $dokumentasi_kegiatan->image = $filename;
        }
        $dokumentasi_kegiatan->deskripsi = $request->deskripsi;
        $dokumentasi_kegiatan->save();

        return redirect()->route('riwayat_kegiatan.show', $dokumentasi_kegiatan->id_kegiatan)->with(['success' => 'Dokumentasi berhasil diupdate']);
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
        return response()->file(
            storage_path($dokumentasi_kegiatan->image)
        );
    }

}
