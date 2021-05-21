<?php

namespace App\Http\Controllers;

use App\Mover;
use App\Pegawai;
use App\Penyuluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PenyuluhanController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::where('id_admin', Auth::guard('admin')->user()->id)->first();
        $penyuluhan = Penyuluhan::where('id_posyandu', $pegawai->id_posyandu)->orderby('tanggal', 'desc')->get();
        return view('pages.admin.informasi.penyuluhan.home', compact('penyuluhan'));
    }

    public function create()
    {
        return view('pages.admin.informasi.penyuluhan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penyuluhan' => 'required|min:2',
            'deskripsi' => 'required|min:2',
            'lokasi' => 'required|min:2',
            'tanggal' => 'required',
            'topik_penyuluhan' => 'required|min:2',
            'gambar' => 'required|max:2000|mimes:png,jpg,svg,jpeg',
        ]);

        $pegawai = Pegawai::where('id_admin', Auth::guard('admin')->user()->id)->first();

        $filename = Mover::slugFile($request->file('gambar'), 'app/informasi/penyuluhan/');
        $penyuluhan = new Penyuluhan();
        $penyuluhan->id_posyandu = $pegawai->posyandu->id;
        $penyuluhan->nama_penyuluhan = $request->nama_penyuluhan;
        $penyuluhan->lokasi = $request->lokasi;
        $penyuluhan->tanggal = $request->tanggal;
        $penyuluhan->topik_penyuluhan = $request->topik_penyuluhan;
        $penyuluhan->deskripsi = $request->deskripsi;
        $penyuluhan->image = $filename;
        $penyuluhan->slug = Str::slug($request->nama_penyuluhan);
        $penyuluhan->save();
        $penyuluhan->sendMessage();

        return redirect()->route('penyuluhan.home')->with(['success' => 'Penyuluhan Berhasil Dikirimkan']);
    }

    public function show($id)
    {
        $penyuluhan = Penyuluhan::find($id);
        return view('pages.admin.informasi.penyuluhan.show', compact('penyuluhan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penyuluhan' => 'required|min:2',
            'deskripsi' => 'required|min:2',
            'lokasi' => 'required|min:2',
            'tanggal' => 'required',
            'topik_penyuluhan' => 'required|min:2',
            'gambar' => 'max:2000|mimes:png,jpg,svg,jpeg',
        ]);

        $penyuluhan = Penyuluhan::find($id);

        if($request->file('gambar') != null){
            File::delete(storage_path($penyuluhan->image));
            $filename = Mover::slugFile($request->file('gambar'), 'app/informasi/penyuluhan/');
            $penyuluhan->image = $filename;
        }

        $penyuluhan->nama_penyuluhan = $request->nama_penyuluhan;
        $penyuluhan->lokasi = $request->lokasi;
        $penyuluhan->tanggal = $request->tanggal;
        $penyuluhan->topik_penyuluhan = $request->topik_penyuluhan;
        $penyuluhan->deskripsi = $request->deskripsi;
        $penyuluhan->slug = Str::slug($request->nama_penyuluhan);
        $penyuluhan->save();
        $penyuluhan->sendMessageRalat();

        return redirect()->back()->with(['success' => 'Penyuluhan Berhasil Diralat']);
    }

    public function getImage($id)
    {
        $penyuluhan = Penyuluhan::find($id);
        if(File::exists(storage_path($penyuluhan->image))) {
            return response()->file(
                storage_path($penyuluhan->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }

    }

    public function delete(Request $request)
    {
        $penyuluhan = Penyuluhan::find($request->id);
        $penyuluhan->delete();
        return redirect()->back()->with(['success' => 'Penyuluhan Berhasil Dihapus']);
    }
}
