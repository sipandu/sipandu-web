<?php

namespace App\Http\Controllers\Admin\ManajemenAkun\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Mover;
use App\User;
use App\KK;


class GetImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getProfileImage(User $user)
    {
        if( File::exists(storage_path($user->profile_image)) && $user->profile_image != NULL ) {
            return response()->file(
                storage_path($user->profile_image)
            );
        } else {
            return response()->file(
                public_path('images/sipandu-logo.png')
            );
        }
    }

    public function getKkAnggota(KK $kk)
    {
        if( File::exists(storage_path($kk->file_kk)) && $kk->file_kk != NULL ) {
            return response()->file(
                storage_path($kk->file_kk)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }
    }
}
