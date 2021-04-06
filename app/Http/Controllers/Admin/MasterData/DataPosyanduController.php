<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;

class DataPosyanduController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //Dari sini di pindah ke controller ProfilePosyanduController
    public function profilePosyandu()
    {
        $headAdmin = Pegawai::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('jabatan', 'head admin')->get();
        $kecamatan = Kecamatan::where('id', Auth::guard('admin')->user()->pegawai->posyandu->desa->id_kecamatan)->first();
        $kabupaten = Kabupaten::where('id', $kecamatan->id_kabupaten)->first();
        $cntAdmin = Pegawai::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('jabatan', 'admin')->get();
        $cntKader = Pegawai::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('jabatan', 'kader')->get();
        $cntNakes = Pegawai::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('jabatan', 'tenaga kesehatan')->get();


        Carbon::setLocale('id');
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

        // Upcoming Event Checking
        $nextKegiatan = Kegiatan::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('start_at', '>', $today)->get();

        // Ended Event Checking
        $lastKegiatan = Kegiatan::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();

        // In progres Event Checking
        $currentKegiatan = Kegiatan::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('end_at', '>', $today)->get();

        return view("pages/admin/master-data/profile-posyandu", compact('headAdmin', 'kecamatan', 'kabupaten', 'cntAdmin', 'cntKader', 'cntNakes', 'nextKegiatan', 'lastKegiatan', 'currentKegiatan'));
    }

    public function editProfilePosyandu(Posyandu $posyandu)
    {
        $dataPosyandu = Posyandu::where('id', $posyandu->id)->first();

        // $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->get();

        $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->where( function ($q) {
            $q->where('jabatan', 'admin')->orWhere('jabatan', 'tenaga kesehatan');
        })->get();

        return view("pages/admin/master-data/edit-profile-posyandu", compact('dataPosyandu', 'pegawai'));
    }

    public function updateProfilePosyandu(Posyandu $posyandu, Request $request)
    {
        if ($request->telp == $posyandu->nomor_telepon) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:27",
                'banjar' => "required|regex:/^[a-z ]+$/i|min:3",
                'telp' => "required|numeric|digits_between:10,15",
                'alamat' => "required|regex:/^[a-z0-9 ,.]+$/i|min:7",
                'lat' => "required|regex:/^[0-9.-]+$/i|min:3",
                'lng' => "required|regex:/^[0-9.-]+$/i|min:3"
            ],
            [
                'nama.required' => "Nama Posyandu wajib diisi",
                'nama.regex' => "Format penamaan posyandu tidak sesuai",
                'nama.min' => "Nama posyandu minimal 2 huruf",
                'nama.max' => "Nama posyandu maksimal 27 huruf",
                'banjar.required' => "Banjar wajib diisi",
                'banjar.regex' => "Format nama banjar tidak sesuai",
                'banjar.min' => "Nama banjar minimal 3 huruf",
                'telp.numeric' => "Nomor telepon posyandu harus berupa angka",
                'telp.digits_between' => "Nomor telp posyandu harus berjumlah 10 sampai 15 digit",
                'alamat.required' => "Alamat posyandu wajib diisi",
                'alamat.regex' => "Format alamat posyandu tidak sesuai",
                'alamat.min' => "Alamat posyandu minimal 7 karakter",
                'lat.required' => "Koordinat Latitude posyandu wajib diisi",
                'lat.regex' => "Format koordinat Latitude posyandu tidak sesuai",
                'lat.min' => "Koordinat Latitude minimal berjumlah 3 karakter",
                'lng.required' => "Koordinat Longitude posyandu wajib diisi",
                'lng.regex' => "Format koordinat Longitude posyandu tidak sesuai",
                'lng.min' => "Koordinat Latitude minimal berjumlah 3 karakter",
            ]);
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:27",
                'banjar' => "required|regex:/^[a-z ]+$/i|min:3",
                'telp' => "required|numeric|unique:tb_posyandu,nomor_telepon|digits_between:10,15",
                'alamat' => "required|regex:/^[a-z0-9 ,.]+$/i|min:7",
                'lat' => "required|regex:/^[0-9.-]+$/i|min:3",
                'lng' => "required|regex:/^[0-9.-]+$/i|min:3"
            ],
            [
                'nama.required' => "Nama Posyandu wajib diisi",
                'nama.regex' => "Format penamaan posyandu tidak sesuai",
                'nama.min' => "Nama posyandu minimal 2 huruf",
                'nama.max' => "Nama posyandu maksimal 27 huruf",
                'banjar.required' => "Banjar wajib diisi",
                'banjar.regex' => "Format nama banjar tidak sesuai",
                'banjar.min' => "Nama banjar minimal 3 huruf",
                'telp.numeric' => "Nomor telepon posyandu harus berupa angka",
                'telp.unique' => "Nomor telepon posyandu sudah digunakan",
                'telp.digits_between' => "Nomor telp posyandu harus berjumlah 10 sampai 15 digit",
                'alamat.required' => "Alamat posyandu wajib diisi",
                'alamat.regex' => "Format alamat posyandu tidak sesuai",
                'alamat.min' => "Alamat posyandu minimal 7 karakter",
                'lat.required' => "Koordinat Latitude posyandu wajib diisi",
                'lat.regex' => "Format koordinat Latitude posyandu tidak sesuai",
                'lat.min' => "Koordinat Latitude minimal berjumlah 3 karakter",
                'lng.required' => "Koordinat Longitude posyandu wajib diisi",
                'lng.regex' => "Format koordinat Longitude posyandu tidak sesuai",
                'lng.min' => "Koordinat Latitude minimal berjumlah 3 karakter",
            ]);
        }
        
        $updatePosyandu = Posyandu::where('id', $posyandu->id)->update([
            'nama_posyandu' => $request->nama,
            'banjar' => $request->banjar,
            'nomor_telepon' => $request->telp,
            'alamat' => $request->alamat,
            'latitude' => $request->lat,
            'longitude' => $request->lng
        ]);
        
        if ($updatePosyandu) {
            return redirect()->route('Profile Posyandu')->with(['success' => 'Data Profile Posyandu Berhasil Diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Profile Posyandu Gagal Diubah']);
        }
    }

    public function updateAdminPosyandu(Request $request)
    {
        $request->validate([
            'pegawai' => "required",
            'nik' => "required|numeric|digits:16",
        ],
        [
            'pegawai.required' => "Nama admin/kader/nakes wajin dipilih",
            'nik.required' => "NIK admin/kader/nakes wajib diisi",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
        ]);

        $pegawai = Pegawai::where('id', $request->pegawai)->first();

        if ($request->nik == $pegawai->nik) {
            $data = Pegawai::where('nik', $request->nik)->update([
                'jabatan' => 'disactive'
            ]);
            if ($data) {
                return redirect()->back()->with(['success' => 'Akun '.$pegawai->jabatan.' berhasil di non-aktifkan']);
            } else {
                return redirect()->back()->with(['failed' => 'Akun '.$pegawai->jabatan.' gagal di non-aktifkan']);
            }
        } else {
            return redirect()->back()->with(['failed' => 'NIK '.$pegawai->jabatan.' tidak sesuai']);
        }
    }
}
