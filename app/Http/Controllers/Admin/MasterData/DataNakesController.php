<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Mover;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\Pegawai;
use App\Nakes;
use App\NakesPosyandu;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;

class DataNakesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function listNakes()
    {
        $nakes = Nakes::get();
        $nakesPosyandu = NakesPosyandu::get();

        return view('pages/admin/master-data/data-nakes/data-nakes', compact('nakes', 'nakesPosyandu'));
    }

    public function getImage($id)
    {
        $admin = Admin::where('id', $id)->get()->first();

        if( File::exists(storage_path($admin->profile_image)) ) {
            return response()->file(
                storage_path($admin->profile_image)
            );
        } else {
            return response()->file(
                public_path('images/sipandu-logo.png')
            );
        }

        return redirect()->back();
    }

    public function getImageKTP($id)
    {
        $nakes = Nakes::where('id', $id)->get()->first();

        if( File::exists(storage_path($nakes->file_ktp)) ) {
            return response()->file(
                storage_path($nakes->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }

        return redirect()->back();
    }

    public function detailNakes(Nakes $nakes)
    {
        $dataAdmin = Admin::where('id', $nakes->id_admin)->first();
        $nakesPosyandu = NakesPosyandu::where('id_nakes', $nakes->id)->get();

        return view('pages/admin/master-data/data-nakes/detail-nakes', compact('dataAdmin', 'nakesPosyandu'));
    }

    public function updateNakes(Request $request, Nakes $nakes)
    {
        if ($nakes->nik == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama admin wajib diisi",
                'nama.regex' => "Format penulisan nama admin tidak sesuai",
                'nama.min' => "Nama admin minimal berjumlah 3 huruf",
                'nama.max' => "Nama admin maksimal berjumlah 50 huruf",
                'nik.required' => "NIK admin wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.digits' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir admin wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir admin wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);  
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16|unique:tb_pegawai,nik",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama admin wajib diisi",
                'nama.regex' => "Format penulisan nama admin tidak sesuai",
                'nama.min' => "Nama admin minimal berjumlah 3 huruf",
                'nama.max' => "Nama admin maksimal berjumlah 50 huruf",
                'nik.required' => "NIK admin wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 huruf",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir admin wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir admin wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);
        }

        $umur = Carbon::parse($request->tgl_lahir)->age;

        if ($umur < 19) {
            return redirect()->back()->with(['error' => 'Data Profile Gagal Diubah. Usia Tenaga Kesehatan Tidak Cukup']);
        } else {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;
            
            $updateNakes = Nakes::where('id', $nakes->id)->update([
                'nama_nakes' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
            ]);
            
            if ($updateNakes) {
                return redirect()->back()->with(['success' => 'Data Profile Tenaga Kesehatan Berhasil Diubah']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Profile Tenaga Kesehatan Gagal Diubah']);
            }
        }
    }
}
