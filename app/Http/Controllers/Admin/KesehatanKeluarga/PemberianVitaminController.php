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
use App\Vitamin;
use App\PemberianVitamin;
use App\Posyandu;

class PemberianVitaminController extends Controller
{
    public function vitaminIbu(Ibu $ibu, Request $request)
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

    public function vitaminAnak(Anak $anak, Request $request)
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

    public function vitaminLansia(Lansia $lansia, Request $request)
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
}
