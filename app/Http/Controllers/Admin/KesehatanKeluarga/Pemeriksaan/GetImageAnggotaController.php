<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga\Pemeriksaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Mover;
use App\User;

class GetImageAnggotaController extends Controller
{
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
}
