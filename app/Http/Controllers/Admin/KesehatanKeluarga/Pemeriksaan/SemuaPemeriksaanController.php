<?php

namespace App\Http\Controllers\Admin\KesehatanKeluarga\Pemeriksaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Mover;
use Carbon\Carbon;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Imunisasi;
use App\KK;
use App\Vitamin;
use App\Posyandu;
use App\Nakes;
use App\NakesPosyandu;
use App\PemeriksaanIbu;
use App\PemeriksaanAnak;
use App\PemeriksaanLansia;
use App\PemberianImunisasi;
use App\PemberianVitamin;
use App\Alergi;
use App\Persalinan;
use App\PenyakitBawaan;
use App\RiwayatPenyakit;
use App\PjLansia;

class SemuaPemeriksaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function semuaPemeriksaanAnggota()
    {
        if ( auth()->guard('admin')->user()->role == 'super admin' ) {
            if ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Provinsi' ) {
                $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();
                if ( count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->get();
                    $anak = Anak::whereIn('id_user', $anggota_id->toArray())->get();
                    $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            } elseif ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kabupaten' ) {
                $id_kecamatan = Kecamatan::where('id_kabupaten', auth()->guard('admin')->user()->superAdmin->id_kabupaten)->select('id')->get();
                $id_desa = Desa::whereIn('id_kecamatan', $id_kecamatan->toArray())->select('id')->get();

                $id_posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->select('id')->get();
                $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();

                if ( count($id_posyandu) > 0 && count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            } elseif ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kecamatan' ) {
                $id_desa = Desa::where('id_kecamatan', auth()->guard('admin')->user()->superAdmin->id_kecamatan)->select('id')->get();
                $id_posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->select('id')->get();
                $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();

                if ( count($id_posyandu) > 0 && count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            }
        } elseif ( auth()->guard('admin')->user()->role == 'tenaga kesehatan' ) {
            $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();
            $id_posyandu = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();

            if ( count($id_posyandu) > 0 && count($anggota_id) ) {
                $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $anak = Anak::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
            } else {
                $ibu = NULL;
                $anak = NULL;
                $lansia = NULL;
            }
        } elseif ( auth()->guard('admin')->user()->role == 'pegawai' ) {
            $anggota_id = User::where('is_verified', '1')->where('status', 1)->select('id')->get();
            if ( count($anggota_id) > 0 ) {
                $ibu = Ibu::whereIn('id_user', $anggota_id->toArray())->where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
                $anak = Anak::whereIn('id_user', $anggota_id->toArray())->where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
                $lansia = Lansia::whereIn('id_user', $anggota_id->toArray())->where('id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)->get();
            } else {
                $ibu = NULL;
                $anak = NULL;
                $lansia = NULL;
            }
        }

        return view('admin.kesehatan-keluarga.pemeriksaan.semua-pemeriksaan-anggota', compact('ibu', 'anak', 'lansia') );
    }
}
