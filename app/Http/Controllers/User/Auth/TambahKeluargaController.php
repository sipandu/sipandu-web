<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Ibu;
use App\Lansia;
use App\Anak;
use App\Kabupaten;
use App\Posyandu;

class TambahKeluargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formAnak()
    {
        $kabupaten = Kabupaten::get()->all();
        return view('pages/auth/user/tambah-keluarga/tambah-keluarga-anak', compact(['kabupaten']));
    }

    public function formIbu()
    {
        $kabupaten = Kabupaten::get()->all();
        return view('pages/auth/user/tambah-keluarga/tambah-keluarga-ibu', compact(['kabupaten']));
    }

    public function formLansia()
    {
        $kabupaten = Kabupaten::get()->all();
        return view('pages/auth/user/tambah-keluarga/tambah-keluarga-lansia', compact(['kabupaten']));
    }

    public function storeIbu(Request $request)
    {
        $this->validate($request,[
            'nama_ibu' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email_ibu' => "required|email|unique:tb_user,email",
            'passwordIbu' => 'required|min:8|max:50|confirmed',
        ],
        [
            'nama_ibu.required' => "Nama lengkap ibu hamil wajib diisi",
            'nama_ibu.regex' => "Format nama ibu hamil tidak sesuai",
            'nama_ibu.min' => "Nama ibu hamil minimal berjumlah 2 huruf",
            'nama_ibu.max' => "Nama ibu hamil maksimal berjumlah 50 huruf",
            'email_ibu.required' => "Email ibu hamil wajib diisi",
            'email_ibu.email' => "Masukan email yang sesuai",
            'email_ibu.unique' => "Email sudah pernah digunakan",
            'passwordIbu.required' => "Kata sandi wajib diisi",
            'passwordIbu.min' => "Kata sandi minimal berjumlah 8 karakter",
            'passwordIbu.max' => "Kata sandi maksimal berjumlah 50 karakter",
            'passwordIbu.confirmed' => "Konfirmasi kata sandi tidak sesuai",
        ]);

        $idKK = Auth::user()->id_kk;
        $user = User::create([
            'id_kk' =>  $idKK,
            'email' => $request->email_ibu,
            'password' => Hash::make($request->passwordIbu),
            'role' => '1',
            'profile_image' => "/images/upload/Profile/default.jpg",
            'is_verified' => 1,
        ]);

        $posyandu = Posyandu::where('id', Auth::user()->lansia->id_posyandu)->first();
        $ibu = $user->ibu()->create([
            'id_posyandu' => $request->banjar_ibu,
            'nama_ibu_hamil' => $request->nama_ibu,
        ]);

        if ($user && $ibu) {
            return redirect()->back()->with(['success' => 'Akun anggota keluarga baru berhasil di tambahkan']);
        } else {
            return redirect()->back()->with(['error' => 'Akun anggota keluarga baru gagal di tambahkan']);
        }
    }

    public function storeAnak(Request $request)
    {
        $this->validate($request,[
            'nama_anak' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email_anak' => "required|email|unique:tb_user,email",
            'passwordAnak' => 'required|min:8|max:50|confirmed',
        ],
        [
            'nama_anak.required' => "Nama lengkap anak wajib diisi",
            'nama_anak.regex' => "Format nama anak tidak sesuai",
            'nama_anak.min' => "Nama anak minimal berjumlah 2 huruf",
            'nama_anak.max' => "Nama anak maksimal berjumlah 50 huruf",
            'email_anak.required' => "Email anak wajib diisi",
            'email_anak.email' => "Masukan email yang sesuai",
            'email_anak.unique' => "Email sudah pernah digunakan",
            'passwordAnak.required' => "Kata sandi wajib diisi",
            'passwordAnak.min' => "Kata sandi minimal berjumlah 8 karakter",
            'passwordAnak.max' => "Kata sandi maksimal berjumlah 50 karakter",
            'passwordAnak.confirmed' => "Konfirmasi kata sandi tidak sesuai",
        ]);

        $idKK = Auth::user()->id_kk;
        $user = User::create([
            'id_kk' =>  $idKK,
            'email' => $request->email_anak,
            'password' => Hash::make($request->passwordAnak),
            'role' => '0',
            'profile_image' => "/images/upload/Profile/default.jpg",
            'is_verified' => 1,
        ]);

        $posyandu = Posyandu::where('id', Auth::user()->lansia->id_posyandu)->first();
        $anak = $user->anak()->create([
            'id_posyandu' => $request->banjar_anak,
            'nama_anak' => $request->nama_anak,
        ]);

        if ($user && $anak) {
            return redirect()->back()->with(['success' => 'Akun anggota keluarga baru berhasil di tambahkan']);
        } else {
            return redirect()->back()->with(['error' => 'Akun anggota keluarga baru gagal di tambahkan']);
        }
    }

    public function storeLansia(Request $request)
    {
        $this->validate($request,[
            'nama_lansia' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email_lansia' => "required|email|unique:tb_user,email",
            'passwordLansia' => 'required|min:8|max:50|confirmed',
        ],
        [
            'nama_lansia.required' => "Nama lengkap lansia wajib diisi",
            'nama_lansia.regex' => "Format nama lansia tidak sesuai",
            'nama_lansia.min' => "Nama lansia minimal berjumlah 2 huruf",
            'nama_lansia.max' => "Nama lansia maksimal berjumlah 50 huruf",
            'email_lansia.required' => "Email lansia wajib diisi",
            'email_lansia.email' => "Masukan email yang sesuai",
            'email_lansia.unique' => "Email sudah pernah digunakan",
            'passwordLansia.required' => "Kata sandi wajib diisi",
            'passwordLansia.min' => "Kata sandi minimal berjumlah 8 karakter",
            'passwordLansia.max' => "Kata sandi maksimal berjumlah 50 karakter",
            'passwordLansia.confirmed' => "Konfirmasi kata sandi tidak sesuai",
        ]);

        $idKK = Auth::user()->id_kk;
        $user = User::create([
            'id_kk' =>  $idKK,
            'email' => $request->email_lansia,
            'password' => Hash::make($request->passwordLansia),
            'role' => '2',
            'profile_image' => "/images/upload/Profile/deafult.jpg",
            'is_verified' => 1,
        ]);

        $posyandu = Posyandu::where('id', Auth::user()->lansia->id_posyandu)->first();
        $lansia = $user->lansia()->create([
            'id_posyandu' => $posyandu->id,
            'nama_lansia' => $request->nama_lansia,
        ]);

        if ($user && $lansia) {
            return redirect()->back()->with(['success' => 'Akun anggota keluarga baru berhasil di tambahkan']);
        } else {
            return redirect()->back()->with(['error' => 'Akun anggota keluarga baru gagal di tambahkan']);
        }
    }

}
