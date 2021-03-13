<?php

namespace App\Http\Controllers;
use App\Posyandu;
use App\Admin;
use App\Pegawai;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function listPosyandu()
    {
        $posyandu = Posyandu::with('pegawai')->orderBy('nama_posyandu', 'asc')->get();
        $admin = Admin::with('pegawai')->get();
        $pegawai = Pegawai::where('jabatan', 'admin')->get();

        return view('pages/admin/master-data/data-posyandu', compact('posyandu', 'pegawai', 'admin'));
    }

    public function addPosyandu()
    {
        $kabupaten = Kabupaten::get();
        $kecamatan = Kecamatan::get();
        $desa = Desa::get();

        return view('pages/admin/master-data/new-posyandu', compact('kabupaten', 'kecamatan', 'desa'));
    }

    public function storePosyandu(Request $request)
    {
        $this->validate($request,[
            'nama_posyandu' => "required|regex:/^[a-z ]+$/i|min:2|max:27",
            'kabupaten' => 'required|exists:Kabupaten,nama_kabupaten',
            'kecamatan' => 'required|exists:Kecamatan,nama_kecamatan',
            'desa' => 'required|exists:Desa,nama_desa',
            'banjar' => "required|regex:/^[a-z ]+$/i|min:3",
            'alamat_posyandu' => "required|regex:/^[a-z ,.]+$/i|min:7",
            'lat' => "required|regex:/^[0-9.-]+$/i|min:5",
            'lng' => "required|regex:/^[0-9.-]+$/i|min:5",
            'nama_pegawai' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'gender' => "required",
            'nik' => "required|numeric|unique:Pegawai,nik|digits:16",
            'email' => "required|email|unique:Admin,email",
            'telp' => "required|numeric|between:12,15",
            'telegram' => "nullable|min:3|unique:Pegawai,username_telegram",
            'alamat_pegawai' => "required|regex:/^[a-z .,0-9]+$/i|min:7",
            'password' => 'required|min:8|max:50|confirmed'
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
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'gender.required' => "Jenis kelamin wajib dipilih",
            'nik.required' => "NIK wajib diisi",
            'nik.numeric' => "NIK telah digunakan sebelumnya",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'email.required' => "Email pegawai wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.unique' => "Email telah digunakan sebelumnya",
            'telp.required' => "Nomor telp pegawai wajib diisi",
            'telp.numeric' => "Nomor telp pegawai harus berupa angka",
            'telp.between' => "Nomor telp harus berjumlah 12 sampai 15 karakter",
            'telegram.min' => "Username telegram terlalu pendek",
            'telegram.unique' => "Username telegram sudah digunakan",
            'alamat_pegawai.required' => "Alamat pegawai wajib diisi",
            'alamat_pegawai.regex' => "Format alamat pegawai tidak sesuai",
            'alamat_pegawai.min' => "Alamat pegawai minimal 7 karakter",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai"
        ]);

        // Validate Password
        // $this->validate([
        //     'last_password' => "required|min:6",
        //     'password' => 'required|confirmed|min:6'
        // ]);

        // $admin = Admin::where('id', $this->adminID)->get()->first();

        // if (Hash::check($this->last_password, $admin->password)) {
        //     Admin::where('id', $this->adminID)->update([
        //         'password' => bcrypt($this->password)
        //     ]);

        //     $this->clearModal();

        //     session()->flash('messageSuccess', 'Password anda berhasil di ubah');

        // } else{
        //     session()->flash('messageFailed', 'Password lama anda tidak sesuai');
        // }

        $admin = Admin::create([
            'email' => $request->email,
            'password' => $request->password,
            'profile_image' => "profile123",
            'is_verified' => "1"
        ]);

        $desa = Desa::where('nama_desa', $request->desa)->get()->first();

        $posyandu = Posyandu::create([
            'id_desa' => $desa->id,
            'id_admin' => $admin->id,
            'id_chat_group_tele' => 1234,
            'nama_posyandu' => $request->nama_posyandu,
            'alamat' => $request->alamat_posyandu,
            'nomor_telepon' => $request->telp,
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

        Pegawai::create([
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
            'file_ktp' => "qqsda134"
        ]);

        return redirect()->route("Data Posyandu");
    }

    public function detailPosyandu(Posyandu $posyandu)
    {
        $dataPosyandu = Posyandu::with('pegawai')->where('id', $posyandu->id)->get();
        $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->get();
        // $admin = Admin::with('pegawai')->get();

        return view('pages/admin/master-data/detail-posyandu', compact('dataPosyandu', 'pegawai'));
        return $dataPosyandu;
    }
}
