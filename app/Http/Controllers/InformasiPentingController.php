<?php

namespace App\Http\Controllers;

use App\InformasiPenting;
use Illuminate\Http\Request;
use App\Mover;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Auth;

class InformasiPentingController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->user()->role == 'super admin') {
            $informasi = InformasiPenting::orderby('tanggal', 'desc')->get();
        } else {
            $informasi = InformasiPenting::where('author_id', Auth::guard('admin')->user()->id)
                ->orderby('tanggal', 'desc')->get();
        }
        return view('pages.admin.informasi.informasi-penting.home', compact('informasi'));
    }

    public function create()
    {
        return view('pages.admin.informasi.informasi-penting.create');
    }

    public function store(Request $request)
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
        $informasi->author_id = Auth::guard('admin')->user()->id;
        $informasi->save();

        $informasi->broadcastToAllUser();

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

        return redirect()->route('informasi_penting.home')->with(['success' => 'Data Berhasil Disimpan']);
    }


    public function show($id)
    {
        $informasi = InformasiPenting::find($id);
        return view('pages.admin.informasi.informasi-penting.show', compact('informasi'));
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

    public function delete(Request $request)
    {
        $informasi = InformasiPenting::find($request->id);
        File::delete(storage_path($informasi->image));
        $informasi->delete();
        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
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
