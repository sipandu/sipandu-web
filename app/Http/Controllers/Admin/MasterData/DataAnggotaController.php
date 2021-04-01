<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\User;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;
use App\Ibu;
use App\Anak;
use App\Lansia;

class DataAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function listAnggota()
    {
        $anak = Anak::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
        $ibu = Ibu::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
        $lansia = Lansia::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();

        return view('pages/admin/master-data/data-anggota/data-anggota', compact('anak', 'ibu', 'lansia'));
    }

    public function detailAnggotaIbu(Ibu $ibu)
    {
        $dataIbu = Ibu::where('id', $ibu->id)->first();
        $dataUser = User::where('id', $dataIbu->id_user)->first();

        return view('pages/admin/master-data/data-anggota/detail-anggota-ibu', compact('dataUser'));
    }

    public function detailAnggotaAnak(Anak $anak)
    {
        $dataAnak = Anak::where('id', $anak->id)->first();
        $dataUser = User::where('id', $dataAnak->id_user)->first();

        return view('pages/admin/master-data/data-anggota/detail-anggota-anak', compact('dataUser'));
    }

    public function detailAnggotaLansia(Lansia $lansia)
    {
        $dataLansia = Lansia::where('id', $lansia->id)->first();
        $dataUser = User::where('id', $dataLansia->id_user)->first();

        return view('pages/admin/master-data/data-anggota/detail-anggota-lansia', compact('dataUser'));
    }

    public function updateAnggotaIbu(Request $request, Ibu $ibu)
    {
        if ($ibu->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama ibu wajib diisi",
                'nama.regex' => "Format penulisan nama ibu tidak sesuai",
                'nama.min' => "Nama ibu minimal berjumlah 3 huruf",
                'nama.max' => "Nama ibu maksimal berjumlah 50 huruf",
                'nik.required' => "NIK ibu wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir ibu wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir ibu wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);  
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16|unique:tb_ibu_hamil,NIK",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama ibu wajib diisi",
                'nama.regex' => "Format penulisan nama ibu tidak sesuai",
                'nama.min' => "Nama ibu minimal berjumlah 3 huruf",
                'nama.max' => "Nama ibu maksimal berjumlah 50 huruf",
                'nik.required' => "NIK ibu wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir ibu wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir ibu wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);
        }

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;
        
        $updateUser = Ibu::where('id', $ibu->id)->update([
            'nama_ibu_hamil' => $request->nama,
            'NIK' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
        ]);
        
        if ($updateUser) {
            return redirect()->back()->with(['success' => 'Data profile ibu hamil berhasil diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Data profile ibu hamil gagal diubah']);
        }
    }

    public function updateAnggotaAnak(Request $request, Anak $anak)
    {
        if ($anak->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama anak wajib diisi",
                'nama.regex' => "Format penulisan nama anak tidak sesuai",
                'nama.min' => "Nama anak minimal berjumlah 3 huruf",
                'nama.max' => "Nama anak maksimal berjumlah 50 huruf",
                'nik.required' => "NIK anak wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir anak wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir anak wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);  
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16|unique:tb_anak,NIK",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama anak wajib diisi",
                'nama.regex' => "Format penulisan nama anak tidak sesuai",
                'nama.min' => "Nama anak minimal berjumlah 3 huruf",
                'nama.max' => "Nama anak maksimal berjumlah 50 huruf",
                'nik.required' => "NIK anak wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir anak wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir anak wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);
        }

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;
        
        $updateUser = Anak::where('id', $anak->id)->update([
            'nama_anak' => $request->nama,
            'NIK' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
        ]);
        
        if ($updateUser) {
            return redirect()->back()->with(['success' => 'Data profile anak berhasil diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Data profile anak gagal diubah']);
        }
    }

    public function updateAnggotaLansia(Request $request, Lansia $lansia)
    {
        if ($lansia->NIK == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama lansia wajib diisi",
                'nama.regex' => "Format penulisan nama lansia tidak sesuai",
                'nama.min' => "Nama lansia minimal berjumlah 3 huruf",
                'nama.max' => "Nama lansia maksimal berjumlah 50 huruf",
                'nik.required' => "NIK lansia wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir lansia wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir lansia wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);  
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16|unique:tb_lansia,NIK",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama ibu wajib diisi",
                'nama.regex' => "Format penulisan nama ibu tidak sesuai",
                'nama.min' => "Nama ibu minimal berjumlah 3 huruf",
                'nama.max' => "Nama ibu maksimal berjumlah 50 huruf",
                'nik.required' => "NIK ibu wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir ibu wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir ibu wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);
        }

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;
        
        $updateUser = Lansia::where('id', $lansia->id)->update([
            'nama_lansia' => $request->nama,
            'NIK' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
        ]);
        
        if ($updateUser) {
            return redirect()->back()->with(['success' => 'Data profile lansia berhasil diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Data profile lansia gagal diubah']);
        }
    }
}
