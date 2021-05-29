<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Posyandu;
use Mail;
use Illuminate\Mail\Mailable;
use App\Mail\NotificationAccUser;
use App\Mail\NotificationRjctUser;
use App\Pegawai;
use App\Admin;
use App\User;
use App\Anak;
use App\Ibu;
use App\NakesPosyandu;
use App\Lansia;
use App\KK;
use App\Mover;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showVerifyUser(Request $request)
    {
        $id_posyandu = [];
        $login_user = [];
        $ibu = [];
        $anak = [];
        $lansia = [];

        $data_ibu = Ibu::join('tb_user', 'tb_user.id', 'tb_ibu_hamil.id_user')
            ->select('tb_ibu_hamil.*')
            ->where('tb_user.is_verified', 0)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_ibu_hamil.created_at', 'desc')
        ->get();

        $data_anak = Anak::join('tb_user', 'tb_user.id', 'tb_anak.id_user')
            ->select('tb_anak.*')
            ->where('tb_user.is_verified', 0)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_anak.created_at', 'desc')
        ->get();

        $data_lansia = Lansia::join('tb_user', 'tb_user.id', 'tb_lansia.id_user')
            ->select('tb_lansia.*')
            ->where('tb_user.is_verified', 0)
            ->where('tb_user.keterangan', NULL)
            ->orderBy('tb_lansia.created_at', 'desc')
        ->get();

        if (auth()->guard('admin')->user()->role == 'tenaga kesehatan') {
            $nakes = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->select('id_posyandu')->get();
            $login_user = $nakes;
        }
        if (auth()->guard('admin')->user()->role == 'pegawai') {
            $admin = auth()->guard('admin')->user()->pegawai;
            $login_user = $admin;
        }

        foreach ($login_user as $data) {
            $id_posyandu[] = $data->id_posyandu;
        }
        
        foreach ($id_posyandu as $item) {
            foreach ($data_ibu->where('id_posyandu', $item) as $data) {
                $ibu[] = $data;
            }
        }
        foreach ($id_posyandu as $item) {
            foreach ($data_anak->where('id_posyandu', $item) as $data) {
                $anak[] = $data;
            }
        }
        foreach ($id_posyandu as $item) {
            foreach ($data_lansia->where('id_posyandu', $item) as $data) {
                $lansia[] = $data;
            }
        }

        return view('pages/auth/admin/verifikasi/verify-user',compact('anak','ibu','lansia'));
    }

    public function getKKImage($id)
    {
        // $user = User::where('id', $id)->get()->first();
        $kk = KK::where('id', $id)->get()->first();

        if( File::exists(storage_path($kk->file_kk)) ) {
            return response()->file(
                storage_path($kk->file_kk)
            );
        } else {
            return response()->file(
                public_path('images/forms-logo.jpg')
            );
        }

        return redirect()->back();
    }

    public function detailVerifyAnak(Request $request, $id)
    {
        $anak = User::find($id);
        return view('pages/auth/admin/verifikasi/detail-verify-anak',compact('anak'));
    }

    public function detailVerifyLansia(Request $request, $id)
    {
        $lansia = User::find($id);
        return view('pages/auth/admin/verifikasi/detail-verify-lansia',compact('lansia'));
    }

    public function detailVerifyIbu(Request $request, $id)
    {
        $ibu = User::find($id);
        return view('pages/auth/admin/verifikasi/detail-verify-bumil', compact('ibu'));
    }

    public function terimaUser(Request $request)
    {
        $user = User::find($request->iduser);
        $user->is_verified = 1;
        Mail::to($user->email)->send(new NotificationAccUser($user));

        $user->save();
        return redirect()->route('show.verify');

    }

    public function tolakUser(Request $request)
    {
        $this->validate($request, [
            'keterangan' => "required|regex:/^[a-z .,0-9]+$/i|min:5",
        ],
        [
            'keterangan.required' => "Silahkan berikan keterangan",
            'keterangan.regex' => "Format pemberian keterangan tidak sesuai",
            'keterangan.min' => "Keterangan yang diberikan minimal berjumlah 5 karakter",

        ]);

        $user = User::find($request->iduser);
        $user->is_verified = 0;
        $user->keterangan = $request->keterangan;
        $user->save();

        Mail::to($user->email)->send(new NotificationRjctUser($user));

        return redirect()->route('show.verify');
    }

    public function updateStatus(Request $request)
    {
        $this->validate($request, [
            'customRadio' => "required",
        ],
        [
            'customRadio.required' => "Pilihlah Custom Status Anda",
        ]);

        $idAdmin = Auth::guard('admin')->user()->id;
        $pegawai = Pegawai::where('id_admin',$idAdmin)->first();
        $pegawai->status = $request->customRadio;
        $pegawai->save();

        return redirect()->back()->with(['success' => 'Status Berhasil Di Ubah']);
    }

    public function gantiJabatan()
    {
        $pegawai = Pegawai::orderBy('nama_pegawai', 'DESC')->where('jabatan', '!=', 'disactive')->get();

        return view('pages/auth/admin/manajemen-akun/ganti-jabatan', compact('pegawai'));
    }

    public function updateJabatan(Request $request)
    {
        $request->validate([
            'pegawai' => "required|exists:tb_pegawai,id",
            'jabatan' => "required|exists:tb_pegawai,jabatan",
        ],
        [
            'pegawai.required' => "Pegawai wajib dipilih",
            'pegawai.exists' => "Nama pegawai tidak tersedia",
            'jabatan.required' => "Jabatan pegawai wajib dipilih",
            'jabatan.exists' => "Jabatan pegawai tidak tersedia",
        ]);

        $pegawai = Pegawai::where('id', $request->pegawai)->update([
            'jabatan' => $request->jabatan
        ]);

        if ($pegawai) {
            return redirect()->back()->with(['success' => 'Jabatan Pegawai Berhasil Diubah']);
        } else {
            return redirect()->back()->with(['failed' => 'Jabatan Pegawai Gagal Diubah']);
        }
    }
}
