<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Posyandu;
use App\Pegawai;
use App\Admin;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\KK;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        return view('pages/admin/dashboard');
    }


    public function profile(Request $request)
    {
        return view('pages/auth/admin/profile-admin');
    }


    public function showVerifyUser(Request $request)
    {
        $idPosyandu = Auth::guard('admin')->user()->pegawai->id_posyandu;
        $anak = Anak::with('user')->where('id_posyandu',$idPosyandu)->orderBy('created_at', 'asc')->get();
        $ibu = Ibu::with('user')->where('id_posyandu',$idPosyandu)->orderBy('created_at', 'asc')->get();
        $lansia = Lansia::with('user')->where('id_posyandu',$idPosyandu)->orderBy('created_at', 'asc')->get();
        return view('pages/auth/admin/verify-user',compact('anak','ibu','lansia'));
    }

    public function detailVerifyAnak(Request $request, $id)
    {
        $anak = User::find($id);
        return view('pages/auth/admin/verifikasi/detail-verify-anak',compact('anak'));
    }

    public function detailVerifyLansia(Request $request, $id)
    {
        $lansia = User::find($id);
        return view('pages/auth/admin/verifikasi/detail-verify-lansia',compact('lansia'));
    }

    public function detailVerifyIbu(Request $request, $id)
    {
        $ibu = User::find($id);
        return view('pages/auth/admin/verifikasi/detail-verify-bumil', compact('ibu'));
    }


    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg',
        ],
        [
            'file.required' => "Silahkan masukan foto profile",
            'file.image' => "Gambar harus berupa foto",
            'file.mimes' => "Format gambar harus jpeg, png atau jpg",
        ]);

        $path ='/images/upload/Profile/'.time().'-'.$request->file->getClientOriginalName();
        $imageName = time().'-'.$request->file->getClientOriginalName();

        $request->file->move(public_path('images/upload/Profile'),$imageName);

        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->profile_image = $path;
        $admin->save();

        return redirect()->back()->with(['success' => 'Foto profile anda berhasil di ubah']);
    }

    public function accountUpdate(Request $request)
    {

        $this->validate($request, [
            'email' => "required|email",
            'telegram' => "required|max:20",
            'no_tlpn' => "required|numeric|digits_between:11,15",
        ]
        ,[
            'email.required' => "Email tidak boleh kosong",
            'email.email' => "Masukan Email yang valid",
            'telegram.required' => "Username Telegram wajib diisi",
            'telegram.max' => "Username Telegram maksimal 30 karakter",
            'no_tlpn.required' => "Nomor telepon tidak boleh kosong",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.digits_between' => "Nomor telepon yang dimasukan harus berjumlah 11 sampai 15 karakter",

        ]);

        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->email = $request->email;
        $admin->save();

        $pegawai = Pegawai::where('id_admin',$idAdmin)->first();
        $pegawai->username_telegram = $request->telegram;
        $pegawai->nomor_telepon = $request->no_tlpn;
        $pegawai->save();

        return redirect()->back()->with(['success' => 'Data akun anda berhasil di ubah']);
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

    public function terimaUser(Request $request)
    {
        $user = User::find($request->iduser);
        $user->is_verified = 1;
        $user->save();
        return redirect()->route('show.verify');

    }

    public function tolakUser(Request $request)
    {
        $this->validate($request, [
            'keterangan' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
        ]
        ,[
            'keterangan.required' => "Telegram wajib diisi",
            'keterangan.regex' => "Format penamaan Username Telegram tidak sesuai",
            'keterangan.max' => "Masukan Username Telegram maksimal 30 huruf",

        ]);

        $user = User::find($request->iduser);
        $user->is_verified = 0;
        $user->keterangan = $request->keterangan;
        $user->save();
        return redirect()->route('show.verify');
    }
}
