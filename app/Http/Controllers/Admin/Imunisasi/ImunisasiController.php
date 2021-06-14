<?php

namespace App\Http\Controllers\Admin\Imunisasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Anak;
use App\Ibu;
use Carbon\Carbon;
use App\Lansia;
use App\Imunisasi;

class ImunisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function semuaJenisImunisasi()
    {
        $imunisasi = Imunisasi::orderBy('created_at', 'desc')->where('deleted_at', NULL)->get();
        
        return view('admin.imunisasi.semua-imunisasi', compact('imunisasi'));
    }

    public function tambahImunisasi()
    {
        return view('admin.imunisasi.tambah-imunisasi');
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
            'nama_imunisasi.required' => "Nama imunisasi wajib diisi",
            'nama_imunisasi.unique' => "Imunisasi telah ditambahkan sebelumnya",
            'nama_imunisasi.regex' => "Format nama imunisasi tidak sesuai",
            'nama_imunisasi.min' => "Nama imunisasi minimal berjumlah 2 karakter",
            'nama_imunisasi.max' => "Nama imunisasi maksimal berjumlah 50 karakter",
            'usia_pemberian.required' => "Usia pemberian imunisasi wajib diisi",
            'usia_pemberian.regex' => "Format usia pemberian imunisasi tidak sesuai",
            'usia_pemberian.min' => "Penulisan usia pemberian imunisasi minimal berjumlah 5 karakter",
            'usia_pemberian.max' => "Penulisan usia pemberian imunisasi maksimal berjumlah 50 karakter",
            'perulangan.required' => "Frekuensi perulangan imunisasi wajib diisi",
            'perulangan.regex' => "Format perulangan imunisasi tidak sesuai",
            'perulangan.min' => "Penulisan perulangan imunisasi minimal berjumlah 5 karakter",
            'perulangan.max' => "Penulisan perulangan imunisasi maksimal berjumlah 50 karakter",
            'keterangan.required' => "Deskripsi imunisasi wajib diisi",
            'status.required' => "Status imunisasi wajib diisi",
            'status.in' => "Status imunisasi tidak terdaftar",
            'penerima.required' => "Pemerima imunisasi wajib diisi",
            'penerima.in' => "Pemerima imunisasi tidak terdaftar",
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
            return redirect()->back()->with(['success' => 'Imunisasi Berhasil Ditambahkan']);
        } else {
            return redirect()->back()->with(['failed' => 'Imunisasi Gagal Ditambahkan']);
        }
    }

    public function detailImunisasi(Imunisasi $imunisasi)
    {
        return view('admin.imunisasi.detail-imunisasi', compact('imunisasi'));
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
                'nama_imunisasi.required' => "Nama imunisasi wajib diisi",
                'nama_imunisasi.unique' => "Imunisasi telah ditambahkan sebelumnya",
                'nama_imunisasi.regex' => "Format nama imunisasi tidak sesuai",
                'nama_imunisasi.min' => "Nama imunisasi minimal berjumlah 2 karakter",
                'nama_imunisasi.max' => "Nama imunisasi maksimal berjumlah 50 karakter",
                'usia_pemberian.required' => "Usia pemberian imunisasi wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian imunisasi tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian imunisasi minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian imunisasi maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan imunisasi wajib diisi",
                'perulangan.regex' => "Format perulangan imunisasi tidak sesuai",
                'perulangan.min' => "Penulisan perulangan imunisasi minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan imunisasi maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi imunisasi wajib diisi",
                'status.required' => "Status imunisasi wajib diisi",
                'status.in' => "Status imunisasi tidak terdaftar",
                'penerima.required' => "Pemerima imunisasi wajib diisi",
                'penerima.in' => "Pemerima imunisasi tidak terdaftar",
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
                return redirect()->back()->with(['success' => 'Imunisasi Berhasil Diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Imunisasi Gagal Diperbaharui']);
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
                'nama_imunisasi.required' => "Nama imunisasi wajib diisi",
                'nama_imunisasi.regex' => "Format nama imunisasi tidak sesuai",
                'nama_imunisasi.min' => "Nama imunisasi minimal berjumlah 2 karakter",
                'nama_imunisasi.max' => "Nama imunisasi maksimal berjumlah 50 karakter",
                'usia_pemberian.required' => "Usia pemberian imunisasi wajib diisi",
                'usia_pemberian.regex' => "Format usia pemberian imunisasi tidak sesuai",
                'usia_pemberian.min' => "Penulisan usia pemberian imunisasi minimal berjumlah 5 karakter",
                'usia_pemberian.max' => "Penulisan usia pemberian imunisasi maksimal berjumlah 50 karakter",
                'perulangan.required' => "Frekuensi perulangan imunisasi wajib diisi",
                'perulangan.regex' => "Format perulangan imunisasi tidak sesuai",
                'perulangan.min' => "Penulisan perulangan imunisasi minimal berjumlah 5 karakter",
                'perulangan.max' => "Penulisan perulangan imunisasi maksimal berjumlah 50 karakter",
                'keterangan.required' => "Deskripsi imunisasi wajib diisi",
                'status.required' => "Status imunisasi wajib diisi",
                'status.in' => "Status imunisasi tidak terdaftar",
                'penerima.required' => "Pemerima imunisasi wajib diisi",
                'penerima.in' => "Pemerima imunisasi tidak terdaftar",
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
                return redirect()->back()->with(['success' => 'Imunisasi Berhasil Diperbaharui']);
            } else {
                return redirect()->back()->with(['failed' => 'Imunisasi Gagal Diperbaharui']);
            }
        }
    }

    public function hapusImunisasi(Imunisasi $imunisasi)
    {
        $today = Carbon::now()->setTimezone('GMT+8');

        $updateImunisasi = Imunisasi::where('id', $imunisasi->id)->update([
            'deleted_at' => $today
        ]);

        if ($updateImunisasi) {
            return redirect()->back()->with(['success' => 'Imunisasi Berhasil Dihapus']);
        } else {
            return redirect()->back()->with(['failed' => 'Imunisasi Gagal Dihapus']);
        }
    }
}
