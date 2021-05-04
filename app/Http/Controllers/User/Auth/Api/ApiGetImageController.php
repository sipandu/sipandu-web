<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\InformasiPenting;
use Illuminate\Http\Request;
use App\Mover;
use Illuminate\Support\Str;
use File;
use App\Http\Controllers\Controller;

class ApiGetImageController extends Controller
{
    //
    public function getInformasiImage($id)
    {
        $informasi = InformasiPenting::find($id);

        if(File::exists(storage_path($informasi->image))) {
            return response()->file(
                storage_path($informasi->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }
    }

    public function getPengumumanImage($id)
    {
        $pengumuman = Pengumuman::find($id);

        if(File::exists(storage_path($pengumuman->image))) {
            return response()->file(
                storage_path($pengumuman->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }
    }
}
