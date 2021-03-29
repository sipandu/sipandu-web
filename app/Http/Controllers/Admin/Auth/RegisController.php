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

    public function storeAdminKader(Request $request)
    {
        // return($request);
        $this->validate($request,[
            'name' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email' => "email|unique:tb_admin,email",
            'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir' => "required|date",
            'gender' => "required",
            'nik' => "required|numeric|unique:tb_pegawai,nik|digits:16",
            'file'=> 'required|image|mimes:jpeg,png,jpg',
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i",
            'jabatan' => "required",
            'tlpn' => "required|numeric|unique:tb_pegawai,nomor_telepon|digits_between:11,15",
            'lokasi_posyandu' => "required",
            'telegram' => "max:25|unique:tb_pegawai,username_telegram",
            'password' => 'required|min:8|confirmed',
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
            'file.required' => "NIK wajib diisi",
            'file.image' => "Gambar yang di unggah harus berupa jpeg, png atau,jpg ",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format alamat tidak sesuai",
            'jabatan.required' => "Jabatan wajib diiisi",
            'tlpn.required' => "Nomor telepon wajib diisi",
            'tlpn.numeric' => "Nomor telepon harus berupa angka",
            'tlpn.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'tlpn.unique' => "Nomor telepon sudah pernah digunakan",
            'lokasi_posyandu.required' => "Posyandu tempat bertugas wajib diisi",
            'telegram.max' => "Username Telegram maksimal berjumlah 25 karakter",
            'telegram.unique' => "Username Telegram pernah digunakan",
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
            'profile_image' => '/images/upload/Profile/default.jpg',
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
        return redirect()->back()->with(['success' => 'Data akun '.$request->jabatan.' baru berhasil ditambahkan']);
    }

    public function storeUserIbu(Request $request)
    {
        $this->validate($request,[
            'no_kk_bumil' =>"required|numeric|digits:16",
            'nama_bumil' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_suami' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir_bumil' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir_bumil' => "required|date",
            'nik_bumil' => "required|numeric|unique:tb_ibu_hamil,nik|digits:16",
            'alamat_bumil' => "required|regex:/^[a-z .,0-9]+$/i",
            'email_bumil' => "required|email|unique:tb_user,email",
            'telegram_bumil' => "max:25|unique:tb_user,username_tele",
            'no_tlpn_bumil' => "required|numeric|unique:tb_ibu_hamil,nomor_telepon",
            'lokasi_posyandu_bumil' => "required",
            'passwordBumil' => 'required|min:8|max:50|confirmed',
        ],
        [
            'no_kk_bumil.required' => "Nomor KK ibu hamil wajib diisi",
            'no_kk_bumil.numeric' => "Nomor KK harus berupa angka",
            'no_kk_bumil.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nama_bumil.required' => "Nama ibu hamil wajib diisi",
            'nama_bumil.regex' => "Format nama ibu hamil tidak sesuai",
            'nama_bumil.min' => "Nama ibu hamil minimal berjumlah 2 karakter",
            'nama_bumil.max' => "Nama ibu hamil maksimal berjumlah 50 karakter",
            'nama_suami.required' => "Nama suami wajib diisi",
            'nama_suami.regex' => "Format nama suami tidak sesuai",
            'nama_suami.min' => "Nama suami minimal berjumlah 2 karakter",
            'nama_suami.max' => "Nama suami maksimal berjumlah 50 karakter",
            'tempat_lahir_bumil.required' => "Tempat lahir ibu hamil wajib diisi",
            'tempat_lahir_bumil.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir_bumil.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tempat_lahir_bumil.max' => "Tempat lahir minimal berjumlah 50 karakter",
            'tgl_lahir_bumil.required' => "Tanggal lahir ibu hamil wajib diisi",
            'tgl_lahir_bumil.date' => "Tanggal lahir harus berupa tanggal",
            'nik_bumil.required' => "NIK ibu hamil wajib diisi",
            'nik_bumil.unique' => "NIK ibu hamil sudah digunakan",
            'nik_bumil.numeric' => "NIK harus berupa angka",
            'nik_bumil.digits' => "NIK harus berjumlah 16 karakter",
            'alamat_bumil.required' => "Alamat ibu hamil wajib diisi",
            'alamat_bumil.regex' => "Format penamaan alamat tidak sesuai",
            'email_bumil.required' => "Email ibu hamil wajib diisi",
            'email_bumil.email' => "Masukan email yang sesuai",
            'email_bumil.unique' => "Email ibu hamil sudah pernah digunakan",
            'telegram_bumil.max' => "Username Telegram maksimal berjumlah 25 karakter",
            'telegram_bumil.unique' => "Username Telegram ibu hamil sudah pernah digunakan",
            'no_tlpn_bumil.required' => "Nomor telepon ibu hamil wajib diisi",
            'no_tlpn_bumil.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn_bumil.between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'no_tlpn_bumil.unique' => "Nomor telepon ibu hamil sudah digunakan",
            'lokasi_posyandu_bumil.required' => "Lokasi posyandu ibu hamil wajib diisi",
            'passwordBumil.required' => "Password akun ibu hamil wajib diisi",
            'passwordBumil.min' => "Password minimal berjumlah 8 karakter",
            'passwordBumil.max' => "Password maksimal berjumlah 50 karakter",
            'passwordBumil.confirmed' => "Konfirmasi password akun ibu hamil tidak sesuai"

        ]);

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir_bumil;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        $selectIdKK = KK::where('no_kk',$request->no_kk_bumil)->first();

        if($selectIdKK != NULL){
            $user = User::create([
                'id_chat_tele' => NULL,
                'id_kk' => $selectIdKK->id,
                'email' => $request->email_bumil,
                'username_tele' => $request->telegram_bumil,
                'password' => Hash::make($request->passwordBumil),
                'profile_image' => "/images/upload/Profile/default.jpg",
                'is_verified' => 1,
            ]);

            Ibu::create([
                'id_posyandu' => $request->lokasi_posyandu_bumil,
                'id_user' => $user->id,
                'nama_ibu_hamil' => $request->nama_bumil,
                'nama_suami' => $request->nama_suami,
                'tempat_lahir' => $request->tempat_lahir_bumil,
                'tanggal_lahir' => $tgl_lahir_bumil,
                'alamat' => $request->alamat_bumil,
                'nomor_telepon' => $request->no_tlpn_bumil,
                'NIK' => $request->nik_bumil,
            ]);

            return redirect()->back()->with(['success' => 'Akun ibu hamil berhasil ditambahkan']);
        }else{

            $this->validate($request,[
                'file_bumil'=> 'required|image|mimes:jpeg,png,jpg',
            ],
            [
                'file_bumil.required' => "Nomor KK belum terdaftar, silahkan unggah Scan KK "
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file_bumil->getClientOriginalName();
            $imageName = time().'-'.$request->file_bumil->getClientOriginalName();

            $request->file_bumil->move(public_path('images/upload/KK'),$imageName);
            $kk = KK::create([
                'no_kk' => $request->no_kk_bumil,
                'file_kk' => $path,
            ]);

            $user = User::create([
                'id_chat_tele' => NULL,
                'id_kk' => $kk->id,
                'email' => $request->email_bumil,
                'password' => Hash::make($request->passwordBumil),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 1,
            ]);

            Ibu::create([
                'id_posyandu' => $request->_bumil,
                'id_user' => $user->id,
                'nama_ibu_hamil' => $request->nama_bumil,
                'nama_suami' => $request->nama_suami,
                'tempat_lahir' => $request->tempat_lahir_bumil,
                'tanggal_lahir' => $tgl_lahir_bumil,
                'alamat' => $request->alamat_bumil,
                'nomor_telepon' => $request->no_tlpn_bumil,
                'username_telegram' => $request->telegram_bumil,
                'NIK' => $request->nik_bumil,
            ]);

            return redirect()->back()->with(['success' => 'Akun ibu hamil berhasil ditambahkan']);
        }
    }

    public function storeUserAnak(Request $request)
    {
        $this->validate($request,[
            'no_kk_anak' =>"required|numeric|digits:16",
            'nama_anak' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_ayah' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'nama_ibu' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir_anak' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir_anak' => "required|date",
            'gender_anak' => "required",
            'nik_anak' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'alamat_anak' => "required|regex:/^[a-z .,0-9]+$/i|max:30",
            'email_anak' => "required|email|unique:tb_user,email",
            'telegram_anak' => "max:25|unique:tb_user,username_tele",
            'no_tlpn_anak' => "required|numeric|unique:tb_anak,nomor_telepon|digits_between:11,15",
            'status_anak' => "required|numeric",
            'lokasi_posyandu_anak' => "required",
            'passwordAnak' => 'required|min:8|max:50|confirmed',
        ],
        [
            'no_kk_anak.required' => "Nomor KK anak wajib diisi",
            'no_kk_anak.numeric' => "Nomor KK harus berupa angka",
            'no_kk_anak.digits' => "Nomor KK harus berjumlah 16 karakter",
            'nama_anak.required' => "Nama anak wajib diisi",
            'nama_anak.regex' => "Format nama anak tidak sesuai",
            'nama_anak.min' => "Nama anak minimal berjumlah 2 karakter",
            'nama_anak.max' => "Nama anak maksimal berjumlah 50 karakter",
            'nama_ayah.required' => "Nama ayah wajib diisi",
            'nama_ayah.regex' => "Format nama ayah tidak sesuai",
            'nama_ayah.min' => "Nama ayah minimal berjumlah 2 karakter",
            'nama_ayah.max' => "Nama ayah maksimal berjumlah 50 karakter",
            'nama_ibu.required' => "Nama ibu wajib diisi",
            'nama_ibu.regex' => "Format nama ibu tidak sesuai",
            'nama_ibu.min' => "Nama ibu minimal berjumlah 2 karakter",
            'nama_ibu.max' => "Nama ibu maksimal berjumlah 50 karakter",
            'tempat_lahir_anak.required' => "Tempat lahir anak wajib diisi",
            'tempat_lahir_anak.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir_anak.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tempat_lahir_anak.max' => "Tempat lahir minimal berjumlah 50 karakter",
            'tgl_lahir_anak.required' => "Tanggal lahir anak wajib diisi",
            'tgl_lahir_anak.date' => "Tanggal lahir harus berupa tanggal",
            'gender_anak.required' => "Jenis kelamin anak wajib diisi",
            'nik_anak.required' => "NIK anak wajib diisi",
            'nik_anak.unique' => "NIK anak sudah pernah digunakan",
            'nik_anak.numeric' => "NIK harus berupa angka",
            'nik_anak.digits' => "NIK harus berjumlah 16 karakter",
            'alamat_anak.required' => "Alamat anak wajib diisi",
            'alamat_anak.regex' => "Format penulisan alamat tidak sesuai",
            'email_anak.required' => "Email anak wajib diisi",
            'email_anak.email' => "Masukan format email yang sesuai",
            'email_anak.unique' => "Email anak sudah pernah digunakan",
            'telegram_anak.max' => "Username Telegram maksimal 25 karakter",
            'telegram_anak.unique' => "Username Telegram anak sudah pernah digunakan",
            'no_tlpn_anak.required' => "Nomor telepon anak wajib diisi",
            'no_tlpn_anak.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn_anak.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 karakter",
            'no_tlpn_anak.unique' => "Nomor telepon anak sudah pernah digunakan",
            'lokasi_posyandu_anak.required' => "Lokasi posyandu anak wajib diisi",
            'status_anak.required' => "Status anak wajib diisi",
            'status_anak.numeric' => "Status anak berupa angka",
            'password.required' => "Password akun anak wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password akun anak tidak sesuai"

        ]);

        // Ubah format tanggal //
        $tgl_lahir_indo = $request->tgl_lahir_anak;
        $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
        $tahun = $tgl_lahir_eng[2];
        $bulan = $tgl_lahir_eng[1];
        $tgl = $tgl_lahir_eng[0];
        $tgl_lahir = $tahun.$bulan.$tgl;

        $selectIdKK = KK::where('no_kk',$request->no_kk_anak)->first();

        if($selectIdKK != null){
            $user = User::create([
                'id_chat_tele' => null,
                'id_kk' => $selectIdKK->id,
                'email' => $request->email_anak,
                'username_tele' => $request->telegram_anak,
                'password' => Hash::make($request->passwordAnak),
                'profile_image' => "/images/upload/Profile/default.jpg",
                'is_verified' => 1,
            ]);

            Anak::create([
                'id_posyandu' => $request->lokasi_posyandu_anak,
                'id_user' => $user->id,
                'nama_anak' => $request->nama_anak,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir' => $request->tempat_lahir_anak,
                'tanggal_lahir' => $tgl_lahir_anak,
                'alamat' => $request->alamat_anak,
                'nomor_telepon' => $request->no_tlpn_anak,
                'NIK' => $request->nik_anak,
                'anak_ke' => $request->status_anak,
                'jenis_kelamin' => $request->gender_anak,
            ]);

            return redirect()->back()->with(['success' => 'Akun anak berhasil ditambahkan']);
        }else{

            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
                'file.required' => "Nomor KK belum terdaftar,Wajib Upload Scan KK "
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file_anak->getClientOriginalName();
            $imageName = time().'-'.$request->file_anak->getClientOriginalName();

            $request->file_anak->move(public_path('images/upload/KK'),$imageName);
            $kk = KK::create([
                'no_kk' => $request->no_kk_anak,
                'file_kk' => $path,
            ]);

            $user = User::create([
                'id_kk' => $kk->id,
                'id_chat_tele' => NULL,
                'email' => $request->email_anak,
                'username_tele' => $request->telegram_anak,
                'password' => Hash::make($request->password_anak),
                'profile_image' => "/images/upload/Profile/default.jpg",
                'is_verified' => 1,
            ]);

            Anak::create([
                'id_posyandu' => $request->lokasi_posyandu_anak,
                'id_user' => $user->id,
                'nama_anak' => $request->nama_anak,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir' => $request->tempat_lahir_anak,
                'tanggal_lahir' => $tgl_lahir_anak,
                'alamat' => $request->alamat_anak,
                'nomor_telepon' => $request->no_tlpn_anak,
                'NIK' => $request->nik_anak,
                'anak_ke' => $request->status_anak,
                'jenis_kelamin' => $request->gender_anak,
            ]);

            return redirect()->back()->with(['success' => 'Akun anak berhasil ditambahkan']);
        }
    }

    public function storeUserLansia(Request $request)
    {
        $this->validate($request,[
            'no_kk_lansia' =>"required|numeric|digits:16",
            'nama_lansia' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'tempat_lahir_lansia' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
            'tgl_lahir_lansia' => "required|date",
            'gender_lansia' => "required",
            'nik_lansia' => "required|numeric|unique:tb_lansia,nik|digits:16",
            'alamat_lansia' => "required|regex:/^[a-z0-9 ,.'-]+$/i",
            'email_lansia' => "required|email|unique:tb_user,email",
            'telegram_lansia' => "max:25|unique:tb_user,username_tele",
            'no_tlpn_lansia' => "required|numeric|unique:tb_lansia,nomor_telepon|digits:between:11,15",
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
            'nama_lansia.min' => "Nama lansia minimal berjumlah 2 karakter",
            'nama_lansia.max' => "Nama lansia maksimal 50 karakter",
            'tempat_lahir_lansia.required' => "Tempat lahir lansia wajin diisi",
            'tempat_lahir_lansia.regex' => "Format tempat lahir tidak sesuai",
            'tempat_lahir_lansia.min' => "Tempat lahir minimal berjumlah 3 karakter",
            'tempat_lahir_lansia.max' => "Tempat lahir minimal berjumlah 50 karakter",
            'tgl_lahir_lansia.required' => "Tanggal lahir lansia wajib diisi",
            'tgl_lahir_lansia.date' => "Tanggal lahir harus berformat tanggal",
            'gender_lansia.required' => "Jenis kelamin lansia wajib diisi",
            'nik_lansia.required' => "NIK lansia wajib diisi",
            'nik_lansia.unique' => "NIK lansia sudah pernah digunakan",
            'nik_lansia.numeric' => "NIK harus berupa angka",
            'nik_lansia.digits' => "NIK harus berjumlah 16 karakter",
            'alamat_lansia.required' => "Alamat lansia wajib diisi",
            'alamat_lansia.regex' => "Format penulisan alamat tidak sesuai",
            'email_lansia.required' => "Email lansia wajib diisi",
            'email_lansia.email' => "Masukan format email yang sesuai",
            'email_lansia.unique' => "Email lansia sudah pernah digunakan",
            'telegram_lansia.max' => "Username Telegram maksimal 25 karakter",
            'telegram_lansia.unique' => "Username Telegram lansia sudah pernah digunakan",
            'no_tlpn_lansia.required' => "Nomor telepon lansia wajib diisi",
            'no_tlpn_lansia.numeric' => "Nomor telepon harus berupa angka",
            'no_tlpn_lansia.digits_between' => "Nomor telepon harus berjumlah 11 sampai 15 angka",
            'no_tlpn_lansia.unique' => "Nomor telepon lansia sudah pernah digunakan",
            'lokasi_posyandu_lansia.required' => "Lokasi posyandu lansia wajib diisi",
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
