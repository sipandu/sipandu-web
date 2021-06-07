<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\NotificationAccUser;
use App\Mail\NotificationRjctUser;
use App\Posyandu;
use App\Pegawai;
use App\Admin;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\SuperAdmin;
use App\NakesPosyandu;
use App\Nakes;
use App\KK;
use App\Mover;
use App\PemeriksaanIbu;
use App\PemeriksaanAnak;
use App\PemeriksaanLansia;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::where('id', $idAdmin)->get()->first();
        $pegawai = Pegawai::Where('id_admin', $admin->id)->first();
        // dd($idAdmin);
        if($pegawai != null){
            $idPosyandu = $pegawai->id_posyandu;
            $nakes = Pegawai::where('id_posyandu', $idPosyandu)->where('jabatan', 'tenaga kesehatan')->get();
        }else{
            $idPosyandu = null;
            $nakes = null;
        }
        
        $anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
        ->get();
        $bumil = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
        ->get();
        $lansia = Lansia::join('tb_user', 'tb_user.id', 'tb_lansia.id_user')
            ->select('tb_lansia.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
        ->get();
        
        $nakesAll = Nakes::get();
        $kaderAll = Pegawai::where('jabatan', 'kader')->get();
        $anggota = User::where('is_verified', 1)->get();
        $posyandu = Posyandu::get();
        // dd($posyandu);
        if($admin->role == "super admin"){
            $indicateUser = SuperAdmin::where('id_admin', Auth()->user()->id)->first();
        }elseif($admin->role == "pegawai"){
            $indicateUser = Pegawai::where('id_admin', Auth()->user()->id)->first();
        }else{
            $indicateUser = Nakes::where('id_admin', Auth()->user()->id)->first();
        }
        
        if($indicateUser != null){
            if($admin->role == "super admin"){
                $superadmin = SuperAdmin::where('id_admin', $indicateUser->id)->get();
                $datIbu = Ibu::whereMonth('created_at', date("m") )->get();
                $jumlahIbu = count($datIbu);
                $datAnak = Anak::whereMonth('created_at', date("m") )->get();
                $jumlahAnak = count($datAnak);
                $datLansia = Lansia::whereMonth('created_at', date("m") )->get();
                $jumlahLansia = count($datLansia);
                // dd($jumlahIbu);
                return view('pages/admin/dashboard', compact('admin','jumlahIbu', 'jumlahAnak', 'jumlahLansia', 'anak', 'bumil', 'lansia', 'nakes', 'nakesAll', 'kaderAll', 'kaderAll', 'anggota', 'posyandu'));
            }elseif($admin->role == "tenaga kesehatan"){
                $nakes = Nakes::where('id_admin', $admin->id)->first();
                // dd($nakes->id);
                $nakespos = NakesPosyandu::where('id_nakes', $nakes->id)->get();
                $jumlahIbu = 0;
                $jumlahAnak = 0;
                $jumlahLansia = 0;
                   
                foreach($nakespos as $np){
                    
                    $datIbu = Ibu::where('id_posyandu', $np->id_posyandu)->whereMonth('created_at', date("m") )->get();
                    $jumlahIbu += count($datIbu);
                    $datAnak = Anak::where('id_posyandu', $np->id_posyandu)->whereMonth('created_at', date("m") )->get();
                    $jumlahAnak += count($datAnak);
                    $datLansia = Lansia::where('id_posyandu', $np->id_posyandu)->whereMonth('created_at', date("m") )->get();
                    $jumlahLansia += count($datLansia);
                }
                
                $datIbus = Ibu::where('id_posyandu', $nakespos[0]->id_posyandu)->whereMonth('created_at', date("m") )->get();
                $datIbuss = Ibu::where('id_posyandu', $nakespos[1]->id_posyandu)->whereMonth('created_at', date("m") )->get();
                // dd($jumlahIbu);
                return view('pages/admin/dashboard', compact('admin','jumlahIbu', 'jumlahAnak', 'jumlahLansia', 'anak', 'bumil', 'lansia', 'nakes', 'nakesAll', 'kaderAll', 'kaderAll', 'anggota', 'posyandu'));
            }else{
                $datKonIbu = PemeriksaanIbu::where('jenis_pemeriksaan', "Konsultasi")->whereMonth('created_at', date('m'))->get();
                $datKonAnak = PemeriksaanAnak::where('jenis_pemeriksaan', "Konsultasi")->whereMonth('created_at', date('m'))->get();
                $datKonLansia = PemeriksaanLansia::where('jenis_pemeriksaan', "Konsultasi")->whereMonth('created_at', date('m'))->get();
                $datPemIbu = PemeriksaanIbu::where('jenis_pemeriksaan', "Pemeriksaan")->whereMonth('created_at', date('m'))->get();
                $datPemAnak = PemeriksaanAnak::where('jenis_pemeriksaan', "Pemeriksaan")->whereMonth('created_at', date('m') )->get();
                $datPemLansia = PemeriksaanLansia::where('jenis_pemeriksaan', "Pemeriksaan")->whereMonth('created_at', date('m'))->get();
                // dd($datKonIbu);
                $jumlahKonIbu = count($datKonIbu);
                $jumlahKonAnak = count($datKonAnak);
                $jumlahKonLansia = count($datKonLansia);
                $jumlahPemIbu = count($datPemIbu);
                $jumlahPemAnak = count($datPemAnak);
                $jumlahPemLansia = count($datPemLansia);
                return view('pages/admin/dashboard', compact('jumlahKonIbu', 'jumlahKonAnak','jumlahKonLansia','jumlahPemIbu','jumlahPemAnak','jumlahPemLansia','anak', 'bumil', 'lansia', 'nakes', 'nakesAll', 'kaderAll', 'kaderAll', 'anggota', 'posyandu'));
            }
        }
        // return view('pages/admin/dashboard', compact('anak', 'bumil', 'lansia', 'posyandu', 'anggota', 'nakesAll', 'kaderAll'));
    }

    public function getProfileImage()
    { 
        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::where('id', $idAdmin)->get()->first();
        
        if(File::exists(storage_path($admin->profile_image))) {
            return response()->file(
                storage_path($admin->profile_image)
            );
        } else {
            return response()->file(
                public_path('images/sipandu-logo.png')
            );
        }
    }

    public function profile(Request $request)
    {
        $nakesPosyandu = NakesPosyandu::get();
        return view('pages/auth/admin/profile-admin', compact('nakesPosyandu'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ],
        [
            'file.required' => "Silahkan masukan foto profile",
            'file.image' => "Gambar harus berupa foto",
            'file.mimes' => "Format gambar harus jpeg, png atau jpg",
            'file.size' => "Gambar maksimal berukuran 5 Mb",
        ]);

        $idAdmin = Auth::guard('admin')->user()->id;
        $dataAdmin = Admin::where('id', $idAdmin)->get()->first();

        if($request->file('file') != null){
            File::delete(storage_path($dataAdmin->profile_image));
            $filename = Mover::slugFile($request->file('file'), 'app/profile/pegawai/');
            $admin = Admin::find($idAdmin);
            $admin->profile_image = $filename;
            $admin->save();
        } else {
            $filename = Mover::slugFile($request->file('file'), 'app/profile/pegawai/');
            $admin = Admin::find($idAdmin);
            $admin->profile_image = $filename;
            $admin->save();
        }

        if ($filename && $admin) {
            return redirect()->back()->with(['success' => 'Foto profile anda berhasil di ubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Foto profile anda gagal di ubah']);
        }
    }

    public function accountUpdate(Request $request)
    {
        $this->validate($request, [
            'email' => "required|email",
            'telegram' => "nullable|max:25|unique:tb_admin,username_tele",
            'no_tlpn' => "nullable|numeric|unique:tb_pegawai,nomor_telepon",
        ]
        ,[
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan format email yang sesuai",
            'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
            'telegram.unique' => "Username Telegram sudah pernah digunakan",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
        ]);

        $idAdmin = Auth::guard('admin')->user()->id;

        if ($request->telegram == NULL) {
            $admin = Admin::find($idAdmin);
            $admin->email = $request->email;
            $admin->save();

            $pegawai = Pegawai::where('id_admin', $idAdmin)->update([
                'status' => 'tidak tersedia',
                'username_telegram' => $request->telegram,
                'nomor_telepon' => $request->no_tlpn
            ]);
        } else {
            $admin = Admin::find($idAdmin);
            $admin->email = $request->email;
            $admin->save();
            
            $pegawai = Pegawai::where('id_admin',$idAdmin)->first();
            $pegawai->username_telegram = $request->telegram;
            $pegawai->nomor_telepon = $request->no_tlpn;
            $pegawai->save();
        }

        if ($admin && $pegawai) {
            return redirect()->back()->with(['success' => 'Data akun anda berhasil disimpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data akun anda gagal disimpan']);
        }
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'password_lama' => 'required',
            'password' => 'required|min:8|max:50|confirmed',
        ],
        [
            'password_lama.required' => "Password lama wajib diisi",
            'password.required' => "Password baru wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai",
        ]);

        if (Hash::check($request->password_lama, Auth::guard('admin')->user()->password)) {
            $idAdmin = Auth::guard('admin')->user()->id;
            $admin = Admin::find($idAdmin);
            $admin->password = Hash::make($request->password);
            $admin->save();
            return redirect()->back()->with(['success' => 'Password anda berhasil diubah']);
        } else {
            return redirect()->back()->with(['error' => 'Password lama anda tidak sesuai']);
        }
    }

    public function accountUpdateSuperadmin(Request $request)
    {
        $this->validate($request, [
            'email' => "required|email",
            'telegram' => "nullable|max:25|unique:tb_admin,username_tele",
            'no_tlpn' => "nullable|numeric|unique:tb_pegawai,nomor_telepon",
        ]
        ,[
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan format email yang sesuai",
            'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
            'telegram.unique' => "Username Telegram sudah pernah digunakan",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
        ]);

        $idAdmin = Auth::guard('admin')->user()->id;

        if ($request->telegram == NULL) {
            $admin = Admin::find($idAdmin);
            $admin->email = $request->email;
            $admin->save();

            $pegawai = SuperAdmin::where('id_admin', $idAdmin)->update([
                'username_telegram' => $request->telegram,
                'nomor_telepon' => $request->no_tlpn
            ]);
        } else {
            $admin = Admin::find($idAdmin);
            $admin->email = $request->email;
            $admin->save();
            
            $pegawai = SuperAdmin::where('id_admin',$idAdmin)->first();
            $pegawai->username_telegram = $request->telegram;
            $pegawai->nomor_telepon = $request->no_tlpn;
            $pegawai->save();
        }

        if ($admin && $pegawai) {
            return redirect()->back()->with(['success' => 'Data akun anda berhasil disimpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data akun anda gagal disimpan']);
        }
    }
}
