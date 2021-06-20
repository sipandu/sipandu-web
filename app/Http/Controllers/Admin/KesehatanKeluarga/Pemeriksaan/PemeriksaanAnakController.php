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

class PemeriksaanAnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function pemeriksaanAnak(Anak $anak)
    {
        $today = Carbon::now()->setTimezone('GMT+8');        
        $umur = Carbon::parse($anak->tanggal_lahir)->diff($today)->format('%y');
        $umurBayi = Carbon::parse($anak->tanggal_lahir)->diff($today)->format('%m');
        $umurLahirBayi = Carbon::parse($anak->tanggal_lahir)->diff($today)->format('%d');
        
        $dataAnak = $anak;
        $jenisImunisasi = Imunisasi::where('penerima', 'Anak')->get();
        $jenisVitamin = Vitamin::where('penerima', 'Anak')->get();
        $imunisasi = PemberianImunisasi::where('id_user', $anak->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $anak->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $anak->id_user)->get();
        $persalinan = Persalinan::where('id_anak', $anak->id)->get()->first();
        $pemeriksaan = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('id', 'desc')->limit(5)->get();
        $gizi = PemeriksaanAnak::where('id_anak', $anak->id)->orderBy('id', 'desc')->first();
        
        // if ($umur > 0) {
        //     $usia = $umur.' Tahun';
        // } else {
        //     if ($umur < 1) {
        //         $usia= $umurLahirBayi.' Hari';
        //     } else {
        //         $usia = $umurBayi.' Bulan';
        //     }
        // }
        $usia = $umur.' Tahun'.' '.$umurBayi.' Bulan';

        $ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_ibu_hamil.nama_ibu_hamil', 'asc')
        ->get();

        return view('admin.kesehatan-keluarga.pemeriksaan.pemeriksaan-anak', compact('dataAnak', 'pemeriksaan', 'imunisasi', 'vitamin', 'usia', 'alergi', 'persalinan', 'jenisVitamin', 'jenisImunisasi', 'ibu', 'gizi'));
    }

    public function simpanDataKelahiranAnak(Anak $anak, Request $request)
    {
        $this->validate($request,[
            'nama_ibu' => "required|min:2|max:50",
            'berat_lahir' => "required|numeric|min:2",
            'persalinan' => 'required',
            'penolong_persalinan' => 'required',
        ],
        [
            'nama_ibu.required' => "Nama ibu wajib diisi",
            'nama_ibu.min' => "Nama ibu minimal berjumlah 2 huruf",
            'nama_ibu.max' => "Nama ibu maksimal berjumlah 50 huruf",
            'berat_lahir.required' => "Berat lahir anak wajib diisi",
            'berat_lahir.numeric' => "Berat lahir anak harus berupa angka",
            'berat_lahir.min' => "Berat lahir anak kurang dari nilai minimum",
            'persalinan.required' => "Jenis persalinan wajib diisi",
            'penolong_persalinan.required' => "Penolong persalinan wajib diisi",
        ]);

        // Exploded Nama Ibu
        $namaIbu = $request->nama_ibu;
        $nama_ibu = explode(",", $namaIbu);

        if (count($nama_ibu) > 1) {
            $nama = $nama_ibu[0];
            $nik = $nama_ibu[1];

            $dataBumil = Ibu::where('NIK', $nik)->get()->first();

            $persalinan = Persalinan::create([
                'id_anak' => $anak->id,
                'id_ibu_hamil' => $dataBumil->id,
                'nama_ibu' => $dataBumil->nama_ibu_hamil,
                'nama_anak' => $anak->nama_anak,
                'berat_lahir' => $request->berat_lahir,
                'persalinan' => $request->persalinan,
                'penolong_persalinan' => $request->penolong_persalinan,
                'komplikasi' => $request->komplikasi,
            ]);
    
            if ($persalinan) {
                return redirect()->back()->with(['success' => 'Data Kelahiran Anak Berhasil di Simpan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Kelahiran Anak Gagal di Simpan']);
            }
        } else {
            $nama = $nama_ibu[0];

            $persalinan = Persalinan::create([
                'id_anak' => $anak->id,
                'nama_ibu' => $nama,
                'nama_anak' => $anak->nama_anak,
                'berat_lahir' => $request->berat_lahir,
                'persalinan' => $request->persalinan,
                'penolong_persalinan' => $request->penolong_persalinan,
                'komplikasi' => $request->komplikasi,
            ]);
    
            if ($persalinan) {
                return redirect()->back()->with(['success' => 'Data Kelahiran Anak Berhasil di Simpan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Kelahiran Anak Gagal di Simpan']);
            }
        }
    }

    public function simpanPemeriksaanAnak(Anak $anak, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'lingkar_kepala' => "required|numeric|min:2",
            'berat_badan' => "required|numeric|min:2",
            'tinggi_badan' => 'required|numeric|min:2',
            'tgl_kembali' => 'required|date',
            'status_gizi' => 'required',
            'lokasiPemeriksaan' => 'required|min:5',
            'diagnosa' => 'required|min:5',
            'pengobatan' => 'nullable',
            'keterangan' => 'nullable',
        ],
        [
            'lingkar_kepala.required' => "Lingkar kepala anak wajib diisi",
            'lingkar_kepala.numeric' => "Lingkar kepala anak harus berupa angka",
            'lingkar_kepala.min' => "Lingkar kepala anak kurang dari nilai minimum",
            'berat_badan.required' => "berat badan anak wajib diisi",
            'berat_badan.numeric' => "berat badan anak harus berupa angka",
            'berat_badan.min' => "Berat badan anak kurang dari nilai minimum",
            'tinggi_badan.required' => "Tinggi badan anak wajib diisi",
            'tinggi_badan.numeric' => "Tinggi badan anak harus berupa angka",
            'tinggi_badan.min' => "Tinggi badan anak kurang dari nilai minimum",
            'tgl_kembali.required' => "Tanggal pemeriksaan kembali wajib diisi",
            'tgl_kembali.date' => "Tanggal pemeriksaan kembali harus berformat tanggal",
            'status_gizi.required' => "Status gizi anak wajib dipilih",
            'lokasiPemeriksaan.required' => "Tempat pemeriksaan anak wajib diisi",
            'lokasiPemeriksaan.min' => "Nama tempat pemeriksaan anak terlalu singkat",
            'diagnosa.required' => "Diagnosa pemeriksaan anak wajib diisi",
            'diagnosa.min' => "Diagnosa pemeriksaan anak terlalu singkat",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $umur = Carbon::parse($anak->tanggal_lahir)->age;
        $nakes = Auth::guard('admin')->user()->nakes;

        // Ubah format tanggal //
        $tgl_kotor = $request->tgl_kembali;
        $tgl_bersih = explode("-", $tgl_kotor);
        $tahun = $tgl_bersih[2];
        $bulan = $tgl_bersih[1];
        $tgl = $tgl_bersih[0];
        $tgl_kembali = $tahun.$bulan.$tgl;

        $tanggal_kembali = Carbon::parse($tgl_kembali)->toDateString();

        if ($tanggal_kembali <= $today) {
            return redirect()->back()->with(['error' => 'Tanggal periksa kembali untuk anak tidak sesuai']);
        } else {
            $day = Carbon::now()->setTimezone('GMT+8');
            $persalinan = Persalinan::where('id_anak', $anak->id)->get()->first();
            $umurBayi = Carbon::parse($anak->tanggal_lahir)->diff($day)->format('%m');

            if ($umurBayi <= 6) {
                $imtAnak = $persalinan->berat_lahir + ($umurBayi*600);
            } elseif ($umurBayi>6 && $umurBayi<=12) {
                $imtAnak = $persalinan->berat_lahir + ($umurBayi*500);
            } elseif ($umurBayi > 12) {
                $usiaBayi = $umurBayi/12;
                $imtAnak = ( 2*($usiaBayi) ) + 8;
            }

            $pemeriksaanAnak = PemeriksaanAnak::create([
                'id_posyandu' => $anak->id_posyandu,
                'id_nakes' => $nakes->id,
                'id_anak' => $anak->id,
                'nama_posyandu' => $anak->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'nama_anak' => $anak->nama_anak,
                'usia_anak' => $umur,
                'lingkar_kepala' => $request->lingkar_kepala,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'diagnosa' => $request->diagnosa,
                'pengobatan' => $request->pengobatan,
                'keterangan' => $request->keterangan,
                'IMT' => $imtAnak,
                'status_gizi' => $request->status_gizi,
                'jenis_pemeriksaan' => 'Pemeriksaan',
                'tempat_pemeriksaan' => $request->lokasiPemeriksaan,
                'tanggal_pemeriksaan' => $today,
                'tanggal_kembali' => $tgl_kembali,
            ]);
            
            if ($pemeriksaanAnak) {
                return redirect()->back()->with(['success' => 'Data Pemeriksaan Berhasil di Simpan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Pemeriksaan Gagal di Simpan']);
            }
        }
    }

    public function simpanImunisasiAnak(Anak $anak, Request $request)
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
        $umur = Carbon::parse($anak->tanggal_lahir)->age;
        $nakes = Auth::guard('admin')->user()->nakes;
        $user = User::where('id', $anak->id_user)->get()->first();
        
        if ($request->tgl_kembali_imunisasi) {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_kembali_imunisasi;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_kembali = $tahun.$bulan.$tgl;

            $imunisasiAnak = PemberianImunisasi::create([
                'id_jenis_imunisasi' => $request->imunisasi,
                'id_posyandu' => $anak->id,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $anak->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_imunisasi' => $today,
                'tanggal_kembali' => $tgl_kembali,
                'keterangan' => $request->keteranganImunisasi,
                'lokasi' => $request->lokasiImunisasi,
            ]);
        } else {
            $imunisasiAnak = PemberianImunisasi::create([
                'id_jenis_imunisasi' => $request->imunisasi,
                'id_posyandu' => $anak->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $anak->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_imunisasi' => $today,
                'tanggal_kembali' => NULL,
                'keterangan' => $request->keteranganImunisasi,
                'lokasi' => $request->lokasiImunisasi,
            ]);
        }

        if ($imunisasiAnak) {
            return redirect()->back()->with(['success' => 'Data Pemberian Imunisasi Anak Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Imunisasi Anak Gagal Ditambahkan']);
        }
    }

    public function simpanVitaminAnak(Anak $anak, Request $request)
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
            'lokasiVitamin.required' => "Lokasi Vitamin wajib diisi",
            'lokasiVitamin.regex' => "Format penulisan lokasi Vitamin tidak sesuai",
            'lokasiVitamin.min' => "Penulisan lokasi Vitamin minimal berjumlah 5 karakter",
            'lokasiVitamin.max' => "Penulisan lokasi Vitamin minimal berjumlah 100 karakter",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $umur = Carbon::parse($anak->tanggal_lahir)->age;
        $nakes = Auth::guard('admin')->user()->nakes;
        $user = User::where('id', $anak->id_user)->get()->first();

        if ($request->tgl_kembali_vitamin) {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_kembali_vitamin;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_kembali = $tahun.$bulan.$tgl;

            $vitaminAnak = PemberianVitamin::create([
                'id_jenis_vitamin' => $request->vitamin,
                'id_posyandu' => $anak->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $anak->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_pemberian' => $today,
                'tanggal_kembali' => $tgl_kembali,
                'keterangan' => $request->keteranganVitamin,
                'lokasi' => $request->lokasiVitamin,
            ]);
        } else {
            $vitaminAnak = PemberianVitamin::create([
                'id_jenis_vitamin' => $request->vitamin,
                'id_posyandu' => $anak->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $anak->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_pemberian' => $today,
                'tanggal_kembali' => NULL,
                'keterangan' => $request->keteranganVitamin,
                'lokasi' => $request->lokasiVitamin,
            ]);
        }

        if ($vitaminAnak) {
            return redirect()->back()->with(['success' => 'Data Pemberian Vitamin Anak Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Vitamin Anak Gagal Ditambahkan']);
        }
    }
}
