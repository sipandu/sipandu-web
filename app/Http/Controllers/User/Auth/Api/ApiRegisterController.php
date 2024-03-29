<?php

namespace App\Http\Controllers\User\Auth\Api;

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

class ApiRegisterController extends Controller
{
    /*
    Flag role user
        0, anak
        1, bumil
        2, lansia
    */

    public function firstRegis(Request $request)
    {
        $noKK = $request->no_kk;
        $selectKK = KK::where('no_kk', $noKK)->first();
        if($selectKK != null){
            $idKK = $selectKK->id;
            return response()->json([
                'status_code' => 200,
                'idKK' => $idKK,
                'noKK' => $selectKK->no_kk
            ]);

        }else{
            $idKK = null;
            return response()->json([
                'status_code' => 200,
                'idKK' => null,
            ]);
        }
    }

    public function storeAnak(Request $request)
    {
        // $this->validate($request,[
        //     'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
        //     'email' => "required|email|unique:tb_user,email",
        //     'password' => 'required|min:8|max:50|confirmed',
        //     'kabupaten' => "required",
        //     'kecamatan' => "required",
        //     'desa' => "required",
        //     'banjar' => "required",

        // ],
        // [
        //     'nama.required' => "Nama Lengkap wajib diisi",
        //     'nama.regex' => "Format Nama Lengkap tidak sesuai",
        //     'nama.min' => "Nama Lengkap minimal 2 karakter",
        //     'nama.max' => "Nama Lengkap maksimal 50 karakter",
        //     'email.required' => "Email wajib diisi",
        //     'email.email' => "Masukan email yang valid",
        //     'email.unique' => "Email sudah pernah digunakan",
        //     'password.required' => "Password wajib diisi",
        //     'password.min' => "Password minimal 8 karakter",
        //     'password.max' => "Password maksimal 50 karakter",
        //     'password.confirmed' => "Konfirmasi password tidak sesuai",
        //     'kabupaten.required' => "Kolom kabupaten Wajib diisi",
        //     'kecamatan.required' => "Kolom kecamatan Wajib diisi",
        //     'desa.required' => "Kolom desa Wajib diisi",
        //     'banjar.required' => "Kolom Banjar Wajib diisi",

        // ]);

        $cekUser = User::where('email', $request->email)->count();
        if($cekUser > 0) {
            return response()->json([
                'status_register' => 'email sama',
                'status_code' => 200
            ]);
        }
        else {
            if($request->idKK != null){
                $user = User::create([
                    'id_kk' => $request->idKK,
                    'id_chat_tele' => null,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'profile_image' => "/images/upload/Profile/deafult.jpg",
                    'is_verified' => 0,
                    'role' => '0'
                ]);

                $anak = $user->anak()->create([
                    'id_posyandu' => $request->banjar,
                    'nama_anak' => $request->nama,
                ]);

                return response()->json([
                    'status_register' => 'sukses',
                    'status_code' => 200
                ]);

            }else{
                // $this->validate($request,[
                //     'file'=> 'required|image|mimes:jpeg,png,jpg',
                //     'file.required' => "Kolom Upload File Wajib Diisi ",
                //     'file.image' => "File yang di upload harus berupa foto",
                //     'file.mimes' => "Format yang di dukung hanya : jpeg,png,jpg "
                // ]);


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
                    'role' => '0'
                ]);

                $anak = $user->anak()->create([
                    'id_posyandu' => $request->banjar,
                    'nama_anak' => $request->nama,
                ]);

                return response()->json([
                    'status_register' => 'sukses',
                    'status_code' => 200
                ]);
            }
        }
    }

    public function storeIbu(Request $request)
    {

        // $this->validate($request,[
        //     'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
        //     'email' => "required|email|unique:tb_user,email",
        //     'password' => 'required|min:8|max:50|confirmed',
        //     'kabupaten' => "required",
        //     'kecamatan' => "required",
        //     'desa' => "required",
        //     'banjar' => "required",

        // ],
        // [
        //     'nama.required' => "Nama Lengkap wajib diisi",
        //     'nama.regex' => "Format Nama Lengkap tidak sesuai",
        //     'nama.min' => "Nama Lengkap minimal 2 karakter",
        //     'nama.max' => "Nama Lengkap maksimal 50 karakter",
        //     'email.required' => "Email wajib diisi",
        //     'email.email' => "Masukan email yang valid",
        //     'email.unique' => "Email sudah pernah digunakan",
        //     'password.required' => "Password wajib diisi",
        //     'password.min' => "Password minimal 8 karakter",
        //     'password.max' => "Password maksimal 50 karakter",
        //     'password.confirmed' => "Konfirmasi password tidak sesuai",
        //     'kabupaten.required' => "Kolom kabupaten Wajib diisi",
        //     'kecamatan.required' => "Kolom kecamatan Wajib diisi",
        //     'desa.required' => "Kolom desa Wajib diisi",
        //     'banjar.required' => "Kolom Banjar Wajib diisi",

        // ]);

        $cekUser = User::where('email', $request->email)->count();
        if($cekUser > 0) {
            return response()->json([
                'status_register' => 'email sama',
                'status_code' => 200
            ]);
        }
        else {
            if($request->idKK != null){
                $user = User::create([
                    'id_kk' => $request->idKK,
                    'id_chat_tele' => null,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'profile_image' => "/images/upload/Profile/deafult.jpg",
                    'is_verified' => 0,
                    'role' => '1'
                ]);

                $anak = $user->ibu()->create([
                    'id_posyandu' => $request->banjar,
                    'nama_ibu_hamil' => $request->nama,
                ]);

                return response()->json([
                    'status_register' => 'sukses',
                    'status_code' => 200
                ]);

            }else{
                // $this->validate($request,[
                //     'file'=> 'required|image|mimes:jpeg,png,jpg',
                //     'file.required' => "Kolom Upload File Wajib Diisi ",
                //     'file.image' => "File yang di upload harus berupa foto",
                //     'file.mimes' => "Format yang di dukung hanya : jpeg,png,jpg "
                // ]);

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
                    'role' => '1'
                ]);

                $anak = $user->ibu()->create([
                    'id_posyandu' => $request->banjar,
                    'nama_ibu_hamil' => $request->nama,
                ]);

                return response()->json([
                    'status_register' => 'sukses',
                    'status_code' => 200
                ]);
            }
        }
    }

    public function storeLansia(Request $request)
    {
        // dd($request->all());
        // $this->validate($request,[
        //     'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
        //     'email' => "required|email|unique:tb_user,email",
        //     'password' => 'required|min:8|max:50|confirmed',
        //     'kabupaten' => "required",
        //     'kecamatan' => "required",
        //     'desa' => "required",
        //     'banjar' => "required",

        // ],
        // [
        //     'nama.required' => "Nama Lengkap wajib diisi",
        //     'nama.regex' => "Format Nama Lengkap tidak sesuai",
        //     'nama.min' => "Nama Lengkap minimal 2 karakter",
        //     'nama.max' => "Nama Lengkap maksimal 50 karakter",
        //     'email.required' => "Email wajib diisi",
        //     'email.email' => "Masukan email yang valid",
        //     'email.unique' => "Email sudah pernah digunakan",
        //     'password.required' => "Password wajib diisi",
        //     'password.min' => "Password minimal 8 karakter",
        //     'password.max' => "Password maksimal 50 karakter",
        //     'password.confirmed' => "Konfirmasi password tidak sesuai",
        //     'kabupaten.required' => "Kolom kabupaten Wajib diisi",
        //     'kecamatan.required' => "Kolom kecamatan Wajib diisi",
        //     'desa.required' => "Kolom desa Wajib diisi",
        //     'banjar.required' => "Kolom Banjar Wajib diisi",

        // ]);

        $cekUser = User::where('email', $request->email)->count();
        if($cekUser > 0) {
            return response()->json([
                'status_register' => 'email sama',
                'status_code' => 200
            ]);
        }
        else {
            if($request->idKK != null){
                $user = User::create([
                    'id_kk' => $request->idKK,
                    'id_chat_tele' => null,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'profile_image' => "/images/upload/Profile/deafult.jpg",
                    'is_verified' => 0,
                    'role' => '2'
                ]);

                $anak = $user->lansia()->create([
                    'id_posyandu' => $request->banjar,
                    'nama_lansia' => $request->nama,
                ]);

                return response()->json([
                    'status_register' => 'sukses',
                    'status_code' => 200
                ]);

            }else{
                // $this->validate($request,[
                //     'file'=> 'required|image|mimes:jpeg,png,jpg',
                //     'file.required' => "Kolom Upload File Wajib Diisi ",
                //     'file.image' => "File yang di upload harus berupa foto",
                //     'file.mimes' => "Format yang di dukung hanya : jpeg,png,jpg "
                // ]);

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
                    'role' => '2'
                ]);

                $anak = $user->lansia()->create([
                    'id_posyandu' => $request->banjar,
                    'nama_lansia' => $request->nama,
                ]);

                return response()->json([
                    'status_register' => 'sukses',
                    'status_code' => 200
                ]);
            }
        }
    }

    public function getAllPosyandu(Request $request) {
        $data = Kabupaten::query()
            ->with(['kecamatan' => function($qkecamatan) {
                $qkecamatan->with(['desa' => function($qdesa) {
                    $qdesa->with(['posyandu']);
                }]);
            },
        ])->get();

        return response()->json([
            'status_code' => 200,
            'data' => $data
        ]);
    }
}
