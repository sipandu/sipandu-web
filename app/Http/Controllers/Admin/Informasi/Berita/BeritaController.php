<?php

namespace App\Http\Controllers\Admin\Informasi\Berita;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\NotifikasiUser;
use File;
use App\Mover;
use App\InformasiPenting;
use App\User;
use App\Tag;
use App\TagBerita;

class BeritaController extends Controller
{
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
        // return ($request);
        $messages = [
            'required' => ':attribute Wajib Diisi',
            'min' => ':attribute Harus Diisi minimum :min karakter',
            'max' => ':attribute Ukuran Maksimal File :value',
            'mimes' => ':attribute Format file yang boleh adalah :value'
        ];

        $request->validate([
            'judul_informasi' => 'required|min:2',
            'informasi' => 'required|min:2',
            'gambar' => 'required|max:2000|mimes:png,jpg,svg,jpeg',
        ], $messages);

        $filename = Mover::slugFile($request->file('gambar'), 'app/informasi/informasi-penting/');
        $informasi = new InformasiPenting();
        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->informasi = $request->informasi;
        $informasi->tanggal = NOW();
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

        return redirect()->route('informasi_penting.home')->with(['success' => 'Data Berhasil Disimpan']);
    }


    public function show($id)
    {
        $informasi = InformasiPenting::find($id);
        return view('admin.informasi.berita.show', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute Wajib Diisi',
            'min' => ':attribute Harus Diisi minimum :min karakter',
            'max' => ':attribute Ukuran Maksimal File :value',
            'mimes' => ':attribute Format file yang boleh adalah :value'
        ];

        $request->validate([
            'judul_informasi' => 'required|min:2',
            'informasi' => 'required|min:2',
            'gambar' => 'max:2000|mimes:png,jpg,svg,jpeg',
        ]);

        $informasi = InformasiPenting::find($id);

        if($request->file('image') != null) {
            File::delete(storage_path($informasi->image));
            $filename = Mover::slugFile($request->file('gambar'), 'app/informasi/informasi-penting/');
            $informasi->image = $filename;
        }

        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->informasi = $request->informasi;
        $informasi->slug = Str::slug($request->judul_informasi);
        $informasi->author_id = Auth::guard('admin')->user()->id;
        $informasi->save();

        try {
            $informasi->broadcastUpdateToAllUser();
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->back()->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function statusBerita(Request $request, InformasiPenting $informasiPenting)
    {
        $informasi = InformasiPenting::find($informasiPenting->id);
        $informasi->status = $request->status;
        $informasi->save();

        return redirect()->back()->with(['success' => 'Status publikasi berhasil diubah']);
    }

    public function getImage($id)
    {
        $informasi = InformasiPenting::find($id);

        if(File::exists(storage_path($informasi->image))) {
            return response()->file(
                storage_path($informasi->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }
    }
}
