<?php

namespace App\Http\Controllers\Admin\Informasi\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function semuaTag()
    {
        $tag = Tag::where('status', 'Aktif')->get();
        return view('admin.informasi.tag.semua-tag', compact('tag'));
    }

    public function simpanTag(Request $request)
    {
        $this->validate($request,[
            'nama_tag' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:2|max:25",
        ],
        [
            'nama_tag.required' => "Nama tag wajib diisi",
            'nama_tag.regex' => "Format penulisan nama tag tidak sesuai",
            'nama_tag.min' => "Nama tag minimal berjumlah 2 karakter",
            'nama_tag.max' => "Nama tag maksimal berjumlah 25 karakter",
        ]);

        $cek_tag = Tag::where('nama_tag', $request->nama_tag)->get();

        if (count($cek_tag) > 0) {
            return redirect()->back()->with('success', 'Tag Berhasil Ditambahkan');
        } else {
            $simpan_tag = Tag::create([
                'nama_tag' => $request->nama_tag,
                'status' => 'Aktif',
            ]);

            if ($simpan_tag) {
                return redirect()->back()->with('success', 'Tag Berhasil Ditambahkan');
            } else {
                return redirect()->back()->with('failed', 'Tag Gagal Ditambahkan');
            }
        }
    }

    public function hapusTag(Tag $tag)
    {
        $hapus_tag = Tag::where('id', $tag->id)->update([
            'status' => 'Tidak Aktif'
        ]);

        if ($hapus_tag) {
            return redirect()->back()->with('success', 'Tag Barhasil Dihapus');
        } else {
            return redirect()->back()->with('failed', 'Tag Gagal Dihapus');
        }
    }
}
