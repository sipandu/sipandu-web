<?php

namespace App\Http\Controllers\Admin\Vitamin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

    public function semuaJenisVitamin()
    {
        $vitamin = Vitamin::orderBy('created_at', 'desc')->where('deleted_at', NULL)->get();

        return view('admin.vitamin.semua-vitamin', compact('vitamin'));
    }

    public function tambahVitamin(Request $request)
    {
        return view('admin.vitamin.tambah-vitamin');
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
            'nama_vitamin.required' => "Nama vitamin wajib diisi",
            'nama_vitamin.unique' => "Vitamin telah ditambahkan sebelumnya",
            'nama_vitamin.regex' => "Format nama vitamin tidak sesuai",
            'nama_vitamin.min' => "Nama vitamin minimal berjumlah 1 karakter",
            'nama_vitamin.max' => "Nama vitamin maksimal berjumlah 50 karakter",
            'usia_pemberian.required' => "Usia pemberian vitamin wajib diisi",
            'usia_pemberian.regex' => "Format usia pemberian vitamin tidak sesuai",
            'usia_pemberian.min' => "Penulisan usia pemberian vitamin minimal berjumlah 5 karakter",
            'usia_pemberian.max' => "Penulisan usia pemberian vitamin maksimal berjumlah 50 karakter",
            'perulangan.required' => "Frekuensi perulangan vitamin wajib diisi",
            'perulangan.regex' => "Format perulangan vitamin tidak sesuai",
            'perulangan.min' => "Penulisan perulangan vitamin minimal berjumlah 5 karakter",
            'perulangan.max' => "Penulisan perulangan vitamin maksimal berjumlah 50 karakter",
            'keterangan.required' => "Deskripsi vitamin wajib diisi",
            'status.required' => "Status vitamin wajib diisi",
            'penerima.required' => "Penerima vitamin wajib diisi",
        ]);

        $vitamin = Vitamin::create([
            'nama_vitamin' => $request->nama_vitamin,
            'usia_pemberian' => $request->usia_pemberian,
            'perulangan' => $request->perulangan,
            'deskripsi' => $request->keterangan,
            'status' => $request->status,
            'penerima' => $request->penerima,
        ]);

        if ($vitamin) {
            return redirect()->back()->with(['success' => 'Vitamin Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Vitamin Gagal Ditambahkan']);
        }
    }

    public function detailVitamin(Vitamin $vitamin)
    {
        return view('admin.vitamin.detail-vitamin', compact('vitamin'));
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
                'nama_vitamin.required' => "Nama vitamin wajib diisi",
                'nama_vitamin.unique' => "Vitamin telah ditambahkan sebelumnya",
                'nama_vitamin.regex' => "Format nama vitamin tidak sesuai",
                'nama_vitamin.min' => "Nama vitamin minimal berjumlah 1 karakter",
                'nama_vitamin.max' => "Nama vitamin maksimal berjumlah 50 karakter",
                'usia_pemberian.required' => "Usia pemberian Imunisasai wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian Imunisasai tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian vitamin minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian vitamin maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan Imunisasai wajib diisi",
                'perulangan.regex' => "Format perulangan Imunisasai tidak sesuai",
                'perulangan.min' => "Penulisan perulangan vitamin minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan vitamin maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi vitamin wajib diisi",
                'status.required' => "Status vitamin wajib diisi",
                'penerima.required' => "Penerima vitamin wajib diisi",
            ]);

            $updateVitamin = Vitamin::where('id', $vitamin->id)->update([
                'nama_vitamin' => $request->nama_vitamin,
                'usia_pemberian' => $request->usia_pemberian,
                'perulangan' => $request->perulangan,
                'deskripsi' => $request->keterangan,
                'status' => $request->status,
                'penerima' => $request->penerima,
            ]);

            if ($updateVitamin) {
                return redirect()->back()->with(['success' => 'Vitamin Berhasil Diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Vitamin Gagal Diperbaharui']);
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
                'nama_vitamin.required' => "Nama vitamin wajib diisi",
                'nama_vitamin.regex' => "Format nama vitamin tidak sesuai",
                'nama_vitamin.min' => "Nama vitamin minimal berjumlah 1 karakter",
                'nama_vitamin.max' => "Nama vitamin maksimal berjumlah 50 karakter",
                'usia_pemberian.required' => "Usia pemberian Imunisasai wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian Imunisasai tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian vitamin minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian vitamin maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan Imunisasai wajib diisi",
                'perulangan.regex' => "Format perulangan Imunisasai tidak sesuai",
                'perulangan.min' => "Penulisan perulangan vitamin minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan vitamin maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi vitamin wajib diisi",
                'status.required' => "Status vitamin wajib diisi",
                'penerima.required' => "Penerima vitamin wajib diisi",
            ]);

            $updateVitamin = Vitamin::where('id', $vitamin->id)->update([
                'nama_vitamin' => $request->nama_vitamin,
                'usia_pemberian' => $request->usia_pemberian,
                'perulangan' => $request->perulangan,
                'deskripsi' => $request->keterangan,
                'status' => $request->status,
                'penerima' => $request->penerima,
            ]);

            if ($updateVitamin) {
                return redirect()->back()->with(['success' => 'Vitamin Berhasil Diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Vitamin Gagal Diperbaharui']);
            }
        }
    }

    public function hapusVitamin(Vitamin $vitamin)
    {
        $today = Carbon::now()->setTimezone('GMT+8');

        $updateVitamin = Vitamin::where('id', $vitamin->id)->update([
            'deleted_at' => $today
        ]);

        if ($updateVitamin) {
            return redirect()->back()->with(['success' => 'Vitamin Berhasil Dihapus']);
        } else {
            return redirect()->back()->with(['failed' => 'Vitamin Gagal Dihapus']);
        }
    }
}
