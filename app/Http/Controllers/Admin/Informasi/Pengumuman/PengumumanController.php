<?php

namespace App\Http\Controllers\Admin\Informasi\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\NotifikasiUser;
use Carbon\Carbon;
use File;
use App\Mover;
use App\Pegawai;
use App\Pengumuman;
use App\Posyandu;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (auth()->guard('admin')->user()->role == 'super admin') {
            $pengumuman = Pengumuman::orderby('created_at', 'desc')->get();
        } elseif (auth()->guard('admin')->user()->role == 'tenaga kesehatan') {
            $nakes = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $pengumuman = Pengumuman::whereIn('id_posyandu', $nakes->toArray())->get();
        } elseif (auth()->guard('admin')->user()->role == 'pegawai') {
            $id_posyandu = auth()->guard('admin')->user()->pegawai->id_posyandu;
            $pengumuman = Pengumuman::where('id_posyandu', $id_posyandu)->orderby('created_at', 'desc')->get();
        }
        
        return view('admin.informasi.pengumuman.home', compact('pengumuman'));
    }

    public function create()
    {
        if (auth()->guard('admin')->user()->role == 'super admin') {
            $posyandu = Posyandu::get();
        } elseif (auth()->guard('admin')->user()->role == 'tenaga kesehatan') {
            $nakes = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $posyandu = Posyandu::whereIn('id', $nakes->toArray())->get();
        } elseif (auth()->guard('admin')->user()->role == 'pegawai') {
            $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu);
        }

        return view('admin.informasi.pengumuman.create', compact('posyandu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:2|max:150",
            'pengumuman' => 'required|min:2|',
            'posyandu.*' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ],[
            'judul_informasi.required' => "Judul pengumuman wajib diisi",
            'judul_informasi.regex' => "Format judul pengumuman tidak sesuai",
            'judul_informasi.min' => "Judul pengumuman minimal berjumlah 2 karakter",
            'judul_informasi.max' => "Judul pengumuman maksimal berjumlah 150 karakter",
            'pengumuman.required' => "Isi pengumuman wajib diisi",
            'pengumuman.min' => "Isi pengumuman minimal berjumlah 2 karakter",
            'posyandu.*.required' => "Posyandu tujuan wajib dipilih",
            'image.required' => "Gambar wajib dipilih",
            'image.mimes' => "Format gambar tidak sesuai",
            'image.max' => "Ukuran gambar maksimal 2 Mb",
        ]);

        $filename = Mover::slugFile($request->file('image'), 'app/informasi/pengumuman/');
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

        foreach ($request->posyandu as $data => $value) {
            $pengumuman = Pengumuman::create([
                'id_posyandu' => $request->posyandu[$data],
                'judul_pengumuman' => $request->judul_pengumuman,
                'pengumuman' => $request->pengumuman,
                'tanggal' => $today,
                'image' => $filename,
                'slug' => Str::slug($request->judul_pengumuman),
            ]);
        }

        /* notif mobile user shit start here */

         /* $notiftitle = "Ada pengumuman baru!";
        $notifcontent = $pengumuman->judul_pengumuman;

        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            "to" => "/topics/all",
            "android" => array (
                "notification"=> array (
                    "tag" => "pengumuman"
                )
            ),
            "data" => array(
                "title" => $notiftitle,
                "body" => $notifcontent,
                "image" => $pengumuman->getUrlImage(),
                "posyandu" => $pengumuman->id_posyandu,
                "type" => "pengumuman"
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
            if ( $item->role == '0' ) {
                $duar = Anak::where("id_user", $item->id)->get()->first();
            }

            else if ( $item->role == '1' ) {
                $duar = Ibu::where("id_user", $item->id)->get()->first();
            }

            else if ( $item->role == '2' ) {
                $duar = Lansia::where("id_user", $item->id)->get()->first();
            }
            if ( $duar->id_posyandu == $pengumuman->id_posyandu ) {
                $notif = NotifikasiUser::create([
                    'id_user' => $item->id,
                    'notif_title' => $notiftitle,
                    'notif_content' => $notifcontent
                ]);
            }
        } */

        /* notif mobile user shit end here */

        
        if ($pengumuman) {
            $pengumuman->broadcastPengumumanToMember();
            return redirect()->back()->with(['success' => 'Pengumuman Berhasil Dibuat']);
        } else {
            return redirect()->back()->with(['failed' => 'Pengumuman Gagal Dibuat']);
        }
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::find($id);

        if (auth()->guard('admin')->user()->role == 'super admin') {
            $posyandu = Posyandu::get();
        } elseif (auth()->guard('admin')->user()->role == 'tenaga kesehatan') {
            $nakes = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $posyandu = Posyandu::whereIn('id', $nakes->toArray())->get();
        } elseif (auth()->guard('admin')->user()->role == 'pegawai') {
            $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu);
        }

        return view('admin.informasi.pengumuman.show', compact('pengumuman', 'posyandu'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul_pengumuman' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:2|max:150",
            'pengumuman' => 'required|min:2|',
            'posyandu' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ],[
            'judul_informasi.required' => "Judul pengumuman wajib diisi",
            'judul_informasi.regex' => "Format judul pengumuman tidak sesuai",
            'judul_informasi.min' => "Judul pengumuman minimal berjumlah 2 karakter",
            'judul_informasi.max' => "Judul pengumuman maksimal berjumlah 150 karakter",
            'pengumuman.required' => "Isi pengumuman wajib diisi",
            'pengumuman.min' => "Isi pengumuman minimal berjumlah 2 karakter",
            'posyandu.required' => "Posyandu tujuan wajib dipilih",
            'image.mimes' => "Format gambar tidak sesuai",
            'image.max' => "Ukuran gambar maksimal 2 Mb",
        ]);

        if($request->file('image') != null) {
            File::delete(storage_path($pengumuman->image));
            $filename = Mover::slugFile($request->file('image'), 'app/informasi/pengumuman/');
        } else {
            $filename = $pengumuman->image;
        }

        $simpan_pengumuman = Pengumuman::where('id', $pengumuman->id)->update([
            'id_posyandu' => $request->posyandu,
            'judul_pengumuman' => $request->judul_pengumuman,
            'pengumuman' => $request->pengumuman,
            'tanggal' => $today,
            'image' => $filename,
            'slug' => Str::slug($request->judul_pengumuman),
        ]);

        
        if ($simpan_pengumuman) {
            $simpan_pengumuman->broadcastUpdatePengumumanToMember();
            return redirect()->back()->with(['success' => 'Pengumuman Berhasil Diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Pengumuman Gagal Diubah']);
        }
    }

    public function delete($id)
    {
        $pengumuman = Pengumuman::find($id);
        File::delete(storage_path($pengumuman->image));
        $pengumuman->delete();
        
        if ($pengumuman) {
            return redirect()->back()->with(['success' => 'Pengumuman Berhasil Dihapus']);
        } else {
            return redirect()->back()->with(['failed' => 'Pengumuman Gagal Dihapus']);
        }
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
