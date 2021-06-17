<?php

namespace App\Http\Controllers\Admin\Kegiatan\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\DokumentasiKegiatan;
use App\Kegiatan;
use App\Mover;
use File;

class RiwayatKegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

        if(Auth::guard('admin')->user()->role == 'super admin') {
            $kegiatan_lewat = Kegiatan::where('end_at', '<', $today)
                ->orderby('end_at', 'desc')->get();
            $kegiatan_cancel = Kegiatan::onlyTrashed()->orderby('end_at', 'desc')->get();
        } else {
            $kegiatan_lewat = Kegiatan::where('end_at', '<', $today)
                ->where('id_posyandu', Auth::guard('admin')->user()->pegawai->id_posyandu)
                ->orderby('end_at', 'desc')->get();
            $kegiatan_cancel = Kegiatan::
                where('id_posyandu', Auth::guard('admin')->user()->pegawai->id_posyandu)
                ->onlyTrashed()->orderby('end_at', 'desc')->get();
        }

        return view('admin.kegiatan.riwayat.home', compact('kegiatan_lewat', 'kegiatan_cancel'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        $dokumentasi_kegiatan = DokumentasiKegiatan::where('id_kegiatan', $id)->get();
        return view('admin.kegiatan.riwayat.show', compact('kegiatan', 'dokumentasi_kegiatan'));
    }

    public function statusPublikasi(Request $request, Kegiatan $kegiatan)
    {
        $status_kegiatan = Kegiatan::find($kegiatan->id);
        $status_kegiatan->status = $request->status;
        $status_kegiatan->save();

        if ($status_kegiatan) {
            return redirect()->back()->with(['success' => 'Status Publikasi Kegiatan Posyandu Berhasil Diperbaharui']);
        } else {
            return redirect()->back()->with(['failed' => 'Status Publikasi Kegiatan Posyandu Gagal Diperbaharui']);
        }
    }
}
