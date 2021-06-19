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

class PemberianImunisasiController extends Controller
{

    public function imunisasiLansia(Lansia $lansia, Request $request)
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
}
