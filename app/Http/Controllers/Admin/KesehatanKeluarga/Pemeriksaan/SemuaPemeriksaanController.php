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
                    $ibu = Ibu::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
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
                    $ibu = Ibu::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
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
                $ibu = Ibu::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $anak = Anak::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $lansia = Lansia::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
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

    public function tambahPersalinanIbu(Ibu $ibu, Request $request)
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

    public function tambahAlergi(User $user, Request $request)
    {
        $this->validate($request,[
            'nama_alergi' => "required|min:2|max:50",
            'kategori' => "required",
        ],
        [
            'nama_alergi.required' => "Nama alergi wajib diisi",
            'nama_alergi.min' => "Nama alergi minimal berjumlah 2 huruf",
            'nama_alergi.max' => "Nama alergi maksimal berjumlah 50 huruf",
            'kategori.required' => "Kategori alergi wajib dipilih",
        ]);

        // return($request);

        $alergi = Alergi::create([
            'id_user' => $user->id,
            'nama_alergi' => $request->nama_alergi,
            'kategori' => $request->kategori,
        ]);

        if ($alergi) {
            return redirect()->back()->with(['success' => 'Data Alergi Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Alergi Gagal di Simpan']);
        }
    }

    public function tambahPenyakitBawaan(User $user, Request $request)
    {
        $this->validate($request,[
            'nama_penyakit' => "required|min:3|max:50",
        ],
        [
            'nama_penyakit.required' => "Nama penyakit bawaan wajib diisi",
            'nama_penyakit.min' => "Nama penyakit bawaan minimal berjumlah 3 huruf",
            'nama_penyakit.max' => "Nama penyakit bawaan maksimal berjumlah 50 huruf",
        ]);

        $penyakitBawaan = PenyakitBawaan::create([
            'id_user' => $user->id,
            'nama_penyakit' => $request->nama_penyakit,
        ]);

        if ($penyakitBawaan) {
            return redirect()->back()->with(['success' => 'Data Penyakit Bawaan Berhasil di Simpan']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Penyakit Bawaan Gagal di Simpan']);
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
