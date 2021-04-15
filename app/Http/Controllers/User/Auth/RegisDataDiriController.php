<?php

namespace App\Http\Controllers\User\Auth;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Kabupaten;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisDataDiriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // awal dari fungsi menampilkan user dari data diri //
    public function showRegisFormAnak(Request $request)
    {
        return view('pages/auth/user/data-diri/anak');
    }

    public function showRegisFormIbu(Request $request)
    {
     return view('pages/auth/user/data-diri/ibu');
    }

    public function showRegisFormLansia(Request $request)
    {
        return view('pages/auth/user/data-diri/lansia');
    }


    // awal dari fungsi menampilkan user dari data diri //
    public function storeDataAnak(Request $request)
    {
        $this->validate($request,[
            'nik' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'nama_ayah' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'nama_ibu' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'no_tlpn' => "required|numeric|digits_between:11,15|unique:tb_anak,nomor_telepon",
            'anak_ke' => "required|numeric",
            'gender' => "required",
            'alamat' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'telegram' => "required|regex:/^[a-z .,0-9]+$/i|max:30",

        ],
        [
            'telegram.required' => "Telegram wajib diisi",
            'telegram.regex' => "Format penamaan Username Telegram tidak sesuai",
            'telegram.max' => "Masukan Username Telegram maksimal 30 huruf",
            'nik.required' => "NIK wajib diisi",
            'nik.unique' => "NIK sudah pernah digunakan",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'nama_ayah.required' => "Nama Ayah wajib diisi",
            'nama_ayah.regex' => "Format Nama Ayah tidak sesuai",
            'nama_ayah.min' => "Nama Ayah minimal 2 karakter",
            'nama_ayah.max' => "Nama Ayah maksimal 50 karakter",
            'nama_ibu.required' => "Nama Ibu wajib diisi",
            'nama_ibu.regex' => "Format Nama Ibu tidak sesuai",
            'nama_ibu.min' => "Nama Ibu minimal 2 karakter",
            'nama_ibu.max' => "Nama Ibu maksimal 50 karakter",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'no_tlpn.required' => "Nomor telepon wajib diisi",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 12 sampai 15 karakter",
            'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'gender.required' => "Jenis Kelamin Wajib diisi",
            'anak_ke.required' => "Nomor telepon wajib diisi",
            'anak_ke.numeric' => "Format harus berupa angka",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format penamaan alamat tidak sesuai",
            'alamat.max' => "Masukan alamat maksimal 30 huruf",

        ]);
        //Auth User
        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->update([
            'username_tele' => $request->telegram,
        ]);

        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;


        $anak = Anak::whereId_user($idUser)->first();
        $anak->update([
            'NIK' => $request->nik,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
            'jenis_kelamin' => $request->gender,
            'nomor_telepon' => $request->no_tlpn,
            'anak_ke' => $request->anak_ke,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('anak.home');
    }

    public function storeDataIbu(Request $request)
    {

        $this->validate($request,[
            'nik' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'nama_suami' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'no_tlpn' => "required|numeric|digits_between:11,15|unique:tb_anak,nomor_telepon",
            'alamat' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'telegram' => "required|regex:/^[a-z .,0-9]+$/i|max:30",

        ],
        [
            'telegram.required' => "Telegram wajib diisi",
            'telegram.regex' => "Format penamaan Username Telegram tidak sesuai",
            'telegram.max' => "Masukan Username Telegram maksimal 30 huruf",
            'nik.required' => "NIK wajib diisi",
            'nik.unique' => "NIK sudah pernah digunakan",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'nama_suami.required' => "Nama Suami wajib diisi",
            'nama_suami.regex' => "Format Nama Suami tidak sesuai",
            'nama_suami.min' => "Nama Suami minimal 2 karakter",
            'nama_suami.max' => "Nama Suami maksimal 50 karakter",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'no_tlpn.required' => "Nomor telepon wajib diisi",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 12 sampai 15 karakter",
            'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format penamaan alamat tidak sesuai",
            'alamat.max' => "Masukan alamat maksimal 30 huruf",

        ]);

        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        //Auth User
        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->update([
            'username_tele' => $request->telegram,
        ]);

        $ibu = Ibu::whereId_user($idUser)->first();
        $ibu->update([
            'NIK' => $request->nik,
            'nama_suami' => $request->nama_suami,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
            'nomor_telepon' => $request->no_tlpn,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('ibu.home');

    }

    public function storeDataLansia(Request $request)
    {
        $this->validate($request,[
            'nik' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'no_tlpn' => "required|numeric|digits_between:11,15|unique:tb_anak,nomor_telepon",
            'status' => "required",
            'gender' => "required",
            'alamat' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'telegram' => "required|regex:/^[a-z .,0-9]+$/i|max:30",

        ],
        [
            'telegram.required' => "Telegram wajib diisi",
            'telegram.regex' => "Format penamaan Username Telegram tidak sesuai",
            'telegram.max' => "Masukan Username Telegram maksimal 30 huruf",
            'nik.required' => "NIK wajib diisi",
            'nik.unique' => "NIK sudah pernah digunakan",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'no_tlpn.required' => "Nomor telepon wajib diisi",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.digits_between' => "Nomor telepon harus berjumlah 12 sampai 15 karakter",
            'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'gender.required' => "Jenis Kelamin Wajib diisi",
            'gender.required' => "Jenis Kelamin Wajib diisi",
            'status.required' => "Status Lansia wajib diisi",
            'alamat.regex' => "Format penamaan alamat tidak sesuai",
            'alamat.max' => "Masukan alamat maksimal 30 huruf",

        ]);
        //Auth User
        $idUser = Auth::user()->id;
        $user = User::find($idUser);
        $user->update([
            'username_tele' => $request->telegram,
        ]);;

        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;


        $lansia = Lansia::whereId_user($idUser)->first();
        $lansia->update([
            'NIK' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
            'jenis_kelamin' => $request->gender,
            'nomor_telepon' => $request->no_tlpn,
            'status' => $request->status,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('lansia.home');
    }
}
