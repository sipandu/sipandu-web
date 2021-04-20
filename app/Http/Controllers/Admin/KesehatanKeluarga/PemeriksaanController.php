<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Imunisasi;
use App\Vitamin;
use App\PemberianImunisasi;
use App\Posyandu;
use App\PemeriksaanIbu;
use App\PemeriksaanAnak;
use App\PemeriksaanLansia;

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

    public function pemeriksaanIbu(Ibu $ibu)
    {
        $dataIbu = Ibu::where('id', $ibu->id)->get()->first();
        $imunisasi = Imunisasi::where('penerima', 'Ibu Hamil')->get();
        $vitamin = Vitamin::where('penerima', 'Ibu Hamil')->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-ibu', compact('dataIbu', 'imunisasi', 'vitamin'));
    }

    public function pemeriksaanAnak(Anak $anak)
    {
        $dataAnak = Anak::where('id', $anak->id)->get()->first();
        $imunisasi = Imunisasi::where('penerima', 'Anak')->get();
        $vitamin = Vitamin::where('penerima', 'Anak')->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-anak', compact('dataAnak', 'imunisasi', 'vitamin'));
    }

    public function pemeriksaanLansia(Lansia $lansia)
    {
        $dataLansia = Lansia::where('id', $lansia->id)->get()->first();
        $imunisasi = Imunisasi::where('penerima', 'Lansia')->get();
        $vitamin = Vitamin::where('penerima', 'Lansia')->get();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-lansia', compact('dataLansia', 'imunisasi', 'vitamin'));
    }

    public function tambahPemeriksaanIbu(Ibu $ibu, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'lingkar_lengan' => "required|numeric",
            'berat_badan' => "required|numeric",
            'usia_kandungan' => 'required|numeric|digits_between:1,40',
            'tekanan_darah' => 'required',
            'denyut_nadi' => 'required|numeric',
            'detak_jantung_bayi' => 'required|numeric',
            'tinggi_rahim' => 'required|numeric',
            'diagnosa' => 'required',
            'pengobatan' => 'nullable',
            'keterangan' => 'nullable',
            'lokasiPemeriksaan' => 'required',
            'tgl_kembali' => 'required|date',
        ],
        [
            'lingkar_lengan.required' => "Berat badan ibu hamil wajib diisi",
            'lingkar_lengan.numeric' => "Berat badan harus berupa angka",
            'berat_badan.required' => "Lingkar lengan ibu hamil wajib diisi",
            'berat_badan.numeric' => "Lingkar lengan harus berupa angka",
            'usia_kandungan.required' => "Usia kandungan ibu hamil wajib diisi",
            'usia_kandungan.numeric' => "Usia kandungan harus berupa angka",
            'usia_kandungan.digits_between' => "Rentan usia kandungan tidak sesuai",
            'tekanan_darah.required' => "Tekanan darah ibu hamil wajib diisi",
            'denyut_nadi.required' => "Denyut nadi ibu hamil wajib diisi",
            'denyut_nadi.numeric' => "Denyut nadi ibu hamil harus berupa angka",
            'detak_jantung_bayi.required' => "Detak jantung janin wajib diisi",
            'detak_jantung_bayi.numeric' => "Detak jantung janin harus berupa angka",
            'tinggi_rahim.required' => "Tinggi rahim wajib diisi",
            'tinggi_rahim.numeric' => "Tinggi rahin harus berupa angka",
            'diagnosa.required' => "Diagnosa pemeriksaan ibu hamil wajib diisi",
            'lokasiPemeriksaan.required' => "Tempat pemeriksaan ibu hamil wajib diisi",
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
                'berat_badan' => $request->berat_badan,
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
            $tb = $request->tinggi_badan / 100;
            $imt = $request->berat_badan / $tb;

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
                'IMT' => $imt,
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
}
