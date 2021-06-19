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

class SemuaPemeriksaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function semuaPemeriksaanAnggota()
    {
        if ( auth()->guard('admin')->user()->role == 'super admin' ) {
            if ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Provinsi' ) {
                $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();
                if ( count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->get();
                    $anak = Anak::whereIn('id_user', $anggota_id->toArray())->get();
                    $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            } elseif ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kabupaten' ) {
                $id_kecamatan = Kecamatan::where('id_kabupaten', auth()->guard('admin')->user()->superAdmin->id_kabupaten)->select('id')->get();
                $id_desa = Desa::whereIn('id_kecamatan', $id_kecamatan->toArray())->select('id')->get();

                $id_posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->select('id')->get();
                $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();

                if ( count($id_posyandu) > 0 && count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            } elseif ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kecamatan' ) {
                $id_desa = Desa::where('id_kecamatan', auth()->guard('admin')->user()->superAdmin->id_kecamatan)->select('id')->get();
                $id_posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->select('id')->get();
                $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();

                if ( count($id_posyandu) > 0 && count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            }
        } elseif ( auth()->guard('admin')->user()->role == 'tenaga kesehatan' ) {
            $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();
            $id_posyandu = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();

            if ( count($id_posyandu) > 0 && count($anggota_id) ) {
                $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $anak = Anak::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
            } else {
                $ibu = NULL;
                $anak = NULL;
                $lansia = NULL;
            }
        } elseif ( auth()->guard('admin')->user()->role == 'pegawai' ) {
            $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();
            if ( count($anggota_id) > 0 ) {
                $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
                $anak = Anak::whereIn('id_user', $anggota_id->toArray())->where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
                $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
            } else {
                $ibu = NULL;
                $anak = NULL;
                $lansia = NULL;
            }
        }

        return view('admin.kesehatan-keluarga.pemeriksaan.semua-pemeriksaan-anggota', compact('ibu', 'anak', 'lansia') );
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
    
    public function tambahRiwayatPenyakit(Lansia $lansia, Request $request)
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
