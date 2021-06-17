<?php

namespace App\Http\Controllers\Admin\ManajemenAkun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mover;
use App\Admin;
use App\Nakes;
use App\NakesPosyandu;
use App\Posyandu;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;

class NakesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function semuaNakes()
    {
        if (auth()->guard('admin')->user()->role == 'super admin') {

            if(auth()->guard('admin')->user()->superAdmin->area_tugas == 'Provinsi'){
                $nakes = Nakes::get();
                if ( count($nakes) > 0 ) {
                    $nakes_id = Nakes::select('id')->get();
                    $nakesPosyandu = NakesPosyandu::whereIn('id_nakes', $nakes_id->toArray())->get();
                } else {
                    $nakes = NULL;
                    $nakesPosyandu = NULL;
                }
                
            } elseif (auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kabupaten') {

                $id_kecamatan = Kecamatan::where('id_kabupaten', auth()->guard('admin')->user()->superAdmin->id_kabupaten)->select('id')->get();
                $id_desa = Desa::whereIn('id_kecamatan', $id_kecamatan->toArray())->select('id')->get();
                $id_posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->select('id')->get();

                if ( count($id_posyandu) > 0 ) {
                    $id_all_nakes = NakesPosyandu::whereIn('id_posyandu', $id_posyandu->toArray())->select('id_nakes')->get();
                    if ( count($id_all_nakes) > 0) {
                        $nakes = Nakes::whereIn('id', $id_all_nakes)->get();
                        $nakes_id = Nakes::whereIn('id', $id_all_nakes)->select('id')->get();
                        if ( count($nakes_id) > 0 ) {
                            $nakesPosyandu = NakesPosyandu::whereIn('id_nakes', $nakes_id->toArray())->get();
                        } else {
                            $nakes = NULL;
                            $nakesPosyandu = NULL;
                        }
                        
                    } else {
                        $nakes = NULL;
                        $nakesPosyandu = NULL;
                    }
                } else {
                    $nakes = NULL;
                    $nakesPosyandu = NULL;
                }

            } elseif (auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kecamatan') {
                
                $id_desa = Desa::where('id_kecamatan', auth()->guard('admin')->user()->superAdmin->id_kecamatan)->select('id')->get();
                $id_posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->select('id')->get();

                if ( count($id_posyandu) > 0 ) {
                    $id_all_nakes = NakesPosyandu::whereIn('id_posyandu', $id_posyandu->toArray())->select('id_nakes')->get();
                    if ( count($id_all_nakes) > 0) {
                        $nakes = Nakes::whereIn('id', $id_all_nakes)->get();
                        $nakes_id = Nakes::whereIn('id', $id_all_nakes)->select('id')->get();
                        if ( count($nakes_id) > 0 ) {
                            $nakesPosyandu = NakesPosyandu::whereIn('id_nakes', $nakes_id->toArray())->get();
                        } else {
                            $nakes = NULL;
                            $nakesPosyandu = NULL;
                        }
                    } else {
                        $nakes = NULL;
                        $nakesPosyandu = NULL;
                    }
                } else {
                    $nakes = NULL;
                    $nakesPosyandu = NULL;
                }
            }
        } elseif (auth()->guard('admin')->user()->role == 'tenaga kesehatan') {
            
            $id_posyandu = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $id_all_nakes = NakesPosyandu::whereIn('id_posyandu', $id_posyandu->toArray())->select('id_nakes')->get();
            
            $nakes = Nakes::whereIn('id', $id_all_nakes->toArray())->get();
            $nakes_id = Nakes::whereIn('id', $id_all_nakes)->select('id')->get();
            $nakesPosyandu = NakesPosyandu::whereIn('id_nakes', $nakes_id->toArray())->get();
            
        } elseif (auth()->guard('admin')->user()->role == 'pegawai') {
            $nakes_id = NakesPosyandu::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->select('id_nakes')->get();
            $nakes = Nakes::whereIn('id', $nakes_id->toArray())->get();
            $nakesPosyandu = NakesPosyandu::whereIn('id_nakes', $nakes_id->toArray())->get();
        }

        return view('admin.manajemen-akun.admin.nakes.semua-nakes', compact('nakes', 'nakesPosyandu'));
    }

    public function tambahNakes()
    {
        if (auth()->guard('admin')->user()->role == 'super admin') {
            if (auth()->guard('admin')->user()->superAdmin->area_tugas == 'Provinsi') {
                $posyandu = Posyandu::all();
            } elseif (auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kabupaten') {
                $id_kecamatan = Kecamatan::where('id_kabupaten', auth()->guard('admin')->user()->superAdmin->id_kabupaten)->select('id')->get();
                $id_desa = Desa::whereIn('id_kecamatan', $id_kecamatan->toArray())->select('id')->get();

                $posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->get();
            } elseif (auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kecamatan') {
                $id_desa = Desa::where('id_kecamatan', auth()->guard('admin')->user()->superAdmin->id_kecamatan)->select('id')->get();
                $posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->get();
            }
        } elseif (auth()->guard('admin')->user()->role == 'tenaga kesehatan') {
            $id_posyandu = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $posyandu = Posyandu::whereIn('id', $id_posyandu)->get();
        } elseif (auth()->guard('admin')->user()->role == 'pegawai') {
            $posyandu = Posyandu::where('id', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
        }

        return view('admin.manajemen-akun.admin.nakes.tambah-nakes', compact('posyandu'));
    }

    public function simpanNakes(Request $request)
    {
        $this->validate($request,[
            'name' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_admin,email",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir' => "required|date",
            'gender' => "required",
            'nik' => "required|numeric|unique:tb_pegawai,nik|digits:16",
            'file'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i",
            'tlpn' => "nullable|numeric|unique:tb_nakes,nomor_telepon|digits_between:11,15",
            'lokasi_posyandu' => "required",
            'telegram' => "nullable|max:25|unique:tb_nakes,username_telegram",
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
            'gender.required' => "Jenis kelamin wajib diisi",
            'nik.required' => "NIK wajib diisi",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.unique' => "NIK sudah digunakan",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'file.required' => "Upload scan KTP wajib diisi",
            'file.image' => "Gambar yang di unggah harus berupa jpeg, png atau jpg ",
            'file.mimes' => "Format gambar harus jpeg png atau jpg",
            'file.size' => "Gambar maksimal berukuran 2 Mb",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format alamat tidak sesuai",
            'jabatan.required' => "Jabatan wajib diiisi",
            'tlpn.required' => "Nomor telepon wajib diisi",
            'tlpn.numeric' => "Nomor telepon harus berupa angka",
            'tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'lokasi_posyandu.required' => "Posyandu tempat bertugas wajib diisi",
            'telegram.max' => "Username telegram maksimal berjumlah 25 karakter",
            'telegram.unique' => "Username telegram pernah digunakan",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
        ]);

        $umur = Carbon::parse($request->tgl_lahir)->age;
        if ($umur < 19) {
            return redirect()->back()->with(['error' => 'Tidak Dapat Menambahkan Akun. Usia Tidak Mencukupi']);
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
                    'role' => 'tenaga kesehatan',
                ]);
            } else {
                return redirect()->back()->with(['failed' => 'Akun Gagal Ditambahkan']);
            }

            if ($admin) {
                $nakes = Nakes::create([
                    'id_admin' => $admin->id,
                    'nama_nakes' => $request->name,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $tgl_lahir,
                    'jenis_kelamin' => $request->gender,
                    'alamat' => $request->alamat,
                    'jabatan' => 'tenaga kesehatan',
                    'nomor_telepon' => $request->tlpn,
                    'username_telegram' => $request->telegram,
                    'nik' => $request->nik,
                    'file_ktp' => $filename,
                ]);
            } else {
                return redirect()->back()->with(['failed' => 'Akun Gagal Ditambahkan']);
            }

            if ($nakes) {
                foreach ($request->lokasi_posyandu as $data => $value) {
                    $nakesPosyandu = NakesPosyandu::create([
                        'id_posyandu' => $request->lokasi_posyandu[$data],
                        'id_nakes' => $nakes->id,
                    ]);
                }
            } else {
                return redirect()->back()->with(['failed' => 'Akun Gagal Ditambahkan']);
            }
            
            if ($filename && $admin && $nakes && $nakesPosyandu) {
                return redirect()->back()->with(['success' => 'Akun Tenaga Kesehatan Berhasil Ditambahkan']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Akun Gagal Ditambahkan']);
            }
        }
    }

    public function detailNakes(Nakes $nakes)
    {
        $nakesPosyandu = NakesPosyandu::where('id_nakes', $nakes->id)->get();

        return view('admin.manajemen-akun.admin.nakes.detail-nakes', compact('nakes', 'nakesPosyandu'));
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
                'nik' => "required|numeric|digits:16|unique:tb_nakes,nik",
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
            return redirect()->back()->with(['error' => 'Tidak Dapat Memperbaharui Akun. Usia Tidak Mencukupi']);
        } else {

            // Ubah format tanggal //
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;
            
            $update_nakes = Nakes::where('id', $nakes->id)->update([
                'nama_nakes' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
            ]);
            
            if ($update_nakes) {
                return redirect()->back()->with(['success' => 'Profil Nakes Berhasil Diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Profile Nakes Gagal Diperbaharui']);
            }
        }
    }
}
