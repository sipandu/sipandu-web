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
use App\KK;
use App\Mover;

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

    public function getProfileImage($id)
    {
        $admin = Admin::where('id', $id)->get()->first();
        if(File::exists(storage_path($admin->profile_image))) {
            return response()->file(
                storage_path($admin->profile_image)
            );
        } else {
            return response()->file(
                public_path('images/sipandu-logo.png')
            );
        }

        return redirect()->back();
    }

    public function profile(Request $request)
    {
        return view('pages/auth/admin/profile-admin');
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
            'no_tlpn' => "nullable|numeric|unique:tb_admin|nomor_telepon",
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

        if ($request->telegram == NULL) {
            $pegawai = Pegawai::update([
                'status' => 'tidak tersedia'
            ]);
        } else {
            $idAdmin = Auth::guard('admin')->user()->id;
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
}
