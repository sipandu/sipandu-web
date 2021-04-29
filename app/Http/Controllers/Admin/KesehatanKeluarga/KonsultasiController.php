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
        $alergi = Alergi::where('id_user', $ibu->id_user)->get();
        $persalinan = Persalinan::where('id_ibu_hamil', $ibu->id)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $ibu->id_user)->get();

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
        // $age = Carbon::parse($dataAnak->tanggal_lahir)->age;
        $umur = Carbon::parse($dataAnak->tanggal_lahir)->diff($today)->format('%y Tahun');
        $umurBayi = Carbon::parse($dataAnak->tanggal_lahir)->diff($today)->format('%m Bulan');

        if ($umur > 0) {
            $usia = $umur;
        } else {
            $usia = $umurBayi;
        }    

        $pemeriksaan = PemeriksaanAnak::where('id_anak', $dataAnak->id)->orderBy('id', 'desc')->limit(5)->get();
        $imunisasi = PemberianImunisasi::where('id_user', $dataUser->id)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $dataUser->id)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $dataUser->id)->get();
        $persalinan = Persalinan::where('id_anak', $dataAnak->id)->get()->first();

        return view('pages/admin/kesehatan-keluarga/konsultasi/konsul-anak', compact('dataAnak', 'pemeriksaan', 'imunisasi', 'vitamin', 'usia', 'alergi', 'persalinan'));
    }

    public function konsultasiLansia(Lansia $lansia)
    {
        $dataLansia = Lansia::where('id', $lansia->id)->get()->first();

        return view('pages/admin/kesehatan-keluarga/konsultasi/konsul-lansia', compact('dataLansia'));
    }

    public function storeKonsultasiIbu(Ibu $ibu, Request $request)
    {
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
