<?php

namespace App\Http\Controllers\Admin\ManajemenAkun\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mover;
use App\Admin;
use App\SuperAdmin;
use App\Pegawai;
use App\Nakes;

class GetImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getProfileImage(Admin $admin)
    {
        if( File::exists(storage_path($admin->profile_image)) && $admin->profile_image != NULL ) {
            return response()->file(
                storage_path($admin->profile_image)
            );
        } else {
            return response()->file(
                public_path('images/sipandu-logo.png')
            );
        }
    }

    public function getImageKTPSuperAdmin(SuperAdmin $superAdmin)
    {
        if( File::exists(storage_path($superAdmin->file_ktp)) && $superAdmin->file_ktp != NULL ) {
            return response()->file(
                storage_path($superAdmin->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }
    }

    public function getImageKTPNakes(Nakes $nakes)
    {
        if( File::exists(storage_path($nakes->file_ktp)) && $nakes->file_ktp != NULL ) {
            return response()->file(
                storage_path($nakes->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }
    }

    public function getImageKTPHeadAdmin(Pegawai $pegawai)
    {
        if( File::exists(storage_path($pegawai->file_ktp)) && $pegawai->file_ktp != NULL ) {
            return response()->file(
                storage_path($pegawai->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }
    }

    public function getImageKTPAdmin(Pegawai $pegawai)
    {
        if( File::exists(storage_path($pegawai->file_ktp)) && $pegawai->file_ktp != NULL ) {
            return response()->file(
                storage_path($pegawai->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }
    }

    public function getImageKTPKader(Pegawai $pegawai)
    {
        if( File::exists(storage_path($pegawai->file_ktp)) && $pegawai->file_ktp != NULL ) {
            return response()->file(
                storage_path($pegawai->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }
    }
}
