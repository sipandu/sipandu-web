<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Pengumuman;
use App\Posyandu;
use Illuminate\Http\Request;
use App\Mover;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use File;

class PengumumanController extends Controller
{    
    public function index()
    {
        $pegawai = Pegawai::where('id_admin', Auth::guard('admin')->user()->id)->first();
        $posyandu = Posyandu::find($pegawai->id_posyandu);
        $pengumuman = Pengumuman::where('id_posyandu', $posyandu->id)->orderby('created_at', 'desc')->get();
        return view('pages.admin.informasi.pengumuman.home', compact('pengumuman', 'posyandu'));
    }

    public function create()
    {
        return view('pages.admin.informasi.pengumuman.create');
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::where('id_admin', Auth::guard('admin')->user()->id)->first();
        $posyandu = Posyandu::find($pegawai->id_posyandu);
        $request->validate([
            'judul_pengumuman' => 'required|min:2',
            'pengumuman' => 'required|min:2',
            'image' => 'required|max:2000|mimes:png,jpg,svg,jpeg',
        ]);

        $filename = Mover::slugFile($request->file('image'), 'app/informasi/pengumuman/');
        $pengumuman = new Pengumuman();
        $pengumuman->judul_pengumuman = $request->judul_pengumuman;
        $pengumuman->id_posyandu = $posyandu->id;
        $pengumuman->pengumuman = $request->pengumuman;
        $pengumuman->tanggal = NOW();
        $pengumuman->image = $filename;
        $pengumuman->slug = Str::slug($request->judul_pengumuman);
        $pengumuman->save();

        $pengumuman->broadcastPengumumanToMember();
        return redirect()->route('pengumuman.home')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::find($id);
        return view('pages.admin.informasi.pengumuman.show', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_pengumuman' => 'required|min:2',
            'pengumuman' => 'required|min:2',
            'image' => 'max:2000|mimes:png,jpg,svg,jpeg',
        ]);

        $pengumuman = Pengumuman::find($id);

        if($request->file('image') != null) {
            File::delete(storage_path($pengumuman->image));
            $filename = Mover::slugFile($request->file('image'), 'app/informasi/pengumuman/');
            $pengumuman->image = $filename;
        }

        $pengumuman->judul_pengumuman = $request->judul_pengumuman;
        $pengumuman->pengumuman = $request->pengumuman;
        $pengumuman->slug = Str::slug($request->judul_pengumuman);
        $pengumuman->save();
        $pengumuman->broadcastUpdatePengumumanToMember();
        return redirect()->back()->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function delete(Request $request)
    {
        $pengumuman = Pengumuman::find($request->id);
        File::delete(storage_path($pengumuman->image));
        $pengumuman->delete();
        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }

    public function getImage($id)
    {
        $pengumuman = Pengumuman::find($id);

        if(File::exists(storage_path($pengumuman->image))) {
            return response()->file(
                storage_path($pengumuman->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }
    }
}
