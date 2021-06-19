<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga\Pemeriksaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Mover;
use Carbon\Carbon;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Imunisasi;
use App\KK;
use App\Vitamin;
use App\Posyandu;
use App\Nakes;
use App\NakesPosyandu;
use App\PemeriksaanIbu;
use App\PemeriksaanAnak;
use App\PemeriksaanLansia;
use App\PemberianImunisasi;
use App\PemberianVitamin;
use App\Alergi;
use App\Persalinan;
use App\PenyakitBawaan;
use App\RiwayatPenyakit;
use App\PjLansia;

class PemeriksaanBumilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function pemeriksaanBumil(Ibu $ibu)
    {
        $umur = Carbon::parse($ibu->tanggal_lahir)->age;
        
        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->first();
        if ($pemeriksaanIbu != NULL) {
            $usia_kandungan = $pemeriksaanIbu->usia_kandungan;
        } else {
            $usia_kandungan = '0';
        }
        
        $dataIbu = $ibu;
        $jenisImunisasi = Imunisasi::where('penerima', 'Ibu Hamil')->where('deleted_at', NULL)->get();
        $jenisVitamin = Vitamin::where('penerima', 'Ibu Hamil')->where('deleted_at', NULL)->get();
        $imunisasi = PemberianImunisasi::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $ibu->id_user)->get();
        $persalinan = Persalinan::where('id_ibu_hamil', $ibu->id)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $ibu->id_user)->get();
        $pemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->limit(5)->get();

        $anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_anak.nama_anak', 'asc')
        ->get();

        return view('admin.kesehatan-keluarga.pemeriksaan.pemeriksaan-bumil', compact('dataIbu', 'umur', 'usia_kandungan', 'pemeriksaan', 'imunisasi', 'vitamin', 'alergi', 'penyakitBawaan', 'jenisImunisasi', 'jenisVitamin', 'anak', 'persalinan'));
    }

    public function simpanDataPersalinan(Ibu $ibu, Request $request)
    {
        $this->validate($request,[
            'nama_anak' => "required|min:2|max:50",
            'berat_lahir' => "required|numeric|min:2",
            'tanggal_persalinan' => "required|date",
            'persalinan' => 'required',
            'penolong_persalinan' => 'required',
        ],
        [
            'nama_anak.required' => "Nama anak wajib diisi",
            'nama_anak.min' => "Nama anak minimal berjumlah 2 huruf",
            'nama_anak.max' => "Nama anak maksimal berjumlah 50 huruf",
            'berat_lahir.required' => "Berat lahir anak wajib diisi",
            'berat_lahir.numeric' => "Berat lahir anak harus berupa angka",
            'berat_lahir.min' => "Berat lahir anak kurang dari nilai minimum",
            'tanggal_persalinan.required' => "Tanggal persalinan wajib diisi",
            'tanggal_persalinan.required' => "Tanggal persalinan harus berformat tanggal",
            'persalinan.required' => "Jenis persalinan wajib diisi",
            'penolong_persalinan.required' => "Penolong persalinan wajib diisi",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8');

        // Exploded Nama Anak
        $namaAnak = $request->nama_anak;
        $nama_anak = explode(",", $namaAnak);

        if (count($nama_anak) > 1) {
            $nama = $nama_anak[0];
            $nik = $nama_anak[1];

            $dataAnak = Anak::where('NIK', $nik)->get()->first();

            $persalinan = Persalinan::create([
                'id_anak' => $dataAnak->id,
                'id_ibu_hamil' => $ibu->id,
                'nama_anak' => $dataAnak->nama_anak,
                'nama_ibu' => $ibu->nama_ibu_hamil,
                'berat_lahir' => $request->berat_lahir,
                'tanggal_lahir' => $dataAnak->tanggal_lahir,
                'persalinan' => $request->persalinan,
                'penolong_persalinan' => $request->penolong_persalinan,
                'komplikasi' => $request->komplikasi,
            ]);

            $persalinanTerakhir = Persalinan::where('id_ibu_hamil', $ibu->id)->get();
            $jarakKehamilan = Carbon::parse($persalinan->tanggal_lahir)->diff($today)->format('%y');

            if (count($persalinanTerakhir) > 0) {
                $jumlahKehamilan = count($persalinanTerakhir) + 1;
            } else {
                $jumlahKehamilan = 1;
            }

            if ($jarakKehamilan > 0) {
                $bumil = Ibu::where('id', $ibu->id)->update([
                    'kehamilan_ke' => $jumlahKehamilan,
                    'jarak_anak_sebelumnya' => $jarakKehamilan,
                ]);
            } else {
                $bumil = Ibu::where('id', $ibu->id)->update([
                    'kehamilan_ke' => $jumlahKehamilan,
                ]);
            }
            
            if ($persalinan && $bumil) {
                return redirect()->back()->with(['success' => 'Data Persalinan Berhasil di Simpan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Persalinan Gagal di Simpan']);
            }
        } else {
            $nama = $nama_anak[0];

            // Ubah format tanggal //
            $tgl_kotor = $request->tanggal_persalinan;
            $tgl_bersih = explode("-", $tgl_kotor);
            $tahun = $tgl_bersih[2];
            $bulan = $tgl_bersih[1];
            $tgl = $tgl_bersih[0];
            $tgl_persalinan = $tahun.$bulan.$tgl;

            $persalinan = Persalinan::create([
                'id_ibu_hamil' => $ibu->id,
                'nama_ibu' => $ibu->nama_ibu_hamil,
                'nama_anak' => $nama,
                'berat_lahir' => $request->berat_lahir,
                'tanggal_lahir' => $tgl_persalinan,
                'persalinan' => $request->persalinan,
                'penolong_persalinan' => $request->penolong_persalinan,
                'komplikasi' => $request->komplikasi,
            ]);
    
            $persalinanTerakhir = Persalinan::where('id_ibu_hamil', $ibu->id)->orderBy('tanggal_lahir', 'desc')->get();
            $jarakKehamilan = Carbon::parse($persalinan->tanggal_lahir)->diff($today)->format('%y');

            if (count($persalinanTerakhir) > 0) {
                $jumlahKehamilan = count($persalinanTerakhir) + 1;
            } else {
                $jumlahKehamilan = 1;
            }

            if ($jarakKehamilan > 0) {
                $bumil = Ibu::where('id', $ibu->id)->update([
                    'kehamilan_ke' => $jarakKehamilan,
                    'jarak_anak_sebelumnya' => $jarakKehamilan,
                ]);
            } else {
                $bumil = Ibu::where('id', $ibu->id)->update([
                    'kehamilan_ke' => $jarakKehamilan,
                ]);
            }
            
            if ($persalinan && $jarakKehamilan) {
                return redirect()->back()->with(['success' => 'Data Persalinan Berhasil di Simpan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Persalinan Gagal di Simpan']);
            }
        }
    }

    public function simpanDataPemeriksaanBumil(Ibu $ibu, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'lingkar_lengan' => "required|numeric|min:2",
            'berat_badan' => "required|numeric|min:2",
            'usia_kandungan' => 'required|numeric|digits_between:1,40',
            'tekanan_darah' => 'required',
            'denyut_nadi' => 'required|numeric|min:1',
            'detak_jantung_bayi' => 'required|numeric|min:1',
            'tinggi_rahim' => 'required|numeric|min:1',
            'diagnosa' => 'required|min:5',
            'pengobatan' => 'nullable',
            'keterangan' => 'nullable',
            'lokasiPemeriksaan' => 'required|min:5',
            'tgl_kembali' => 'required|date',
        ],
        [
            'lingkar_lengan.required' => "Lingkar lengan ibu hamil wajib diisi",
            'lingkar_lengan.numeric' => "Lingkar lengan harus berupa angka",
            'lingkar_lengan.min' => "Lingkar lengan kurang dari nilai minimum",
            'berat_badan.required' => "Berat badan ibu hamil wajib diisi",
            'berat_badan.numeric' => "Berat badan harus berupa angka",
            'berat_badan.min' => "Berat badan ibu hamil kurang dari nilai minimum",
            'usia_kandungan.required' => "Usia kandungan ibu hamil wajib diisi",
            'usia_kandungan.numeric' => "Usia kandungan harus berupa angka",
            'usia_kandungan.digits_between' => "Rentan usia kandungan tidak sesuai",
            'tekanan_darah.required' => "Tekanan darah ibu hamil wajib diisi",
            'denyut_nadi.required' => "Denyut nadi ibu hamil wajib diisi",
            'denyut_nadi.numeric' => "Denyut nadi ibu hamil harus berupa angka",
            'denyut_nadi.min' => "Denyut nadi ibu hamil kurang dari nilai minimum",
            'detak_jantung_bayi.required' => "Detak jantung janin wajib diisi",
            'detak_jantung_bayi.numeric' => "Detak jantung janin harus berupa angka",
            'detak_jantung_bayi.numeric' => "Detak jantung janin kurang dari nilai minimum",
            'tinggi_rahim.required' => "Tinggi rahim wajib diisi",
            'tinggi_rahim.numeric' => "Tinggi rahin harus berupa angka",
            'tinggi_rahim.min' => "Tinggi rahin kurang dari nilai minimum",
            'diagnosa.required' => "Diagnosa pemeriksaan ibu hamil wajib diisi",
            'diagnosa.min' => "Diagnosa pemeriksaan ibu hamil terlalu singkat",
            'lokasiPemeriksaan.required' => "Tempat pemeriksaan ibu hamil wajib diisi",
            'lokasiPemeriksaan.min' => "Nana tempat pemeriksaan ibu hamil terlalu singkat",
            'tgl_kembali.required' => "Tanggal pemeriksaan kembali wajib diisi",
            'tgl_kembali.required' => "Tanggal pemeriksaan kembali harus berformat tanggal",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $nakes = Auth::guard('admin')->user()->nakes;

        // Ubah format tanggal //
        $tgl_kotor = $request->tgl_kembali;
        $tgl_bersih = explode("-", $tgl_kotor);
        $tahun = $tgl_bersih[2];
        $bulan = $tgl_bersih[1];
        $tgl = $tgl_bersih[0];
        $tgl_kembali = $tahun.$bulan.$tgl;

        $tanggal_kembali = Carbon::parse($tgl_kembali)->toDateString();

        $berat_badan = $request->berat_badan;

        if ($tanggal_kembali <= $today) {
            return redirect()->back()->with(['error' => 'Tanggal periksa kembali untuk ibu hamil tidak sesuai']);
        } else {
            $pemeriksaanIbu = PemeriksaanIbu::create([
                'id_posyandu' => $ibu->id_posyandu,
                'id_nakes' => $nakes->id,
                'id_ibu_hamil' => $ibu->id,
                'nama_posyandu' => $ibu->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'nama_ibu_hamil' => $ibu->nama_ibu_hamil,
                'lingkar_lengan' => $request->lingkar_lengan,
                'berat_badan' => $berat_badan,
                'usia_kandungan' => $request->usia_kandungan,
                'tekanan_darah' => $request->tekanan_darah,
                'denyut_nadi_ibu' => $request->denyut_nadi,
                'detak_jantung_bayi' => $request->detak_jantung_bayi,
                'tinggi_rahim' => $request->tinggi_rahim,
                'diagnosa' => $request->diagnosa,
                'pengobatan' => $request->pengobatan,
                'keterangan' => $request->keterangan,
                'jenis_pemeriksaan' => 'Pemeriksaan',
                'tempat_pemeriksaan' => $request->lokasiPemeriksaan,
                'tanggal_pemeriksaan' => $today,
                'tanggal_kembali' => $tgl_kembali,
            ]);
            
            if ($pemeriksaanIbu) {
                return redirect()->back()->with(['success' => 'Data Pemeriksaan Berhasil di Simpan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Pemeriksaan Gagal di Simpan']);
            }
        }
    }

    public function simpanImunisasiBumil(Ibu $ibu, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'imunisasi' => "required|exists:tb_jenis_imunisasi,id",
            'tgl_kembali_imunisasi' => 'nullable|date',
            'lokasiImunisasi' => 'required|regex:/^[a-z., 0-9]+$/i|min:5|max:100',
            'keteranganImunisasi' => 'nullable',
        ],
        [
            'imunisasi.required' => "Nama Imunisasi wajib diisi",
            'imunisasi.exists' => "Jenis Imunisasi tidak terdaftar",
            'tgl_kembali_imunisasi.date' => "Format tanggal Imunisasi kembali tidak sesuai",
            'lokasiImunisasi.required' => "Lokasi Imunisasi wajib diisi",
            'lokasiImunisasi.regex' => "Format penulisan lokasi Imunisasi tidak sesuai",
            'lokasiImunisasi.min' => "Penulisan lokasi Imunisasi minimal berjumlah 5 karakter",
            'lokasiImunisasi.max' => "Penulisan lokasi Imunisasi minimal berjumlah 100 karakter",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $umur = Carbon::parse($ibu->tanggal_lahir)->age;
        $nakes = Auth::guard('admin')->user()->nakes;
        $user = User::where('id', $ibu->id_user)->get()->first();

        // return($ibu);

        if ($request->tgl_kembali_imunisasi) {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_kembali_imunisasi;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_kembali = $tahun.$bulan.$tgl;

            $imunisasiIbu = PemberianImunisasi::create([
                'id_jenis_imunisasi' => $request->imunisasi,
                'id_posyandu' => $ibu->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $ibu->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_imunisasi' => $today,
                'tanggal_kembali' => $tgl_kembali,
                'keterangan' => $request->keteranganImunisasi,
                'lokasi' => $request->lokasiImunisasi,
            ]);    
        } else {
            $imunisasiIbu = PemberianImunisasi::create([
                'id_jenis_imunisasi' => $request->imunisasi,
                'id_posyandu' => $ibu->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $ibu->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_imunisasi' => $today,
                'tanggal_kembali' => NULL,
                'keterangan' => $request->keteranganImunisasi,
                'lokasi' => $request->lokasiImunisasi,
            ]);
        }

        if ($imunisasiIbu) {
            return redirect()->back()->with(['success' => 'Data Pemberian Imunisasi Ibu Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Imunisasi Ibu Gagal Ditambahkan']);
        }
    }

    public function simpanVitaminBumil(Ibu $ibu, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'vitamin' => "required|exists:tb_jenis_vitamin,id",
            'tgl_kembali_vitamin' => 'nullable|date',
            'lokasiVitamin' => 'required|regex:/^[a-z., 0-9]+$/i|min:5|max:100',
            'keteranganVitamin' => 'nullable',
        ],
        [
            'vitamin.required' => "Nama Vitamin wajib diisi",
            'vitamin.exists' => "Jenis Vitamin tidak terdaftar",
            'tgl_kembali_vitamin.date' => "Format tanggal Vitamin kembali tidak sesuai",
            'lokasiVitamin.required' => "Lokasi pemberian Vitamin wajib diisi",
            'lokasiVitamin.regex' => "Format penulisan lokasi pemberian Vitamin tidak sesuai",
            'lokasiVitamin.min' => "Penulisan lokasi pemberian Vitamin minimal berjumlah 5 karakter",
            'lokasiVitamin.max' => "Penulisan lokasi pemberian Vitamin minimal berjumlah 100 karakter",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $umur = Carbon::parse($ibu->tanggal_lahir)->age;
        $nakes = Auth::guard('admin')->user()->nakes;
        $user = User::where('id', $ibu->id_user)->get()->first();

        if ($request->tgl_kembali_vitamin) {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_kembali_vitamin;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_kembali = $tahun.$bulan.$tgl;

            $vitaminIbu = PemberianVitamin::create([
                'id_jenis_vitamin' => $request->vitamin,
                'id_posyandu' => $ibu->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $ibu->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_pemberian' => $today,
                'tanggal_kembali' => $tgl_kembali,
                'keterangan' => $request->keteranganVitamin,
                'lokasi' => $request->lokasiVitamin,
            ]);
        } else {
            $vitaminIbu = PemberianVitamin::create([
                'id_jenis_vitamin' => $request->vitamin,
                'id_posyandu' => $ibu->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $ibu->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_pemberian' => $today,
                'tanggal_kembali' => NULL,
                'keterangan' => $request->keteranganVitamin,
                'lokasi' => $request->lokasiVitamin,
            ]);
        }

        if ($vitaminIbu) {
            return redirect()->back()->with(['success' => 'Data Pemberian Vitamin Ibu Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Vitamin Ibu Gagal Ditambahkan']);
        }
    }
}
