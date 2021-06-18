<?php

namespace App\Http\Controllers\Admin\PengaturanAkun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posyandu;
use App\Admin;
use App\User;
use App\Anak;
use App\Ibu;
use App\NakesPosyandu;
use App\Lansia;
use App\KK;

class SemuaVerifikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function verifikasiAnggota()
    {
        if ( auth()->guard('admin')->user()->role == 'super admin' ) {
            if ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Provinsi' ) {
                $anggota_id = User::where('is_verified', '0')->where('keterangan', NULL)->select('id')->get();
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
                $anggota_id = User::where('is_verified', '0')->where('keterangan', NULL)->select('id')->get();

                if ( count($id_posyandu) > 0 && count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            } elseif ( auth()->guard('admin')->user()->superAdmin->area_tugas == 'Kecamatan' ) {
                $id_desa = Desa::where('id_kecamatan', auth()->guard('admin')->user()->superAdmin->id_kecamatan)->select('id')->get();
                $id_posyandu = Posyandu::whereIn('id_desa', $id_desa->toArray())->select('id')->get();
                $anggota_id = User::where('is_verified', '0')->where('keterangan', NULL)->select('id')->get();

                if ( count($id_posyandu) > 0 && count($anggota_id) > 0 ) {
                    $ibu = Ibu::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $anak = Anak::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                    $lansia = Lansia::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                } else {
                    $ibu = NULL;
                    $anak = NULL;
                    $lansia = NULL;
                }
            }
        } elseif ( auth()->guard('admin')->user()->role == 'tenaga kesehatan' ) {
            $anggota_id = User::where('is_verified', '0')->where('keterangan', NULL)->select('id')->get();
            $id_posyandu = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();

            if ( count($id_posyandu) > 0 && count($anggota_id) ) {
                $ibu = Ibu::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $anak = Anak::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
                $lansia = Lansia::whereIn('id_user', $anggota->toArray())->whereIn('id_posyandu', $id_posyandu)->get();
            } else {
                $ibu = NULL;
                $anak = NULL;
                $lansia = NULL;
            }
        } elseif ( auth()->guard('admin')->user()->role == 'pegawai' ) {
            $anggota_id = User::where('is_verified', '0')->where('keterangan', NULL)->select('id')->get();
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

        return view('admin.pengaturan-akun.semua-verifikasi', compact('anak', 'ibu', 'lansia'));
    }
}
