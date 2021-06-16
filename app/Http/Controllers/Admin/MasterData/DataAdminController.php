<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Mover;
use Carbon\Carbon;
use App\Posyandu;
use App\Admin;
use App\Pegawai;
use App\Kabupaten;
use App\Nakes;
use App\NakesPosyandu;
use App\Kecamatan;
use App\Desa;
use App\Kegiatan;

class DataAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getImage($id)
    {
        $admin = Admin::where('id', $id)->get()->first();

        if( File::exists(storage_path($admin->profile_image)) ) {
            return response()->file(
                storage_path($admin->profile_image)
            );
        } else {
            return response()->file(
                public_path('images/sipandu-logo.png')
            );
        }

        return redirect()->back();
    }

    public function getImageKTP($id)
    {
        $pegawai = Pegawai::where('id', $id)->get()->first();

        if( File::exists(storage_path($pegawai->file_ktp)) ) {
            return response()->file(
                storage_path($pegawai->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }

        return redirect()->back();
    }
}
