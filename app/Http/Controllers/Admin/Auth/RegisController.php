<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Posyandu;
use App\Pegawai;
use App\Admin;
use App\KK;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisController extends Controller
{
      // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function formAddAdmin(Request $request)
    {
        $posyandu = Posyandu::all();
        return view('pages/auth/admin/new-admin',compact('posyandu'));
    }

    public function formAddUser(Request $request)
    {
        $kk = KK::all();
        return view('pages/auth/admin/new-user', compact('kk'));
    }

    public function formAddKader(Request $request)
    {
        $posyandu = Posyandu::all();
        return view('pages/auth/admin/new-kader',compact('posyandu'));
    }


    public function submitAdmin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'nik' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg',
            'alamat' => 'required',
            'jabatan' => 'required',
            'tlpn' => 'required',
            'telegram' => 'required',
            'posyandu' => 'required',
            'password' => 'required',
            'c_password' => 'required',
        ]);

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
            'id_posyandu' => $request->posyandu,
            'nama_pegawai' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->gender,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'nomor_telepon' => $request->tlpn,
            'username_telegram' => $request->telegram,
            'nik' => $request->nik,
            'file_ktp' => $path,
        ]);

        return redirect()->back();

    }

    public function submitUserIbu(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'nik' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg',
            'alamat' => 'required',
            'jabatan' => 'required',
            'tlpn' => 'required',
            'telegram' => 'required',
            'posyandu' => 'required',
            'password' => 'required',
            'c_password' => 'required',
        ]);


    }

}
