<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Posyandu;
use App\Pegawai;
use App\Admin;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\KK;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function formAddAdmin(Request $request)
    {
        $posyandu = Posyandu::all();
        return view('pages/auth/admin/new-admin',compact('posyandu'));
    }

    public function formAddUser(Request $request)
    {
        $posyandu = Posyandu::all();
        return view('pages/auth/admin/new-user', compact('posyandu'));
    }

    public function formAddKader(Request $request)
    {
        $posyandu = Posyandu::all();
        return view('pages/auth/admin/new-kader',compact('posyandu'));
    }

    public function storeAdmin(Request $request)
    {
        $this->validate($request,[
            'name' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email' => "email|unique:tb_admin,email",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'gender' => "required",
            'nik' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'file'=> 'image|mimes:jpeg,png,jpg',
            'alamat' => "required|regex:/^[a-z .,0-9]+$/i",
            'jabatan' => "required",
            'tlpn' => "required|numeric|unique:tb_lansia,nomor_telepon|digits_between:12,15",
            'lokasi_posyandu' => "required",
            'telegram' => "max:25|unique:tb_pegawai,username_telegram",
            'password' => 'required|min:8|confirmed',
        ],
        [
            'name.required' => "Nama lengkap admin wajib diisi",
            'name.regex' => "Format nama tidak sesuai",
            'name.min' => "Nama lengkap admin minimal 2 karakter",
            'name.max' => "Nama lengkap admin maksimal 50 karakter",
            'email.required' => "Email admin wajib diisi",
            'email.email' => "Masukan Email yang valid",
            'email.unique' => "Email sudah pernah digunakan",
            'tempat_lahir.required' => "Tampat lahir admin wajib diisi",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'gender.required' => "Jenis Kelamin Wajib diisi",
            'nik.required' => "NIK wajib diisi",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.unique' => "NIK sudah pernah digunakan",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'file.image' => "Gambar yang di unggah harus berupa jpeg, png atau,jpg ",
            'alamat.required' => "Alamat admin wajib diisi",
            'alamat.regex' => "Format alamat tidak sesuai",
            'jabatan.required' => "Jabatan admin wajib diiisi",
            'tlpn.required' => "Nomor telepon wajib diisi",
            'tlpn.numeric' => "Nomor telepon harus berupa angka",
            'tlpn.digits_between' => "Nomor telepon harus berjumlah 12 sampai 15 karakter",
            'tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'lokasi_posyandu.required' => "Lokasi Posyandu wajib diisi",
            'telegram.max' => "Masukan Username Telegram maksimal 25 karakter",
            'telegram.unique' => "Username Telegram sudah pernah digunakan",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai",
        ]);

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        $path ='/images/upload/KTP/'.time().'-'.$request->file->getClientOriginalName();
        $imageName = time().'-'.$request->file->getClientOriginalName();

        $request->file->move(public_path('images/upload/KTP'),$imageName);

        $admin = Admin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => '/images/upload/Profile/deafult.jpg',
            'is_verified' => 1,
        ]);

        $pegawai = $admin->pegawai()->create([
            'id_posyandu' => $request->lokasi_posyandu,
            'nama_pegawai' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
            'jenis_kelamin' => $request->gender,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'nomor_telepon' => $request->tlpn,
            'username_telegram' => $request->telegram,
            'nik' => $request->nik,
            'file_ktp' => $path,
        ]);
        return redirect()->back()->with(['success' => 'Akun admin baru berhasil ditambahkan']);
    }

    public function storeUserIbu(Request $request)
    {
        $this->validate($request,[
            'no_kk' =>"required|numeric|digits:16",
            'nama_ibu' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_suami' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'nik' => "required|numeric|unique:tb_ibu_hamil,nik|digits:16",
            'alamat' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'email' => "required|email|unique:tb_user,email",
            'telegram' => "max:25|unique:tb_user,username_tele",
            'no_tlpn' => "required|numeric|unique:tb_ibu_hamil,nomor_telepon",
            'lokasi_posyandu' => "required",
            'password' => 'required|min:8|max:50|confirmed',
        ],
        [
            'no_kk.required' => "Nomor KK wajib diisi",
            'no_kk.numeric' => "Nomor KK harus berupa angka",
            'no_kk.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nama_ibu.required' => "Nama Bumil wajib diisi",
            'nama_ibu.regex' => "Format nama bumil tidak sesuai",
            'nama_ibu.min' => "Nama Bumil minimal 2 karakter",
            'nama_ibu.max' => "Nama Bumil maksimal 50 karakter",
            'nama_suami.required' => "Nama Suami wajib diisi",
            'nama_suami.regex' => "Format nama suami tidak sesuai",
            'nama_suami.min' => "Nama Suami minimal 2 karakter",
            'nama_suami.max' => "Nama Suami maksimal 50 karakter",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'nik.required' => "NIK wajib diisi",
            'nik.unique' => "NIK sudah pernah digunakan",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format penamaan alamat tidak sesuai",
            'alamat.max' => "Masukan alamat maksimal 30 huruf",
            'email.required' => "Email pegawai wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.unique' => "Email sudah pernah digunakan",
            'telegram.max' => "Masukan Username Telegram maksimal 25 karakter",
            'telegram.unique' => "Username Telegram sudah pernah digunakan",
            'no_tlpn.required' => "Nomor telepon wajib diisi",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.between' => "Nomor telepon harus berjumlah 12 sampai 15 karakter",
            'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'lokasi_posyandu.required' => "Lokasi Posyandu wajib diisi",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai"

        ]);

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        $selectIdKK = KK::where('no_kk',$request->no_kk)->first();

        if($selectIdKK != null){
            $user = User::create([
                'id_chat_tele' => null,
                'id_kk' => $selectIdKK->id,
                'email' => $request->email,
                'username_tele' => $request->telegram,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 1,
            ]);

            Ibu::create([
                'id_posyandu' => $request->lokasi_posyandu,
                'id_user' => $user->id,
                'nama_ibu_hamil' => $request->nama_ibu,
                'nama_suami' => $request->nama_suami,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->no_tlpn,
                'NIK' => $request->nik,
            ]);

            return redirect()->back()->with(['success' => 'Akun lansia berhasil ditambahkan']);
        }else{

            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
            ],
            [
                'file.required' => "Nomor KK belum terdaftar,Wajib Upload Scan KK "
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);
            $kk = KK::create([
                'no_kk' => $request->no_kk,
                'file_kk' => $path,
            ]);

            $user = User::create([
                'id_chat_tele' => null,
                'id_kk' => $kk->id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 1,
            ]);

            Ibu::create([
                'id_posyandu' => $request->lokasi_posyandu,
                'id_user' => $user->id,
                'nama_ibu_hamil' => $request->nama_ibu,
                'nama_suami' => $request->nama_suami,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->no_tlpn,
                'username_telegram' => $request->telegram,
                'NIK' => $request->nik,
            ]);

            return redirect()->back()->with(['success' => 'Akun lansia berhasil ditambahkan']);
        }
    }

    public function storeUserAnak(Request $request)
    {
        $this->validate($request,[
            'no_kk' =>"required|numeric|digits:16",
            'nama_anak' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_ayah' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_ibu' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir' => "required|date",
            'gender' => "required",
            'nik' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'alamat' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'email' => "required|email|unique:tb_user,email",
            'telegram' => "max:25|unique:tb_user,username_tele",
            'no_tlpn' => "required|numeric|unique:tb_anak,nomor_telepon",
            'status_anak' => "required|numeric",
            'lokasi_posyandu' => "required",
            'password' => 'required|min:8|max:50|confirmed',
        ],
        [
            'no_kk.required' => "Nomor KK wajib diisi",
            'no_kk.numeric' => "Nomor KK harus berupa angka",
            'no_kk.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nama_anak.required' => "Nama Anak wajib diisi",
            'nama_anak.regex' => "Format Nama Anak tidak sesuai",
            'nama_anak.min' => "Nama Anak minimal 2 karakter",
            'nama_anak.max' => "Nama Anak maksimal 50 karakter",
            'nama_ayah.required' => "Nama Ayah wajib diisi",
            'nama_ayah.regex' => "Format Nama Ayah tidak sesuai",
            'nama_ayah.min' => "Nama Ayah minimal 2 karakter",
            'nama_ayah.max' => "Nama Ayah maksimal 50 karakter",
            'nama_ibu.required' => "Nama Ibu wajib diisi",
            'nama_ibu.regex' => "Format Nama Ibu tidak sesuai",
            'nama_ibu.min' => "Nama Ibu minimal 2 karakter",
            'nama_ibu.max' => "Nama Ibu maksimal 50 karakter",
            'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir.required' => "Tanggal lahir wajib diisi",
            'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
            'gender.required' => "Jenis Kelamin Wajib diisi",
            'nik.required' => "NIK wajib diisi",
            'nik.unique' => "NIK sudah pernah digunakan",
            'nik.numeric' => "NIK harus berupa angka",
            'nik.digits' => "NIK harus berjumlah 16 karakter",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format penamaan alamat tidak sesuai",
            'alamat.max' => "Masukan alamat maksimal 30 huruf",
            'email.required' => "Email pegawai wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.unique' => "Email sudah pernah digunakan",
            'telegram.max' => "Masukan Username Telegram maksimal 25 karakter",
            'telegram.unique' => "Username Telegram sudah pernah digunakan",
            'no_tlpn.required' => "Nomor telepon wajib diisi",
            'no_tlpn.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn.between' => "Nomor telepon harus berjumlah 12 sampai 15 karakter",
            'no_tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'lokasi_posyandu.required' => "Lokasi Posyandu wajib diisi",
            'status_anak.required' => "Status Lansia Wajib diisi",
            'status_anak.numeric' => "Inputan Harus Berupa Angka",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai"

        ]);

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        $selectIdKK = KK::where('no_kk',$request->no_kk)->first();

        if($selectIdKK != null){
            $user = User::create([
                'id_chat_tele' => null,
                'id_kk' => $selectIdKK->id,
                'email' => $request->email,
                'username_tele' => $request->telegram,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 1,
            ]);

            Anak::create([
                'id_posyandu' => $request->lokasi_posyandu,
                'id_user' => $user->id,
                'nama_anak' => $request->nama_anak,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->no_tlpn,
                'NIK' => $request->nik,
                'anak_ke' => $request->status_anak,
                'jenis_kelamin' => $request->gender,
            ]);

            return redirect()->back()->with(['success' => 'Akun anak berhasil ditambahkan']);
        }else{

            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
                'file.required' => "Nomor KK belum terdaftar,Wajib Upload Scan KK "
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);
            $kk = KK::create([
                'no_kk' => $request->no_kk,
                'file_kk' => $path,
            ]);

            $user = User::create([
                'id_kk' => $kk->id,
                'id_chat_tele' => NULL,
                'email' => $request->email,
                'username_tele' => $request->telegram,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 1,
            ]);

            $anak = $user->anak()->create([
                'id_posyandu' => $request->lokasi_posyandu,
                'nama_lansia' => $request->nama_lansia,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->no_tlpn,
                'NIK' => $request->nik,
                'anak_ke' => $request->status_anak,
                'jenis_kelamin' => $request->gender,
            ]);

            return redirect()->back()->with(['success' => 'Akun anak berhasil ditambahkan']);
        }
    }

    public function storeUserLansia(Request $request)
    {
        $this->validate($request,[
            'no_kk_lansia' =>"required|numeric|digits:16",
            'nama_lansia' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir_lansia' => "required|regex:/^[a-z ]+$/i|min:3",
            'tgl_lahir_lansia' => "required|date",
            'gender_lansia' => "required",
            'nik_lansia' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'alamat_lansia' => "required|regex:/^[a-z0-9 ,.'-]+$/i",
            'email_lansia' => "required|email|unique:tb_user,email",
            'telegram_lansia' => "max:25|unique:tb_user,username_tele",
            'no_tlpn_lansia' => "required|numeric|unique:tb_lansia,nomor_telepon",
            'status_lansia' => "required",
            'lokasi_posyandu_lansia' => "required",
            'passwordLansia' => 'required|min:8|max:50|confirmed',
        ],
        [
            'no_kk_lansia.required' => "Nomor KK Lansia wajib diisi",
            'no_kk_lansia.numeric' => "Nomor KK harus berupa angka",
            'no_kk_lansia.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nama_lansia.required' => "Nama Lansia wajib diisi",
            'nama_lansia.regex' => "Format nama lansia tidak sesuai",
            'nama_lansia.min' => "Nama Lansia minimal 2 karakter",
            'nama_lansia.max' => "Nama Lansia maksimal 50 karakter",
            'tempat_lahir_lansia.required' => "Tempat lahir lansia wajin diisi",
            'tempat_lahir_lansia.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir_lansia.min' => "Tempat lahir minimal 3 karakter",
            'tgl_lahir_lansia.required' => "Tanggal lahir lansia wajib diisi",
            'tgl_lahir_lansia.date' => "Tanggal lahir harus berupa tanggal",
            'gender_lansia.required' => "Jenis kelamin lansia wajib diisi",
            'nik_lansia.required' => "NIK lansia wajib diisi",
            'nik_lansia.unique' => "NIK sudah pernah digunakan",
            'nik_lansia.numeric' => "NIK harus berupa angka",
            'nik_lansia.digits' => "NIK harus berjumlah 16 karakter",
            'alamat_lansia.required' => "Alamat tempat tinggal lansia wajib diisi",
            'alamat_lansia.regex' => "Format penulisan alamat tidak sesuai",
            'email_lansia.required' => "Email lansia wajib diisi",
            'email_lansia.email' => "Masukan format email yang sesuai",
            'email_lansia.unique' => "Email sudah pernah digunakan",
            'telegram_lansia.max' => "Username Telegram maksimal 25 karakter",
            'telegram_lansia.unique' => "Username Telegram sudah pernah digunakan",
            'no_tlpn_lansia.required' => "Nomor telepon lansia wajib diisi",
            'no_tlpn_lansia.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn_lansia.between' => "Nomor telepon harus berjumlah 12 sampai 15 angka",
            'no_tlpn_lansia.unique' => "Nomor telepon sudah pernah digunakan",
            'lokasi_posyandu_lansia.required' => "Lokasi posyandu wajib diisi",
            'status_lansia.required' => "Status lansia wajib diisi",
            'passwordLansia.required' => "Password akun lansia wajib diisi",
            'passwordLansia.min' => "Password minimal 8 karakter",
            'passwordLansia.max' => "Password maksimal 50 karakter",
            'passwordLansia.confirmed' => "Konfirmasi password akun lansia tidak sesuai"

        ]);

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir_lansia;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        $selectIdKK = KK::where('no_kk',$request->no_kk_lansia)->first();

        if($selectIdKK != NULL){
            $user = User::create([
                'id_chat_tele' => NULL,
                'id_kk' => $selectIdKK->id,
                'email' => $request->email_lansia,
                'password' => Hash::make($request->passwordLansia),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 1,
            ]);

            Lansia::create([
                'id_posyandu' => $request->lokasi_posyandu_lansia,
                'id_user' => $user->id,
                'nama_lansia' => $request->nama_lansia,
                'tempat_lahir' => $request->tempat_lahir_lansia,
                'tanggal_lahir' => $tgl_lahir_lansia,
                'alamat' => $request->alamat_lansia,
                'nomor_telepon' => $request->no_tlpn_lansia,
                'username_telegram' => $request->telegram_lansia,
                'NIK' => $request->nik_lansia,
                'status' => $request->status_lansia,
                'jenis_kelamin' => $request->gender_lansia,
            ]);

            return redirect()->back()->with(['success' => 'Akun lansia berhasil ditambahkan']);
        }else{
            $this->validate($request,[
                'file_lansia'=> 'required|image|mimes:jpeg,png,jpg',
            ],
            [
                'file_lansia.required' => "Nomor KK belum terdaftar, silahkan unggah Scan KK"
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file_lansia->getClientOriginalName();
            $imageName = time().'-'.$request->file_lansia->getClientOriginalName();

            $request->file_lansia->move(public_path('images/upload/KK'),$imageName);
            $kk = KK::create([
                'no_kk' => $request->no_kk_lansia,
                'file_kk' => $path,
            ]);

            $user = User::create([
                'id_chat_tele' => NULL,
                'id_kk' => $kk->id,
                'email' => $request->email_lansia,
                'password' => Hash::make($request->passwordLansia),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 1,
            ]);

            Lansia::create([
                'id_posyandu' => $request->lokasi_posyandu_lansia,
                'id_user' => $user->id,
                'nama_lansia' => $request->nama_lansia,
                'tempat_lahir' => $request->tempat_lahir_lansia,
                'tanggal_lahir' => $tgl_lahir_lansia,
                'alamat' => $request->alamat_lansia,
                'nomor_telepon' => $request->no_tlpn_lansia,
                'username_telegram' => $request->telegram_lansia,
                'NIK' => $request->nik_lansia,
                'status' => $request->status_lansia,
                'jenis_kelamin' => $request->gender_lansia,
            ]);

            return redirect()->back()->with(['success' => 'Akun lansia berhasil ditambahkan']);
        }
    }
}
