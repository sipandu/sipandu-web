<?php

namespace App\Http\Controllers\Admin\ManajemenAkun\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mover;
use App\Admin;
use App\User;
use App\Ibu;
use App\KK;

class BumilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function simpanBumil(Request $request)
    {
        $this->validate($request,[
            'no_kk_bumil' =>"required|numeric|digits:16",
            'nik_bumil' => "required|numeric|unique:tb_ibu_hamil,nik|digits:16",
            'nama_bumil' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_suami' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir_bumil' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir_bumil' => "required|date",
            'agama_bumil' => "required",
            'tanggungan_bumil' => "required",
            'faskes_bumil' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3|max:50",
            'alamat_bumil' => "required|regex:/^[a-z .,0-9]+$/i",
            'no_tlpn_bumil' => "nullable|numeric|unique:tb_ibu_hamil,nomor_telepon",
            'telegram_bumil' => "nullable|max:25|unique:tb_user,username_tele",
            'lokasi_posyandu_bumil' => "required",
            'email_bumil' => "required|email|unique:tb_user,email",
            'passwordBumil' => 'required|min:8|max:50',
        ],
        [
            'no_kk_bumil.required' => "Nomor KK ibu hamil wajib diisi",
            'no_kk_bumil.numeric' => "Nomor KK harus berupa angka",
            'no_kk_bumil.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nik_bumil.required' => "NIK ibu hamil wajib diisi",
            'nik_bumil.unique' => "NIK ibu hamil sudah digunakan",
            'nik_bumil.numeric' => "NIK harus berupa angka",
            'nik_bumil.digits' => "NIK harus berjumlah 16 karakter",
            'nama_bumil.required' => "Nama ibu hamil wajib diisi",
            'nama_bumil.regex' => "Format nama ibu hamil tidak sesuai",
            'nama_bumil.min' => "Nama ibu hamil minimal berjumlah 2 karakter",
            'nama_bumil.max' => "Nama ibu hamil maksimal berjumlah 50 karakter",
            'nama_suami.required' => "Nama suami wajib diisi",
            'nama_suami.regex' => "Format nama suami tidak sesuai",
            'nama_suami.min' => "Nama suami minimal berjumlah 2 karakter",
            'nama_suami.max' => "Nama suami maksimal berjumlah 50 karakter",
            'tempat_lahir_bumil.required' => "Tempat lahir ibu hamil wajib diisi",
            'tempat_lahir_bumil.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir_bumil.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tempat_lahir_bumil.max' => "Tempat lahir minimal berjumlah 50 karakter",
            'tgl_lahir_bumil.required' => "Tanggal lahir ibu hamil wajib diisi",
            'tgl_lahir_bumil.date' => "Tanggal lahir harus berupa tanggal",
            'agama_bumil.required' => "Agama ibu hamil wajib diisi",
            'goldar_bumil.required' => "Golongan darah ibu hamil wajib diisi",
            'tanggungan_bumil.required' => "Tanggungan ibu hamil wajib diisi",
            'faskes_bumil.required' => "Faskes rujukan wajib diisi",
            'faskes_bumil.regex' => "Format faskes rujukan tidak sesuai",
            'faskes_bumil.min' => "Nama faskes rujukan minimal berjumlah 2 karakter",
            'faskes_bumil.max' => "Nama faskes rujukan maksimal berjumlah 50 karakter",
            'alamat_bumil.required' => "Alamat ibu hamil wajib diisi",
            'alamat_bumil.regex' => "Format penamaan alamat tidak sesuai",
            'email_bumil.required' => "Email ibu hamil wajib diisi",
            'email_bumil.email' => "Masukan email yang sesuai",
            'email_bumil.unique' => "Email ibu hamil sudah pernah digunakan",
            'telegram_bumil.max' => "Username Telegram maksimal berjumlah 25 karakter",
            'telegram_bumil.unique' => "Username Telegram ibu hamil sudah pernah digunakan",
            'no_tlpn_bumil.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn_bumil.between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'no_tlpn_bumil.unique' => "Nomor telepon ibu hamil sudah digunakan",
            'lokasi_posyandu_bumil.required' => "Lokasi posyandu ibu hamil wajib diisi",
            'passwordBumil.required' => "Password akun ibu hamil wajib diisi",
            'passwordBumil.min' => "Password minimal berjumlah 8 karakter",
            'passwordBumil.max' => "Password maksimal berjumlah 50 karakter",

        ]);

        $umur = Carbon::parse($request->tgl_lahir_bumil)->age;

        // Ubah format tanggal lahir //
        $tgl_lahir_indo = $request->tgl_lahir_bumil;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        if ($request->tanggungan_bumil == 'Dengan Tanggungan') {
            $this->validate($request,[
                'jkn_bumil' => "required|numeric|digits:16",
                'masa_berlaku_bumil' => "required|date",
            ],[
            'jkn_bumil.required' => "Nomor JKN wajib diisi",
            'jkn_bumil.numeric' => "Nomor JKN harus berupa angka",
            'jkn_bumil.digits' => "Nomor JKN harus berjumlan 16 angka",
            'masa_berlaku_bumil.required' => "Masa berlaku JKN wajib diisi",
            'masa_berlaku_bumil.date' => "Masa berlaku JKN harus berupa tanggal",
            ]);

            // Ubah format tanggal masa berlaku //
            $tgl_berlaku = $request->masa_berlaku_bumil;
            $masa_berlaku_bumil = explode("-", $tgl_berlaku);
            $tahun = $masa_berlaku_bumil[2];
            $bulan = $masa_berlaku_bumil[1];
            $tgl = $masa_berlaku_bumil[0];
            $masa_berlaku = $tahun.$bulan.$tgl;
        } else {
            $masa_berlaku = NULL;
        }
        
        if ($umur <= 15) {
            return redirect()->back()->with(['error' => 'Tidak dapat menambahkan akun']);
        } else {
            $selectIdKK = KK::where('no_kk',$request->no_kk_bumil)->first();
            if($selectIdKK != NULL){
                $user = User::create([
                    'id_chat_tele' => NULL,
                    'role' => '1',
                    'id_kk' => $selectIdKK->id,
                    'email' => $request->email_bumil,
                    'username_tele' => $request->telegram_bumil,
                    'agama' => $request->agama_bumil,
                    'golongan_darah' => $request->goldar_bumil,
                    'tanggungan' => $request->tanggungan_bumil,
                    'faskes_rujukan' => $request->faskes_bumil,
                    'no_jkn' => $request->jkn_bumil,
                    'masa_berlaku' => $masa_berlaku,
                    'password' => Hash::make($request->passwordBumil),
                    'profile_image' => "/images/upload/Profile/default.jpg",
                    'is_verified' => 1,
                ]);
    
                $ibu = Ibu::create([
                    'id_posyandu' => $request->lokasi_posyandu_bumil,
                    'id_user' => $user->id,
                    'nama_ibu_hamil' => $request->nama_bumil,
                    'nama_suami' => $request->nama_suami,
                    'tempat_lahir' => $request->tempat_lahir_bumil,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat_bumil,
                    'nomor_telepon' => $request->no_tlpn_bumil,
                    'NIK' => $request->nik_bumil,
                ]);
    
                if ($user && $ibu) {
                    return redirect()->back()->with(['success' => 'Akun ibu hamil berhasil ditambahkan']);
                } else {
                    return redirect()->back()->with(['failed' => 'Akun ibu hamil gagal ditambahkan']);
                }
            } else {
                $this->validate($request,[
                    'file_bumil'=> 'required|image|mimes:jpeg,png,jpg|max:5000',
                ],
                [
                    'file_bumil.required' => "Nomor KK belum terdaftar, silahkan unggah Scan KK ",
                    'file.image' => "File yang diunggah harus berupa gambar",
                    'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                    'file.size' => "Gambar maksimal berukuran 5 Mb",
                ]);
    
                $filename = Mover::slugFile($request->file('file_bumil'), 'app/files/kk/bumil/');
                $kk = KK::create([
                    'no_kk' => $request->no_kk_bumil,
                    'file_kk' => $filename,
                ]);

                $user = User::create([
                    'id_chat_tele' => NULL,
                    'role' => '1',
                    'id_kk' => $kk->id,
                    'email' => $request->email_bumil,
                    'agama' => $request->agama_bumil,
                    'golongan_darah' => $request->goldar_bumil,
                    'tanggungan' => $request->tanggungan_bumil,
                    'faskes_rujukan' => $request->faskes_bumil,
                    'no_jkn' => $request->jkn_bumil,
                    'masa_berlaku' => $masa_berlaku,
                    'password' => Hash::make($request->passwordBumil),
                    'profile_image' => "/images/upload/Profile/default.jpg",
                    'is_verified' => 1,
                ]);
    
                $ibu = Ibu::create([
                    'id_posyandu' => $request->lokasi_posyandu_bumil,
                    'id_user' => $user->id,
                    'nama_ibu_hamil' => $request->nama_bumil,
                    'nama_suami' => $request->nama_suami,
                    'tempat_lahir' => $request->tempat_lahir_bumil,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat_bumil,
                    'nomor_telepon' => $request->no_tlpn_bumil,
                    'username_telegram' => $request->telegram_bumil,
                    'NIK' => $request->nik_bumil,
                ]);
    
                if ($filename && $kk && $user && $ibu) {
                    return redirect()->back()->with(['success' => 'Akun ibu hamil berhasil ditambahkan']);
                } else {
                    return redirect()->back()->with(['failed' => 'Akun ibu hamil gagal ditambahkan']);
                }
            }
        }
    }

    public function detailBumil(Ibu $ibu)
    {
        $umur = Carbon::parse($ibu->tanggal_lahir)->age;
        $anggota = User::where('id', $ibu->id_user)->first();

        return view('admin.manajemen-akun.anggota.detail-bumil', compact('anggota', 'umur'));
    }

    public function updateBumil(Request $request, Ibu $ibu)
    {
        Carbon::setLocale('id');

        if ($ibu->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:51",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'alamat' => "required|min:5",
                'tanggungan' => "required",
                'goldar' => "nullable|min:1|max:2",
                'faskes_rujukan' => "required|min:3",
            ],
            [
                'nama.required' => "Nama ibu wajib diisi",
                'nama.regex' => "Format penulisan nama ibu tidak sesuai",
                'nama.min' => "Nama ibu minimal berjumlah 3 huruf",
                'nama.max' => "Nama ibu maksimal berjumlah 50 huruf",
                'nik.required' => "NIK ibu wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir ibu wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir ibu wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
                'alamat.required' => "Alamat tempat tinggal wajib diisi",
                'alamat.min' => "Penulisan alamat tempat tinggal miniminal berjumlah 5 karakter",
                'tanggungan.required' => "Status tanggungan wajib diisi",
                'goldar.min' => "Golongan darah terlalu singkat",
                'goldar.max' => "Golongan darah terlalu panjang",
                'faskes_rujukan.required' => "Faskes rujukan wajib diisi",
                'faskes_rujukan.min' => "Penulisan faskes rujukan miniminal berjumlah 3 karakter",
            ]);
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16|unique:tb_ibu_hamil,NIK",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'alamat' => "required|min:5",
                'tanggungan' => "required",
                'goldar' => "nullable|min:1|max:2",
                'faskes_rujukan' => "required|min:3",
            ],
            [
                'nama.required' => "Nama ibu wajib diisi",
                'nama.regex' => "Format penulisan nama ibu tidak sesuai",
                'nama.min' => "Nama ibu minimal berjumlah 3 huruf",
                'nama.max' => "Nama ibu maksimal berjumlah 50 huruf",
                'nik.required' => "NIK ibu wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir ibu wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir ibu wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
                'alamat.required' => "Alamat tempat tinggal wajib diisi",
                'alamat.min' => "Penulisan alamat tempat tinggal miniminal berjumlah 5 karakter",
                'tanggungan.required' => "Status tanggungan wajib diisi",
                'goldar.min' => "Golongan darah terlalu singkat",
                'goldar.max' => "Golongan darah terlalu panjang",
                'faskes_rujukan.required' => "Faskes rujukan wajib diisi",
                'faskes_rujukan.min' => "Penulisan faskes rujukan miniminal berjumlah 3 karakter",
            ]);
        }

        if ($request->tanggungan == 'Dengan Tanggungan') {
            $request->validate([
                'no_jkn' => "required",
                'masa_berlaku' => "required",
            ],
            [
                'no_jkn.required' => "Nomor JKN wajib diisi",
                'masa_berlaku.required' => "Masa berlaku JKN wajib diisi",
            ]);  

            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;
            
            // Ubah format tanggal //
            $masa_berlaku_indo = $request->masa_berlaku;
            $masa_berlaku_eng = explode("-", $masa_berlaku_indo);
            $tahun = $masa_berlaku_eng[2];
            $bulan = $masa_berlaku_eng[1];
            $tgl = $masa_berlaku_eng[0];
            $masa_berlaku = $tahun.$bulan.$tgl;
    
            $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
            $tgl_masa_berlaku = Carbon::parse($masa_berlaku)->toDateString();
            $umur = Carbon::parse($request->tgl_lahir)->age;
    
            if ($umur < 15) {
                return redirect()->back()->with(['error' => 'Perubahan akun ibu hamil tidak dapat dilakukan']);
            } else {            
                if ($tgl_masa_berlaku <= $today) {
                    return redirect()->back()->with(['error' => 'Penambahan JKN tidak dapat dilakukan']);
                } else {
                    $updateIbu = Ibu::where('id', $ibu->id)->update([
                        'nama_ibu_hamil' => $request->nama,
                        'NIK' => $request->nik,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $tgl_lahir,
                        'alamat' => $request->alamat,
                    ]);
                    
                    $updateUser = User::where('id', $ibu->id_user)->update([
                        'tanggungan' => $request->tanggungan,
                        'no_jkn' => $request->no_jkn,
                        'masa_berlaku' => $masa_berlaku,
                        'golongan_darah' => $request->goldar,
                        'faskes_rujukan' => $request->faskes_rujukan,
                    ]);
                    
                    if ($updateIbu && $updateUser) {
                        return redirect()->back()->with(['success' => 'Data profile ibu hamil berhasil diubah']);
                    } else {
                        return redirect()->back()->with(['failed' => 'Data profile ibu hamil gagal diubah']);
                    }
                }
            }
        } else {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;
    
            $umur = Carbon::parse($request->tgl_lahir)->age;
    
            if ($umur < 15) {
                return redirect()->back()->with(['error' => 'Perubahan akun ibu hamil tidak dapat dilakukan']);
            } else {
                $updateIbu = Ibu::where('id', $ibu->id)->update([
                    'nama_ibu_hamil' => $request->nama,
                    'NIK' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat,
                ]);
                
                $updateUser = User::where('id', $ibu->id_user)->update([
                    'tanggungan' => $request->tanggungan,
                    'no_jkn' => NULL,
                    'masa_berlaku' => NULL,
                    'golongan_darah' => $request->goldar,
                    'faskes_rujukan' => $request->faskes_rujukan,
                ]);
                
                if ($updateIbu && $updateUser) {
                    return redirect()->back()->with(['success' => 'Data profile ibu hamil berhasil diubah']);
                } else {
                    return redirect()->back()->with(['failed' => 'Data profile ibu hamil gagal diubah']);
                }
            }
        }
    }
}
