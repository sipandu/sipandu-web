<?php

namespace App\Http\Controllers\admin\KesehatanKeluarga;

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
use App\Posyandu;
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

class KonsultasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function tambahKonsultasi()
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

        return view('pages/admin/kesehatan-keluarga/konsultasi/tambah-konsul', compact('ibu', 'anak', 'lansia'));
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

    public function konsultasiIbu(Ibu $ibu)
    {
        $dataIbu = $ibu;
        $umur = Carbon::parse($ibu->tanggal_lahir)->age;

        $pemeriksaanIbu = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->get()->first();
        if ($pemeriksaanIbu != NULL) {
            $usia_kandungan = $pemeriksaanIbu->usia_kandungan;
        } else {
            $usia_kandungan = '0';
        }

        $alergi = Alergi::where('id_user', $ibu->id_user)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $ibu->id_user)->get();
        $imunisasi = PemberianImunisasi::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $ibu->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $pemeriksaan = PemeriksaanIbu::where('id_ibu_hamil', $ibu->id)->orderBy('id', 'desc')->limit(5)->get();
        $persalinan = Persalinan::where('id_ibu_hamil', $ibu->id)->get();

        $anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_anak.nama_anak', 'asc')
        ->get();

        return view('pages/admin/kesehatan-keluarga/konsultasi/konsul-ibu', compact('dataIbu', 'umur', 'usia_kandungan', 'pemeriksaan', 'imunisasi', 'vitamin', 'alergi', 'penyakitBawaan', 'alergi', 'persalinan', 'anak'));
    }

    public function konsultasiAnak(Anak $anak)
    {
        $dataAnak = Anak::where('id', $anak->id)->get()->first();
        $dataUser = User::where('id', $anak->id_user)->get()->first();

        $today = Carbon::now()->setTimezone('GMT+8');
        $umur = $age = Carbon::parse($anak->tanggal_lahir)->age;
        $umurBayi = Carbon::parse($anak->tanggal_lahir)->diff($today)->format('%m Bulan');

        if ($umur > 0) {
            $usia = $umur;
        } else {
            $usia = $umurBayi;
        }

        $ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_user.is_verified', 1)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_ibu_hamil.nama_ibu_hamil', 'asc')
        ->get();

        $alergi = Alergi::where('id_user', $anak->id_user)->get();
        $imunisasi = PemberianImunisasi::where('id_user', $anak->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $anak->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $pemeriksaan = PemeriksaanAnak::where('id_anak', $dataAnak->id)->orderBy('id', 'desc')->limit(5)->get();
        $persalinan = Persalinan::where('id_anak', $dataAnak->id)->first();

        return view('pages/admin/kesehatan-keluarga/konsultasi/konsul-anak', compact('dataAnak', 'pemeriksaan', 'imunisasi', 'vitamin', 'usia', 'alergi', 'persalinan', 'ibu'));
    }

    public function konsultasiLansia(Lansia $lansia)
    {
        $dataLansia = $lansia;
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $pj = PjLansia::where('id_lansia', $lansia->id)->first();
        $imunisasi = PemberianImunisasi::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $lansia->id_user)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $lansia->id_user)->get();
        $riwayatPenyakit = RiwayatPenyakit::where('id_lansia', $lansia->id)->get();
        $pemeriksaan = PemeriksaanLansia::where('id_lansia', $lansia->id)->orderBy('id', 'desc')->limit(5)->get();

        return view('pages/admin/kesehatan-keluarga/konsultasi/konsul-lansia', compact('dataLansia', 'imunisasi', 'vitamin', 'umur', 'alergi', 'penyakitBawaan', 'riwayatPenyakit', 'pj', 'pemeriksaan'));
    }

    public function storeKonsultasiIbu(Ibu $ibu, Request $request)
    {
        $this->validate($request,[
            'usia_kehamilan' => "required|min:1|max:2",
            'diagnosa' => "required",
            'pengobatan' => "nullable",
            'keterangan' => "nullable|numeric|digits_between:12,15",
        ],
        [
            'usia_kehamilan.required' => "Usia kehamilan wajib diisi",
            'usia_kehamilan.min' => "Usia kehamilan kurang dari nilai minimum",
            'usia_kehamilan.max' => "Usia kehamilan melebihi batas maksimum",
            'diagnosa.required' => "Hasil pemeriksaan wajib diisi",
        ]);

        Carbon::setLocale('id');

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();
        $pegawai = Auth::guard('admin')->user()->pegawai;

        $konsultasiIbu = PemeriksaanIbu::create([
            'id_posyandu' => $posyandu->id,
            'id_pegawai' => $pegawai->id,
            'id_ibu_hamil' => $ibu->id,
            'nama_posyandu' => $posyandu->nama_posyandu,
            'nama_pemeriksa' => $pegawai->nama_pegawai,
            'nama_ibu_hamil' => $ibu->nama_ibu_hamil,
            'usia_kandungan' => $request->usia_kehamilan,
            'diagnosa' => $request->diagnosa,
            'pengobatan' => $request->pengobatan,
            'keterangan' => $request->keterangan,
            'jenis_pemeriksaan' => 'Konsultasi',
            'tempat_pemeriksaan' => 'Virtual by Telegram',
            'tanggal_pemeriksaan' => $today,
        ]);
        
        if ($konsultasiIbu) {
            return redirect()->back()->with(['success' => 'Data Konsultasi Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Konsultasi Gagal di Simpan']);
        }
    }

    public function storeKonsultasiAnak(Anak $anak, Request $request)
    {
        $this->validate($request,[
            'diagnosa' => "required",
            'pengobatan' => "nullable",
            'keterangan' => "nullable|numeric|digits_between:12,15",
        ],
        [
            'diagnosa.required' => "Hasil pemeriksaan wajib diisi",
        ]);

        Carbon::setLocale('id');

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();
        $pegawai = Auth::guard('admin')->user()->pegawai;
        $umur = Carbon::parse($anak->tanggal_lahir)->age;

        $konsultasiAnak = PemeriksaanAnak::create([
            'id_posyandu' => $posyandu->id,
            'id_pegawai' => $pegawai->id,
            'id_anak' => $anak->id,
            'nama_posyandu' => $posyandu->nama_posyandu,
            'nama_pemeriksa' => $pegawai->nama_pegawai,
            'nama_anak' => $anak->nama_anak,
            'usia_anak' => $umur,
            'diagnosa' => $request->diagnosa,
            'pengobatan' => $request->pengobatan,
            'keterangan' => $request->keterangan,
            'jenis_pemeriksaan' => 'Konsultasi',
            'tempat_pemeriksaan' => 'Virtual by Telegram',
            'tanggal_pemeriksaan' => $today,
        ]);

        if ($konsultasiAnak) {
            return redirect()->back()->with(['success' => 'Data Konsultasi Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Konsultasi Gagal di Simpan']);
        }
    }

    public function storeKonsultasiLansia(Lansia $lansia, Request $request)
    {
        $this->validate($request,[
            'diagnosa' => "required",
            'pengobatan' => "nullable",
            'keterangan' => "nullable|numeric|digits_between:12,15",
        ],
        [
            'diagnosa.required' => "Hasil pemeriksaan wajib diisi",
        ]);

        Carbon::setLocale('id');

        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();
        $pegawai = Auth::guard('admin')->user()->pegawai;
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;

        $konsultasiLansia = PemeriksaanLansia::create([
            'id_posyandu' => $posyandu->id,
            'id_pegawai' => $pegawai->id,
            'id_lansia' => $lansia->id,
            'nama_posyandu' => $posyandu->nama_posyandu,
            'nama_pemeriksa' => $pegawai->nama_pegawai,
            'nama_lansia' => $lansia->nama_lansia,
            'usia_lansia' => $umur,
            'diagnosa' => $request->diagnosa,
            'pengobatan' => $request->pengobatan,
            'keterangan' => $request->keterangan,
            'jenis_pemeriksaan' => 'Konsultasi',
            'tempat_pemeriksaan' => 'Virtual by Telegram',
            'tanggal_pemeriksaan' => $today,
        ]);

        if ($konsultasiLansia) {
            return redirect()->back()->with(['success' => 'Data Konsultasi Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Konsultasi Gagal di Simpan']);
        }
    }
}
