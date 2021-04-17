<?php

namespace App\Http\Controllers\Admin\ImunisasiVitamin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Vitamin;

class VitaminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function tambahVitamin(Request $request)
    {
        return view('pages/admin/vitamin/tambah-vitamin');
    }

    public function storeVitamin(Request $request)
    {
        $this->validate($request,[
            'nama_vitamin' => "required|unique:tb_jenis_vitamin,nama_vitamin|regex:/^[a-z,. 0-9]+$/i|min:1|max:50",
            'usia_pemberian' => 'required|regex:/^[a-z 0-9]+$/i|min:2|max:25',
            'perulangan' => 'required|regex:/^[a-z 0-9]+$/i|min:5|max:25',
            'keterangan' => 'required',
            'status' => 'required',
            'penerima' => 'required',
        ],
        [
            'nama_vitamin.required' => "Nama Vitamin wajib diisi",
            'nama_vitamin.unique' => "Vitamin telah ditambahkan sebelumnya",
            'nama_vitamin.regex' => "Format nama Vitamin tidak sesuai",
            'nama_vitamin.min' => "Nama Vitamin minimal berjumlah 1 huruf",
            'nama_vitamin.max' => "Nama Vitamin maksimal berjumlah 50 huruf",
            'usia_pemberian.required' => "Usia pemberian Vitamin wajib diisi",
            'usia_pemberian.regex' => "Format usia pemberian Vitamin tidak sesuai",
            'usia_pemberian.min' => "Penulisan usia pemberian Vitamin minimal berjumlah 5 karakter",
            'usia_pemberian.max' => "Penulisan usia pemberian Vitamin maksimal berjumlah 50 karakter",
            'perulangan.required' => "Frekuensi perulangan Vitamin wajib diisi",
            'perulangan.regex' => "Format perulangan Vitamin tidak sesuai",
            'perulangan.min' => "Penulisan perulangan Vitamin minimal berjumlah 5 karakter",
            'perulangan.max' => "Penulisan perulangan Vitamin maksimal berjumlah 50 karakter",
            'keterangan.required' => "Deskripsi Vitamin wajib diisi",
            'status.required' => "Status Vitamin wajib diisi",
            'penerima.required' => "Pemerima Vitamin wajib diisi",
        ]);

        if ($request->status == "Wajib" || $request->status == "Tidak Wajib") {
            if ($request->penerima == "Ibu Hamil" || $request->penerima == "Anak" || $request->penerima == "Lansia") {
                $vitamin = Vitamin::create([
                    'nama_vitamin' => $request->nama_vitamin,
                    'usia_pemberian' => $request->usia_pemberian,
                    'perulangan' => $request->perulangan,
                    'deskripsi' => $request->keterangan,
                    'status' => $request->status,
                    'penerima' => $request->penerima,
                ]);
            } else {
                return redirect()->back()->with(['failed' => 'Penerima Vitamin Tidak Terdaftar']);
            }
        } else {
            return redirect()->back()->with(['failed' => 'Status Vitamin Tidak Terdaftar']);
        }
        
        if ($vitamin) {
            return redirect()->back()->with(['success' => 'Vitamin '.$vitamin->nama_imunisasi.' berhasil ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Vitamin gagal ditambahkan']);
        }
    }

    public function jenisVitamin()
    {
        $vitamin = Vitamin::orderBy('created_at', 'desc')->get();

        return view('pages/admin/vitamin/jenis-vitamin', compact('vitamin'));
    }

    public function detailVitamin(Vitamin $vitamin)
    {
        $vitamin = Vitamin::where('id', $vitamin->id)->get()->first();

        return view('pages/admin/vitamin/detail-vitamin', compact('vitamin'));
    }

    public function updateVitamin(Vitamin $vitamin, Request $request)
    {
        if ($request->nama_vitamin != $vitamin->nama_vitamin) {
            $this->validate($request,[
                'nama_vitamin' => "required|unique:tb_jenis_vitamin,nama_vitamin|regex:/^[a-z,. 0-9]+$/i|min:1|max:50",
                'usia_pemberian' => 'required|regex:/^[a-z 0-9]+$/i|min:2|max:25',
                'perulangan' => 'required|regex:/^[a-z 0-9]+$/i|min:5|max:25',
                'keterangan' => 'required',
                'status' => "required",
                'penerima' => "required",
            ],
            [
                'nama_vitamin.required' => "Nama Vitamin wajib diisi",
                'nama_vitamin.unique' => "Vitamin telah ditambahkan sebelumnya",
                'nama_vitamin.regex' => "Format nama Vitamin tidak sesuai",
                'nama_vitamin.min' => "Nama Vitamin minimal berjumlah 1 huruf",
                'nama_vitamin.max' => "Nama Vitamin maksimal berjumlah 50 huruf",
                'usia_pemberian.required' => "Usia pemberian Imunisasai wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian Imunisasai tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian Vitamin minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian Vitamin maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan Imunisasai wajib diisi",
                'perulangan.regex' => "Format perulangan Imunisasai tidak sesuai",
                'perulangan.min' => "Penulisan perulangan Vitamin minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan Vitamin maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi Vitamin wajib diisi",
                'status.required' => "Status Vitamin wajib diisi",
                'penerima.required' => "Pemerima Vitamin wajib diisi",
            ]);

            if ($request->status == "Wajib" || $request->status == "Tidak Wajib") {
                if ($request->penerima == "Ibu Hamil" || $request->penerima == "Anak" || $request->penerima == "Lansia") {
                    $updateVitamin = Vitamin::where('id', $vitamin->id)->update([
                        'nama_vitamin' => $request->nama_vitamin,
                        'usia_pemberian' => $request->usia_pemberian,
                        'perulangan' => $request->perulangan,
                        'deskripsi' => $request->keterangan,
                        'status' => $request->status,
                        'penerima' => $request->penerima,
                    ]);
                } else {
                    return redirect()->back()->with(['failed' => 'Penerima Vitamin Tidak Terdaftar']);
                }
            } else {
                return redirect()->back()->with(['failed' => 'Status Vitamin Tidak Terdaftar']);
            }

            if ($updateVitamin) {
                return redirect()->back()->with(['success' => 'Data Vitamin '.$request->nama_vitamin.' berhasil diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Vitamin gagal diperbaharui']);
            }
        } else {
            $this->validate($request,[
                'nama_vitamin' => "required|regex:/^[a-z,. 0-9]+$/i|min:1|max:50",
                'usia_pemberian' => 'required|regex:/^[a-z 0-9]+$/i|min:2|max:25',
                'perulangan' => 'required|regex:/^[a-z 0-9]+$/i|min:5|max:25',
                'keterangan' => 'required',
                'status' => "required",
                'penerima' => "required",
            ],
            [
                'nama_vitamin.required' => "Nama Vitamin wajib diisi",
                'nama_vitamin.regex' => "Format nama Vitamin tidak sesuai",
                'nama_vitamin.min' => "Nama Vitamin minimal berjumlah 1 huruf",
                'nama_vitamin.max' => "Nama Vitamin maksimal berjumlah 50 huruf",
                'usia_pemberian.required' => "Usia pemberian Imunisasai wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian Imunisasai tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian Vitamin minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian Vitamin maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan Imunisasai wajib diisi",
                'perulangan.regex' => "Format perulangan Imunisasai tidak sesuai",
                'perulangan.min' => "Penulisan perulangan Vitamin minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan Vitamin maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi Vitamin wajib diisi",
                'status.required' => "Status Vitamin wajib diisi",
                'penerima.required' => "Pemerima Vitamin wajib diisi",
            ]);

            if ($request->status == "Wajib" || $request->status == "Tidak Wajib") {
                if ($request->penerima == "Ibu Hamil" || $request->penerima == "Anak" || $request->penerima == "Lansia") {
                    $updateVitamin = Vitamin::where('id', $vitamin->id)->update([
                        'nama_vitamin' => $request->nama_vitamin,
                        'usia_pemberian' => $request->usia_pemberian,
                        'perulangan' => $request->perulangan,
                        'deskripsi' => $request->keterangan,
                        'status' => $request->status,
                        'penerima' => $request->penerima,
                    ]);
                } else {
                    return redirect()->back()->with(['failed' => 'Penerima Vitamin Tidak Terdaftar']);
                }
            } else {
                return redirect()->back()->with(['failed' => 'Status Vitamin Tidak Terdaftar']);
            }

            if ($updateVitamin) {
                return redirect()->back()->with(['success' => 'Data Vitamin '.$request->nama_vitamin.' berhasil diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Data Vitamin gagal diperbaharui']);
            }
        }
    }
}
