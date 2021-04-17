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
use App\PemberianImunisasi;
use App\Posyandu;

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
        $imunisasi = Imunisasi::where('penerima', 'Ibu Hamil')->get();
        $dataIbu = Ibu::where('id', $ibu->id)->get()->first();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-ibu', compact('imunisasi', 'dataIbu'));
    }

    public function pemeriksaanAnak(Anak $anak)
    {
        $imunisasi = Imunisasi::where('penerima', 'Anak')->get();
        $dataAnak = Anak::where('id', $anak->id)->get()->first();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-anak', compact('imunisasi', 'dataAnak'));
    }

    public function pemeriksaanLansia(Lansia $lansia)
    {
        $imunisasi = Imunisasi::where('penerima', 'Lansia')->get();
        $dataLansia = Lansia::where('id', $lansia->id)->get()->first();

        return view('pages/admin/kesehatan-keluarga/pemeriksaan/pemeriksaan-lansia', compact('imunisasi', 'dataLansia'));
    }

    public function imunisasiIbu(Ibu $ibu, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'imunisasi' => "required|exists:tb_jenis_imunisasi,nama_imunisasi",
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
        $pegawai = Auth::guard('admin')->user()->pegawai;
        $user = User::where('id', $ibu->id_user)->get()->first();
        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_kembali_imunisasi;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_kembali = $tahun.$bulan.$tgl;

        $imunisasiIbu = PemberianImunisasi::create([
            'id_jenis_imunisasi' => $request->imunisasi,
            'id_posyandu' => $posyandu->id,
            'id_user' => $user->id,
            'id_pegawai' => $pegawai->id,
            'nama_posyandu' => $posyandu->nama_posyandu,
            'nama_pemeriksa' => $pegawai->nama_pegawai,
            'usia' => $umur,
            'tanggal_imunisasi' => $today,
            'tanggal_kembali' => $tgl_kembali,
            'keterangan' => $request->keteranganImunisasi,
            'lokasi' => $request->lokasiImunisasi,
        ]);

        if ($imunisasiIbu) {
            return redirect()->back()->with(['success' => 'Data Pemberian Imunisasi Ibu Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Imunisasi Ibu Gagal Ditambahkan']);
        }
    }

    public function imunisasiAnak(Anak $anak, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'imunisasi' => "required|exists:tb_jenis_imunisasi,nama_imunisasi",
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
        $pegawai = Auth::guard('admin')->user()->pegawai;
        $user = User::where('id', $anak->id_user)->get()->first();
        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_kembali_imunisasi;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_kembali = $tahun.$bulan.$tgl;

        $imunisasiAnak = PemberianImunisasi::create([
            'id_jenis_imunisasi' => $request->imunisasi,
            'id_posyandu' => $posyandu->id,
            'id_user' => $user->id,
            'id_pegawai' => $pegawai->id,
            'nama_posyandu' => $posyandu->nama_posyandu,
            'nama_pemeriksa' => $pegawai->nama_pegawai,
            'usia' => $umur,
            'tanggal_imunisasi' => $today,
            'tanggal_kembali' => $tgl_kembali,
            'keterangan' => $request->keteranganImunisasi,
            'lokasi' => $request->lokasiImunisasi,
        ]);

        if ($imunisasiAnak) {
            return redirect()->back()->with(['success' => 'Data Pemberian Imunisasi Anak Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Imunisasi Anak Gagal Ditambahkan']);
        }
    }

    public function imunisasiLansia(Lansia $lansia, Request $request)
    {
        Carbon::setLocale('id');

        $this->validate($request,[
            'imunisasi' => "required|exists:tb_jenis_imunisasi,nama_imunisasi",
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
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $pegawai = Auth::guard('admin')->user()->pegawai;
        $user = User::where('id', $lansia->id_user)->get()->first();
        $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get()->first();

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_kembali_imunisasi;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_kembali = $tahun.$bulan.$tgl;

        $imunisasiIbu = PemberianImunisasi::create([
            'id_jenis_imunisasi' => $request->imunisasi,
            'id_posyandu' => $posyandu->id,
            'id_user' => $user->id,
            'id_pegawai' => $pegawai->id,
            'nama_posyandu' => $posyandu->nama_posyandu,
            'nama_pemeriksa' => $pegawai->nama_pegawai,
            'usia' => $umur,
            'tanggal_imunisasi' => $today,
            'tanggal_kembali' => $tgl_kembali,
            'keterangan' => $request->keteranganImunisasi,
            'lokasi' => $request->lokasiImunisasi,
        ]);

        if ($imunisasiIbu) {
            return redirect()->back()->with(['success' => 'Data Pemberian Imunisasi Lansia Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Imunisasi Lansia Gagal Ditambahkan']);
        }
    }
}
