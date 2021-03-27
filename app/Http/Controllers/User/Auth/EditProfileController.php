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
            'file.required' => "Silakan unggah foto profile",
            'file.image' => "Foto profile harus berupa gambar",
            'file.mimes' => "Foto profile harus berformat jpeg, png, jpg",
        ]);

        $path ='/images/upload/Profile/'.time().'-'.$request->file->getClientOriginalName();
        $imageName = time().'-'.$request->file->getClientOriginalName();

        $request->file->move(public_path('images/upload/Profile'),$imageName);

        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->profile_image = $path;
        $user->save();

        return redirect()->back()->with(['success' => 'Foto profile berhasil di ubah']);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password_lama' => 'required',
            'password' => 'required|min:8|max:50|confirmed',
        ],
        [
            'password_lama.required' => "Password lama wajib diisi",
            'password.required' => "Password baru wajib diisi",
            'password.min' => "Password minimal berjumlah 8 karakter",
            'password.max' => "Password maksimal berjumlah 50 karakter",
            'password.confirmed' => "Konfirmasi password anda tidak sesuai",
        ]);

        if (Hash::check($request->password_lama, Auth::user()->password)) {
            $idUser = Auth::user()->id;
            $user = User::find($idUser);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with(['success' => 'Password berhasil diperbaharui']);
        } else {
            return redirect()->back()->with(['error' => 'Password lama anda tidak sesuai']);
        }
    }

    public function updatePersonalAnak (Request $request)
    {
        if (Auth::user()->email == $request->email) {
            if (Auth::user()->username_tele == $request->telegram) {
                if (Auth::user()->anak->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                }
            } else {
                if (Auth::user()->anak->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                }
            }
        } else {
            if (Auth::user()->username_tele == $request->telegram) {
                if (Auth::user()->anak->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } 
            } else {
                if (Auth::user()->anak->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } 
            }
        }
        
        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->email = $request->email;
        $user->username_tele = $request->telegram;
        $user->save();

        $anak = Anak::where('id_user',$idUser)->first();
        $anak->nomor_telepon = $request->no_tlpn;
        $anak->save();

        return redirect()->back()->with(['success' => 'Perubahan data akun anak berhasil disimpan']);
    }

    public function updatePersonalIbu (Request $request)
    {
        if (Auth::user()->email == $request->email) {
            if (Auth::user()->username_tele == $request->telegram) {
                if (Auth::user()->ibu->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                }
            } else {
                if (Auth::user()->ibu->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                }
            }
        } else {
            if (Auth::user()->username_tele == $request->telegram) {
                if (Auth::user()->ibu->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            
                    ]);
                } 
            } else {
                if (Auth::user()->ibu->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } 
            }
        }

        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->email = $request->email;
        $user->username_tele = $request->telegram;
        $user->save();

        $ibu = Ibu::where('id_user',$idUser)->first();
        $ibu->nomor_telepon = $request->no_tlpn;
        $ibu->save();

        return redirect()->back()->with(['success' => 'Perubahan data akun ibu hamil berhasil disimpan']);
    }

    public function updatePersonalLansia (Request $request)
    {
        if (Auth::user()->email == $request->email) {
            if (Auth::user()->username_tele == $request->telegram) {
                if (Auth::user()->lansia->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                }
            } else {
                if (Auth::user()->lansia->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                }
            }
        } else {
            if (Auth::user()->username_tele == $request->telegram) {
                if (Auth::user()->lansia->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            
                    ]);
                } 
            } else {
                if (Auth::user()->lansia->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } else {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_user,email",
                        'telegram' => "required|max:25|unique:tb_user,username_tele",
                        'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
                    ]
                    ,[
                        'email.required' => "Email wajib diisi",
                        'email.email' => "Masukan format email yang sesuai",
                        'email.unique' => "Email sudah pernah digunakan",
                        'telegram.required' => "Username Telegram wajib diisi",
                        'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
                        'telegram.unique' => "Username Telegram sudah pernah digunakan",
                        'no_tlpn.required' => "Nomor telepon wajib diisi",
                        'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
                        'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
                        'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
                    ]);
                } 
            }
        }
        
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
