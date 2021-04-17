<?php

namespace App\Http\Controllers\Admin\ImunisasiVitamin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Imunisasi;

class ImunisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function tambahImunisasi()
    {
        return view('pages/admin/imunisasi/tambah-imunisasi');
    }

    public function storeImunisasi(Request $request)
    {
        $this->validate($request,[
            'nama_imunisasi' => "required|unique:tb_jenis_imunisasi,nama_imunisasi|regex:/^[a-z,. 0-9]+$/i|min:2|max:50",
            'usia_pemberian' => 'required|regex:/^[a-z 0-9]+$/i|min:2|max:25',
            'perulangan' => 'required|regex:/^[a-z 0-9]+$/i|min:5|max:25',
            'keterangan' => 'required',
            'status' => 'required',
            'penerima' => 'required',
        ],
        [
            'nama_imunisasi.required' => "Nama Imunisasi wajib diisi",
            'nama_imunisasi.unique' => "Imunisasi telah ditambahkan sebelumnya",
            'nama_imunisasi.regex' => "Format nama Imunisasi tidak sesuai",
            'nama_imunisasi.min' => "Nama Imunisasi minimal berjumlah 2 huruf",
            'nama_imunisasi.max' => "Nama Imunisasi maksimal berjumlah 50 huruf",
            'usia_pemberian.required' => "Usia pemberian Imunisasai wajib diisi",
            'usia_pemberian.regex' => "Format usia pemberian Imunisasai tidak sesuai",
            'usia_pemberian.min' => "Penulisan usia pemberian Imunisasi minimal berjumlah 5 karakter",
            'usia_pemberian.max' => "Penulisan usia pemberian Imunisasi maksimal berjumlah 50 karakter",
            'perulangan.required' => "Frekuensi perulangan Imunisasai wajib diisi",
            'perulangan.regex' => "Format perulangan Imunisasai tidak sesuai",
            'perulangan.min' => "Penulisan perulangan Imunisasi minimal berjumlah 5 karakter",
            'perulangan.max' => "Penulisan perulangan Imunisasi maksimal berjumlah 50 karakter",
            'keterangan.required' => "Deskripsi Imunisasi wajib diisi",
            'status.required' => "Status Imunisasi wajib diisi",
            'status.in' => "Status Imunisasi tidak terdaftar",
            'penerima.required' => "Pemerima Imunisasi wajib diisi",
            'penerima.in' => "Pemerima Imunisasi tidak terdaftar",
        ]);
        
        $imunisasi = Imunisasi::create([
            'nama_imunisasi' => $request->nama_imunisasi,
            'usia_pemberian' => $request->usia_pemberian,
            'perulangan' => $request->perulangan,
            'deskripsi' => $request->keterangan,
            'status' => $request->status,
            'penerima' => $request->penerima,
        ]);

        if ($imunisasi) {
            return redirect()->back()->with(['success' => 'Imunisasi '.$imunisasi->nama_imunisasi.' berhasil ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Imunisasi gagal ditambahkan']);
        }
        
    }

    public function jenisImunisasi()
    {
        $imunisasi = Imunisasi::orderBy('created_at', 'desc')->get();
        
        return view('pages/admin/imunisasi/jenis-imunisasi', compact('imunisasi'));
    }

    public function detailImunisasi(Imunisasi $imunisasi)
    {
        $imunisasi = Imunisasi::where('id', $imunisasi->id)->get()->first();

        return view('pages/admin/imunisasi/detail-imunisasi', compact('imunisasi'));
    }

    public function updateImunisasi(Imunisasi $imunisasi, Request $request)
    {
        if ($request->nama_imunisasi != $imunisasi->nama_imunisasi) {
            $this->validate($request,[
                'nama_imunisasi' => "required|unique:tb_jenis_imunisasi,nama_imunisasi|regex:/^[a-z,. 0-9]+$/i|min:2|max:50",
                'usia_pemberian' => 'required|regex:/^[a-z 0-9]+$/i|min:2|max:25',
                'perulangan' => 'required|regex:/^[a-z 0-9]+$/i|min:5|max:25',
                'keterangan' => 'required',
                'status' => "required",
                'penerima' => "required",
            ],
            [
                'nama_imunisasi.required' => "Nama Imunisasi wajib diisi",
                'nama_imunisasi.unique' => "Imunisasi telah ditambahkan sebelumnya",
                'nama_imunisasi.regex' => "Format nama Imunisasi tidak sesuai",
                'nama_imunisasi.min' => "Nama Imunisasi minimal berjumlah 2 huruf",
                'nama_imunisasi.max' => "Nama Imunisasi maksimal berjumlah 50 huruf",
                'usia_pemberian.required' => "Usia pemberian Imunisasai wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian Imunisasai tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian Imunisasi minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian Imunisasi maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan Imunisasai wajib diisi",
                'perulangan.regex' => "Format perulangan Imunisasai tidak sesuai",
                'perulangan.min' => "Penulisan perulangan Imunisasi minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan Imunisasi maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi Imunisasi wajib diisi",
                'status.required' => "Status Imunisasi wajib diisi",
                'status.in' => "Status Imunisasi tidak terdaftar",
                'penerima.required' => "Pemerima Imunisasi wajib diisi",
                'penerima.in' => "Pemerima Imunisasi tidak terdaftar",
            ]);

            $updateImunisasi = Imunisasi::where('id', $imunisasi->id)->update([
                'nama_imunisasi' => $request->nama_imunisasi,
                'usia_pemberian' => $request->usia_pemberian,
                'perulangan' => $request->perulangan,
                'deskripsi' => $request->keterangan,
                'status' => $request->status,
                'penerima' => $request->penerima,
            ]);

            if ($updateImunisasi) {
                return redirect()->back()->with(['success' => 'Data Imunisasi '.$request->nama_imunisasi.' berhasil diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Imunisasi gagal diperbaharui']);
            }
        } else {
            $this->validate($request,[
                'nama_imunisasi' => "required|regex:/^[a-z,. 0-9]+$/i|min:5|max:50",
                'usia_pemberian' => 'required|regex:/^[a-z 0-9]+$/i|min:2|max:25',
                'perulangan' => 'required|regex:/^[a-z 0-9]+$/i|min:5|max:25',
                'keterangan' => 'required',
                'status' => "required",
                'penerima' => "required",
            ],
            [
                'nama_imunisasi.required' => "Nama Imunisasi wajib diisi",
                'nama_imunisasi.regex' => "Format nama Imunisasi tidak sesuai",
                'nama_imunisasi.min' => "Nama Imunisasi minimal berjumlah 2 huruf",
                'nama_imunisasi.max' => "Nama Imunisasi maksimal berjumlah 50 huruf",
                'usia_pemberian.required' => "Usia pemberian Imunisasai wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian Imunisasai tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian Imunisasi minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian Imunisasi maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan Imunisasai wajib diisi",
                'perulangan.regex' => "Format perulangan Imunisasai tidak sesuai",
                'perulangan.min' => "Penulisan perulangan Imunisasi minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan Imunisasi maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi Imunisasi wajib diisi",
                'status.required' => "Status Imunisasi wajib diisi",
                'status.in' => "Status Imunisasi tidak terdaftar",
                'penerima.required' => "Pemerima Imunisasi wajib diisi",
                'penerima.in' => "Pemerima Imunisasi tidak terdaftar",
            ]);

            $updateImunisasi = Imunisasi::where('id', $imunisasi->id)->update([
                'nama_imunisasi' => $request->nama_imunisasi,
                'usia_pemberian' => $request->usia_pemberian,
                'perulangan' => $request->perulangan,
                'deskripsi' => $request->keterangan,
                'status' => $request->status,
                'penerima' => $request->penerima,
            ]);

            if ($updateImunisasi) {
                return redirect()->back()->with(['success' => 'Data Imunisasi '.$request->nama_imunisasi.' berhasil diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Imunisasi gagal diperbaharui']);
            }
        }
    }
}
