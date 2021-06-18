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
use App\Lansia;
use App\KK;
use App\PjLansia;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;

class LansiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function simpanLansia(Request $request)
    {
        $this->validate($request,[
            'no_kk_lansia' =>"required|numeric|digits:16",
            'nama_lansia' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir_lansia' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir_lansia' => "required|date",
            'agama_lansia' => "required",
            'tanggungan_lansia' => "required",
            'faskes_lansia' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3|max:50",
            'gender_lansia' => "required",
            'nik_lansia' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'alamat_lansia' => "required|regex:/^[a-z0-9 ,.'-]+$/i",
            'email_lansia' => "required|email|unique:tb_user,email",
            'telegram_lansia' => "nullable|max:25|unique:tb_user,username_tele",
            'no_tlpn_lansia' => "nullable|numeric|unique:tb_lansia,nomor_telepon|digits_between:10,15",
            'status_lansia' => "required",
            'lokasi_posyandu_lansia' => "required",
            'passwordLansia' => 'required|min:8|max:50',
        ],
        [
            'no_kk_lansia.required' => "Nomor KK lansia wajib diisi",
            'no_kk_lansia.numeric' => "Nomor KK harus berupa angka",
            'no_kk_lansia.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nama_lansia.required' => "Nama lansia wajib diisi",
            'nama_lansia.regex' => "Format nama lansia tidak sesuai",
            'nama_lansia.min' => "Nama lansia minimal berjumlah 2 karakter",
            'nama_lansia.max' => "Nama lansia maksimal 50 karakter",
            'tempat_lahir_lansia.required' => "Tempat lahir lansia wajib diisi",
            'tempat_lahir_lansia.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir_lansia.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tempat_lahir_lansia.max' => "Tempat lahir minimal berjumlah 50 karakter",
            'tgl_lahir_lansia.required' => "Tanggal lahir lansia wajib diisi",
            'tgl_lahir_lansia.date' => "Tanggal lahir harus berformat tanggal",
            'agama_lansia.required' => "Agama lansia wajib diisi",
            'goldar_lansia.required' => "Golongan darah lansia wajib diisi",
            'tanggungan_lansia.required' => "Tanggungan lansia wajib diisi",
            'faskes_lansia.required' => "Faskes rujukan wajib diisi",
            'faskes_lansia.regex' => "Format faskes rujukan tidak sesuai",
            'faskes_lansia.min' => "Nama faskes rujukan minimal berjumlah 2 karakter",
            'faskes_lansia.max' => "Nama faskes rujukan maksimal berjumlah 50 karakter",
            'gender_lansia.required' => "Jenis kelamin lansia wajib diisi",
            'nik_lansia.required' => "NIK lansia wajib diisi",
            'nik_lansia.unique' => "NIK lansia sudah pernah digunakan",
            'nik_lansia.numeric' => "NIK harus berupa angka",
            'nik_lansia.digits' => "NIK harus berjumlah 16 karakter",
            'alamat_lansia.required' => "Alamat lansia wajib diisi",
            'alamat_lansia.regex' => "Format penulisan alamat tidak sesuai",
            'email_lansia.required' => "Email lansia wajib diisi",
            'email_lansia.email' => "Masukan format email yang sesuai",
            'email_lansia.unique' => "Email lansia sudah pernah digunakan",
            'telegram_lansia.max' => "Username Telegram maksimal 25 karakter",
            'telegram_lansia.unique' => "Username Telegram lansia sudah pernah digunakan",
            'no_tlpn_lansia.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn_lansia.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 angka",
            'no_tlpn_lansia.unique' => "Nomor telepon lansia sudah pernah digunakan",
            'lokasi_posyandu_lansia.required' => "Lokasi posyandu lansia wajib diisi",
            'status_lansia.required' => "Status lansia wajib diisi",
            'passwordLansia.required' => "Password akun lansia wajib diisi",
            'passwordLansia.min' => "Password minimal 8 karakter",
            'lokasi_posyandu_lansia.required' => "Lokasi posyandu lansia wajib diisi",
            'passwordLansia.max' => "Password maksimal 50 karakter",
        ]);

        $umur = Carbon::parse($request->tgl_lahir_lansia)->age;

        if ($request->tanggungan_lansia == 'Dengan Tanggungan') {
            $this->validate($request,[
                'jkn_lansia' => "required|numeric|digits:16",
                'masa_berlaku_lansia' => "required|date",
            ],[
                'jkn_lansia.required' => "Nomor JKN wajib diisi",
                'jkn_lansia.numeric' => "Nomor JKN harus berupa angka",
                'jkn_lansia.digits' => "Nomor JKN harus berjumlan 16 angka",
                'masa_berlaku_lansia.required' => "Masa berlaku JKN wajib diisi",
                'masa_berlaku_lansia.date' => "Masa berlaku JKN harus berupa tanggal",
            ]);

            // Ubah format tanggal masa berlaku //
            $tgl_berlaku = $request->masa_berlaku_lansia;
            $masa_berlaku_lansia = explode("-", $tgl_berlaku);
            $tahun = $masa_berlaku_lansia[2];
            $bulan = $masa_berlaku_lansia[1];
            $tgl = $masa_berlaku_lansia[0];
            $masa_berlaku = $tahun.$bulan.$tgl;
        } else {
            $masa_berlaku = NULL;
        }

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir_lansia;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        if ($umur <= 50) {
            return redirect()->back()->with(['error' => 'Tidak dapat menambahkan akun']);
        } else {
            $selectIdKK = KK::where('no_kk',$request->no_kk_lansia)->first();
            if($selectIdKK != NULL){
                $user = User::create([
                    'id_chat_tele' => NULL,
                    'role' => '2',
                    'id_kk' => $selectIdKK->id,
                    'email' => $request->email_lansia,
                    'agama' => $request->agama_bumil,
                    'golongan_darah' => $request->goldar_lansia,
                    'tanggungan' => $request->tanggungan_lansia,
                    'faskes_rujukan' => $request->faskes_lansia,
                    'no_jkn' => $request->jkn_lansia,
                    'masa_berlaku' => $masa_berlaku,
                    'password' => Hash::make($request->passwordLansia),
                    'profile_image' => "/images/upload/Profile/default.jpg",
                    'is_verified' => 1,
                    'status' => 1,
                ]);

                $lansia = Lansia::create([
                    'id_posyandu' => $request->lokasi_posyandu_lansia,
                    'id_user' => $user->id,
                    'nama_lansia' => $request->nama_lansia,
                    'tempat_lahir' => $request->tempat_lahir_lansia,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat_lansia,
                    'nomor_telepon' => $request->no_tlpn_lansia,
                    'username_telegram' => $request->telegram_lansia,
                    'NIK' => $request->nik_lansia,
                    'status' => $request->status_lansia,
                    'jenis_kelamin' => $request->gender_lansia,
                ]);

                if ($user && $lansia) {
                    return redirect()->back()->with(['success' => 'Akun lansia berhasil ditambahkan']);
                } else {
                    return redirect()->back()->with(['failed' => 'Akun lansia gagal ditambahkan']);
                }
            } else {
                $this->validate($request,[
                    'file_lansia'=> 'required|image|mimes:jpeg,png,jpg|max:5000',
                ],
                [
                    'file_lansia.required' => "Nomor KK belum terdaftar, silahkan unggah Scan KK",
                    'file.image' => "File yang diunggah harus berupa gambar",
                    'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                    'file.size' => "Gambar maksimal berukuran 5 Mb",
                ]);

                $filename = Mover::slugFile($request->file('file_lansia'), 'app/files/kk/lansia/');

                $kk = KK::create([
                    'no_kk' => $request->no_kk_lansia,
                    'file_kk' => $filename,
                ]);

                $user = User::create([
                    'id_chat_tele' => NULL,
                    'role' => '2',
                    'id_kk' => $kk->id,
                    'email' => $request->email_lansia,
                    'agama' => $request->agama_bumil,
                    'golongan_darah' => $request->goldar_lansia,
                    'tanggungan' => $request->tanggungan_lansia,
                    'faskes_rujukan' => $request->faskes_lansia,
                    'no_jkn' => $request->jkn_lansia,
                    'masa_berlaku' => $masa_berlaku,
                    'password' => Hash::make($request->passwordLansia),
                    'profile_image' => "/images/upload/Profile/default.jpg",
                    'is_verified' => 1,
                    'status' => 1,
                ]);

                $lansia = Lansia::create([
                    'id_posyandu' => $request->lokasi_posyandu_lansia,
                    'id_user' => $user->id,
                    'nama_lansia' => $request->nama_lansia,
                    'tempat_lahir' => $request->tempat_lahir_lansia,
                    'tanggal_lahir' => $tgl_lahir,
                    'alamat' => $request->alamat_lansia,
                    'nomor_telepon' => $request->no_tlpn_lansia,
                    'username_telegram' => $request->telegram_lansia,
                    'NIK' => $request->nik_lansia,
                    'status' => $request->status_lansia,
                    'jenis_kelamin' => $request->gender_lansia,
                ]);

                if ($filename && $kk && $user && $lansia) {
                    return redirect()->back()->with(['success' => 'Akun lansia berhasil ditambahkan']);
                } else {
                    return redirect()->back()->with(['failed' => 'Akun lansia gagal ditambahkan']);
                }
            }
        }
    }

    public function detailLansia(Lansia $lansia)
    {
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $anggota = User::where('id', $lansia->id_user)->first();

        $pj = PjLansia::where('id_lansia', $lansia->id)->get()->first();

        return view('admin.manajemen-akun.anggota.detail-lansia', compact('anggota', 'umur', 'pj'));
    }

    public function updateLansia(Request $request, Lansia $lansia)
    {
        if ($lansia->NIK == $request->nik) {
            $request->validate([
                'nama_lansia' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'pendidikan_terakhir' => "required",
                'pekerjaan' => "required",
                'status_perkawinan' => "required",
                'sumber_biaya_hidup' => "required",
                'jumlah_keluarga_serumah' => "required|numeric|digits_between:1,3",
                'jumlah_anak' => "required|numeric|digits_between:1,3",
                'jumlah_cucu' => "required|numeric|digits_between:1,3",
                'jumlah_cicit' => "required|numeric|digits_between:1,3",
                'tanggungan' => "required",
                'goldar' => "nullable|min:1|max:2",
                'faskes_rujukan' => "required|min:3",
            ],
            [
                'nama_lansia.required' => "Nama lansia wajib diisi",
                'nama_lansia.regex' => "Format penulisan nama lansia tidak sesuai",
                'nama_lansia.min' => "Nama lansia minimal berjumlah 3 huruf",
                'nama_lansia.max' => "Nama lansia maksimal berjumlah 50 huruf",
                'nik.required' => "NIK lansia wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir lansia wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir lansia wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
                'pendidikan_terakhir.required' => "Pendidikan terakhir wajib diisi",
                'pekerjaan.required' => "Pekerjaan wajib diisi",
                'status_perkawinan.required' => "Status perkawinan wajib diisi",
                'sumber_biaya_hidup.required' => "Sumber biaya hidup wajib diisi",
                'jumlah_keluarga_serumah.required' => "Jumlah keluarga serumah wajib diisi",
                'jumlah_keluarga_serumah.min' => "Jumlah keluarga serumah kurang dari nilai minimum",
                'jumlah_keluarga_serumah.max' => "Jumlah keluarga serumah melebihi dari nilai maksimum",
                'jumlah_anak.required' => "Jumlah anak wajib diisi",
                'jumlah_anak.min' => "Jumlah anak kurang dari nilai minimum",
                'jumlah_anak.max' => "Jumlah anak melebihi dari nilai maksimum",
                'jumlah_cucu.required' => "Jumlah cucu kandung wajib diisi",
                'jumlah_cucu.min' => "Jumlah cucu kandung kurang dari nilai minimum",
                'jumlah_cucu.max' => "Jumlah cucu kandung melebihi dari nilai maksimum",
                'jumlah_cicit.required' => "Jumlah cicit kandung wajib diisi",
                'jumlah_cicit.min' => "Jumlah cicit kandung kurang dari nilai minimum",
                'jumlah_cicit.max' => "Jumlah cicit kandung melebihi dari nilai maksimum",
                'tanggungan.required' => "Status tanggungan wajib diisi",
                'goldar.min' => "Golongan darah terlalu singkat",
                'goldar.max' => "Golongan darah terlalu panjang",
                'faskes_rujukan.required' => "Faskes rujukan wajib diisi",
                'faskes_rujukan.min' => "Penulisan faskes rujukan miniminal berjumlah 3 karakter",
            ]);  
        } else {
            $request->validate([
                'nama_lansia' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16|unique:tb_lansia,NIK",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'tanggungan' => "required",
                'faskes_rujukan' => "required",
                'pendidikan_terakhir' => "required|exists:tb_lansia,pendidikan_terakhir",
                'pekerjaan' => "required|exists:tb_lansia,pekerjaan",
                'status_perkawinan' => "required|exists:tb_lansia,status_perkawinan",
                'sumber_biaya_hidup' => "required|exists:tb_lansia,sumber_biaya_hidup",
                'jumlah_keluarga_serumah' => "required",
                'jumlah_anak' => "required",
                'jumlah_cucu' => "required",
                'jumlah_cicit' => "required",
                'tanggungan' => "required|exists:tb_user,tanggungan",
                'goldar.min' => "Golongan darah terlalu singkat",
                'goldar.max' => "Golongan darah terlalu panjang",
                'goldar' => "nullable|min:1|max:2",
                'faskes_rujukan' => "required|min:3",
            ],
            [
                'nama_lansia.required' => "Nama ibu wajib diisi",
                'nama_lansia.regex' => "Format penulisan nama ibu tidak sesuai",
                'nama_lansia.min' => "Nama ibu minimal berjumlah 3 huruf",
                'nama_lansia.max' => "Nama ibu maksimal berjumlah 50 huruf",
                'nik.required' => "NIK ibu wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir ibu wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir ibu wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
                'pendidikan_terakhir.required' => "Pendidikan terakhir wajib diisi",
                'pendidikan_terakhir.exists' => "Pendidikan terakhir tidak tersedia",
                'pekerjaan.required' => "Pekerjaan wajib diisi",
                'pekerjaan.exists' => "Pekerjaan tidak tersedia",
                'status_perkawinan.required' => "Status perkawinan wajib diisi",
                'status_perkawinan.exists' => "Status perkawinan tidak tersedia",
                'sumber_biaya_hidup.required' => "Sumber biaya hidup wajib diisi",
                'sumber_biaya_hidup.exists' => "Sumber biaya hidup tidak tersedia",
                'jumlah_keluarga_serumah.required' => "Jumlah keluarga serumah wajib diisi",
                'jumlah_keluarga_serumah.min' => "Jumlah keluarga serumah kurang dari nilai minimum",
                'jumlah_keluarga_serumah.max' => "Jumlah keluarga serumah melebihi dari nilai maksimum",
                'jumlah_anak.required' => "Jumlah anak wajib diisi",
                'jumlah_anak.min' => "Jumlah anak kurang dari nilai minimum",
                'jumlah_anak.max' => "Jumlah anak melebihi dari nilai maksimum",
                'jumlah_cucu.required' => "Jumlah cucu kandung wajib diisi",
                'jumlah_cucu.min' => "Jumlah cucu kandung kurang dari nilai minimum",
                'jumlah_cucu.max' => "Jumlah cucu kandung melebihi dari nilai maksimum",
                'jumlah_cicit.required' => "Jumlah cicit kandung wajib diisi",
                'jumlah_cicit.min' => "Jumlah cicit kandung kurang dari nilai minimum",
                'jumlah_cicit.max' => "Jumlah cicit kandung melebihi dari nilai maksimum",
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
    
            if ($umur <= 50) {
                return redirect()->back()->with(['error' => 'Perubahan akun lansia tidak dapat dilakukan']);
            } else {
                // Ubah format tanggal //
                $tgl_lahir_indo = $request->tgl_lahir;
                $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
                $tahun = $tgl_lahir_eng[2];
                $bulan = $tgl_lahir_eng[1];
                $tgl = $tgl_lahir_eng[0];
                $tgl_lahir = $tahun.$bulan.$tgl;
                
                $updateLansia = Lansia::where('id', $lansia->id)->update([
                    'nama_lansia' => $request->nama_lansia,
                    'NIK' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tgl_lahir,
                    'pendidikan_terakhir' => $request->pendidikan_terakhir,
                    'pekerjaan' => $request->pekerjaan,
                    'status_perkawinan' => $request->status_perkawinan,
                    'sumber_biaya_hidup' => $request->sumber_biaya_hidup,
                    'jumlah_keluarga_serumah' => $request->jumlah_keluarga_serumah,
                    'jumlah_anak' => $request->jumlah_anak,
                    'jumlah_cucu' => $request->jumlah_cucu,
                    'jumlah_cicit' => $request->jumlah_cicit,
                ]);

                $updateUser = User::where('id', $lansia->id_user)->update([
                    'tanggungan' => $request->tanggungan,
                    'golongan_darah' => $request->goldar,
                    'no_jkn' => $request->no_jkn,
                    'masa_berlaku' => $masa_berlaku,
                    'faskes_rujukan' => $request->faskes_rujukan,
                ]);
                
                if ($updateLansia && $updateUser) {
                    return redirect()->back()->with(['success' => 'Data profile lansia berhasil diubah']);
                } else {
                    return redirect()->back()->with(['failed' => 'Data profile lansia gagal diubah']);
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
    
            if ($umur <= 50) {
                return redirect()->back()->with(['error' => 'Perubahan akun lansia tidak dapat dilakukan']);
            } else {
                // Ubah format tanggal //
                $tgl_lahir_indo = $request->tgl_lahir;
                $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
                $tahun = $tgl_lahir_eng[2];
                $bulan = $tgl_lahir_eng[1];
                $tgl = $tgl_lahir_eng[0];
                $tgl_lahir = $tahun.$bulan.$tgl;
                
                $updateLansia = Lansia::where('id', $lansia->id)->update([
                    'nama_lansia' => $request->nama_lansia,
                    'NIK' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tgl_lahir,
                    'pendidikan_terakhir' => $request->pendidikan_terakhir,
                    'pekerjaan' => $request->pekerjaan,
                    'status_perkawinan' => $request->status_perkawinan,
                    'sumber_biaya_hidup' => $request->sumber_biaya_hidup,
                    'jumlah_keluarga_serumah' => $request->jumlah_keluarga_serumah,
                    'jumlah_anak' => $request->jumlah_anak,
                    'jumlah_cucu' => $request->jumlah_cucu,
                    'jumlah_cicit' => $request->jumlah_cicit,
                ]);

                $updateUser = User::where('id', $lansia->id_user)->update([
                    'tanggungan' => $request->tanggungan,
                    'no_jkn' => NULL,
                    'masa_berlaku' => NULL,
                    'golongan_darah' => $request->goldar,
                    'faskes_rujukan' => $request->faskes_rujukan,
                ]);
                
                if ($updateLansia && $updateUser) {
                    return redirect()->back()->with(['success' => 'Data profile lansia berhasil diubah']);
                } else {
                    return redirect()->back()->with(['failed' => 'Data profile lansia gagal diubah']);
                }
            }
        }
    }

    public function tambahPjLansia(Lansia $lansia, Request $request)
    {
        $this->validate($request,[
            'nama' => "required|min:3|max:50",
            'desa' => "required",
            'status' => "required",
            'no_telp' => "required|numeric|digits_between:12,15",
            'alamat' => "required|min:5",
        ],
        [
            'nama.required' => "Nama penanggung jawab lansia wajib diisi",
            'nama.min' => "Nama penanggung jawab lansia minimal berjumlah 3 huruf",
            'nama.max' => "Nama penanggung jawab lansia maksimal berjumlah 50 huruf",
            'desa.required' => "Kolom Desa wajib diisi",
            'status.required' => "Kolom Hubungan keluarga wajib diisi",
            'no_telp.required' => "Nomor telepon penanggung jawab lansia wajib diisi",
            'no_telp.numeric' => "Nomor telepon penanggung jawab lansia harus berupa angka",
            'no_telp.digits_between' => "Nomor telepon harus berjumlah antara 12 hingga 15 karakter",
            'alamat.required' => "Alamat penanggung jawab lansia wajib diisi",
            'alamat.min' => "Alamat penanggung jawab lansia terlalu singkat",
        ]);

        $pj = PjLansia::create([
            'id_lansia' => $lansia->id,
            'id_desa' => $request->desa,
            'nama' => $request->nama,
            'hubungan_keluarga' => $request->status,
            'nomor_telepon' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        if ($pj) {
            return redirect()->back()->with(['success' => 'Data Penanggung Jawab Lansia Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Penanggung Jawab Lansia Gagal di Simpan']);
        }
    }

    public function updatePjLansia(PjLansia $pjLansia, Request $request)
    {
        $this->validate($request,[
            'nama' => "required|min:3|max:50",
            'desa' => "required",
            'status' => "required",
            'no_telp' => "required|numeric|digits_between:12,15",
            'alamat' => "required|min:5",
        ],
        [
            'nama.required' => "Nama penanggung jawab lansia wajib diisi",
            'nama.min' => "Nama penanggung jawab lansia minimal berjumlah 3 huruf",
            'nama.max' => "Nama penanggung jawab lansia maksimal berjumlah 50 huruf",
            'desa.required' => "Kolom Desa wajib diisi",
            'status.required' => "Kolom Hubungan keluarga wajib diisi",
            'no_telp.required' => "Nomor telepon penanggung jawab lansia wajib diisi",
            'no_telp.numeric' => "Nomor telepon penanggung jawab lansia harus berupa angka",
            'no_telp.digits_between' => "Nomor telepon harus berjumlah antara 12 hingga 15 karakter",
            'alamat.required' => "Alamat penanggung jawab lansia wajib diisi",
            'alamat.min' => "Alamat penanggung jawab lansia terlalu singkat",
        ]);

        $pj = PjLansia::where('id', $pjLansia->id)->update([
            'id_lansia' => $pjLansia->id_lansia,
            'id_desa' => $request->desa,
            'nama' => $request->nama,
            'hubungan_keluarga' => $request->status,
            'nomor_telepon' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        if ($pj) {
            return redirect()->back()->with(['success' => 'Data Penanggung Jawab Lansia Berhasil di Diperbaharui']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Penanggung Jawab Lansia Gagal di Diperbaharui']);
        }
    }
}
