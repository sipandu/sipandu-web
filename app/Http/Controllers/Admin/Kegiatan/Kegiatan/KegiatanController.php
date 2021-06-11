<?php

namespace App\Http\Controllers\Admin\Kegiatan\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\NotifikasiUser;
use Carbon\Carbon;
use App\Kegiatan;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $kegiatan = Kegiatan::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->orderby('created_at', 'desc')->get();
        return view('admin.kegiatan.kegiatan.home', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|regex:/^[a-z,. 0-9]+$/i|min:2|max:100',
            'tempat' => 'required|regex:/^[a-z,. 0-9]+$/i|min:2|max:100|min:2',
            'deskripsi' => 'required|min:2',
            'start_at' => 'required',
            'end_at' => 'required',
        ],[
            'nama_kegiatan.required' => "Nama kegiatan wajib diisi",
            'nama_kegiatan.regex' => "Forma nama kegiatan tidak sesuai",
            'nama_kegiatan.min' => "Nama kegiatan minimal berjumlah 2 karakter",
            'nama_kegiatan.max' => "Nama kegiatan maksimal berjumlah 100 karakter",
            'tempat.required' => "Tempat kegiatan wajib diisi",
            'tempat.regex' => "Format tempat kegiatan tidak sesuai",
            'tempat.min' => "Tempat kegiatan minimal berjumlah 2 karakter",
            'tempat.max' => "Tempat kegiatan maksimal berjumlah 100 karakter",
            'start_at.required' => "Waktu mulai kegiatan kegiatan wajib diisi",
            'end_at.required' => "Waktu berakhir kegiatan wajib diisi",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

        if ($request->start_at <= $today || $request->end_at <= $today) {
            return redirect()->back()->with(['failed' => 'Tanggal kegiatan tidak sesuai']);
        } else {
            $kegiatan = new Kegiatan();
            $kegiatan->id_posyandu = auth()->guard('admin')->user()->pegawai->id_posyandu;
            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->tempat = $request->tempat;
            $kegiatan->start_at = $request->start_at;
            $kegiatan->end_at = $request->end_at;
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->status = 'Tampil';
            $kegiatan->slug = Str::slug($request->nama_kegiatan);
            $kegiatan->save();
    
            /* notif mobile user shit start here */
    
            $notiftitle = "Ada pengumuman kegiatan baru!";
            $notifcontent = $kegiatan->nama_kegiatan;
    
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array(
                "to" => "/topics/all",
                "android" => array (
                    "notification"=> array (
                        "tag" => "kegiatan"
                    )
                ),
                "data" => array(
                    "title" => $notiftitle,
                    "body" => $notifcontent,
                    "kegiatan_start" => $kegiatan->start_at,
                    "kegiatan_end" => $kegiatan->end_at,
                    "posyandu" => $kegiatan->id_posyandu,
                    "type" => "kegiatan"
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
           /* foreach( $user as $item) {
                if ( $item->role == '0' ) {
                    $duar = Anak::where("id_user", $item->id)->get()->first();
                }
    
                else if ( $item->role == '1' ) {
                    $duar = Ibu::where("id_user", $item->id)->get()->first();
                }
    
                else if ( $item->role == '2' ) {
                    $duar = Lansia::where("id_user", $item->id)->get()->first();
                }
                if ( $duar->id_posyandu == $kegiatan->id_posyandu ) {
                    $notif = NotifikasiUser::create([
                        'id_user' => $item->id,
                        'notif_title' => $notiftitle,
                        'notif_content' => $notifcontent
                    ]);
                }
            } */
    
            /* notif mobile user shit end here */
    
    
            return redirect()->route('kegiatan.home')->with(['success' => 'Kegiatan posyandu berhasil ditambahkan']);
        }
        

    }

    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('admin.kegiatan.kegiatan.show', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|regex:/^[a-z,. 0-9]+$/i|min:2|max:100',
            'tempat' => 'required|regex:/^[a-z,. 0-9]+$/i|min:2|max:100|min:2',
            'deskripsi' => 'required|min:2',
            'start_at' => 'required',
            'end_at' => 'required',
        ],[
            'nama_kegiatan.required' => "Nama kegiatan wajib diisi",
            'nama_kegiatan.regex' => "Forma nama kegiatan tidak sesuai",
            'nama_kegiatan.min' => "Nama kegiatan minimal berjumlah 2 karakter",
            'nama_kegiatan.max' => "Nama kegiatan maksimal berjumlah 100 karakter",
            'tempat.required' => "Tempat kegiatan wajib diisi",
            'tempat.regex' => "Format tempat kegiatan tidak sesuai",
            'tempat.min' => "Tempat kegiatan minimal berjumlah 2 karakter",
            'tempat.max' => "Tempat kegiatan maksimal berjumlah 100 karakter",
            'start_at.required' => "Waktu mulai kegiatan kegiatan wajib diisi",
            'end_at.required' => "Waktu berakhir kegiatan wajib diisi",
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

    public function delete(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'alasan' => 'required|regex:/^[a-z,. 0-9]+$/i|min:2|max:150',
        ],[
            'alasan.required' => "Alasan pembatalan kegiatan wajib diisi",
            'alasan.regex' => "Forma alasan pembatalan kegiatan tidak sesuai",
            'alasan.min' => "Alasan pembatalan kegiatan minimal berjumlah 2 karakter",
            'alasan.max' => "Alasan pembatalan kegiatan maksimal berjumlah 150 karakter",
        ]);

        $kegiatan = Kegiatan::find($kegiatan->id);
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
