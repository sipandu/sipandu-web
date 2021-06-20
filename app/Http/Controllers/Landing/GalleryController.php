<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Kegiatan;
use App\DokumentasiKegiatan;
use Carbon\Carbon;

class GalleryController extends Controller
{
    public function getImage($id)
    {
        $dokumentasi_kegiatan = DokumentasiKegiatan::find($id);

        if(File::exists(storage_path($dokumentasi_kegiatan->image))) {
            return response()->file(
                storage_path($dokumentasi_kegiatan->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }
    }

    public function semuaGaleri()
    {
        $kegiatan = Kegiatan::where('status', 'Tampil')->where('end_at', '<', Carbon::now()->setTimezone('GMT+8')->toDateString())->paginate(6);
        $dokumentasi_kegiatan = DokumentasiKegiatan::get();
        // $foto_dokumentasi = [];
        // $id_kegiatan = [];

        // foreach ($dokumentasi_kegiatan as $data) {
        //     $id_kegiatan[] = $data->id_kegiatan;
        // }

        // foreach ($id_kegiatan as $item) {
        //     foreach ($kegiatan->where('id', $item) as $data) {
        //         $foto_dokumentasi[] = $data;
        //     }
        // }


        // $ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
        //     ->select('tb_ibu_hamil.*')
        //     ->where('tb_ibu_hamil.id_posyandu', auth()->guard('admin')->user()->pegawai->id_posyandu)
        //     ->where('tb_user.is_verified', 1)
        //     ->where('tb_user.keterangan', NULL)
        //     ->orderBy('tb_ibu_hamil.created_at', 'desc')
        // ->get();

        // $dokumentasi_kegiatan = DokumentasiKegiatan::join('tb_kegiatan', 'tb_kegiatan.id', 'tb_dokumentasi_kegiatan.id_kegiatan')
        //     ->select('tb_kegiatan.*', 'tb_dokumentasi_kegiatan.image')
        //     ->where('tb_kegiatan.status', 'Tampil')
        //     ->where('tb_kegiatan.deleted_at', NULL)
        //     ->orderBy('tb_kegiatan.created_at', 'desc')
        // ->get();

        // return($dokumentasi_kegiatan);

        return view('landing.gallery.gallery', compact('kegiatan', 'dokumentasi_kegiatan'));
    }

    public function detailGaleri($slug)
    {
        $kegiatan = Kegiatan::where('status', 'Tampil')
                    ->where('end_at', '<', date('Y-m-d'))
                    ->where('slug', $slug)
        ->first();
        $dokumentasi_kegiatan = DokumentasiKegiatan::where('id_kegiatan', $kegiatan->id)->get();

        return view('landing.gallery.gallery-detail', compact('kegiatan', 'dokumentasi_kegiatan'));
    }
}
