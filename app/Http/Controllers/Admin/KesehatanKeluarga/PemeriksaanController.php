<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga;

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
use App\PemeriksaanIbu;
use App\PemeriksaanAnak;
use App\PemeriksaanLansia;
use App\PemberianImunisasi;
use App\PemberianVitamin;
use App\Alergi;
use App\Persalinan;
use App\PenyakitBawaan;

class PemeriksaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function tambahPemeriksaan()
    {
        $idPosyandu = Auth::guard('admin')->user()->pegawai->id_posyandu;

        $ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_ibu_hamil.id_posyandu', $idPosyandu)
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_ibu_hamil.nama_ibu_hamil', 'asc')
        ->get();

        $anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_anak.id_posyandu', $idPosyandu)
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
        ->get();

        $lansia = Lansia::join('tb_user', 'tb_user.id', 'tb_lansia.id_user')
            ->select('tb_lansia.*')
            ->where('tb_lansia.id_posyandu', $idPosyandu)
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
        ->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/tambah-pemeriksaan', compact('ibu', 'anak', 'lansia') );
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

    public function pemeriksaanIbu(Ibu $ibu)
    {
        $dataIbu = Ibu::where('id', $ibu->id)->get()->first();
        $dataUser = User::where('id', $ibu->id_user)->get()->first();

        $umur = Carbon::parse($dataAnak->tanggal_lahir)->age;

        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $dataIbu->id)->orderBy('id', 'desc')->get()->first();

        if ($pemeriksaanIbu != NULL) {
            $usia_kandungan = $pemeriksaanIbu->usia_kandungan;
        } else {
            $usia_kandungan = '0';
        }

        $pemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $dataIbu->id)->orderBy('id', 'desc')->limit(5)->get();
        $imunisasi = PemberianImunisasi::where('id_user', $dataUser->id)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $dataUser->id)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $dataUser->id)->get();
        $jenisImunisasi = Imunisasi::where('penerima', 'Ibu Hamil')->get();
        $jenisVitamin = Vitamin::where('penerima', 'Ibu Hamil')->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $dataUser->id)->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-ibu', compact('dataIbu', 'umur', 'usia_kandungan', 'pemeriksaan', 'imunisasi', 'vitamin', 'alergi', 'penyakitBawaan', 'jenisImunisasi', 'jenisVitamin'));
    }

    public function pemeriksaanAnak(Anak $anak)
    {
        $today = Carbon::now()->setTimezone('GMT+8');

        $dataAnak = Anak::where('id', $anak->id)->get()->first();
        $dataUser = User::where('id', $anak->id_user)->get()->first();

        $umur = Carbon::parse($dataAnak->tanggal_lahir)->diff($today)->format('%y');
        $umurBayi = Carbon::parse($dataAnak->tanggal_lahir)->diff($today)->format('%m');
        $umurLahirBayi = Carbon::parse($dataAnak->tanggal_lahir)->diff($today)->format('%d');

        if ($umur > 0) {
            $usia = $umur.' Tahun';
        } else {
            if ($umur < 1) {
                $usia= $umurLahirBayi.' Hari';
            } else {
                $usia = $umurBayi.' Bulan';
            }
        }

        $alergi = Alergi::where('id_user', $dataUser->id)->get();
        $persalinan = Persalinan::where('id_anak', $dataAnak->id)->get()->first();
        $jenisImunisasi = Imunisasi::where('penerima', 'Anak')->get();
        $jenisVitamin = Vitamin::where('penerima', 'Anak')->get();
        $imunisasi = PemberianImunisasi::where('id_user', $dataUser->id)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $dataUser->id)->orderBy('id', 'desc')->limit(5)->get();
        $pemeriksaan = PemeriksaanAnak::where('id_anak', $dataAnak->id)->orderBy('id', 'desc')->limit(5)->get();

        $ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_ibu_hamil.nama_ibu_hamil', 'asc')
        ->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-anak', compact('dataAnak', 'pemeriksaan', 'imunisasi', 'vitamin', 'usia', 'alergi', 'persalinan', 'jenisVitamin', 'jenisImunisasi', 'ibu'));
    }

    public function pemeriksaanLansia(Lansia $lansia)
    {
        $dataLansia = Lansia::where('id', $lansia->id)->get()->first();
        $imunisasi = Imunisasi::where('penerima', 'Lansia')->get();
        $vitamin = Vitamin::where('penerima', 'Lansia')->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-lansia', compact('dataLansia', 'imunisasi', 'vitamin'));
    }

    public function tambahAlergiAnak(Anak $anak, Request $request)
    {
        $this->validate($request,[
            'nama_alergi' => "required|min:2|max:50",
            'kategori' => "required",
        ],
        [
            'nama_alergi.required' => "Nama alergi anak wajib diisi",
            'nama_alergi.numeric' => "Nama alergi minimal berjumlah 2 huruf",
            'nama_alergi.numeric' => "Nama alergi maksimal berjumlah 50 huruf",
            'kategori.required' => "Kategori alergi wajib dipilih",
        ]);

        $alergi = Alergi::create([
            'id_user' => $anak->id_user,
            'nama_alergi' => $request->nama_alergi,
            'kategori' => $request->kategori,
        ]);

        if ($alergi) {
            return redirect()->back()->with(['success' => 'Data Alergi Anak Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Alergi Anak Gagal di Simpan']);
        }
    }

    public function tambahPemeriksaanIbu(Ibu $ibu, Request $request)
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
            'lingkar_lengan.required' => "Berat badan ibu hamil wajib diisi",
            'lingkar_lengan.numeric' => "Berat badan harus berupa angka",
            'lingkar_lengan.min' => "Berat badan kurang dari nilai minimum",
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

        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();
        $pegawai = Auth::guard('admin')->user()->pegawai;

        // Ubah format tanggal //
        $tgl_kotor = $request->tgl_kembali;
        $tgl_bersih = explode("-", $tgl_kotor);
        $tahun = $tgl_bersih[2];
        $bulan = $tgl_bersih[1];
        $tgl = $tgl_bersih[0];
        $tgl_kembali = $tahun.$bulan.$tgl;

        $tanggal_kembali = Carbon::parse($tgl_kembali)->toDateString();

        $berat_badan = $request->berat_badan/100;

        if ($tanggal_kembali <= $today) {
            return redirect()->back()->with(['error' => 'Tanggal periksa kembali untuk ibu hamil tidak sesuai']);
        } else {
            $pemeriksaanIbu = PemeriksaanIbu::create([
                'id_posyandu' => $posyandu->id,
                'id_pegawai' => $pegawai->id,
                'id_ibu_hamil' => $ibu->id,
                'nama_posyandu' => $posyandu->nama_posyandu,
                'nama_pemeriksa' => $pegawai->nama_pegawai,
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

    public function tambahPemeriksaanAnak(Anak $anak, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'lingkar_kepala' => "required|numeric|min:2",
            'berat_badan' => "required|numeric|min:2",
            'tinggi_badan' => 'required|numeric|min:2',
            'tgl_kembali' => 'required|date',
            'lokasiPemeriksaan' => 'required|min:5',
            'diagnosa' => 'required|min:5',
            'pengobatan' => 'nullable',
            'keterangan' => 'nullable',
        ],
        [
            'lingkar_kepala.required' => "Lingkar kepala anak wajib diisi",
            'lingkar_kepala.numeric' => "Lingkar kepala anak harus berupa angka",
            'lingkar_kepala.min' => "Lingkar kepala anak kurang dari nilai minimum",
            'berat_badan.required' => "berat badan anak hamil wajib diisi",
            'berat_badan.numeric' => "berat badan anak harus berupa angka",
            'berat_badan.min' => "Berat badan anak kurang dari nilai minimum",
            'tinggi_badan.required' => "Tinggi badan anak wajib diisi",
            'tinggi_badan.numeric' => "Tinggi badan anak harus berupa angka",
            'tinggi_badan.min' => "Tinggi badan anak kurang dari nilai minimum",
            'tgl_kembali.required' => "Tanggal pemeriksaan kembali wajib diisi",
            'tgl_kembali.required' => "Tanggal pemeriksaan kembali harus berformat tanggal",
            'lokasiPemeriksaan.required' => "Tempat pemeriksaan anak wajib diisi",
            'lokasiPemeriksaan.min' => "Nama tempat pemeriksaan anak terlalu singkat",
            'diagnosa.required' => "Diagnosa pemeriksaan anak wajib diisi",
            'diagnosa.min' => "Diagnosa pemeriksaan anak terlalu singkat",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $umur = Carbon::parse($anak->tanggal_lahir)->age;

        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();
        $pegawai = Auth::guard('admin')->user()->pegawai;

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
                'id_posyandu' => $posyandu->id,
                'id_pegawai' => $pegawai->id,
                'id_anak' => $anak->id,
                'nama_posyandu' => $posyandu->nama_posyandu,
                'nama_pemeriksa' => $pegawai->nama_pegawai,
                'nama_anak' => $anak->nama_anak,
                'usia_anak' => $umur,
                'lingkar_kepala' => $request->lingkar_kepala,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'diagnosa' => $request->diagnosa,
                'pengobatan' => $request->pengobatan,
                'keterangan' => $request->keterangan,
                'IMT' => $imtAnak,
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
    
    public function tambahPemeriksaanLansia(Lansia $lansia, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'berat_badan' => "required|numeric|min:2",
            'suhu_tubuh' => "required|numeric|min:2",
            'tinggi_lutut' => 'required|numeric|min:2',
            'tinggi_badan' => 'required|numeric|min:2',
            'tekanan_darah' => 'required',
            'denyut_nadi' => 'required|numeric|min:2',
            'lokasi_pemeriksaan' => 'required|min:5',
            'tgl_kembali' => 'required|date',
            'diagnosa' => 'required|min:5',
            'pengobatan' => 'nullable',
            'keterangan' => 'nullable',
        ],
        [
            'berat_badan.required' => "Berat badan lansia wajib diisi",
            'berat_badan.numeric' => "Berat badan harus berupa angka",
            'berat_badan.min' => "Berat badan lansia kurang dari nilai minimum",
            'suhu_tubuh.required' => "Suhu tubuh lansia wajib diisi",
            'suhu_tubuh.numeric' => "Suhu tubuh harus berupa angka",
            'suhu_tubuh.min' => "Suhu tubuh kurang dari nilai minimum",
            'tinggi_lutut.required' => "Tinggi lutut lansia wajib diisi",
            'tinggi_lutut.numeric' => "Tinggi lutut harus berupa angka",
            'tinggi_lutut.min' => "Tinggi lutut lansia kurang dari nilai minimum",
            'tekanan_darah.required' => "Tekanan darah lansia wajib diisi",
            'denyut_nadi.required' => "Denyut nadi lansia wajib diisi",
            'denyut_nadi.numeric' => "Denyut nadi lansia harus berupa angka",
            'denyut_nadi.min' => "Denyut nadi lansia kurang dari nilai minimum",
            'lokasiPemeriksaan.required' => "Tempat pemeriksaan lansia wajib diisi",
            'lokasiPemeriksaan.min' => "Nana tempat pemeriksaan lansia terlalu singkat",
            'tgl_kembali.required' => "Tanggal pemeriksaan kembali wajib diisi",
            'tgl_kembali.required' => "Tanggal pemeriksaan kembali harus berformat tanggal",
            'diagnosa.required' => "Diagnosa pemeriksaan lansia wajib diisi",
            'diagnosa.min' => "Diagnosa pemeriksaan lansia terlalu singkat",
        ]);

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;

        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();
        $pegawai = Auth::guard('admin')->user()->pegawai;

        // Ubah format tanggal //
        $tgl_kotor = $request->tgl_kembali;
        $tgl_bersih = explode("-", $tgl_kotor);
        $tahun = $tgl_bersih[2];
        $bulan = $tgl_bersih[1];
        $tgl = $tgl_bersih[0];
        $tgl_kembali = $tahun.$bulan.$tgl;

        $tanggal_kembali = Carbon::parse($tgl_kembali)->toDateString();

        if ($tanggal_kembali <= $today) {
            return redirect()->back()->with(['error' => 'Tanggal periksa kembali untuk lansia tidak sesuai']);
        } else {
            $tb = $request->tinggi_badan / 100;
            $imt = $request->berat_badan / $tb;

            $pemeriksaanLansia = PemeriksaanLansia::create([
                'id_posyandu' => $posyandu->id,
                'id_pegawai' => $pegawai->id,
                'id_lansia' => $lansia->id,
                'nama_posyandu' => $posyandu->nama_posyandu,
                'nama_pemeriksa' => $pegawai->nama_pegawai,
                'nama_lansia' => $lansia->nama_lansia,
                'usia_lansia' => $umur,
                'berat_badan' => $request->berat_badan,
                'tinggi_lutut' => $request->tinggi_lutut,
                'tekanan_darah' => $request->tekanan_darah,
                'suhu_tubuh' => $request->suhu_tubuh,
                'denyut_nadi' => $request->denyut_nadi,
                'diagnosa' => $request->diagnosa,
                'pengobatan' => $request->pengobatan,
                'keterangan' => $request->keteranganPemeriksaan,
                'IMT' => $imt,
                'jenis_pemeriksaan' => 'Pemeriksaan',
                'tempat_pemeriksaan' => $request->lokasi_pemeriksaan,
                'tanggal_pemeriksaan' => $today,
                'tanggal_kembali' => $tgl_kembali,
            ]);
            
            if ($pemeriksaanLansia) {
                return redirect()->back()->with(['success' => 'Data Pemeriksaan Berhasil di Simpan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Pemeriksaan Gagal di Simpan']);
            }
        }
    }

    public function tambahKelahiranAnak(Anak $anak, Request $request)
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
}
