<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $kegiatan = Kegiatan::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)
            ->orderby('start_at', 'asc')->get();
        return view('pages.admin.kegiatan.home', compact('kegiatan'));
    }

    public function create()
    {
        return view('pages.admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|min:2',
            'tempat' => 'required|min:2',
            'deskripsi' => 'required|min:2',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->id_posyandu = auth()->guard('admin')->user()->pegawai->id_posyandu;
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
        $request->validate([
            'nama_kegiatan' => 'required|min:2',
            'tempat' => 'required|min:2',
            'deskripsi' => 'required|min:2',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        $kegiatan = Kegiatan::find($id);
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tempat = $request->tempat;
        $kegiatan->start_at = $request->start_at;
        $kegiatan->end_at = $request->end_at;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->save();

        $kegiatan->broadcastKegiatanUpdate();

        return redirect()->back()->with(['success' => 'Data Berhasil Diupdate']);
    }

    public function delete(Request $request)
    {
        $kegiatan = Kegiatan::find($request->id);
        $kegiatan->alasan_cancel = $request->alasan;
        $kegiatan->save();
        $kegiatan->broadcastKegiatanCancel($request->alasan);
        $kegiatan->delete();
        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }

    public function broadcast($id)
    {
        $kegiatan = Kegiatan::find($id);
        $success = $kegiatan->broadcastKegiatanBaru();
        if($success){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
