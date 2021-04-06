<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;

class MasterPosyanduController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function listPosyandu()
    {
        // $admin = Admin::with('pegawai')->get();
        $posyandu = Posyandu::with('pegawai')->orderBy('nama_posyandu', 'asc')->get();
        $pegawai = Pegawai::orWhere('jabatan', 'admin')->orWhere('jabatan', 'head admin')->get();

        return view('pages/admin/master-data/data-posyandu/data-posyandu', compact('posyandu', 'pegawai'));
    }

    public function addPosyandu()
    {
        $kabupaten = Kabupaten::get();
        $kecamatan = Kecamatan::get();
        $desa = Desa::get();

        return view('pages/admin/master-data/data-posyandu/new-posyandu', compact('kabupaten', 'kecamatan', 'desa'));
    }

    public function storePosyandu(Request $request)
    {
        $this->validate($request,[
            'nama_posyandu' => "required|regex:/^[a-z ]+$/i|min:2|max:27",
            'kabupaten' => 'required|exists:tb_kabupaten,id',
            'kecamatan' => 'required|exists:tb_kecamatan,id',
            'desa' => 'required|exists:tb_desa,id',
            'banjar' => "required|regex:/^[a-z ]+$/i|min:3",
            'telp_posyandu' => "required|nullable|numeric|digits_between:10,15|unique:tb_posyandu,nomor_telepon",
            'alamat_posyandu' => "required|regex:/^[a-z .,0-9]+$/i|min:7",
            'lat' => "required|regex:/^[0-9.-]+$/i|min:5",
            'lng' => "required|regex:/^[0-9.-]+$/i|min:5",
            'nama_pegawai' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'gender' => "required",
            'nik' => "required|numeric|unique:tb_pegawai,nik|digits:16",
            'file_ktp'=> 'required|image|mimes:jpeg,png,jpg',
            'email' => "required|email|unique:tb_admin,email",
            'telp_pegawai' => "nullable|numeric|digits_between:12,15|unique:tb_pegawai,nomor_telepon",
            'telegram' => "nullable|min:3|unique:tb_pegawai,username_telegram",
            'alamat_pegawai' => "required|regex:/^[a-z .,0-9]+$/i|min:7",
            'password' => 'required|min:8|max:50|confirmed',
            'passwordAdmin' => 'required|min:8|max:50',
        ],
        [
            'nama_posyandu.required' => "Nama Posyandu wajib diisi",
            'nama_posyandu.regex' => "Format penamaan posyandu tidak sesuai",
            'nama_posyandu.min' => "Nama posyandu minimal 2 huruf",
            'nama_posyandu.max' => "Nama posyandu maksimal 27 huruf",
            'kabupaten.required' => "Kabupaten wajib diisi",
            'kabupaten.exists' => "Kabupaten yang dimasukan tidak tersedia",
            'kecamatan.required' => "Kecamatan wajib diisi",
            'kecamatan.exists' => "Kecamatan yang dimasukan tidak tersedia",
            'desa.required' => "Desa wajib diisi",
            'desa.exists' => "Desa yang dimasukan tidak tersedia",
            'banjar.required' => "Banjar wajib diisi",
            'banjar.regex' => "Format nama banjar tidak sesuai",
            'banjar.min' => "Nama banjar minimal 3 huruf",
            'telp_posyandu.required' => "Nomor telepon posyandu wajib diisi",
            'telp_posyandu.numeric' => "Nomor telepon posyandu harus berupa angka",
            'telp_posyandu.digits_between' => "Nomor telepon posyandu harus berjumlah 10 sampai 15 digit",
            'telp_posyandu.unique' => "Nomor telepon posyandu sudah digunakan",
            'alamat_posyandu.required' => "Alamat posyandu wajib diisi",
            'alamat_posyandu.regex' => "Format alamat posyandu tidak sesuai",
            'alamat_posyandu.min' => "Alamat posyandu minimal 7 karakter",
            'lat.required' => "Koordinat Latitude posyandu wajib diisi",
            'lat.regex' => "Format koordinat Latitude posyandu tidak sesuai",
            'lng.required' => "Koordinat Longitude posyandu wajib diisi",
            'lng.regex' => "Format koordinat Longitude posyandu tidak sesuai",
            'nama_pegawai.required' => "Nama pegawai wajib diisi",
            'nama_pegawai.regex' => "Format nama pegawai tidak sesuai",
            'nama_pegawai.min' => "Nama pegawai minimal 2 karakter",
            'nama_pegawai.max' => "Nama pegawai maksimal 50 karakter",
            'tempat_lahir.required' => "Tempat lahir wajib diisi",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'gender.required' => "Jenis kelamin wajib dipilih",
            'nik.required' => "NIK wajib diisi",
            'nik.numeric' => "NIK telah digunakan sebelumnya",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'file_ktp.required' => "Silahkan masukan Scan KTP",
            'file_ktp.image' => "Scan KTP harus berupa foto",
            'file_ktp.mimes' => "Format Scan KTP harus jpeg, png atau jpg",
            'email.required' => "Email pegawai wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.unique' => "Email telah digunakan sebelumnya",
            'telp_pegawai.numeric' => "Nomor telepon pegawai harus berupa angka",
            'telp_pegawai.digits_between' => "Nomor telepon harus berjumlah 12 sampai 15 digit",
            'telp_pegawai.unique' => "Nomor telepon sudah pernah digunakan",
            'telegram.min' => "Username telegram terlalu pendek",
            'telegram.unique' => "Username telegram sudah digunakan",
            'alamat_pegawai.required' => "Alamat pegawai wajib diisi",
            'alamat_pegawai.regex' => "Format alamat pegawai tidak sesuai",
            'alamat_pegawai.min' => "Alamat pegawai minimal 7 karakter",
            'passwordAdmin.required' => "Password akun anda wajib diisi",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai"
        ]);

        if (Hash::check($request->passwordAdmin, auth()->guard('admin')->user()->password)) {
            $admin = Admin::create([
                'email' => $request->email,
                'password' => $request->password,
                'profile_image' => "/images/upload/Profile/default.jpg",
                'is_verified' => "1"
            ]);

            $desa = Desa::where('nama_desa', $request->desa)->get()->first();
    
            $posyandu = Posyandu::create([
                'id_desa' => $request->desa,
                'id_chat_group_tele' => NULL,
                'nama_posyandu' => $request->nama_posyandu,
                'alamat' => $request->alamat_posyandu,
                'nomor_telepon' => $request->telp_posyandu,
                'banjar' => $request->banjar,
                'latitude' => $request->lat,
                'longitude' => $request->lng
            ]);
    
            $tgl_lahir_indo = $request->tgl_lahir;
            $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
            $tahun = $tgl_lahir_eng[2];
            $bulan = $tgl_lahir_eng[1];
            $tgl = $tgl_lahir_eng[0];
            $tgl_lahir = $tahun.$bulan.$tgl;

            $path ='/images/upload/KTP/'.time().'-'.$request->file_ktp->getClientOriginalName();
            $imageName = time().'-'.$request->file_ktp->getClientOriginalName();
    
            $pegawai = Pegawai::create([
                'id_posyandu' => $posyandu->id,
                'id_admin' => $admin->id,
                'nama_pegawai' => $request->nama_pegawai,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
                'jenis_kelamin' => $request->gender,
                'alamat' => $request->alamat_pegawai,
                'nomor_telepon' => $request->no_telp,
                'jabatan' => "admin",
                'username_telegram' => $request->telegram,
                'nik' => $request->nik,
                'file_ktp' => $path,
            ]);

            if ($admin && $posyandu && $pegawai) {
                return redirect()->back()->with(['success' => 'Posyandu Baru Berhasil Ditambahkan']);
            } else {
                return redirect()->back()->with(['failed' => 'Posyandu Gagal Ditambahkan']);
            }
        } else {
            return redirect()->back()->with(['failed' => 'Konfirmasi Password Anda Tidak Sesuai. Silahkan Masukan Password Akun Anda!']);
        }

        //     $this->clearModal();

        //     session()->flash('messageSuccess', 'Password anda berhasil di ubah');

        // } else{
        //     session()->flash('messageFailed', 'Password lama anda tidak sesuai');
        // }


    }

    public function detailPosyandu(Posyandu $posyandu)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

        $dataPosyandu = Posyandu::with('pegawai')->where('id', $posyandu->id)->get();
        $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->get();

        // Upcoming Event Checking
        $nextKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '>', $today)->get();

        // Ended Event Checking
        $lastKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('end_at', '<', $today)->get();

        // In progres Event Checking
        $currentKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '<', $today)->where('end_at', '>', $today)->get();

        $headAdmin = Pegawai::where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->where('jabatan', 'head admin')->get();

        return view('pages/admin/master-data/data-posyandu/detail-posyandu', compact(
            'dataPosyandu', 'pegawai', 'nextKegiatan', 'lastKegiatan', 'currentKegiatan', 'headAdmin'
        ));
        // return $kegiatanPosyandu;
    }

    public function editPosyandu(Posyandu $posyandu)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

        $dataPosyandu = Posyandu::with('pegawai')->where('id', $posyandu->id)->get();
        // $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->orWhere->get();
        $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->where( function ($q) {
            $q->where('jabatan', 'kader')->orWhere('jabatan', 'tenaga kesehatan')->orWhere('jabatan', 'admin')->orWhere('jabatan', 'head admin');
        })->orderBy('id', 'desc')->get();

        // Upcoming Event Checking
        $nextKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '>', $today)->get();

        // Ended Event Checking
        $lastKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('end_at', '<', $today)->get();

        // In progres Event Checking
        $currentKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '<', $today)->where('end_at', '>', $today)->get();

        return view('pages/admin/master-data/data-posyandu/edit-posyandu', compact(
            'dataPosyandu', 'pegawai', 'nextKegiatan', 'lastKegiatan', 'currentKegiatan'
        ));
        // return $kegiatanPosyandu;
    }

    public function updatePosyandu(Request $request, Posyandu $posyandu)
    {
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
            'nama.min' => "Nama posyandu minimal berjumlah 2 huruf",
            'nama.max' => "Nama posyandu maksimal berjumlah 27 huruf",
            'banjar.required' => "Banjar wajib diisi",
            'banjar.regex' => "Format nama banjar tidak sesuai",
            'banjar.min' => "Nama banjar minimal berjumlah 3 huruf",
            'telp.numeric' => "Nomor telepon posyandu harus berupa angka",
            'telp.digits_between' => "Nomor telp posyandu harus berjumlah 10 sampai 15 digit",
            'alamat.required' => "Alamat posyandu wajib diisi",
            'alamat.regex' => "Format alamat posyandu tidak sesuai",
            'alamat.min' => "Alamat posyandu minimal berjumlah 7 karakter",
            'lat.required' => "Koordinat Latitude posyandu wajib diisi",
            'lat.min' => "Koordinat Latitude minimal berjumlah 3 karakter",
            'lat.regex' => "Format koordinat Latitude posyandu tidak sesuai",
            'lng.required' => "Koordinat Longitude posyandu wajib diisi",
            'lng.min' => "Koordinat Longitude minimal berjumlah 3 karakter",
            'lng.regex' => "Format koordinat Longitude posyandu tidak sesuai",
        ]);

        $data = Posyandu::where('id', $posyandu->id)->update([
            'nama_posyandu' => $request->nama,
            'banjar' => $request->banjar,
            'nomor_telepon' => $request->telp,
            'alamat' => $request->alamat,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
        ]);

        if ($data) {
            return redirect()->route('Detail Posyandu', [$posyandu->id])->with(['success' => 'Data profile '.$posyandu->nama_posyandu.' berhasil diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Data profile '.$request->nama.' gagal diubah']);
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
