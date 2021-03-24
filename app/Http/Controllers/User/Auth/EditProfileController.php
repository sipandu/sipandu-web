<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;

class EditProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function anak(Request $request)
    {
        return view('pages/auth/user/profile/anak');
    }

    public function ibu(Request $request)
    {
        return view('pages/auth/user/profile/ibu');
    }

    public function lansia(Request $request)
    {
        return view('pages/auth/user/profile/lansia');
    }

    public function updateProfile(Request $request)
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

        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->profile_image = $path;
        $user->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);
    }

    public function updatePassword(Request $request)
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

        if (!(Hash::check($request->password_lama,Auth::user()->password))) {
            return redirect()->back()->with(['error' => 'Password Lama tidak sesuai']);
        }
        if(strcmp($request->password_lama, $request->password) == 0){
            return redirect()->back()->with(['error' => 'Password yang anda masukan sama dengan yang lama']);
        }

        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);


    }


    public function updatePersonalAnak (Request $request)
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

        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->email = $request->email;
        $user->username_tele = $request->telegram;
        $user->save();

        $anak = Anak::where('id_user',$idUser)->first();
        $anak->nomor_telepon = $request->no_tlpn;
        $anak->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);

    }

    public function updatePersonalIbu (Request $request)
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

        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->email = $request->email;
        $user->username_tele = $request->telegram;
        $user->save();

        $ibu = Ibu::where('id_user',$idUser)->first();
        $ibu->nomor_telepon = $request->no_tlpn;
        $ibu->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);

    }

    public function updatePersonalLansia (Request $request)
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

        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->email = $request->email;
        $user->username_tele = $request->telegram;
        $user->save();

        $lansia = Lansia::where('id_user',$idUser)->first();
        $lansia->nomor_telepon = $request->no_tlpn;
        $lansia->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);

    }



}
