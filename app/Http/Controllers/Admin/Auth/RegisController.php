<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mover;
use App\Posyandu;
use App\Pegawai;
use App\Admin;
use App\User;
use App\Kabupaten;
use App\Kecamatan;
use App\SuperAdmin;
use App\Anak;
use App\Nakes;
use App\NakesPosyandu;
use App\Ibu;
use App\Lansia;
use App\KK;

class RegisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
