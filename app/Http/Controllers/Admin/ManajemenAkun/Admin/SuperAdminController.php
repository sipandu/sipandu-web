<?php

namespace App\Http\Controllers\Admin\ManajemenAkun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mover;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\SuperAdmin;
use App\Admin;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function semuaSuperAdmin()
    {
        $superAdmin = SuperAdmin::get();
        return view('admin.manajemen-akun.admin.super-admin.semua-super-admin', compact('superAdmin'));
    }

    public function tambahSuperAdmin()
    {
        $kabupaten = Kabupaten::get();
        $kecamatan = Kecamatan::get();
        $desa = Desa::get();

        return view('admin.manajemen-akun.admin.super-admin.tambah-super-admin', compact('kabupaten', 'kecamatan', 'desa'));
    }

    public function simpanSuperAdmin(Request $request)
    {
        $this->validate($request,[
            'name' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_admin,email|unique:tb_user,email",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir' => "required|date",
            'gender' => "required",
            'nik' => "required|numeric|unique:tb_pegawai,nik|digits:16",
            'file'=> 'required|image|mimes:jpeg,png,jpg|max:2000',
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i",
            'tlpn' => "nullable|numeric|unique:tb_super_admin,nomor_telepon|digits_between:11,15",
            'kabupaten' => "required",
            'kecamatan' => "required",
            'desa' => "required",
            'area_tugas' => "required",
            'telegram' => "nullable|max:25|unique:tb_super_admin,username_telegram",
            'password' => 'required|min:8',
        ],
        [
            'name.required' => "Nama lengkap wajib diisi",
            'name.regex' => "Format nama tidak sesuai",
            'name.min' => "Nama lengkap minimal berjumlah 2 karakter",
            'name.max' => "Nama lengkap maksimal berjumlah 50 karakter",
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan format email yang sesuai",
            'email.unique' => "Email sudah digunakan",
            'tempat_lahir.required' => "Tampat lahir wajib diisi",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tempat_lahir.min' => "Tempat lahir maksimal berjumlah 50 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berformat tanggal",
            'gender.required' => "Jenis kelamin wajib dipilih",
            'nik.required' => "NIK wajib diisi",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.unique' => "NIK sudah digunakan",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'file.required' => "Upload Scan KTP Wajib diisi",
            'file.image' => "Gambar yang di unggah harus berupa jpeg, png atau,jpg ",
            'file.mimes' => "Format gambar harus jpeg, png atau jpg",
            'file.size' => "Gambar maksimal berukuran 2 Mb",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format alamat tidak sesuai",
            'tlpn.required' => "Nomor telepon wajib diisi",
            'tlpn.numeric' => "Nomor telepon harus berupa angka",
            'tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'tlpn.unique' => "Nomor telepon tidak dapat digunakan",
            'kabupaten.required' => "Kabupaten wajib dipilih",
            'kecamatan.required' => "Kecamatan wajib dipilih",
            'desa.required' => "Desa wajib dipilih",
            'desa.required' => "Area tugas wajib dipilih",
            'telegram.max' => "Username telegram maksimal berjumlah 25 karakter",
            'telegram.unique' => "Username telegram tidak dapat digunakan",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal berjumlah 8 karakter",
        ]);

        // $default_role = ['Lihat Super Admin', 'Lihat Tenaga Kesehatan', 'Lihat Head Admin', 'Lihat Admin', 'Lihat Kader', 'Lihat Anggota', 'Lihat Imunisasi', 'Tambah Imunisasi', 'Ubah Imunisasi', 'Hapus Imunisasi', 'Lihat Vitamin', 'Tambah Vitamin', 'Ubah Vitamin', 'Hapus Vitamin', 'Lihat Tag Berita', 'Tambah Tag Berita', 'Hapus Tag Berita', 'Lihat Hak Akses'];

        $umur = Carbon::parse($request->tgl_lahir)->age;
        if ($umur < 19) {
            return redirect()->back()->with(['error' => 'Tidak dapat menambahkan akun. Usia Tidak Mencukupi']);
        } else {

            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;

            $filename = Mover::slugFile($request->file('file'), 'app/files/ktp/');

            if ($filename) {
                $admin = Admin::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'profile_image' => '/images/upload/Profile/default.jpg',
                    'is_verified' => 1,
                    'role' => 'super admin',
                ]);
            } else {
                return redirect()->back()->with(['failed' => 'Akun Gagal Ditambahkan']);
            }
            
            if ($admin) {
                $super_admin = SuperAdmin::create([
                    'id_admin' => $admin->id,
                    'id_kabupaten' => $request->kabupaten,
                    'id_kecamatan' => $request->kecamatan,
                    'id_desa' => $request->desa,
                    'nama_super_admin' => $request->name,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tgl_lahir,
                    'jenis_kelamin' => $request->gender,
                    'alamat' => $request->alamat,
                    'nomor_telepon' => $request->tlpn,
                    'username_telegram' => $request->telegram,
                    'nik' => $request->nik,
                    'file_ktp' => $filename,
                    'area_tugas' => $request->area_tugas,
                ]);    
            } else {
                return redirect()->back()->with(['failed' => 'Akun Gagal Ditambahkan']);
            }

            // foreach ($default_role as $data => $value) {
            //     $admin_permission = AdminPermission::create([
            //         'id_admin' => $admin->id,
            //         'id_admin' => $admin->id,
            //     ]);
            // }

            if ($filename && $admin && $super_admin) {
                return redirect()->back()->with(['success' => 'Akun Super Admin Berhasil Ditambahkan']);
            } else {
                return redirect()->back()->with(['failed' => 'Akun Gagal Ditambahkan']);
            }
        }
    }

    public function detailSuperAdmin(SuperAdmin $superAdmin)
    {
        return view('admin.manajemen-akun.admin.super-admin.detail-super-admin', compact('superAdmin'));
    }

    public function updateSuperAdmin(Request $request, SuperAdmin $superAdmin)
    {
        if ($superAdmin->nik == $request->nik) {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama wajib diisi",
                'nama.regex' => "Format penulisan nama tidak sesuai",
                'nama.min' => "Nama minimal berjumlah 3 karakter",
                'nama.max' => "Nama maksimal berjumlah 50 karakter",
                'nik.required' => "NIK wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 karakter",
                'tempat_lahir.required' => "Tempat lahir wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);  
        } else {
            $request->validate([
                'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
                'nik' => "required|numeric|digits:16|unique:tb_super_admin,nik",
                'tempat_lahir' => "required|min:3|max:50",
                'tgl_lahir' => "required|date",
            ],
            [
                'nama.required' => "Nama wajib diisi",
                'nama.regex' => "Format penulisan nama tidak sesuai",
                'nama.min' => "Nama minimal berjumlah 3 karakter",
                'nama.max' => "Nama maksimal berjumlah 50 karakter",
                'nik.required' => "NIK wajib diisi",
                'nik.regex' => "NIK harus berupa angka",
                'nik.digits' => "NIK harus berjumlah 16 karakter",
                'nik.unique' => "NIK sudah pernah digunakan",
                'tempat_lahir.required' => "Tempat lahir wajib diisi",
                'tempat_lahir.min' => "Penulisan tempat lahir miniminal berjumlah 3 karakter",
                'tempat_lahir.max' => "Penulisan tempat lahir maksimal berjumlah 50 karakter",
                'tgl_lahir.required' => "Tanggal lahir wajib diisi",
                'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            ]);
        }

        $umur = Carbon::parse($request->tgl_lahir)->age;

        if ($umur < 19) {
            return redirect()->back()->with(['error' => 'Profil Super Admin Gagal Diubah. Usia Tidak Mencukupi']);
        } else {
        
            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;
            
            $update_super_admin = SuperAdmin::where('id', $superAdmin->id)->update([
                'nama_super_admin' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
            ]);
            
            if ($update_super_admin) {
                return redirect()->back()->with(['success' => 'Profil Super Admin Berhasil Diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Profile Super Admin Gagal Diperbaharui']);
            }
        }
    }
}
