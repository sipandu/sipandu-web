<?php

namespace App\Http\Controllers;
use App\Kecamatan;
use App\Desa;
use App\Kabupaten;
use App\Posyandu;
use Illuminate\Http\Request;

class AjaxSearchLocation extends Controller
{
    public function kecamatan($id)
    {
        $kecamatan = Kecamatan::where("id_kabupaten",$id)->get();
        return json_encode($kecamatan);
    }

    public function desa($id)
    {
        $desa = Desa::where("id_kecamatan",$id)->get();
        return json_encode($desa);
    }

    public function banjar($id)
    {
        $banjar = Posyandu::where("id_desa",$id)->get();
        echo json_encode($banjar);
    }

    public function getKabupaten()
    {
        $data = Kabupaten::query()
            ->with([
                'kecamatan' => function($qkecamatan) {
                    $qkecamatan->with(['desa']);
                },
            ])->get();
        return response()->json(['data' => $data]);
    }
}
