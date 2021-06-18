<?php

namespace App\Http\Controllers\Admin\PengaturanAkun\KonfirmasiAnggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\User;
use App\KK;

class GetKkAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getKk($id)
    {
        $kk = KK::where('id', $id)->get()->first();

        if( File::exists(storage_path($kk->file_ktp)) && $kk->file_ktp != NULL ) {
            return response()->file(
                storage_path($kk->file_ktp)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }
    }
}
