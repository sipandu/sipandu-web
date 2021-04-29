<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use App\InformasiPenting;
use Illuminate\Http\Request;
use App\Mover;

class ApiInformasiController extends Controller
{
    //
    public function getInformasiHome()
    {
        $informasi = InformasiPenting::orderby('created_at', 'desc')->limit(5)->get()->map(function($item){
            $item->foto = $item->getUrlImage();
            return $item;
        });
        $informasiPopuler = InformasiPenting::orderby('dilihat', 'desc')->limit(3)->get()->map(function($item){
            $item->foto = $item->getUrlImage();
            return $item;
        });
        // $populer_informasi = InformasiPenting::orderby('dilihat', 'desc')->limit(5)->get();
        return response()->json([
            'status_code' => 200,
            'informasi' => $informasi,
            'informasi_populer' => $informasiPopuler,
            'message' => 'success',
        ]);

        // $item->slug
    }


    public function getInformasi(Request $request)
    {
        /*
            0 = paling baru -> paling lama (default)
            1 = paling lama -> paling baru
            2 = paling banyak di view -> paling sedikit
        */

        if ($request->flag == 0) {
            $informasiList = InformasiPenting::paginate(5);
            $informasi = InformasiPenting::orderby('created_at', 'desc')->get()->map(function($item){
                $item->foto = $item->getUrlImage();
                return $item;
            });
            return response()->json([
                'status_code' => 200,
                'informasi' => $informasi,
                'message' => 'success',
            ]);
        }

        else if ($request->flag == 1) {
            $informasi = InformasiPenting::orderby('created_at', 'asc')->get()->map(function($item){
                $item->foto = $item->getUrlImage();
                return $item;
            });
            return response()->json([
                'status_code' => 200,
                'informasi' => $informasi,
                'message' => 'success',
            ]);
        }

        else if ($request->flag == 2) {
            $informasi = InformasiPenting::orderby('dilihat', 'desc')->get()->map(function($item){
                $item->foto = $item->getUrlImage();
                return $item;
            });
            return response()->json([
                'status_code' => 200,
                'informasi' => $informasi,
                'message' => 'success',
            ]);
        }
    }


    public function getImage(Request $request)
    {
        $informasi = InformasiPenting::find($request->id);
        return response()->json([
            'status_code' => 200,
            'path' => storage_path($informasi->image),
            'message' => 'success',
        ]);
    }

    public function show($slug)
    {
        $informasi = InformasiPenting::where('slug', $slug)->first();
        $informasi->dilihat = $informasi->dilihat + 1;
        $informasi->save();
        $informasi_terbaru = InformasiPenting::orderby('created_at', 'desc')->limit(5)->get();
        return view('pages.user.content.detail-news', compact('informasi', 'informasi_terbaru'));
    }
}
