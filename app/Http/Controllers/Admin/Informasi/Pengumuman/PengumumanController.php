<?php

namespace App\Http\Controllers\Admin\Informasi\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\NotifikasiUser;
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
            $id_posyandu = [];
            $data_nakes = [];
            $pengumuman = [];;

            $data_pengumuman = Pengumuman::get();
            $nakes = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $data_nakes = $nakes;

            foreach ($data_nakes as $data) {
                $id_posyandu[] = $data->id_posyandu;
            }
            
            foreach ($id_posyandu as $item) {
                foreach ($data_pengumuman->where('id_posyandu', $item) as $data) {
                    $pengumuman[] = $data;
                }
            }
        } elseif (auth()->guard('admin')->user()->role == 'pegawai') {
            $id_posyandu = auth()->guard('admin')->user()->pegawai->id_posyandu;
            $pengumuman = Pengumuman::where('id_posyandu', $id_posyandu)->orderby('created_at', 'desc')->get();
        }
        
        return view('admin.informasi.pengumuman.home', compact('pengumuman'));
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

        /* notif mobile user shit start here */

        $notiftitle = "Ada pengumuman baru!";
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
        }

        /* notif mobile user shit end here */

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
