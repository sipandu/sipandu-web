<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Posyandu;
use App\Pegawai;
use App\Admin;
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

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg',
        ],
        [
            'file.required' => "File foto wajib diiisi",
            'file.image' => "Format file harus berupa Foto",
            'file.mimes' => "Upload Foto dengan Format : jpeg,png,jpg",
        ]);

        $path ='/images/upload/Profile/'.time().'-'.$request->file->getClientOriginalName();
        $imageName = time().'-'.$request->file->getClientOriginalName();

        $request->file->move(public_path('images/upload/Profile'),$imageName);

        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->profile_image = $path;
        $admin->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);
    }

    public function accountUpdate(Request $request)
    {
        $this->validate($request, [
            'email' => "required|email",
            'telegram' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'no_tlpn' => "required|numeric|digits_between:11,15",
        ]
        ,[
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email yang valid",
            'telegram.required' => "Telegram wajib diisi",
            'telegram.regex' => "Format penamaan Username Telegram tidak sesuai",
            'telegram.max' => "Masukan Username Telegram maksimal 30 huruf",
            'no_tlpn.required' => "Nomor telepon wajib diisi",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 12 sampai 15 karakter",

        ]);

        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->email = $request->email;
        $admin->save();

        $pegawai = Pegawai::where('id_admin',$idAdmin)->first();
        $pegawai->username_telegram = $request->telegram;
        $pegawai->nomor_telepon = $request->no_tlpn;
        $pegawai->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);

    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'password_lama' => 'required',
            'password' => 'required|min:8|max:50|confirmed',
        ],
        [
            'password_lama.required' => "Password Terakhir wajib diisi",
            'password.required' => "Password Baru wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai",
        ]);
        
        if (!(Hash::check($request->password_lama,Auth::guard('admin')->user()->password))) {
            return redirect()->back()->with(['error' => 'Password Lama tidak sesuai']);
        }
        if(strcmp($request->password_lama, $request->password) == 0){
            return redirect()->back()->with(['error' => 'Password yang anda masukan sama dengan yang lama']);
        }
        
        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);
             
        
    }

}
