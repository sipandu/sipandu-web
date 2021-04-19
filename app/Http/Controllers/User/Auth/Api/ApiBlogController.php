<?php

namespace App\Http\Controllers\User\Auth\Api;

use App\Http\Controllers\Controller;
use App\InformasiPenting;
use Illuminate\Http\Request;
use App\Mover;

class ApiBlogController extends Controller
{
    //
    public function getInformasiHome()
    {
        $informasi = InformasiPenting::orderby('created_at', 'desc')->limit(3)->get()->map(function($item){
            $item->foto = $item->getUrlImage();
            return $item;
        });
        // $populer_informasi = InformasiPenting::orderby('dilihat', 'desc')->limit(5)->get();
        return response()->json([
            'status_code' => 200,
            'informasi' => $informasi,
            'message' => 'success',
        ]);

        // $item->slug
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
