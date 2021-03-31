<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::guard('admin')->user()->email == $request->email) {
            if (Auth::guard('admin')->user()->pegawai->username_telegram == $request->telegram) {
                if (Auth::guard('admin')->user()->pegawai->nomor_telepon == $request->no_tlpn) {
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
                        'no_tlpn' => "required|numeric|unique:tb_pegawai,nomor_telepon",
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
                if (Auth::guard('admin')->user()->pegawai->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email",
                        'telegram' => "required|max:25|unique:tb_pegawai,username_telegram",
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
                        'telegram' => "required|max:25|unique:tb_pegawai,username_telegram",
                        'no_tlpn' => "required|numeric|unique:tb_pegawai,nomor_telepon",
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
            if (Auth::guard('admin')->user()->pegawai->username_telegram == $request->telegram) {
                if (Auth::guard('admin')->user()->pegawai->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_admin,email",
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
                        'email' => "required|email|unique:tb_admin,email",
                        'telegram' => "required|max:25",
                        'no_tlpn' => "required|numeric|unique:tb_pegawai,nomor_telepon",
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
                if (Auth::guard('admin')->user()->pegawai->nomor_telepon == $request->no_tlpn) {
                    $this->validate($request, [
                        'email' => "required|email|unique:tb_admin,email",
                        'telegram' => "required|max:25|unique:tb_pegawai,username_telegram",
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
                        'email' => "required|email|unique:tb_admin,email",
                        'telegram' => "required|max:25|unique:tb_pegawai,username_telegram",
                        'no_tlpn' => "required|numeric|unique:tb_pegawai,nomor_telepon",
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

        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->email = $request->email;
        $admin->save();

        $pegawai = Pegawai::where('id_admin',$idAdmin)->first();
        $pegawai->username_telegram = $request->telegram;
        $pegawai->nomor_telepon = $request->no_tlpn;
        $pegawai->save();

        return redirect()->back()->with(['success' => 'Perubahan data akun anda berhasil disimpan']);
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
        Mail::to($user->email)->send(new NotificationAccUser($user));

        $user->save();
        return redirect()->route('show.verify');

    }

    public function tolakUser(Request $request)
    {
        $this->validate($request, [
            'keterangan' => "required|regex:/^[a-z .,0-9]+$/i|min:5",
        ],
        [
            'keterangan.required' => "Silahkan berikan keterangan",
            'keterangan.regex' => "Format pemberian keterangan tidak sesuai",
            'keterangan.min' => "Keterangan yang diberikan minimal berjumlah 5 karakter",

        ]);

        $user = User::find($request->iduser);
        $user->is_verified = 0;
        $user->keterangan = $request->keterangan;
        $user->save();

        Mail::to($user->email)->send(new NotificationRjctUser($user));

        return redirect()->route('show.verify');
    }


    public function updateStatus(Request $request)
    {
        $this->validate($request, [
            'customRadio' => "required",
        ],
        [
            'customRadio.required' => "Pilihlah Custom Status Anda",
        ]);

        $idAdmin = Auth::guard('admin')->user()->id;
        $pegawai = Pegawai::where('id_admin',$idAdmin)->first();
        $pegawai->status = $request->customRadio;
        $pegawai->save();

        return redirect()->back()->with(['success' => 'Status Berhasil Di Ubah']);
    }

}
