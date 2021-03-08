<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('start_at', '>=', date('Y-m-d'))
            ->orderby('start_at', 'asc')->get();
        return view('pages.admin.kegiatan.home', compact('kegiatan'));
    }

    public function create()
    {
        return view('pages.admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $kegiatan = new Kegiatan();
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tempat = $request->tempat;
        $kegiatan->start_at = $request->start_at;
        $kegiatan->end_at = $request->end_at;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->save();

        return redirect()->route('kegiatan.home')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('pages.admin.kegiatan.show', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tempat = $request->tempat;
        $kegiatan->start_at = $request->start_at;
        $kegiatan->end_at = $request->end_at;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->save();

        $kegiatan->sendMessageRalat();

        return redirect()->back()->with(['success' => 'Data Berhasil Diupdate']);
    }

    public function delete(Request $request)
    {
        $kegiatan = Kegiatan::find($request->id);
        $kegiatan->sendMessageCancel($request->alasan);
        $kegiatan->delete();
        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }

    public function broadcast($id)
    {
        $kegiatan = Kegiatan::find($id);
        $success = $kegiatan->sendMessage();
        if($success){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
