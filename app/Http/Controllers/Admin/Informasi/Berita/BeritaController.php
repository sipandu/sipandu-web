<?php

namespace App\Http\Controllers\Admin\Informasi\Berita;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\NotifikasiUser;
use Carbon\Carbon;
use File;
use App\Mover;
use App\InformasiPenting;
use App\User;
use App\Tag;
use App\TagBerita;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $informasi = InformasiPenting::where('author_id', Auth::guard('admin')->user()->id)->orderby('tanggal', 'desc')->get();
        return view('admin.informasi.berita.home', compact('informasi'));
    }

    public function create()
    {
        $tag = Tag::where('status', 'Aktif')->get();
        return view('admin.informasi.berita.create', compact('tag'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_informasi' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:2|max:150", 
            'informasi' => 'required|min:2|',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2000',
            'tag_berita.*' => 'required',
        ],[
            'judul_informasi.required' => "Judul berita wajib diisi",
            'judul_informasi.regex' => "Format judul berita tidak sesuai",
            'judul_informasi.min' => "Judul berita minimal berjumlah 2 karakter",
            'judul_informasi.max' => "Judul berita maksimal berjumlah 150 karakter",
            'informasi.required' => "Isi berita wajib diisi",
            'informasi.min' => "Isi berita minimal berjumlah 2 karakter",
            'gambar.required' => "Gambar wajib diunggah",
            'gambar.mimes' => "Format gambar tidak sesuai",
            'gambar.max' => "Ukuran gambar maksimal 5 Mb",
            'tag_berita.*.required' => "Tag berita wajib dipilih",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

        $filename = Mover::slugFile($request->file('gambar'), 'app/informasi/informasi-penting/');

        $informasi = new InformasiPenting();
        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->informasi = $request->informasi;
        $informasi->tanggal = $today;
        $informasi->image = $filename;
        $informasi->slug = Str::slug($request->judul_informasi);
        $informasi->dilihat = 0;
        $informasi->status = 'Aktif';
        $informasi->author_id = Auth::guard('admin')->user()->id;
        $informasi->save();

        foreach ($request->tag_berita as $data => $value) {
            $tag = TagBerita::create([
                'id_informasi' => $informasi->id,
                'id_tag' => $request->tag_berita[$data],
            ]);
        }

        $informasi->broadcastToAllUser();

        /* notif mobile shit start here */

        $notiftitle = "Ada informasi baru!";
        $notifcontent = $informasi->judul_informasi;

        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            "to" => "/topics/all",
            "android" => array (
                "notification"=> array (
                    "tag" => "informasi"
                )
            ),
            "data" => array(
                "title" => $notiftitle,
                "body" => $notifcontent,
                "image" => $informasi->getUrlImage(),
                "type" => "informasi"
            )
        );
        $headers = array(
            'Authorization: key=AAAAVT49iyk:APA91bH_tmF2z2SCC8mPWWsNSvXZ-CuhjV-8SXmY8l0gNtvNw5wFuXVRjX0-l4KIFm7DaHy6JGI5v-ltwutEXCddhTlcFhqy9YyoO0kg3WQ4d290KB_4hM4N91kk0P4JkkH5Qkk8G72W',
            'Content-type: Application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_exec($ch);
        curl_close($ch);

        $user = User::get();
        foreach( $user as $item) {
            $notif = NotifikasiUser::create([
                'id_user' => $item->id,
                'notif_title' => $notiftitle,
                'notif_content' => $notifcontent
            ]);
        }

        /* notif mobile shit end here */

        if ($informasi) {
            return redirect()->back()->with(['success' => 'Berita Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Berita Gagal Ditambahkan']);
        }
    }

    public function show($id)
    {
        $informasi = InformasiPenting::find($id);
        $tag = Tag::where('status', 'Aktif')->get();
        $data_tag_berita = TagBerita::where('id_informasi', $informasi->id)->pluck('id_tag');

        $tag_berita = [];
        foreach ($data_tag_berita as $data => $value) {
            $tag_berita[] = $data_tag_berita[$data];
        }

        return view('admin.informasi.berita.show', compact('informasi', 'tag', 'tag_berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_informasi' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:2|max:150",
            'informasi' => 'required|min:2|',
            'gambar' => 'nullable|mimes:png,jpg,jpeg|max:2000',
            'tag_berita.*' => 'required',
        ],[
            'judul_informasi.required' => "Judul berita wajib diisi",
            'judul_informasi.regex' => "Format judul berita tidak sesuai",
            'judul_informasi.min' => "Judul berita minimal berjumlah 2 karakter",
            'judul_informasi.max' => "Judul berita maksimal berjumlah 150 karakter",
            'informasi.required' => "Isi berita wajib diisi",
            'informasi.min' => "Isi berita minimal berjumlah 2 karakter",
            'gambar.mimes' => "Format gambar tidak sesuai",
            'gambar.max' => "Ukuran gambar maksimal 5 Mb",
            'tag_berita.*.required' => "Tag berita wajib dipilih",
        ]);

        $informasi = InformasiPenting::find($id);

        if($request->file('gambar') != null) {
            File::delete(storage_path($informasi->image));
            $filename = Mover::slugFile($request->file('gambar'), 'app/informasi/informasi-penting/');
        } else {
            $filename = $informasi->image;
        }
        
        $informasi->image = $filename;
        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->informasi = $request->informasi;
        $informasi->slug = Str::slug($request->judul_informasi);
        $informasi->author_id = Auth::guard('admin')->user()->id;
        $informasi->save();

        $tag_berita = TagBerita::where('id_informasi', $informasi->id)->get();
    
        foreach ($tag_berita as $data => $value) {
            $tag[$data] = TagBerita::where('id_informasi', $informasi->id)->delete();
        }

        foreach ($request->tag_berita as $data => $value) {
            $tag = TagBerita::create([
                'id_informasi' => $informasi->id,
                'id_tag' => $request->tag_berita[$data],
            ]);
        }

        try {
            $informasi->broadcastUpdateToAllUser();
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($informasi) {
            return redirect()->back()->with(['success' => 'Berita Berhasil Diperbaharui']);
        } else {
            return redirect()->back()->with(['failed' => 'Berita Gagal Diperbaharui']);
        }
    }

    public function statusBerita(Request $request, InformasiPenting $informasiPenting)
    {
        $informasi = InformasiPenting::find($informasiPenting->id);
        $informasi->status = $request->status;
        $informasi->save();

        if ($informasi) {
            return redirect()->back()->with(['success' => 'Status Publikasi Berita Berhasil Diperbaharui']);
        } else {
            return redirect()->back()->with(['failed' => 'Status Publikasi Berita Gagal Diperbaharui']);
        }
    }
}
