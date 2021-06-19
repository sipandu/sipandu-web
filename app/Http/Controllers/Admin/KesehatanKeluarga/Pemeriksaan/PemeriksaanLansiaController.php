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

class PemeriksaanLansiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function pemeriksaanLansia(Lansia $lansia)
    {
        $dataLansia = $lansia;
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $pj = PjLansia::where('id_lansia', $lansia->id)->first();
        $jenisImunisasi = Imunisasi::where('penerima', 'Lansia')->get();
        $jenisVitamin = Vitamin::where('penerima', 'Lansia')->get();
        $imunisasi = PemberianImunisasi::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $vitamin = PemberianVitamin::where('id_user', $lansia->id_user)->orderBy('id', 'desc')->limit(5)->get();
        $alergi = Alergi::where('id_user', $lansia->id_user)->get();
        $penyakitBawaan = PenyakitBawaan::where('id_user', $lansia->id_user)->get();
        $riwayatPenyakit = RiwayatPenyakit::where('id_lansia', $lansia->id)->get();
        $pemeriksaan = PemeriksaanLansia::where('id_lansia', $lansia->id)->orderBy('id', 'desc')->limit(5)->get();

        return view('admin.kesehatan-keluarga.pemeriksaan.pemeriksaan-lansia', compact('dataLansia', 'imunisasi', 'vitamin', 'umur', 'alergi', 'penyakitBawaan', 'riwayatPenyakit', 'pj', 'pemeriksaan', 'jenisImunisasi', 'jenisVitamin'));
    }

    public function simpanPemeriksaanLansia(Lansia $lansia, Request $request)
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
            'tinggi_badan.required' => "Tinggi badan lansia wajib diisi",
            'tinggi_badan.numeric' => "Tinggi badan harus berupa angka",
            'tinggi_badan.min' => "Tinggi badan lansia kurang dari nilai minimum",
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
            return redirect()->back()->with(['error' => 'Tanggal periksa kembali untuk lansia tidak sesuai']);
        } else {
            $tb = $request->tinggi_badan / 100;
            $imt = $request->berat_badan / $tb;

            $pemeriksaanLansia = PemeriksaanLansia::create([
                'id_posyandu' => $lansia->id_posyandu,
                'id_nakes' => $nakes->id,
                'id_lansia' => $lansia->id,
                'nama_posyandu' => $lansia->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'nama_lansia' => $lansia->nama_lansia,
                'usia_lansia' => $umur,
                'berat_badan' => $request->berat_badan,
                'tinggi_lutut' => $request->tinggi_lutut,
                'tinggi_badan' => $request->tinggi_badan,
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

    public function simpanImunisasiLansia(Lansia $lansia, Request $request)
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
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $nakes = Auth::guard('admin')->user()->nakes;
        $user = User::where('id', $lansia->id_user)->get()->first();

        if ($request->tgl_kembali_imunisasi) {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_kembali_imunisasi;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_kembali = $tahun.$bulan.$tgl;

            $imunisasiLansia = PemberianImunisasi::create([
                'id_jenis_imunisasi' => $request->imunisasi,
                'id_posyandu' => $lansia->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $lansia->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_imunisasi' => $today,
                'tanggal_kembali' => $tgl_kembali,
                'keterangan' => $request->keteranganImunisasi,
                'lokasi' => $request->lokasiImunisasi,
            ]);
        } else {
            $imunisasiLansia = PemberianImunisasi::create([
                'id_jenis_imunisasi' => $request->imunisasi,
                'id_posyandu' => $lansia->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $lansia->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_imunisasi' => $today,
                'tanggal_kembali' => NULL,
                'keterangan' => $request->keteranganImunisasi,
                'lokasi' => $request->lokasiImunisasi,
            ]);
        }

        if ($imunisasiLansia) {
            return redirect()->back()->with(['success' => 'Data Pemberian Imunisasi Lansia Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Imunisasi Lansia Gagal Ditambahkan']);
        }
    }

    public function simpanVitaminLansia(Lansia $lansia, Request $request)
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
        $umur = Carbon::parse($lansia->tanggal_lahir)->age;
        $nakes = Auth::guard('admin')->user()->nakes;
        $user = User::where('id', $lansia->id_user)->get()->first();

        if ($request->tgl_kembali_vitamin) {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_kembali_vitamin;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_kembali = $tahun.$bulan.$tgl;

            $vitaminLansia = PemberianVitamin::create([
                'id_jenis_vitamin' => $request->vitamin,
                'id_posyandu' => $lansia->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $lansia->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_pemberian' => $today,
                'tanggal_kembali' => $tgl_kembali,
                'keterangan' => $request->keteranganVitamin,
                'lokasi' => $request->lokasiVitamin,
            ]);
        } else {
            $vitaminLansia = PemberianVitamin::create([
                'id_jenis_vitamin' => $request->vitamin,
                'id_posyandu' => $lansia->id_posyandu,
                'id_user' => $user->id,
                'id_nakes' => $nakes->id,
                'nama_posyandu' => $lansia->posyandu->nama_posyandu,
                'nama_pemeriksa' => $nakes->nama_nakes,
                'usia' => $umur,
                'tanggal_pemberian' => $today,
                'tanggal_kembali' => NULL,
                'keterangan' => $request->keteranganVitamin,
                'lokasi' => $request->lokasiVitamin,
            ]);
        }

        if ($vitaminLansia) {
            return redirect()->back()->with(['success' => 'Data Pemberian Vitamin Lansia Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Pemberian Vitamin Lansia Gagal Ditambahkan']);
        }
    }
    
    public function simpanRiwayatPenyakit(Lansia $lansia, Request $request)
    {
        $this->validate($request,[
            'nama_penyakit' => "required|min:2|max:50",
            'status' => "required",
        ],
        [
            'nama_penyakit.required' => "Nama penyakit wajib diisi",
            'nama_penyakit.min' => "Nama penyakit minimal berjumlah 2 huruf",
            'nama_penyakit.max' => "Nama penyakit maksimal berjumlah 50 huruf",
            'status.required' => "Status penyakit wajib dipilih",
        ]);

        $riwayatPenyakit = RiwayatPenyakit::create([
            'id_lansia' => $lansia->id,
            'nama_penyakit' => $request->nama_penyakit,
            'status' => $request->status,
        ]);

        if ($riwayatPenyakit) {
            return redirect()->back()->with(['success' => 'Data Riwayat Penyakit Lansia Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Riwayat Penyakit Lansia Gagal di Simpan']);
        }
    }
}
