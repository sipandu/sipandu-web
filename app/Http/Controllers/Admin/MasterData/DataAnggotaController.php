<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Mover;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\User;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;
use App\Ibu;
use App\Anak;
use App\Lansia;
use App\KK;
use App\PjLansia;

class DataAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function listAnggota()
    {
        $anak = Anak::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
        $ibu = Ibu::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
        $lansia = Lansia::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();

        return view('pages/admin/master-data/data-anggota/data-anggota', compact('anak', 'ibu', 'lansia'));
    }

    public function getImage($id)
    {
        $user = User::where('id', $id)->get()->first();

        if( File::exists(storage_path($user->profile_image)) ) {
            return response()->file(
                storage_path($user->profile_image)
            );
        } else {
            return response()->file(
                public_path('images/sipandu-logo.png')
            );
        }

        return redirect()->back();
    }

    public function getImageKK($id)
    {
        $kk = KK::where('id', $id)->get()->first();

        if( File::exists(storage_path($kk->file_kk)) ) {
            return response()->file(
                storage_path($kk->file_kk)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }

        return redirect()->back();
    }

    public function detailAnggotaIbu(Ibu $ibu)
    {
        $dataIbu = Ibu::where('id', $ibu->id)->first();
        $umur = Carbon::parse($dataIbu->tanggal_lahir)->age;
        $dataUser = User::where('id', $dataIbu->id_user)->first();

        return view('pages/admin/master-data/data-anggota/detail-anggota-ibu', compact('dataUser', 'umur'));
    }

    public function detailAnggotaAnak(Anak $anak)
    {
        $dataAnak = Anak::where('id', $anak->id)->first();
        $umur = Carbon::parse($dataAnak->tanggal_lahir)->age;
        $dataUser = User::where('id', $dataAnak->id_user)->first();

        return view('pages/admin/master-data/data-anggota/detail-anggota-anak', compact('dataUser', 'umur'));
    }

    public function detailAnggotaLansia(Lansia $lansia)
    {
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $dataUser = User::where('id', $lansia->id_user)->first();
        $kabupaten = Kabupaten::get();

        $pj = PjLansia::where('id_lansia', $lansia->id)->get()->first();

        if ($pj != NULL) {
            $dataDesa = Desa::where('id', $pj->id_desa)->first();
            $dataKecamatan = Kecamatan::where('id', $dataDesa->id_kecamatan)->first();
            $dataKabupaten = Kabupaten::where('id', $dataKecamatan->id_kabupaten)->first();
    
            return view('pages/admin/master-data/data-anggota/detail-anggota-lansia', compact('dataUser', 'umur', 'kabupaten', 'pj', 'dataKecamatan', 'dataKabupaten'));
        } else {
            return view('pages/admin/master-data/data-anggota/detail-anggota-lansia', compact('dataUser', 'umur', 'kabupaten', 'pj'));
        }
    }

    public function updateAnggotaIbu(Request $request, Ibu $ibu)
    {
        Carbon::setLocale('id');

        if ($ibu->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'alamat' => "required|min:5",
                'tanggungan' => "required",
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

    public function updateAnggotaAnak(Request $request, Anak $anak)
    {
        if ($anak->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'alamat' => "required|min:5",
                'tanggungan' => "required",
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

    public function updateAnggotaLansia(Request $request, Lansia $lansia)
    {
        if ($lansia->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
                'pendidikan_terakhir' => "required",
                'pekerjaan' => "required",
                'status_perkawinan' => "required",
                'sumber_biaya_hidup' => "required",
                'jumlah_keluarga_serumah' => "required|numeric|min:1",
                'jumlah_anak' => "required|numeric|min:1|max:3",
                'jumlah_cucu' => "required|numeric|min:1|max:3",
                'jumlah_cicit' => "required|numeric|min:1|max:3",
                'tanggungan' => "required",
                'faskes_rujukan' => "required|max:3",
            ],
            [
                'nama.required' => "Nama lansia wajib diisi",
                'nama.regex' => "Format penulisan nama lansia tidak sesuai",
                'nama.min' => "Nama lansia minimal berjumlah 3 huruf",
                'nama.max' => "Nama lansia maksimal berjumlah 50 huruf",
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
                'faskes_rujukan.required' => "Faskes rujukan wajib diisi",
                'faskes_rujukan.min' => "Penulisan faskes rujukan miniminal berjumlah 3 karakter",
            ]);  
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
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
                'faskes_rujukan' => "required|max:3",
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
                    'nama_lansia' => $request->nama,
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
                    'nama_lansia' => $request->nama,
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
