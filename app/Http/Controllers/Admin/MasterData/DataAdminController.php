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
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;

class DataAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function listAdmin()
    {
        if (auth()->guard('admin')->user()->role == 'pegawai') {
            // $idPosyandu = auth()->guard('admin')->user()->pegawai->id_posyandu;
            $admin = Pegawai::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('jabatan', 'admin')->orderBy('id', 'desc')->get();
        } else {
            $admin = NULL;
        }
        $adminAll = Pegawai::orWhere('jabatan', 'admin')->orWhere('jabatan', 'head admin')->orWhere('jabatan', 'super admin')->orderBy('id', 'desc')->get();

        return view('pages/admin/master-data/data-admin/data-admin', compact('admin', 'adminAll'));
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
        $pegawai = Pegawai::where('id', $id)->get()->first();

        if( File::exists(storage_path($pegawai->file_ktp)) ) {
            return response()->file(
                storage_path($pegawai->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }

        return redirect()->back();
    }

    public function detailAdmin(Pegawai $pegawai)
    {
        $dataPegawai = Pegawai::where('id', $pegawai->id)->first();
        $dataAdmin = Admin::where('id', $dataPegawai->id_admin)->first();

        return view('pages/admin/master-data/data-admin/detail-admin', compact('dataAdmin'));
    }
    
    public function updateAdmin(Request $request, Pegawai $pegawai)
    {
        if ($pegawai->nik == $request->nik) {
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
                'nik.unique' => "NIK sudah pernah digunakan",
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
            return redirect()->back()->with(['error' => 'Posyandu Baru Gagal Ditambahkan']);
        } else {
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;
            
            $updateAdmin = Pegawai::where('id', $pegawai->id)->update([
                'nama_pegawai' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
            ]);
            
            if ($updateAdmin) {
                return redirect()->back()->with(['success' => 'Data profile admin berhasil diubah']);
            } else {
                return redirect()->back()->with(['failed' => 'Data profile admin gagal diubah']);
            }
        }

    }
}
