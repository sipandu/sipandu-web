<?php

namespace App\Http\Controllers\User\Auth;
use App\KK;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Kabupaten;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function landingRegis(Request $request)
    {
        return view('pages/auth/regis-landing');
    }

    public function landingVerif(Request $request)
    {
        return view('pages/auth/verif-landing');
    }

    // Source dimana melakukan pengecekan noKK pada Database //
    public function submitLanding(Request $request)
    {

        $this->validate($request,[
            'no_kk' =>"required|numeric|digits:16",
            'role' => "required",
        ],
        [
            'no_kk.required' => "Nomor KK wajib diisi",
            'no_kk.numeric' => "Nomor KK harus berupa angka",
            'no_kk.digits' => "Nomor KK harus berjumlah 16 karakter",
            'role.required' => "Kolom Wajib diisi",

        ]);

        $noKK = $request->no_kk;
        $selectKK = KK::where('no_kk', $noKK)->first();
        $role = $request->role;
        $kabupaten = Kabupaten::all();
        if($selectKK != null){
            $idKK = $selectKK->id;
            return redirect()->route('register.pertama',['idKK' => $idKK,'role' => $role,'noKK' => $request->no_kk]);
            // return view('pages/auth/user/form-register',['idKK' => $idKK,'role' => $role,'noKK' => $request->noKK], compact('kabupaten'));
        }else{
            $idKK = null;
            return redirect()->route('register.pertama',['idKK' => $idKK,'role' => $role,'noKK' => $request->no_kk]);
        }

    }

    public function formRegisAwal(Request $request)
    {
        $kabupaten = Kabupaten::all();
        return view('pages/auth/user/form-register',['idKK' => $request->idKK,'role' => $request->role,'noKK' => $request->noKK], compact('kabupaten'));
    }


    public function storeAnak(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_user,email",
            'password' => 'required|min:8|max:50|confirmed',
            'kabupaten' => "required",
            'kecamatan' => "required",
            'desa' => "required",
            'banjar' => "required",

        ],
        [
            'nama.required' => "Nama Lengkap wajib diisi",
            'nama.regex' => "Format Nama Lengkap tidak sesuai",
            'nama.min' => "Nama Lengkap minimal 2 karakter",
            'nama.max' => "Nama Lengkap maksimal 50 karakter",
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.unique' => "Email sudah pernah digunakan",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai",
            'kabupaten.required' => "Kolom kabupaten Wajib diisi",
            'kecamatan.required' => "Kolom kecamatan Wajib diisi",
            'desa.required' => "Kolom desa Wajib diisi",
            'banjar.required' => "Kolom Banjar Wajib diisi",

        ]);

        if($request->idKK != null){
            $user = User::create([
                'id_kk' => $request->idKK,
                'id_chat_tele' => null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $anak = $user->anak()->create([
                'id_posyandu' => $request->banjar,
                'nama_anak' => $request->nama,
            ]);

            return redirect()->route('landing.verif');

        }else{
            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
                'file.required' => "Kolom Upload File Wajib Diisi ",
                'file.image' => "File yang di upload harus berupa foto",
                'file.mimes' => "Format yang di dukung hanya : jpeg,png,jpg "
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);

            $kk = KK::create([
                'no_kk' =>  $request->noKK,
                'file_kk' => $path,
            ]);

            $user = new User;
            $user = $kk->user()->create([
                'id_chat_tele' => null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $anak = $user->anak()->create([
                'id_posyandu' => $request->banjar,
                'nama_anak' => $request->nama,
            ]);

            return redirect()->route('landing.verif');

        }
    }

    public function storeIbu(Request $request)
    {

        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_user,email",
            'password' => 'required|min:8|max:50|confirmed',
            'kabupaten' => "required",
            'kecamatan' => "required",
            'desa' => "required",
            'banjar' => "required",

        ],
        [
            'nama.required' => "Nama Lengkap wajib diisi",
            'nama.regex' => "Format Nama Lengkap tidak sesuai",
            'nama.min' => "Nama Lengkap minimal 2 karakter",
            'nama.max' => "Nama Lengkap maksimal 50 karakter",
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.unique' => "Email sudah pernah digunakan",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai",
            'kabupaten.required' => "Kolom kabupaten Wajib diisi",
            'kecamatan.required' => "Kolom kecamatan Wajib diisi",
            'desa.required' => "Kolom desa Wajib diisi",
            'banjar.required' => "Kolom Banjar Wajib diisi",

        ]);

        if($request->idKK != null){
            $user = User::create([
                'id_kk' => $request->idKK,
                'id_chat_tele' => null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $anak = $user->ibu()->create([
                'id_posyandu' => $request->banjar,
                'nama_ibu_hamil' => $request->nama,
            ]);

            return redirect()->route('landing.verif');

        }else{
            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
                'file.required' => "Kolom Upload File Wajib Diisi ",
                'file.image' => "File yang di upload harus berupa foto",
                'file.mimes' => "Format yang di dukung hanya : jpeg,png,jpg "
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);

            $kk = KK::create([
                'no_kk' =>  $request->noKK,
                'file_kk' => $path,
            ]);

            $user = new User;
            $user = $kk->user()->create([
                'id_chat_tele' => null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $anak = $user->ibu()->create([
                'id_posyandu' => $request->banjar,
                'nama_ibu_hamil' => $request->nama,
            ]);

            return redirect()->route('landing.verif');

        }
    }

    public function storeLansia(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_user,email",
            'password' => 'required|min:8|max:50|confirmed',
            'kabupaten' => "required",
            'kecamatan' => "required",
            'desa' => "required",
            'banjar' => "required",

        ],
        [
            'nama.required' => "Nama Lengkap wajib diisi",
            'nama.regex' => "Format Nama Lengkap tidak sesuai",
            'nama.min' => "Nama Lengkap minimal 2 karakter",
            'nama.max' => "Nama Lengkap maksimal 50 karakter",
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.unique' => "Email sudah pernah digunakan",
            'password.required' => "Password wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai",
            'kabupaten.required' => "Kolom kabupaten Wajib diisi",
            'kecamatan.required' => "Kolom kecamatan Wajib diisi",
            'desa.required' => "Kolom desa Wajib diisi",
            'banjar.required' => "Kolom Banjar Wajib diisi",

        ]);

        if($request->idKK != null){
            $user = User::create([
                'id_kk' => $request->idKK,
                'id_chat_tele' => null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $anak = $user->anak()->create([
                'id_posyandu' => $request->banjar,
                'nama_lansia' => $request->nama,
            ]);

            return redirect()->route('landing.verif');

        }else{
            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
                'file.required' => "Kolom Upload File Wajib Diisi ",
                'file.image' => "File yang di upload harus berupa foto",
                'file.mimes' => "Format yang di dukung hanya : jpeg,png,jpg "
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);

            $kk = KK::create([
                'no_kk' =>  $request->noKK,
                'file_kk' => $path,
            ]);

            $user = new User;
            $user = $kk->user()->create([
                'id_chat_tele' => null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $anak = $user->anak()->create([
                'id_posyandu' => $request->banjar,
                'nama_lansia' => $request->nama,
            ]);

            return redirect()->route('landing.verif');
        }
    }
    // akhir dari fungsi registrasi user awal belum termasuk dari data diri //



}
