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
            'role.required' => "Jenis akun harus diisi",

        ]);

        $noKK = $request->no_kk;
        $selectKK = KK::where('no_kk', $noKK)->first();
        $role = $request->role;

        if($selectKK != null){
            $idKK = $selectKK->id;
            return redirect()->route('register.pertama',['scr' => $noKK,'idKK' => $idKK,'role' => $role,]);
            // return view('pages/auth/user/form-register',['idKK' => $idKK,'role' => $role,'noKK' => $request->noKK], compact('kabupaten'));
        }else{
            $idKK = null;
            return redirect()->route('register.pertama',['scr' => $noKK,'idKK' => $idKK,'role' => $role]);
        }

    }

    public function formRegisAwal(Request $request)
    {
        $kabupaten = Kabupaten::all();
        return view('pages/auth/user/form-register',['scr' => $request->scr,'idKK' => $request->idKK,'role' => $request->role], compact('kabupaten'));
    }

    public function storeAnak(Request $request)
    {
        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_user,email",
            'password' => 'required|min:8|max:50|confirmed',
            'kabupaten' => "required",
            'kecamatan' => "required",
            'desa' => "required",
            'banjar' => "required",
        ],
        [
            'nama.required' => "Nama lengkap anak wajib diisi",
            'nama.regex' => "Format nama anak tidak sesuai",
            'nama.min' => "Nama anak minimal berjumlah 2 huruf",
            'nama.max' => "Nama anak maksimal berjumlah 50 huruf",
            'email.required' => "Email anak wajib diisi",
            'email.email' => "Masukan email yang sesuai",
            'email.unique' => "Email sudah pernah digunakan",
            'password.required' => "Kata sandi wajib diisi",
            'password.min' => "Kata sandi minimal berjumlah 8 karakter",
            'password.max' => "Kata sandi maksimal berjumlah 50 karakter",
            'password.confirmed' => "Konfirmasi kata sandi tidak sesuai",
            'kabupaten.required' => "Kabupaten wajib diisi",
            'kecamatan.required' => "Kecamatan wajib diisi",
            'desa.required' => "Desa wajib diisi",
            'banjar.required' => "Banjar wajib diisi",
        ]);

        if($request->idKK != null){
            $user = User::create([
                'id_kk' => $request->idKK,
                'role' => 0,
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
            ],
            [
                'file.required' => "Wajib menggunggah Scan atau foto KK",
                'file.image' => "File yang diunggah harus berupa gambar",
                'file.mimes' => "Format gambar yang sesuai hanya jpeg, png, dan jpg"
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);

            $kk = KK::create([
                'no_kk' =>  $request->noKK,
                'file_kk' => $path,
            ]);

            // $user = new User;
            $user = $kk->user()->create([
                'id_chat_tele' => null,
                'role' => 0,
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
            'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_user,email",
            'password' => 'required|min:8|max:50|confirmed',
            'kabupaten' => "required",
            'kecamatan' => "required",
            'desa' => "required",
            'banjar' => "required",
        ],
        [
            'nama.required' => "Nama lengkap ibu hamil wajib diisi",
            'nama.regex' => "Format nama ibu hamil tidak sesuai",
            'nama.min' => "Nama ibu hamil minimal berjumlah 2 huruf",
            'nama.max' => "Nama ibu hamil maksimal berjumlah 50 huruf",
            'email.required' => "Email ibu hamil wajib diisi",
            'email.email' => "Masukan email yang sesuai",
            'email.unique' => "Email sudah pernah digunakan",
            'password.required' => "Kata sandi wajib diisi",
            'password.min' => "Kata sandi minimal berjumlah 8 karakter",
            'password.max' => "Kata sandi maksimal berjumlah 50 karakter",
            'password.confirmed' => "Konfirmasi kata sandi tidak sesuai",
            'kabupaten.required' => "Kabupaten wajib diisi",
            'kecamatan.required' => "Kecamatan wajib diisi",
            'desa.required' => "Desa wajib diisi",
            'banjar.required' => "Banjar wajib diisi",
        ]);

        if($request->idKK != null){
            $user = User::create([
                'id_kk' => $request->idKK,
                'id_chat_tele' => null,
                'role' => 1,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $ibu = $user->ibu()->create([
                'id_posyandu' => $request->banjar,
                'nama_ibu_hamil' => $request->nama,
            ]);

            return redirect()->route('landing.verif');
        }else{
            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
            ],
            [
                'file.required' => "Wajib menggunggah Scan atau foto KK",
                'file.image' => "File yang diunggah harus berupa gambar",
                'file.mimes' => "Format gambar yang sesuai hanya jpeg, png, dan jpg"
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);

            $kk = KK::create([
                'no_kk' =>  $request->noKK,
                'file_kk' => $path,
            ]);

            // $user = new User;
            $user = $kk->user()->create([
                'id_chat_tele' => null,
                'email' => $request->email,
                'role' => 1,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $ibu = $user->ibu()->create([
                'id_posyandu' => $request->banjar,
                'nama_ibu_hamil' => $request->nama,
            ]);

            return redirect()->route('landing.verif');
        }
    }

    public function storeLansia(Request $request)
    {
        $this->validate($request,[
            'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
            'email' => "required|email|unique:tb_user,email",
            'password' => 'required|min:8|max:50|confirmed',
            'kabupaten' => "required",
            'kecamatan' => "required",
            'desa' => "required",
            'banjar' => "required",
        ],
        [
            'nama.required' => "Nama lengkap lansia wajib diisi",
            'nama.regex' => "Format nama lansia tidak sesuai",
            'nama.min' => "Nama lansia minimal berjumlah 2 huruf",
            'nama.max' => "Nama lansia maksimal berjumlah 50 huruf",
            'email.required' => "Email lansia wajib diisi",
            'email.email' => "Masukan email yang sesuai",
            'email.unique' => "Email sudah pernah digunakan",
            'password.required' => "Kata sandi wajib diisi",
            'password.min' => "Kata sandi minimal berjumlah 8 karakter",
            'password.max' => "Kata sandi maksimal berjumlah 50 karakter",
            'password.confirmed' => "Konfirmasi kata sandi tidak sesuai",
            'kabupaten.required' => "Kabupaten wajib diisi",
            'kecamatan.required' => "Kecamatan wajib diisi",
            'desa.required' => "Desa wajib diisi",
            'banjar.required' => "Banjar wajib diisi",
        ]);

        if($request->idKK != null){
            $user = User::create([
                'id_kk' => $request->idKK,
                'id_chat_tele' => null,
                'role' => 2,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $lansia = $user->lansia()->create([
                'id_posyandu' => $request->banjar,
                'nama_lansia' => $request->nama,
            ]);

            return redirect()->route('landing.verif');
        } else {
            $this->validate($request,[
                'file'=> 'required|image|mimes:jpeg,png,jpg',
            ],
            [
                'file.required' => "Wajib menggunggah Scan atau foto KK",
                'file.image' => "File yang diunggah harus berupa gambar",
                'file.mimes' => "Format gambar yang sesuai hanya jpeg, png, dan jpg"
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->file->getClientOriginalName();
            $imageName = time().'-'.$request->file->getClientOriginalName();

            $request->file->move(public_path('images/upload/KK'),$imageName);

            $kk = KK::create([
                'no_kk' =>  $request->noKK,
                'file_kk' => $path,
            ]);

            // $user = new User;
            $user = $kk->user()->create([
                'id_chat_tele' => null,
                'role' => 2,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => "/images/upload/Profile/deafult.jpg",
                'is_verified' => 0,
            ]);

            $lansia = $user->lansia()->create([
                'id_posyandu' => $request->banjar,
                'nama_lansia' => $request->nama,
            ]);

            return redirect()->route('landing.verif');
        }
    }
}
