<?php

namespace App\Http\Controllers;

use App\Mover;
use App\Penyuluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class PenyuluhanController extends Controller
{
    public function index()
    {
        $penyuluhan = Penyuluhan::where('id_posyandu', 4)->orderby('tanggal', 'desc')->get();
        return view('pages.admin.informasi.penyuluhan.home', compact('penyuluhan'));
    }

    public function create()
    {
        return view('pages.admin.informasi.penyuluhan.create');
    }

    public function store(Request $request)
    {
        $filename = Mover::slugFile($request->file('image'), 'app/informasi/penyuluhan/');
        $penyuluhan = new Penyuluhan();
        $penyuluhan->id_posyandu = 4;
        $penyuluhan->nama_penyuluhan = $request->nama_penyuluhan;
        $penyuluhan->lokasi = $request->lokasi;
        $penyuluhan->tanggal = $request->tanggal;
        $penyuluhan->topik_penyuluhan = $request->topik_penyuluhan;
        $penyuluhan->deskripsi = $request->deskripsi;
        $penyuluhan->image = $filename;
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
        $penyuluhan = Penyuluhan::find($id);

        if($request->file('image') != null){
            File::delete(storage_path($penyuluhan->image));
            $filename = Mover::slugFile($request->file('image'), 'app/informasi/penyuluhan/');
            $penyuluhan->image = $filename;
        }

        $penyuluhan->nama_penyuluhan = $request->nama_penyuluhan;
        $penyuluhan->lokasi = $request->lokasi;
        $penyuluhan->tanggal = $request->tanggal;
        $penyuluhan->topik_penyuluhan = $request->topik_penyuluhan;
        $penyuluhan->deskripsi = $request->deskripsi;
        $penyuluhan->save();
        $penyuluhan->sendMessageRalat();

        return redirect()->back()->with(['success' => 'Penyuluhan Berhasil Diralat']);
    }

    public function getImage($id)
    {
        $penyuluhan = Penyuluhan::find($id);
        return response()->file(
            storage_path($penyuluhan->image)
        );
    }

    public function delete(Request $request)
    {
        $penyuluhan = Penyuluhan::find($request->id);
        $penyuluhan->delete();
        return redirect()->back()->with(['success' => 'Penyuluhan Berhasil Dihapus']);
    }
}
