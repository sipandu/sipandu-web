<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posyandu;
use App\Pegawai;
use App\Admin;
use App\KK;

class AdminController extends Controller
{


    public function index(Request $request)
    {
        return view('pages/admin/dashboard');
    }


    public function profile(Request $request)
    {
        return view('pages/auth/admin/profile-admin');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $path ='/images/upload/Profile/'.time().'-'.$request->file->getClientOriginalName();
        $imageName = time().'-'.$request->file->getClientOriginalName();

        $request->file->move(public_path('images/upload/Profile'),$imageName);

        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->profile_image = $path;
        $admin->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
        ]);


    }

    public function accountUpdate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'telegram' => 'required',
            'notlpn' => 'required',
        ]);

        $idAdmin = Auth::guard('admin')->user()->id;
        $admin = Admin::find($idAdmin);
        $admin->email = $request->email;
        $admin->save();

        $pegawai = Pegawai::where('id_admin',$idAdmin)->first();
        $pegawai->username_telegram = $request->telegram;
        $pegawai->nomor_telepon = $request->notlpn;
        $pegawai->save();

        return redirect()->back()->with(['success' => 'Perubahan berhasil di simpan']);

    }



}
