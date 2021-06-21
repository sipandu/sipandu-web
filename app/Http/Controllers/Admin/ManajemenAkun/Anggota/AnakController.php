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
use App\Anak;
use App\KK;

class AnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function simpanAnak(Request $request)
    {
        $this->validate($request,[
            'no_kk_anak' =>"required|numeric|digits:16",
            'nama_anak' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_ayah' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_ibu' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir_anak' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir_anak' => "required|date",
            'agama_anak' => "required",
            'tanggungan_anak' => "required",
            'faskes_anak' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3|max:50",
            'gender_anak' => "required",
            'nik_anak' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'alamat_anak' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'email_anak' => "required|email|unique:tb_user,email",
            'telegram_anak' => "nullable|unique:tb_user,username_tele",
            'no_tlpn_anak' => "nullable|numeric|unique:tb_anak,nomor_telepon|digits_between:11,15",
            'status_anak' => "required|numeric",
            'lokasi_posyandu_anak' => "required",
            'passwordAnak' => 'required|min:8|max:50',
        ],
        [
            'no_kk_anak.required' => "Nomor KK anak wajib diisi",
            'no_kk_anak.numeric' => "Nomor KK harus berupa angka",
            'no_kk_anak.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nama_anak.required' => "Nama anak wajib diisi",
            'nama_anak.regex' => "Format nama anak tidak sesuai",
            'nama_anak.min' => "Nama anak minimal berjumlah 2 karakter",
            'nama_anak.max' => "Nama anak maksimal berjumlah 50 karakter",
            'nama_ayah.required' => "Nama ayah wajib diisi",
            'nama_ayah.regex' => "Format nama ayah tidak sesuai",
            'nama_ayah.min' => "Nama ayah minimal berjumlah 2 karakter",
            'nama_ayah.max' => "Nama ayah maksimal berjumlah 50 karakter",
            'nama_ibu.required' => "Nama ibu wajib diisi",
            'nama_ibu.regex' => "Format nama ibu tidak sesuai",
            'nama_ibu.min' => "Nama ibu minimal berjumlah 2 karakter",
            'nama_ibu.max' => "Nama ibu maksimal berjumlah 50 karakter",
            'tempat_lahir_anak.required' => "Tempat lahir anak wajib diisi",
            'tempat_lahir_anak.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir_anak.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tempat_lahir_anak.max' => "Tempat lahir minimal berjumlah 50 karakter",
            'tgl_lahir_anak.required' => "Tanggal lahir anak wajib diisi",
            'tgl_lahir_anak.date' => "Tanggal lahir harus berupa tanggal",
            'agama_anak.required' => "Agama anak wajib diisi",
            'goldar_anak.required' => "Golongan darah anak wajib diisi",
            'tanggungan_anak.required' => "Tanggungan anak wajib diisi",
            'faskes_anak.required' => "Faskes rujukan wajib diisi",
            'faskes_anak.regex' => "Format faskes rujukan tidak sesuai",
            'faskes_anak.min' => "Nama faskes rujukan minimal berjumlah 2 karakter",
            'faskes_anak.max' => "Nama faskes rujukan maksimal berjumlah 50 karakter",
            'gender_anak.required' => "Jenis kelamin anak wajib diisi",
            'nik_anak.required' => "NIK anak wajib diisi",
            'nik_anak.unique' => "NIK anak sudah pernah digunakan",
            'nik_anak.numeric' => "NIK harus berupa angka",
            'nik_anak.digits' => "NIK harus berjumlah 16 karakter",
            'alamat_anak.required' => "Alamat anak wajib diisi",
            'alamat_anak.regex' => "Format penulisan alamat tidak sesuai",
            'email_anak.required' => "Email anak wajib diisi",
            'email_anak.email' => "Masukan format email yang sesuai",
            'email_anak.unique' => "Email anak sudah pernah digunakan",
            'telegram_anak.max' => "Username Telegram maksimal 25 karakter",
            'telegram_anak.unique' => "Username Telegram anak sudah pernah digunakan",
            'no_tlpn_anak.required' => "Nomor telepon anak wajib diisi",
            'no_tlpn_anak.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn_anak.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'no_tlpn_anak.unique' => "Nomor telepon anak sudah pernah digunakan",
            'lokasi_posyandu_anak.required' => "Lokasi posyandu anak wajib diisi",
            'status_anak.required' => "Status anak wajib diisi",
            'status_anak.numeric' => "Status anak berupa angka",
            'passwordAnak.required' => "Password akun anak wajib diisi",
            'passwordAnak.min' => "Password minimal 8 karakter",
            'passwordAnak.max' => "Password maksimal 50 karakter",

        ]);

        $umur = Carbon::parse($request->tgl_lahir_anak)->age;

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir_anak;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        if ($request->tanggungan_anak == 'Dengan Tanggungan') {
            $this->validate($request,[
                'jkn_anak' => "required|numeric|digits:16",
                'masa_berlaku_anak' => "required|date",
            ],[
                'jkn_anak.required' => "Nomor JKN wajib diisi",
                'jkn_anak.numeric' => "Nomor JKN harus berupa angka",
                'jkn_anak.digits' => "Nomor JKN harus berjumlan 16 angka",
                'masa_berlaku_anak.required' => "Masa berlaku JKN wajib diisi",
                'masa_berlaku_anak.date' => "Masa berlaku JKN harus berupa tanggal",
            ]);

            // Ubah format tanggal masa berlaku //
            $tgl_berlaku = $request->masa_berlaku_anak;
            $masa_berlaku_anak = explode("-", $tgl_berlaku);
            $tahun = $masa_berlaku_anak[2];
            $bulan = $masa_berlaku_anak[1];
            $tgl = $masa_berlaku_anak[0];
            $masa_berlaku = $tahun.$bulan.$tgl;
        } else {
            $masa_berlaku = NULL;
        }

        if ($umur >= 6) {
            return redirect()->back()->with(['error' => 'Tidak dapat menambahkan akun']);
        } else {
            $selectIdKK = KK::where('no_kk',$request->no_kk_anak)->first();

            if($selectIdKK != null){
                $user = User::create([
                    'id_chat_tele' => NULL,
                    'role' => '0',
                    'id_kk' => $selectIdKK->id,
                    'email' => $request->email_anak,
                    'username_tele' => $request->telegram_anak,
                    'agama' => $request->agama_anak,
                    'golongan_darah' => $request->goldar_anak,
                    'tanggungan' => $request->tanggungan_anak,
                    'faskes_rujukan' => $request->faskes_anak,
                    'no_jkn' => $request->jkn_anak,
                    'masa_berlaku' => $masa_berlaku,
                    'password' => Hash::make($request->passwordAnak),
                    'profile_image' => "/images/upload/Profile/default.jpg",
                    'is_verified' => 1,
                    'status' => 1,
                ]);

                $anak = Anak::create([
                    'id_posyandu' => $request->lokasi_posyandu_anak,
                    'id_user' => $user->id,
                    'nama_anak' => $request->nama_anak,
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu,
                    'tempat_lahir' => $request->tempat_lahir_anak,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat_anak,
                    'nomor_telepon' => $request->no_tlpn_anak,
                    'NIK' => $request->nik_anak,
                    'anak_ke' => $request->status_anak,
                    'jenis_kelamin' => $request->gender_anak,
                ]);

                if ($user && $anak) {
                    return redirect()->back()->with(['success' => 'Akun anak berhasil ditambahkan']);
                } else {
                    return redirect()->back()->with(['failed' => 'Akun anak gagal ditambahkan']);
                }
            } else {
                $this->validate($request,[
                    'file_anak'=> 'required|image|mimes:jpeg,png,jpg|max:5000',
                ],
                [
                    'file_anak.required' => "Nomor KK belum terdaftar,Wajib Upload Scan KK",
                    'file.image' => "File yang diunggah harus berupa gambar",
                    'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                    'file.size' => "Gambar maksimal berukuran 5 Mb",
                ]);

                $filename = Mover::slugFile($request->file('file_anak'), 'app/files/kk/anak/');

                $kk = KK::create([
                    'no_kk' => $request->no_kk_anak,
                    'file_kk' => $filename,
                ]);

                $user = User::create([
                    'id_kk' => $kk->id,
                    'role' => '0',
                    'id_chat_tele' => NULL,
                    'email' => $request->email_anak,
                    'agama' => $request->agama_anak,
                    'golongan_darah' => $request->goldar_anak,
                    'tanggungan' => $request->tanggungan_anak,
                    'faskes_rujukan' => $request->faskes_anak,
                    'no_jkn' => $request->jkn_anak,
                    'masa_berlaku' => $masa_berlaku,
                    'username_tele' => $request->telegram_anak,
                    'password' => Hash::make($request->password_anak),
                    'profile_image' => "/images/upload/Profile/default.jpg",
                    'is_verified' => 1,
                    'status' => 1,
                ]);

                $anak = Anak::create([
                    'id_posyandu' => $request->lokasi_posyandu_anak,
                    'id_user' => $user->id,
                    'nama_anak' => $request->nama_anak,
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu,
                    'tempat_lahir' => $request->tempat_lahir_anak,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat_anak,
                    'nomor_telepon' => $request->no_tlpn_anak,
                    'NIK' => $request->nik_anak,
                    'anak_ke' => $request->status_anak,
                    'jenis_kelamin' => $request->gender_anak,
                ]);

                if ($filename && $kk && $user && $anak) {
                    return redirect()->back()->with(['success' => 'Akun anak berhasil ditambahkan']);
                } else {
                    return redirect()->back()->with(['failed' => 'Akun anak gagal ditambahkan']);
                }
            }
        }
    }

    public function detailAnak(Anak $anak)
    {
        // $umur = Carbon::parse($anak->tanggal_lahir)->age;
        $umur = Carbon::parse($anak->tanggal_lahir)->diff(Carbon::now()->setTimezone('GMT+8'))->format('%y Tahun, %m Bulan');
        $anggota = User::where('id', $anak->id_user)->first();

        return view('admin.manajemen-akun.anggota.detail-anak', compact('anggota', 'umur'));
    }

    public function updateAnak(Request $request, Anak $anak)
    {
        if ($anak->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'alamat' => "required|min:5",
                'tanggungan' => "required",
                'goldar' => "nullable|min:1|max:2",
                'faskes_rujukan' => "required|min:3",
            ],
            [
                'nama.required' => "Nama anak wajib diisi",
                'nama.regex' => "Format penulisan nama anak tidak sesuai",
                'nama.min' => "Nama anak minimal berjumlah 3 huruf",
                'nama.max' => "Nama anak maksimal berjumlah 50 huruf",
                'nik.required' => "NIK anak wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir anak wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir anak wajib diisi",
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
                'nik' => "required|numeric|digits:16|unique:tb_anak,NIK",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'alamat' => "required|min:5",
                'tanggungan' => "required",
                'goldar' => "nullable|min:1|max:2",
                'faskes_rujukan' => "required|min:3",
            ],
            [
                'nama.required' => "Nama anak wajib diisi",
                'nama.regex' => "Format penulisan nama anak tidak sesuai",
                'nama.min' => "Nama anak minimal berjumlah 3 huruf",
                'nama.max' => "Nama anak maksimal berjumlah 50 huruf",
                'nik.required' => "NIK anak wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir anak wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir anak wajib diisi",
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
    
            if ($umur >= 6) {
                return redirect()->back()->with(['error' => 'Perubahan akun anak tidak dapat dilakukan']);
            } else {   
                if ($tgl_masa_berlaku <= $today) {
                    return redirect()->back()->with(['error' => 'Penambahan JKN tidak dapat dilakukan']);
                } else {
                    $updateAnak = Anak::where('id', $anak->id)->update([
                        'nama_anak' => $request->nama,
                        'NIK' => $request->nik,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $tgl_lahir,
                        'alamat' => $request->alamat,
                    ]);
    
                    $updateUser = User::where('id', $anak->id_user)->update([
                        'tanggungan' => $request->tanggungan,
                        'no_jkn' => $request->no_jkn,
                        'masa_berlaku' => $masa_berlaku,
                        'golongan_darah' => $request->goldar,
                        'faskes_rujukan' => $request->faskes_rujukan,
                    ]);
                    
                    if ($updateAnak && $updateUser) {
                        return redirect()->back()->with(['success' => 'Data profile anak berhasil diubah']);
                    } else {
                        return redirect()->back()->with(['failed' => 'Data profile anak gagal diubah']);
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
    
            if ($umur >= 6) {
                return redirect()->back()->with(['error' => 'Perubahan akun anak tidak dapat dilakukan']);
            } else {
                $updateAnak = Anak::where('id', $anak->id)->update([
                    'nama_anak' => $request->nama,
                    'NIK' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat,
                ]);

                $updateUser = User::where('id', $anak->id_user)->update([
                    'tanggungan' => $request->tanggungan,
                    'no_jkn' => NULL,
                    'masa_berlaku' => NULL,
                    'golongan_darah' => $request->goldar,
                    'faskes_rujukan' => $request->faskes_rujukan,
                ]);
                
                if ($updateAnak && $updateUser) {
                    return redirect()->back()->with(['success' => 'Data profile anak berhasil diubah']);
                } else {
                    return redirect()->back()->with(['failed' => 'Data profile anak gagal diubah']);
                }
            }
        }
    }

}
